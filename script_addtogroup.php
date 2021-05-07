<?php
if(!isset($_POST["userid"], $_POST["chatid"])){
    echo "values not filled";
    exit;
}

require_once("connection.php");
if(AddUserToGroup($_POST["userid"], $_POST["chatid"])) {
    die("1");
} else {
    die("0");
}