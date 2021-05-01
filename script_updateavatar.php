<?php
if(!isset($_POST["url"])){
    die("value not set");
}

require_once("connection.php");
if(UpdateAvatar($_POST["url"])){
    die("1");
}
die("0");