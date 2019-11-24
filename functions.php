<?php
function get_username($userid){
    global $db;
    $query = 'SELECT fname, lname FROM accounts where id=:userid';
    $statement = $db->prepare($query);
    $statement->bindValue(':userid', $userid);
    // Execute the SQL Query
    $statement->execute();
    $names=$statement->fetch();
    // Close the database
    $statement->closeCursor();
    $firstName=$names['fname'];
    $secondName=$names['lname'];

    return $firstName . ' ' .$secondName;
}

function get_questions($userid){
    global $db;
    $query = 'SELECT * FROM questions where ownerid=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $userid);
    // Execute the SQL Query
    $statement->execute();
    $question=$statement->fetchAll();
    // Close the database
    $statement->closeCursor();

    return $question;
}
