<?php
require_once('../includes/common.inc.php');

//Sanitizing input data
$trig = mysqli_real_escape_string($db, $_POST['Trigedasleng']);
$translation = mysqli_real_escape_string($db, $_POST['Translation']);
$example = mysqli_real_escape_string($db, $_POST['Example']);
$note = mysqli_real_escape_string($db, $_POST['Note']);
$etymology = mysqli_real_escape_string($db, $_POST['Etymology']);

$sql = "UPDATE `dict_words` SET `translation`='".$translation."', `etymology`='".$etymology."', `example`='".$example."', `note`='".$note."' WHERE `word`='".$trig."'";
if (!$result = $db->query($sql)) {
    // Oh no! The query failed.
    echo "Sorry, the website is experiencing problems.";

    //Only show debug stuff if we are running in debug mode
    if(DEBUG_MODE) {
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $db->errno . "\n";
        echo "Error: " . $db->error . "\n";
    }
    exit;
}

//Redirect back to original page
header("Location: https://projectarkadia.com/trigedasleng/word.php?q=".$trig."");
die();
