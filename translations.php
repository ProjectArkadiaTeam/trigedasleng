<?php
require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");

//Website Sidebar
require_once("includes/sidebar.inc.php");
$episode_names = [
    "0201" => "S2E01: The 48",
    "0202" => "S2E02: Inclement Weather",
    "0203" => "S2E03: Reapercussions",
    "0204" => "S2E04: Many happy returns",
    "0205" => "S2E05: Human Trials",
    "0206" => "S2E06: Fog of War",
    "0207" => "S2E07: Long Into An Abyss",
    "0208" => "S2E08: Spacewalker",
    "0209" => "S2E09: Remember Me",
    "0210" => "S2E10: Survival of the Fittest",
    "0211" => "S2E11: Coup de Grace",
    "0212" => "S2E12: Rubicon",
    "0213" => "S2E13: Resurrection",
    "0214" => "S2E14: Bodyguard of Lies",
    "0215" => "S2E15: Blood Must Have Blood: Part 1",
    "0216" => "S2E16: Blood Must Have Blood: Part 2",
    "0301" => "S3E01: Wanheda: Part 1",
    "0302" => "S3E02: Wanheda: Part 2",
    "0303" => "S3E03: Ye Who Enter Here",
    "0304" => "S3E04: Watch The Throne",
    "0305" => "S3E05: Hakeldama",
    "0306" => "S3E06: Bitter Harvest",
    "0307" => "S3E07: Thirteen",
    "0308" => "S3E08: Terms And Conditions",
    "0309" => "S3E09: Stealing Fire",
    "0310" => "S3E10: Fallen",
    "0311" => "S3E11: Nevermore",
    "0312" => "S3E12: Demons",
    "0313" => "S3E13: Join or Die",
    "0314" => "S3E14: Red Sky at Morning",
    "0315" => "S3E15: Perverse Instantiation: Part 1",
    "0316" => "S3E16: Perverse Instantiation: Part 2",
    "0401" => "S4E01: Echoes",
    "0402" => "S4E02: Heavy Lies the Crown",
    "0403" => "S4E03: The Four Horsemen",
    "0404" => "S4E04: A Lie Guarded",
    "0405" => "S4E05: The Tinder Box",
    "0406" => "S4E06: We Will Rise",
    "0407" => "S4E07: Gimme Shelter",
    "0408" => "S4E08: God Complex",
    "0409" => "S4E09: DNR",
    "0410" => "S4E10: Die all, Die Merrily",
    "0411" => "S4E11: The Other Side",
    "0412" => "S4E12: The Chosen",
    "0413" => "S4E13: Praimfaya",
    "0501" => "S5E01: Eden",
    "0502" => "S5E02: Red Queen",
    "0503" => "S5E03: Sleeping Giants",
    "0504" => "S5E04: Pandora's Box",
    "0505" => "S5E05: Shifting Sands",
    "0506" => "S5E06: Exit Wounds",
    "0507" => "S5E07: Acceptable Losses",
    "0508" => "S5E08: How We Get to Peace",
    "0509" => "S5E09: Sic Semper Tyrannis",
    "0510" => "S5E10: The Warriors Will",
    "0511" => "S5E11: The Dark Year",
    "0512" => "S5E12: Damocles – Part One",
    "0513" => "S5E13: Damocles – Part Two",
    "other" => "Other Translations"
];

?>
<div id="content">
    <div id="inner">
        <button type="button" id="toggle">Show/hide filters</button>
        <form id="filter" style="display: block;">
            <section><h3>Show/hide gloss lines</h3>
                <ul id="gloss_filter">
                    <li><input type="checkbox" name="tgs_text" value="tgs_text" onclick="filter('.tgs_text',this)">Hide episode line</li>
                    <li><input type="checkbox" name="tgs" value="tgs" onclick="filter('.tgs',this)" checked="">Hide Trigedasleng gloss</li>
                    <li><input type="checkbox" name="ety" value="ety" onclick="filter('.ety',this)" checked="">Hide etymological gloss</li>
                    <li><input type="checkbox" name="leipzig" value="leipzig" onclick="filter('.leipzig',this)" checked="">Hide Leipzig gloss</li>
                    <li><input type="checkbox" name="en_text" value="en_text" onclick="filter('.en_text',this)">Hide English text</li>
                    <li><input type="checkbox" name="en_text" value="en_text" onclick="filter('.audio',this)">Hide Audio Clip</li>
                </ul>
            </section>

            <section><h3>Hide episodes:</h3>
                <select multiple="multiple" size="10" id="episode-filter">
                    <?php foreach ($episode_names as $number => $name):?>
                        <option value="<?=$number?>" name="<?=$number?>" onclick="filter('.<?=$number?>',this)"><?=$name?></option>
                    <?php endforeach; ?>
                </select>
            </section>
        </form>
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
                    <div class="entry unflagged <?=$number?>">
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
                    <div class="line <?=$number?>"></div>
                <?php endwhile; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once('includes/footer.inc.php') ?>