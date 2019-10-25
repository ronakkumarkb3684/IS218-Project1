<?php
//define variable for the empty values
//$firstNameErr = $lastNameErr = "";

//Get values from the input
$firstName = filter_input(INPUT_POST, 'first-name');
$lastName = filter_input(INPUT_POST, 'last-name');
$birthDay = filter_input(INPUT_POST, 'birthday');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'new-password');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($firstName)) {
        $firstNameErr = "First Name is required";
    }
    if (empty($lastName)){
        $lastNameErr = "Last Name is required";
    }
    if (empty($birthDay)){
        $birthDayErr = "Birth Date is required";
    }
    if (empty($email)) {
        $emailErr = "EMAIL is required";
    } elseif ($double_check === false) {
        $emailErr = "not a valid EMAIL";
    }
    if (empty($password)){
        $passwordErr = "PASSWORD is required";
    } elseif (strlen($password) <= 8){
        $passwordErr = "please make sure your PASSWORD is at least 8 characters";
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


