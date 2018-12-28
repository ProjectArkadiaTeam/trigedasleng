<?php
require_once("includes/common.inc.php");

//HTML Head
include("includes/head.inc.php");

//Website Header
include("includes/header.inc.php");

?>
<div id="content">
    <div id="inner">
        <div class="translations">
            <h1>Translations</h1>
        <?php
        $sql = "SELECT * FROM `dict_translations`";
        if (!$result = $db->query($sql)) {
            // Oh no! The query failed.
            echo "Sorry, the website is experiencing problems.";
            exit;
        }
        ?>
        <?php while ($trig = $result->fetch_assoc()): ?>
        <?php
        $link = 'translation?q='.$trig['trigedasleng'];
        $trigedasleng = $trig['trigedasleng'];
        $translation = $trig['translation'];
        $etymology = $trig['etymology'];
        $leipzig = $trig['leipzig'];
        ?>
        <div class="entry unflagged">
            <table class="gloss">
                <tbody><tr class="tgs_text"><td colspan="10"><a href="#"<?=strip_tags($trigedasleng)?></i></a></td></tr>
                    <tr class="tgs" style="display: table-row;">
                        <?=$trigedasleng?>
                    </tr>
                    <tr class="ety" style="display: table-row;">
                        <?=$etymology?>
                    </tr>
                    <tr class="leipzig" style="display: table-row;">
                        <?=$leipzig?>
                    </tr>
                    <tr class="en_text">
                        <td colspan="10"><?=$translation?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php endwhile; ?>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php') ?>