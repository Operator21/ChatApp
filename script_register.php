<?php
if(!isset($_POST["email"], $_POST["password"], $_POST["nick"])){
    echo "values not filled";
    exit;
}

require_once("connection.php");
if(RegisterUser($_POST["email"], $_POST["nick"], $_POST["password"])) {
    die("1");
} else {
    die("0");
}