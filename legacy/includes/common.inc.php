<?php

session_start();

//Not tracked by version control, create your own
require_once('config.inc.php');

if(DEBUG_MODE){
    error_reporting(E_ALL | E_STRICT);
} else {
    error_reporting(0);
}

$db = new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB);
if(mysqli_connect_errno()){
    if(DEBUG_MODE){
        echo 'Failed To Connect To Database: '.mysqli_connect_errno().': '.mysqli_connect_error();
    }else{
        echo 'Failed To Connect To Database. Try reloading the page or contact the admin.';
    }
}