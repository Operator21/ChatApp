<?php
if(!isset($_POST["email"], $_POST["password"])){
    die("values not filled");
}

require_once("connection.php");
if(LoginUser($_POST["email"], $_POST["password"])) {
    $_SESSION["user"] = GetUserByEmail($_POST["email"])["id"];
    die("1");
} else {
    die("0");
}
