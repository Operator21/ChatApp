<?php
require_once("connection.php");
if(CheckIfUserExists($_POST["email"])){
    die("1");
}
die("0");