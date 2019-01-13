<?php
require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");

//Website Sidebar
require_once("includes/sidebar.inc.php");
$episode_names = [
    "0201" => "0201: The 48",
    "0202" => "0202: Inclement Weather",
    "0203" => "0203: Reapercussions",
    "0204" => "0204: Many happy returns",
    "0205" => "0205: Human Trials",
    "0206" => "0206: Fog of War",
    "0207" => "0207: Long Into An Abyss",
    "0208" => "0208: Spacewalker",
    "0209" => "0209: Remember Me",
    "0210" => "0210: Survival of the Fittest",
    "0211" => "0211: Coup de Grace",
    "0212" => "0212: Rubicon",
    "0213" => "0213: Resurrection",
    "0214" => "0214: Bodyguard of Lies",
    "0215" => "0215: Blood Must Have Blood: Part 1",
    "0216" => "0216: Blood Must Have Blood: Part 2",
    "0301" => "0301: Wanheda: Part 1",
    "0302" => "0302: Wanheda: Part 2",
    "0303" => "0303: Ye Who Enter Here",
    "0304" => "0304: Watch The Throne",
    "0305" => "0305: Hakeldama",
    "0306" => "0306: Bitter Harvest",
    "0307" => "0307: Thirteen",
    "0308" => "0308: Terms And Conditions",
    "0309" => "0309: Stealing Fire",
    "0310" => "0310: Fallen",
    "0311" => "0311: Nevermore",
    "0312" => "0312: Demons",
    "0313" => "0313: Join or Die",
    "0314" => "0314: Red Sky at Morning",
    "0315" => "0315: Perverse Instantiation: Part 1",
    "0316" => "0316: Perverse Instantiation: Part 2",
    "0401" => "0401: Echoes",
    "0402" => "0402: Heavy Lies the Crown",
    "0403" => "0403: The Four Horsemen",
    "0404" => "0404: A Lie Guarded",
    "0405" => "0405: The Tinder Box",
    "0406" => "0406: We Will Rise",
    "0407" => "0407: Gimme Shelter",
    "0408" => "0408: God Complex",
    "0409" => "0409: DNR",
    "0410" => "0410: Die all, Die Merrily",
    "0411" => "0411: The Other Side",
    "0412" => "0412: The Chosen",
    "0413" => "0413: Praimfaya",
    "other" => "Other Translations"
];

?>
<div id="content">
    <div id="inner">
        <div class="translations">
            <h1>Translations</h1>
            <?php foreach ($episode_names as $number => $name):
                $sql = "SELECT * FROM `dict_translations` WHERE `episode`='".$number."'";
                if (!$result = $db->query($sql)) {
                    // Oh no! The query failed.
                    echo "Sorry, the website is experiencing problems.";
                    exit;
                }
                ?>
                <h2 class="<?=$number?>"><?=$name?></h2>
                <?php while ($trig = $result->fetch_assoc()):
                    $link = 'translation?q='.$trig['trigedasleng'];
                    $trigedasleng = explode(" ", $trig['trigedasleng']);
                    $translation = $trig['translation'];
                    $etymology = explode(" ", $trig['etymology']);
                    $leipzig = explode(" ", $trig['leipzig']);
                    $audio = $trig['audio'];
                    ?>
                    <div class="entry unflagged">
                        <table class="gloss">
                            <tbody><tr class="tgs_text"><td colspan="10"><a href="#"><?=strip_tags($trig['trigedasleng'])?></a></td></tr>
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
                    <div class="line"></div>
                <?php endwhile; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once('includes/footer.inc.php') ?>