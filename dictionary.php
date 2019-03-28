<?php
require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");

//Website Sidebar
require_once("includes/sidebar.inc.php");


//Filter Stuff
$filter = $_GET['filter'];
$filterTerms = explode(' ', $filter);
$filterTermBits = array();
foreach ($filterTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $filterTermBits[] = "`filter` RLIKE '[[:<:]]".$term."[[:>:]]'";
    }
}
?>
<!--Char selector to quick jump to section-->
<div class="alphabet-selector">
    <?php //I didn't want to write them all my self, so quick loop to echo them out with php
    foreach (range('A', 'Z') as $char) {
        echo '<a href="#'.$char.'" id="abc">'. $char .'</a>';
    }
    ?>
</div>
<div class="dictionary" id="content" style="margin-top: 120px;">
    <h1>Dictionary</h1>
    <?php
    $sql = "SELECT * FROM `dict_words` WHERE ".implode(' AND ', $filterTermBits)." ORDER BY `word`";
    $current_char = 'a';

    if (!$result = $db->query($sql)) {
        if(DEBUG_MODE){
            echo 'Failed To Connect To Database: '.mysqli_connect_errno().': '.mysqli_connect_error();
        }
        echo 'Sorry, the website is experiencing problems.';
        exit;
    }
    echo '<h2 id="' . strtoupper($current_char) . '">' . strtoupper($current_char) . '</h2>';
    while ($word = $result->fetch_assoc()):
        $link = 'word?q='.$word['word'];        //Link to more information page
        $translation = $word['translation'];    //The word in gonasleng
        $etymology = $word['etymology'];        //Etymology of the word
        if(strtolower($word['word'])[0] != $current_char){
            $current_char = strtolower($word['word'])[0];
            echo '<h2 id="' . strtoupper($current_char) . '">' . strtoupper($current_char) . '</h2>';
        }
        ?>
        <div class="entry">
        <h3><b><a href="<?=$link?>"><?=strtolower($word['word'])?></a></b></h3>
        <p class="definition"><?=$translation?></p>
        <p class="etymology"><?=$etymology?></p></div>
    <?php endwhile; ?>
</div>

<!--Fix for header link overshooting -->
<script>
    (function($, window) {
        var adjustAnchor = function() {

            var $anchor = $(':target'),
                fixedElementHeight = 120;

            if ($anchor.length > 0) {
                $('html, body')
                    .stop()
                    .animate({
                        scrollTop: $anchor.offset().top - fixedElementHeight
                    }, 0);
            }
        };

        $(window).on('hashchange load', function() {
            adjustAnchor();
        });

    })(jQuery, window);
</script>
<?php require_once('includes/footer.inc.php') ?>

