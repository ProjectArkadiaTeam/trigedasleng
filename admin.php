<?php
require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");

//Website Sidebar
require_once("includes/sidebar.inc.php");

//Not admin?
if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != "1") {
    header("Location: https://trigedasleng.net/");
}

$status = "";

//Create new word
if(isset($_POST['action']) && $_POST['action']=="addword"){
    $trig = mysqli_real_escape_string($db,$_REQUEST['trig']);
    $class = mysqli_real_escape_string($db,$_REQUEST['class']);
    $translation = mysqli_real_escape_string($db,$_REQUEST['translation']);
    $etymology = mysqli_real_escape_string($db,$_REQUEST['etymology']);
    $dictionary = mysqli_real_escape_string($db,$_REQUEST['dictionary']);
    $source = mysqli_real_escape_string($db,$_REQUEST['source']);

    // Add slaksleng to noncanon as well
    if($dictionary == "slakgedasleng")
        $dictionary = "slakgedasleng" . " noncanon";

    $translation = $class . ": " . $translation;
    $etymology = "from: " . $etymology;

    $query = "INSERT INTO `dict_words` (`word`,`translation`,`etymology`,`citations`,`filter`) VALUES  ('$trig','$translation','$etymology','$source','$dictionary')";
    if (!$result = $db->query($query)) {
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
    $status = "New Word Inserted Successfully";
}

//Create new translation
if(isset($_POST['action']) && $_POST['action']=="addtranslation"){
    $trig = mysqli_real_escape_string($db,$_REQUEST['trig']);
    $translation = mysqli_real_escape_string($db,$_REQUEST['translation']);
    $etymology = mysqli_real_escape_string($db,$_REQUEST['etymology']);
    $leipzig = mysqli_real_escape_string($db,$_REQUEST['leipzig']);
    $episode = mysqli_real_escape_string($db,$_REQUEST['episode']);
    $speaker = mysqli_real_escape_string($db,$_REQUEST['speaker']);
    $audio = mysqli_real_escape_string($db,$_REQUEST['audio']);
    $source = mysqli_real_escape_string($db,$_REQUEST['source']);

    $query = "INSERT INTO `dict_translations` (`trigedasleng`,`translation`,`etymology`,`leipzig`,`episode`,`audio`,`speaker`,`source`)
              VALUES  ('$trig','$translation','$etymology','$leipzig','$episode','$audio','$speaker','$source')";

    if (!$result = $db->query($query)) {
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
    $status = "New Translation Inserted Successfully";
}
?>

<? // Add / Edit Word ?>
<?php if($_GET["action"] == "addword"): ?>
    <div id="content">
        <div id="inner">
        <div id="admin-form">
            <h1>Add new word</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="action" value="addword" />
                <strong>Word</strong><br>
                <input type="text" name="trig" placeholder="Enter Word (in trig)" required /><br>
                <strong>Translation</strong><br>
                <input type="text" name="translation" placeholder="Enter Translation" required /><br>
                <strong>Classification</strong><br>
                <select name="class">
                    <option value="none">none</option>
                    <option value="noun">noun</option>
                    <option value="pronoun">pronoun</option>
                    <option value="verb">verb</option>
                    <option value="adjective">adjective</option>
                    <option value="adverb">adverb</option>
                    <option value="conjunction">conjunction</option>
                    <option value="preposition">preposition</option>
                    <option value="interjection">interjection</option>
                </select><br>
                <strong>Etymology</strong><br>
                <input type="text" name="etymology" placeholder="Enter Etymology" /><br>
                <strong>Dictionary</strong><br>
                <select name="dictionary">
                    <option value="canon">Canon</option>
                    <option value="slakgedasleng">Slakgedasleng</option>
                    <option value="noncanon">Noncanon</option>
                </select><br>
                <strong>Source?</strong><br>
                <input type="text" name="source" placeholder="Enter URL" /><br>
                <p><input name="submit" type="submit" value="Submit" /></p>
            </form>
            <p style="color:#FF0000;"><?php echo $status; ?></p>
        </div>
        </div>
    </div>
<?php endif; ?>

<? // Add / Edit Word ?>
<?php if($_GET["action"] == "addtranslation"): ?>
    <div id="content">
        <div id="inner">
            <div id="admin-form">
                <h1>Add new translation</h1>
                <form name="form" method="post" action="">
                    <input type="hidden" name="action" value="addtranslation" />
                    <strong>Trigedasleng</strong><br>
                    <input type="text" name="trig" placeholder="Enter Trigedasleng" required /><br>
                    <strong>Translation</strong><br>
                    <input type="text" name="translation" placeholder="Enter Translation" required /><br>
                    <strong>Etymology</strong><br>
                    <input type="text" name="etymology" placeholder="Enter Etymology" /><br>
                    <strong>Leipzig</strong><br>
                    <input type="text" name="leipzig" placeholder="Enter Leipzig" /><br>
                    <strong>Episode (blank if 'other')</strong><br>
                    <input type="text" name="episode" placeholder="0602 => Season 6 Episode 2" /><br>
                    <strong>Speaker</strong><br>
                    <input type="text" name="speaker" placeholder="Octavia?" /><br>
                    <strong>Audio</strong><br>
                    <input type="text" name="speaker" placeholder="audio/s2/<clipname>.mp3" /><br>
                    <strong>Source?</strong><br>
                    <input type="text" name="source" placeholder="Enter URL" /><br>
                    <p><input name="submit" type="submit" value="Submit" /></p>
                </form>
                <p style="color:#FF0000;"><?php echo $status; ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php require_once("includes/footer.inc.php");

