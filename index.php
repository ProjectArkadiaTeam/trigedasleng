<?php
require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");

//Website Sidebar
require_once("includes/sidebar.inc.php");

$random_word = $db->query("SELECT * FROM `dict_words` ORDER BY RAND() LIMIT 1")->fetch_assoc();
$random_translation = $db->query("SELECT * FROM `dict_translations` ORDER BY RAND() LIMIT 1")->fetch_assoc();
$recent_words = $db->query("SELECT * FROM `dict_words` ORDER BY id DESC LIMIT 10");

//Translation
$link = 'translation?q='.$random_translation['trigedasleng'];
$trigedasleng = explode(" ", $random_translation['trigedasleng']);
$translation = $random_translation['translation'];
$etymology = explode(" ", $random_translation['etymology']);
$leipzig = explode(" ", $random_translation['leipzig']);
$audio = $random_translation['audio'];
?>
<div id="content">
    <div id="inner">
        <div class="home">
            <div class="column side">
                <h3>Recently Added</h3>
                <ul>
                    <?php while ($word = $recent_words->fetch_assoc()):?>
                    <li><a href="<?='word?q='.$word['word']?>"><?=$word['word']?></a></li>
                    <?php endwhile;?>
                </ul>
            </div>
            <div class="column center">

                <!--About-->
                <div class="daily">
	                <h3>About this website</h3>
                    <p>
                        This website is an attempt at recreating what was Trigedasleng.info after it went dark in december 2018.
                    </p>
                </div>

                <!--Word of the day-->
                <div class="daily">
	                <h3>Random Word</h3>
                    <div class="dictionary entry" style="width:100%">
                        <h4><b><a href="#"><?=$random_word['word']?></a></b></h4>
                        <p class="definition"><?=$random_word['translation']?></p>
                        <p class="etymology"><?=$random_word['etymology']?></p>
                    </div>
                </div>

                <!--Translation of the day-->
                <div class="daily">
	                <h3>Random Translation</h3>
<!--                    <p><a href="#">--><?//=$random_translation['trigedasleng']?><!--</a></p>-->
                    <div class="translations entry unflagged">
                        <table class="gloss">
                            <tbody><tr class="tgs_text"><td colspan="10"><a href="#"><?=strip_tags($random_translation['trigedasleng'])?></a></td></tr>
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
                        <?php if($audio != ""):?>
                            <audio controls="" preload="none">
                                <source src="<?=$audio?>" type="audio/mpeg">
                            </audio>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="column side">
                <h3>Resources:</h3>
                <ul id="resources">
                    <li><a href="https://en.wikipedia.org/wiki/Trigedasleng">Trigedasleng on Wikipedia</a></li>
                    <li><a href="https://dedalvs.tumblr.com/tagged/Trigedasleng">Dedalvs Tumblr</a></li>
                    <li><a href="http://dedalvs.com/work/the-100/trigedasleng_master_dialogue.pdf">Transcripts of Trig lines in the show</a></li>
                    <li><a href="http://www.memrise.com/course/957902/trigedasleng/">Memrise course</a></li>
                    <li><a href="https://www.youtube.com/watch?v=JCoxlcHn7SQ&list=PLrk1St_BRZTFrhOYsz2KRS_fZ9ZzTavrq">Slakkru's Learn Trigedasleng videos </a></li>
                    <li><a href="http://slakgedakru.tumblr.com/">Slakgedakru</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require_once("includes/footer.inc.php");

