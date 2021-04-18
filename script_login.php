<?php
if(!isset($_POST["email"], $_POST["password"])){
    die("values not filled");
}

require_once("connection.php");
if(LoginUser($_POST["email"], $_POST["password"])) {
    $_SESSION["email"] = $_POST["email"];
    echo 1;
} else {
    echo 0;
}
