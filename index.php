<?php
require_once("includes/common.inc.php");

//HTML Head
include("includes/head.inc.php");

//Website Header
include("includes/header.inc.php");
?>
<div id="content">
    <div id="inner">
        <div class="home">
            <div class="column left">
                <h3>Resources:</h3>
                <ul>
                    <?php
                    echo '<li><a href="">$Resource#1</a></li>'
                    //TODO Link slakkru, tumblr etc
                    ?>
                </ul>
            </div>
            <div class="column right">

                <!--About-->
                <div class="daily">
                    <center><h3>About this website</h3></center>
                    <p>This website is an attempt at recreating what was Trigedasleng.info after it went dark in december 2018.
                    All credits for design and content goes to the original creators of Trigedasleng.info.
                    </p>
                </div>

                <!--Word of the day-->
                <div class="daily">
                    <center><h3>Word of the Day</h3></center>
                    <?php
                    echo '<p><a href="#">gada in</a> (verb) have, own</p>'
                    //TODO Get random word of the day
                    ?>
                </div>

                <!--Translation of the day-->
                <div class="daily">
                    <center><h3>Translation of the Day</h3></center>
                    <?php
                    //TODO Get random translation of the day
                    echo '<p><a href="#">Yu gada som in na kof op?</a></p>';
                    echo '<p>You have something to trade?</p>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.inc.php");

