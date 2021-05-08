<?php
if(!isset($_POST["theme"])) {
    die("values not filled");
}
require_once("connection.php");
if(ChangeTheme($_POST["theme"])){
    die("success");
}
die("failure");