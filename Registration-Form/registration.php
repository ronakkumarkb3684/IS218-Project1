<?php
//define variable for the empty values
//$firstNameErr = $lastNameErr = "";
require("../pdo.php");
//session_start();

//$email = $_SESSION['email'];
//Get values from the input
$firstName = filter_input(INPUT_POST, 'first-name');
$lastName = filter_input(INPUT_POST, 'last-name');
$birthDay = filter_input(INPUT_POST, 'birthday');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'new-password');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formValid=true;
    if (empty($firstName)) {
        $firstNameErr = "First Name is required";
        $formValid=false;
    }
    if (empty($lastName)){
        $lastNameErr = "Last Name is required";
        $formValid=false;
    }
    if (empty($birthDay)){
        $birthDayErr = "Birth Date is required";
        $formValid=false;
    }
    if (empty($email)) {
        $emailErr = "EMAIL is required";
        $formValid=false;
    } elseif ($double_check === false) {
        $emailErr = "not a valid EMAIL";
        $formValid=false;
    }
    if (empty($password)){
        $passwordErr = "PASSWORD is required";
        $formValid=false;
    } elseif (strlen($password) <= 8){
        $passwordErr = "please make sure your PASSWORD is at least 8 characters";
        $formValid=false;
    }
    if($formValid==true){
        //sql query
        $query = 'INSERT INTO accounts
                (email, fname, lname, birthday, password)
              VALUES
                (:email, :fname, :lname, :birthday, :password)';

        // Create PDO Statement
        $statement = $db->prepare($query);

        //binding the values to sql
        $statement->bindValue(':email', $email);
        $statement->bindValue(':fname', $firstName);
        $statement->bindValue(':lname', $lastName);
        $statement->bindValue(':birthday', $birthDay);
        $statement->bindValue(':password', $password);

        // Execute the SQL Query
        $statement->execute();
        // Close the database
        $statement->closeCursor();

        header('Location: ../Login-Form/index.html');
    }
}
?>

<html>
    <style>
        .error {color: #FF0000;}
    </style>
    <head><title>Registration Data</title></head>
    <body>
        <h1>The User Data</h1>
        <div>
            First Name = <?php echo $firstName; ?>
            <span <span class="error"><?php echo $firstNameErr;?></span>
        </div>
        <div>
            Last Name = <?php echo $lastName; ?>
            <span <span class="error"><?php echo $lastNameErr;?></span>
        </div>
        <div>
            Birthday = <?php echo $birthDay; ?>
            <span <span class="error"><?php echo $birthDayErr;?></span>
        </div>
        <div>
            Email = <?php echo $email; ?>
            <span <span class="error"><?php echo $emailErr;?></span>
        </div>
        <div>
            Password = <?php if (!$passwordErr) echo $password; ?>
            <span <span class="error"><?php echo $passwordErr;?></span>
        </div>
    </body>
</html>


