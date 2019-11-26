<?php

require("../pdo.php");
require("../functions.php");
$userId = filter_input(INPUT_GET, 'userId');

session_start();
$_SESSION['userId'] = $userId;
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <style>
            table {
                border-collapse: collapse;
                width: auto;
                color: #fff;
                background: rgba(0, 0, 0, 0.5);
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid black;
                font-size: 20px;
            }
            h1 {
                margin: 0;
                padding: 0 0 20px;
                text-align: center;
                font-size: 35px;
            }
           button {
                border: none;
                outline: none;
                height: 40px;
                /*background: #1c8adb;*/
                color: #fff;
                font-size: 18px;
                border-radius: 20px;
            }
        </style>
        <title>Display Data</title>
    </head>
    <body>
    <h1> Questions of  <?php echo get_username($userId);
        $questionHistory = get_questions($userId);
        ?></h1>

    <button type="submit"><a href="../Question-Form/index.html">Ask a question</a></button>
    <p></p>
        <table class="table table-bordered">
            <tr>
                <th>TITLE</th>
                <th>BODY</th>
                <th>SKILLS</th>
            </tr>
            <?php foreach($questionHistory as $question) : ?>
            <tr>
                <td><?php echo $question['title']; ?></td>
                <td><?php echo $question['body']; ?></td>
                <td><?php echo $question['skills']; ?></td>
            </tr>
            <?php endforeach;?>
        </table>
    <p><button type="submit"><a href="../Login-Form/index.html">Logout</a></button></p>
    </body>
</html>

