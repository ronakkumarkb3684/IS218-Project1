<?php

//includes PDO
require("../pdo.php");
//session_start();

//$email = $_SESSION['email'];

//define variable for the empty values
$emailErr = $passwordErr = "";

 //Get values from the input
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$double_check = strpos($email, '@');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formValid=true;
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
        $query = "SELECT * FROM accounts WHERE email = :email AND password = :password";

        // Create PDO Statement
        $statement = $db->prepare($query);

        //binding the values to sql
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        // Execute the SQL Query
        $statement->execute();
        // fetchAll
        $accounts=$statement->fetchAll();
        // Close the database
        $statement->closeCursor();

        if(count($accounts)>0){
            $userId = $accounts[0]['id'];
            header("Location: ../Question-List/question-list.php?userId=$userId");
        } else{
            header('Location: ../Registration-Form/index.html');
        }
    }
}
?>

<html>
<style>
    .error {color: #FF0000;}
</style>
    <head><title>Login Data</title></head>
    <body>
        <form>
            <h1>User Inputs</h1>
            <div>
                Email = <?php echo $email; ?>
                <span <span class="error"><?php echo $emailErr;?></span>
            </div>
            <div>
                Password = <?php if (!$passwordErr) echo $password; ?>
                <span <span class="error"><?php echo $passwordErr;?></span>
            </div>
        </form>
    </body>
</html>
