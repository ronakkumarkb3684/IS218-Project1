<?php

//Get values from the input
$QuestionName = filter_input(INPUT_POST, 'Question-name');
$QuestionBody = filter_input(INPUT_POST, 'Question-body');
$QuestionSkills = filter_input(INPUT_POST, 'Question-skills');

$CheckSkills = explode(',', $QuestionSkills);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($QuestionName)) {
        $QuestionErr = "Question name is required";
    } elseif(strlen($QuestionName) < 3) {
        $QuestionErr = "Please make sure the question name is atleast 3 characters";
    }
    if (empty($QuestionBody)) {
        $BodyErr = "Question body is required";
    } elseif (strlen($QuestionBody) >= 500){
        $BodyErr ="Please make sure the question body is less than 500 characters";
    }
    if (empty($QuestionSkills)){
        $skillsErr = "Please enter a skill";
    } elseif (count($CheckSkills) < 2) {
        $skillsErr = "Please enter 2 or more skills";
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


