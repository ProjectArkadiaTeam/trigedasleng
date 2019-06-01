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

//Sources
$source_query = "SELECT * FROM `dict_sources` WHERE `id`='$info[citations]'";
$source_result = $db->query($source_query);
$source_info = $source_result->fetch_assoc();

$trig = $info['word'];
$translation = $info['translation'];
$etymology = $info['etymology'];
$example = $info['example'];
$note = $info['note'];
$filter = $info['filter'];
$id = $info['id'];

$status = "";

//Edit word
if(isset($_POST['action']) && $_POST['action']=="editword"){
    $trig = mysqli_real_escape_string($db,$_REQUEST['trig']);
    $translation = mysqli_real_escape_string($db,$_REQUEST['translation']);
    $etymology = mysqli_real_escape_string($db,$_REQUEST['etymology']);
    $dictionary = mysqli_real_escape_string($db,$_REQUEST['dictionary']);
    $source = mysqli_real_escape_string($db,$_REQUEST['source']);
    $id = mysqli_real_escape_string($db,$_REQUEST['id']);

    $query = "UPDATE `dict_words` SET 
        `word`='$trig', 
        `translation`='$translation', 
        `etymology`='$etymology', 
        `citations`='$source', 
        `filter`='$dictionary' 
        WHERE `id`='$id'";


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
    $status = "Updated word successfully!";
    header("Location: ?q=$trig");
}

?>

<?php
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] == "1";
if(!isset($_GET['action']) || !$isAdmin)
{
    defaultPage();
    exit;
}

if($_GET['action'] == "edit" && $isAdmin){
    editPage();
    exit;
}
?>
<?php function editPage() {
    global $trig, $translation, $etymology, $source_info, $status, $filter, $id
?>
    <div id="content">
        <div id="inner">
            <div id="admin-form">
                <h1>Edit <?=$trig?></h1>
                <form name="form" method="post" action="">
                    <input type="hidden" name="action" value="editword" />
                    <input type="hidden" name="id" value="<?=$id?>" />
                    <strong>Word</strong><br>
                    <input type="text" name="trig" placeholder="Enter Word (in trig)" value="<?=$trig?>" required /><br>
                    <strong>Translation</strong><br>
                    <input type="text" name="translation" placeholder="Enter Translation" value="<?=$translation?>" required /><br>
                    <strong>Etymology</strong><br>
                    <input type="text" name="etymology" placeholder="Enter Etymology" value="<?=$etymology?>"/><br>
                    <strong>Dictionary</strong><br>
                    <input type="text" name="dictionary" placeholder="Enter Dictionaries" value="<?=$filter?>"/><br>
                    <strong>Source? (use #id from <a href="./sources">Sources</a>)</strong><br>
                    <input type="text" name="source" placeholder="Enter #ID" value="<?=$source_info['id']?>" /><br>
                    <p><input name="submit" type="submit" value="Submit" /></p>
                </form>
                <p style="color:#FF0000;"><?php echo $status; ?></p>
            </div>
        </div>
    </div>
<?php }?>

<?php function defaultPage() {
global $trig, $translation, $etymology, $note, $translation_result, $source_info, $isAdmin
?>
<div id="content">
    <div id="inner">
<!--        <div class="dictionary entry">-->
            <h1><?=$trig?>
                <?php if($isAdmin): ?>
                    <a style="border-bottom: none;" href="?q=<?=$trig?>&action=edit"><i class="far fa-edit"></i></a>
                <?php endif;?>
            </h1>
            <p class="definition"><?=$translation?></p>
            <p class="etymology"><?=$etymology?></p>
            <p class="example"><strong>Examples:</strong></p>
            <div class="translations">
            <?php while($info = mysqli_fetch_assoc($translation_result)):
                $trigedasleng = explode(" ", $info['trigedasleng']);
                $translation = $info['translation'];
                $etymology = explode(" ", $info['etymology']);
                $leipzig = explode(" ", $info['leipzig']);
                $audio = $info['audio'];
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
                    <?php if($audio != ""):?>
                        <audio controls="">
                            <source src="<?=$audio?>" type="audio/mpeg">
                        </audio>
                    <?php endif;?>
                </div>
                </br>
            <?php endwhile; ?>
            </div>
            <p class="notes"><?=$note?></p>

            <h3 class="citations">Source:</h3>
            <ul class="citations">
                <li><a href="<?=$source_info['url']?>"><?=$source_info['title']?></a></li>
            </ul>
<!--            <div class="comment-form-container">-->
<!--                <form id="frm-comment">-->
<!--                    <div class="input-row">-->
<!--                        <input type="hidden" name="comment_id" id="commentId" placeholder="Name" />-->
<!--                        <input class="input-field" type="text" name="name" id="name" placeholder="Name" />-->
<!--                    </div>-->
<!--                    <div class="input-row">-->
<!--                <textarea class="input-field" type="text" name="comment" id="comment" placeholder="Add a Comment">  </textarea>-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <input type="button" class="btn-submit" id="submitButton" value="Publish" />-->
<!--                        <div id="comment-message">Comments Added Successfully!</div>-->
<!--                    </div>-->
<!---->
<!--                </form>-->
<!--            </div>-->
            <div id="output"></div>
<!--        </div>-->
    </div>
</div>
<!--<script src="./js/comments.js"></script>-->
<?php }?>
<?php require_once('includes/footer.inc.php') ?>
