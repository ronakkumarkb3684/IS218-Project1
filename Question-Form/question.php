<?php

//session_start();
//$aEmail = $_SESSION['email'];

require("../pdo.php");

//session_start();

//$email = $_SESSION['email'];
//Get values from the input
$userId = filter_input(INPUT_GET, 'userId');
$QuestionName = filter_input(INPUT_POST, 'Question-name');
$QuestionBody = filter_input(INPUT_POST, 'Question-body');
$QuestionSkills = filter_input(INPUT_POST, 'Question-skills');


$CheckSkills = explode(',', $QuestionSkills);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formValid=true;
    if (empty($QuestionName)) {
        $QuestionErr = "Question name is required";
        $formValid=false;
    } elseif(strlen($QuestionName) < 3) {
        $QuestionErr = "Please make sure the question name is atleast 3 characters";
        $formValid=false;
    }
    if (empty($QuestionBody)) {
        $BodyErr = "Question body is required";
        $formValid=false;
    } elseif (strlen($QuestionBody) >= 500){
        $BodyErr ="Please make sure the question body is less than 500 characters";
        $formValid=false;
    }
    if (empty($QuestionSkills)){
        $skillsErr = "Please enter a skill";
        $formValid=false;
    } elseif (count($CheckSkills) < 2) {
        $skillsErr = "Please enter 2 or more skills";
        $formValid=false;
    }
    if($formValid==true){

        //sql query
        $query = 'INSERT INTO questions
                (ownerid, title, body, skills)
              VALUES
                (:ownerid, :title, :body, :skills)';

        // Create PDO Statement
        $statement = $db->prepare($query);

        //binding the values to sql
        $statement->bindValue(':ownerid', $userId);
        $statement->bindValue(':title', $QuestionName);
        $statement->bindValue(':body', $QuestionBody);
        $statement->bindValue(':skills', $QuestionSkills);

        // Execute the SQL Query
        $statement->execute();
        // Close the database
        $statement->closeCursor();

        header("Location: ../Question-List/question-list.php?userId=$userId");
    }
}
?>

<html>
    <style>
        .error {color: #FF0000;}
    </style>
    <head><title>Question Data</title></head>
    <body>
        <h1>The User Data</h1>
        <div>
            Question Name = <?php if(!$QuestionErr) echo $QuestionName; ?>
            <span <span class="error"><?php echo $QuestionErr;?></span>
        </div>
        <div>
            Question Body = <?php if(!$BodyErr) echo $QuestionBody; ?>
            <span <span class="error"><?php echo $BodyErr;?></span>
        </div>
        <div>
            Question Skills = <?php if(!$skillsErr) echo $QuestionSkills; ?>
            <span <span class="error"><?php echo $skillsErr;?></span>
        </div>
    </body>
</html>


