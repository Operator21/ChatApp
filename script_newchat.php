<?php
if(!isset($_POST["selected"])){
    die("value not set");
}

require_once("connection.php");
$result = CreateChat($_POST["selected"]);
if($result > 0){
    die($result);
}
die("0");