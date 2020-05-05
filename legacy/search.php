<?php
require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");

//Website Sidebar
require_once("includes/sidebar.inc.php");

$query = mysqli_real_escape_string($db, $_GET['q']);
$words_query = "SELECT * FROM `dict_words` WHERE (`word` LIKE '%".$query."%') OR (`translation` LIKE '%".$query."%')";
$translation_query = "SELECT * FROM `dict_translations` WHERE (`trigedasleng` LIKE '%".$query."%') OR (`translation` LIKE '%".$query."%')";
$words_result = $db->query($words_query);
$translation_result = $db->query($translation_query);
?>

<div id="content">
    <div id="inner">

        <?php if(mysqli_num_rows($words_result) < 0 && mysqli_num_rows($translation_result) < 0) : ?>
            echo 'No results found. Try again...';
        <?php else: ?>
            <h2>Words matching your search</h2>
            <div class="dictionary">
            <?php while($info = mysqli_fetch_assoc($words_result)): ?>
            <div class="entry">
                <h3><b><a href="<?='word?q='.$info['word']?>"><?=$info['word']?></a></b></h3>
                <p class="definition"><?=$info['translation']?></p>
                <p class="etymology"><?=$info['etymology']?></p>
                <?php if (\strpos($info['filter'], 'noncanon') !== false): ?>
                    <i class="noncanon-warning">!!Not a canon word</i>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
            </div>
            <h2>Translations matching your search</h2>
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
        <?php endif; ?>
    </div>
</div>
<?php require_once('includes/footer.inc.php') ?>
