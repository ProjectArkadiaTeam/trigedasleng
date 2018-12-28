<?php
require_once("includes/common.inc.php");

//HTML Head
include("includes/head.inc.php");

//Website Header
include("includes/header.inc.php");

$word = mysqli_real_escape_string($db, $_GET['q']);
$sql = "SELECT * FROM `dict_words` WHERE `word`='". $word ."'";
$result = $db->query($sql);
$info = $result->fetch_assoc();

$trig = $info['word'];
$translation = $info['translation'];
$etymology = $info['etymology'];
$example = $info['example'];
$note = $info['note'];

?>

<div id="content">
    <div id="inner">
        <div class="dictionary entry">
            <h1><?=$trig?></h1>
            <p class="definition"><?=$translation?></p>
            <p class="etymology"><?=$etymology?></p>
            <p class="example"><strong>Example:</strong><?=$example?></p>
            <p class="notes"><?=$note?></p>

            <h3 class="citations">Citations:</h3>
            <ul class="citations">
                <li><a href="$link">$text</a></li>
            </ul>
            <a href="editword?q=<?=$trig?>">Edit Information</a>
        </div>
    </div>
</div>
<?php include('includes/footer.inc.php') ?>
