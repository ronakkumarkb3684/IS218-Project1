<?php
//define variable for the empty values
$emailErr = $passwordErr = "";

 //Get values from the input
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$double_check = strpos($email, '@');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    <head><title>Login Data</title></head>
    <body>
        <h1>User Inputs</h1>
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
