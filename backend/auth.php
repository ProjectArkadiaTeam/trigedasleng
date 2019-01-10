<?php
require_once("../includes/common.inc.php");

if ($_POST['action'] == 'signout') {
    session_destroy();
    header("Location: https://trigedasleng.net/");
}

if ($_POST['action'] == 'signup') {
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        echo 'All fields are required!';
    } else {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        //Hash password, PASSWORD_DEFAULT currently uses bcrypt.
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM `dict_users` WHERE `username`='" . $username . "'";

        if($result = mysqli_query($db, $sql)) {
            if (mysqli_num_rows($result) <= 0) {
                $sql = "INSERT INTO `dict_users`(`username`, `password`, `email`, `signup_date`) VALUES ('".$username."', '".$password_hashed."', '".$email."', NOW())";
                if ($result = $db->query($sql)) {
                    $_SESSION["username"] = $_POST["username"];
                    echo 'Success';
                } else {
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
            } else {
                echo 'Username already exists :(';
            }
        } else {
            echo 'Something went wrong, please try again';
        }
    }
}

if ($_POST['action'] == 'login') {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo 'All fields are required!';
    } else {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        $sql = "SELECT * FROM `dict_users` WHERE `username`='" . $username . "'";

        if($result = mysqli_query($db, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                $user_info = mysqli_fetch_assoc($result);
                if (password_verify($password, $user_info['password'])) {
                    $_SESSION["username"] = $_POST["username"];
                    echo 'Success';
                }
            } else {
                echo 'No user found for this username?';
            }
        } else {
            echo 'Something went wrong, please try again';
            //Only show debug stuff if we are running in debug mode
            if(DEBUG_MODE) {
                echo "Error: Our query failed to execute and here is why: \n";
                echo "Query: " . $sql . "\n";
                echo "Errno: " . $db->errno . "\n";
                echo "Error: " . $db->error . "\n";
            }
        }
    }
}
