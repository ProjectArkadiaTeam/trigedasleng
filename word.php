<?php
require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");

//Website Sidebar
require_once("includes/sidebar.inc.php");

//Word
$word = mysqli_real_escape_string($db, $_GET['q']);
$sql = "SELECT * FROM `dict_words` WHERE `word`='". $word ."'";
$result = $db->query($sql);
$info = $result->fetch_assoc();

//Examples
$translation_query = "SELECT * FROM `dict_translations` WHERE (`trigedasleng` LIKE '%".$word."%') LIMIT 3";
$translation_result = $db->query($translation_query);


$trig = $info['word'];
$translation = $info['translation'];
$etymology = $info['etymology'];
$example = $info['example'];
$note = $info['note'];


?>

<div id="content">
    <div id="inner">
<!--        <div class="dictionary entry">-->
            <h1><?=$trig?></h1>
            <p class="definition"><?=$translation?></p>
            <p class="etymology"><?=$etymology?></p>
            <p class="example"><strong>Examples:</strong></p>
            <div class="translations">
            <?php while($info = mysqli_fetch_assoc($translation_result)):
                $link = 'translation?q='.$info['trigedasleng'];
                $trigedasleng = explode(" ", $info['trigedasleng']);
                $translation = $info['translation'];
                $etymology = explode(" ", $info['etymology']);
                $leipzig = explode(" ", $info['leipzig']);
                ?>
                <div class="entry unflagged">
                    <table class="gloss">
                        <tbody><tr class="tgs_text"><td colspan="10"><a href="#"><?=strip_tags($info['trigedasleng'])?></a></td></tr>
                        <tr class="tgs" style="display: table-row;">
                            <?php foreach($trigedasleng as $word): ?>
                                <td><?=$word?></td>
                            <?php endforeach;?>
                        </tr>
                        <tr class="ety" style="display: table-row;">
                            <?php foreach($etymology as $word): ?>
                                <td><?=$word?></td>
                            <?php endforeach;?>
                        </tr>
                        <tr class="leipzig" style="display: table-row;">
                            <?php foreach($leipzig as $word): ?>
                                <td><?=$word?></td>
                            <?php endforeach;?>
                        </tr>
                        <tr class="en_text">
                            <td colspan="10"><?=$translation?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                </br>
            <?php endwhile; ?>
            </div>
            <p class="notes"><?=$note?></p>

            <h3 class="citations">Citations:</h3>
            <ul class="citations">
                <li><a href="$link">$text</a></li>
            </ul>
<!--        </div>-->
    </div>
</div>
<?php require_once('includes/footer.inc.php') ?>
