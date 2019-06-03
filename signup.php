<?php

require_once("includes/common.inc.php");

//HTML Head
require_once("includes/head.inc.php");

//Website Header
require_once("includes/header.inc.php");

//Website Sidebar
require_once("includes/sidebar.inc.php");

//already logged in?
if(isset($_SESSION["username"])) {
    header("Location: https://trigedasleng.net/");
}
?>
<div id="content">
    <div id="inner-signup-form">
        <div class="signup-form center">
            <form style="border:1px solid #ccc">
                <div class="container">
                    <h1>Sign Up</h1>
                    <p>Please fill in this form to create an account.</p>
                    <hr>

                    <label for="username"><b>Username</b></label>
                    <input id="signup-username" type="username" placeholder="Enter Username" name="Username" required>

                    <label for="email"><b>Email</b></label>
                    <input id="signup-email" type="email" name="Email" placeholder="Enter Email" required>

                    <label for="password"><b>Password</b></label>
                    <input id="signup-password" type="password" name="Password" placeholder="Enter Password" required>

                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input id="signup-passwordrpt" type="password" placeholder="Repeat Password" name="password-rpt" required>

                    <label>
                        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                    </label>

                    <div class="clearfix">
                        <input type="submit" id="signupbtn" value="Sign Up"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once("includes/footer.inc.php");

