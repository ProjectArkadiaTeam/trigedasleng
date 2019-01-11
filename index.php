<?php
require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");

//Website Sidebar
require_once("includes/sidebar.inc.php");
?>
<div id="content">
    <div id="inner">
        <div class="home">
            <div class="column side">
                <h3>Recently Added</h3>
                <ul>
                    <?php
                    echo '<li><a href=""></a></li>'
                    ?>
                </ul>
            </div>
            <div class="column center">

                <!--About-->
                <div class="daily">
	                <h3>About this website</h3>
                    <p>This website is an attempt at recreating what was Trigedasleng.info after it went dark in december 2018.
                    All credits for design and content goes to the original creators of Trigedasleng.info.
                    </p>
                </div>

                <!--Word of the day-->
                <div class="daily">
	                <h3>Word of the Day</h3>
                    <?php
                    echo '<p><a href="#">gada in</a> (verb) have, own</p>'
                    //TODO Get random word of the day
                    ?>
                </div>

                <!--Translation of the day-->
                <div class="daily">
	                <h3>Translation of the Day</h3>
                    <?php
                    //TODO Get random translation of the day
                    echo '<p><a href="#">Yu gada som in na kof op?</a></p>';
                    echo '<p>You have something to trade?</p>';
                    ?>
                </div>
            </div>
            <div class="column side">
                <h3>Resources:</h3>
                <ul>
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

