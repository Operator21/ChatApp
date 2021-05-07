<?php
if(!isset($_POST["chatid"])){
    echo "values not filled";
    exit;
}

require_once("connection.php");
if(LeaveGroup($_POST["chatid"])) {
    die("1");
} else {
    die("0");
}