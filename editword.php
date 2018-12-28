<?php
require_once("includes/common.inc.php");

//HTML Head
include("includes/head.inc.php");

//Website Header
include("includes/header.inc.php");

//Get the word to edit from url
$word = mysqli_real_escape_string($db, $_GET['q']);

//SQL Query string
$sql = "SELECT * FROM `dict_words` WHERE `word`='". $word ."'";

if (!$result = $db->query($sql)) {
    // Oh no! The query failed.
    echo "Sorry, the website is experiencing problems.";

    // Only show debug stuff in debug mode
    if(DEBUG_MODE) {
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $db->errno . "\n";
        echo "Error: " . $db->error . "\n";
    }
    exit;
}

?>
<!--<div id="content">-->
<!--    <div id="inner">-->
<!--        --><?php
//        //TODO Add references and citations
//        while ($wordArray = $result->fetch_assoc()): ?>
<!--            <form action='backend/edit_data.php' method='post' enctype='multipart/form-data'>-->
<!--                Word: </br><input class='input' name='Trigedasleng' type='text' value='--><?//=$wordArray['word']?><!--'><br>-->
<!--                Translation: </br><textarea class='textarea' name='Translation' type='text'>--><?//=$wordArray['translation']?><!--</textarea><br>-->
<!--                Etymology: </br><textarea class='textarea' name='Etymology' type='text'>--><?//=$wordArray['etymology']?><!--</textarea><br>-->
<!--                Example: </br><textarea class='textarea' name='Example' type='text'>--><?//=$wordArray['example']?><!--</textarea><br>-->
<!--                Notes: </br><textarea class='textarea' name='Note' type='text'>--><?//=$wordArray['note']?><!--</textarea><br>-->
<!--                <input type='submit' value='Submit'><br><br><br>-->
<!--            </form>-->
<!--        --><?php //endwhile; ?>
<!--    </div>-->
<!--</div>-->

<?php include('includes/footer.inc.php') ?>