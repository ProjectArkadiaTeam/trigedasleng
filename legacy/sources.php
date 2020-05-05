<?php
require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");

//Website Sidebar
require_once("includes/sidebar.inc.php");

$sql = "SELECT * FROM `dict_sources`";
if (!$result = $db->query($sql)) {
    // Oh no! The query failed.
    echo "Sorry, the website is experiencing problems.";
    exit;
}
?>
    <div id="content">
        <div id="inner">
            <h1>All Sources</h1>
            <?php while ($info = $result->fetch_assoc()):

                // Only show id to admins
                $id = "";
                if(isset($_SESSION['admin']) && $_SESSION['admin'] == '1'){
                    $id = "<i>ID#{$info['id']} - </i> ";
                }

                $author = $info['author'];
                $date = $info['date'];
                $title = $info['title'];
                $url = $info['url'];
                ?>
                <p class="entry" id="2014-11-06-01">
                    <?php echo "$id$author ($date) <a href=\"$url\">$title</a>" ?>
                </p>
            <?php endwhile; ?>
        </div>
    </div>
<?php require_once("includes/footer.inc.php");

