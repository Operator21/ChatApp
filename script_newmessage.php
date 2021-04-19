<?php
if(!isset($_POST["chatid"], $_POST["content"])) {
    die("values not filled");
}
require_once("connection.php");
if(SendMessage($_POST["chatid"], $_POST["content"])){
    die("success");
}
die("failure");