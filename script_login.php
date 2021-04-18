<?php
if(!isset($_POST["email"], $_POST["password"])){
    die("values not filled");
}

require_once("connection.php");
if(LoginUser($_POST["email"], $_POST["password"])) {
    $_SESSION["email"] = $_POST["email"];
    die("1");
} else {
    die("0");
}
