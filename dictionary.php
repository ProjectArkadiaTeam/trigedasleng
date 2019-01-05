<?php
require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");
?>
<!--Char selector to quick jump to section-->
<div class="alphabet-selector">
    <?php //I didn't want to write them all my self, so quick loop to echo them out with php
    foreach (range('A', 'Z') as $char) {
        echo '<a href="#'.$char.'" id="abc">'. $char .'</a>';
    }
    ?>
</div>
<div class="dictionary">
    <h1>Dictionary</h1>
    <?php foreach (range('a', 'z') as $char):
        $sql = "SELECT * FROM `dict_words` WHERE `word` LIKE '$char%'";
        if (!$result = $db->query($sql)) {
            echo 'Sorry, the website is experiencing problems.';
            exit;
        }
        ?>
        <h2 id="<?=strtoupper($char)?>"><?=strtoupper($char)?></h2>
        <?php while ($word = $result->fetch_assoc()):
            $link = 'word?q='.$word['word'];        //Link to more information page
            $translation = $word['translation'];    //The word in gonasleng
            $etymology = $word['etymology'];        //Etymology of the word
        ?>

            <div class="entry">
            <h3><b><a href="<?=$link?>"><?=$word['word']?></a></b></h3>
            <p class="definition"><?=$translation?></p>
            <p class="etymology"><?=$etymology?></p></div>
        <?php endwhile; ?>
    <?php endforeach; ?>
</div>
<?php require_once('includes/footer.inc.php') ?>

