<?php

require("../pdo.php");
require("../functions.php");
$userId = filter_input(INPUT_GET, 'userId');
?>

<html>
   <style>
       table {
           border-collapse: collapse;
           width: auto;
       }

       th, td {
           padding: 8px;
           text-align: left;
           border-bottom: 1px solid black;
       }
       h1{
           margin: 0;
           padding: 0 0 20px;
           text-align: center;
           font-size: 35px;
       }
       .p input[type="submit"]{
           border: none;
           outline: none;
           height: 40px;
           background: #1c8adb;
           color: #fff;
           font-size: 18px;
           border-radius: 20px;
       }
    </style>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css">
        <title>Display Data</title>
    </head>
    <body>
    <h1> Questions of  <?php echo get_username($userId);
        $questionHistory = get_questions($userId);
        ?></h1>

    <p><button type="submit"><a href="../Question-Form/index.html">Ask a question</a></button></p>
        <table align="center">
            <tr>
                <th>Title</th>
                <th>body</th>
                <th>skills</th>
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

