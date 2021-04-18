<?php
try{
    $conf = parse_ini_file("../db/db.ini");
    $db = new PDO("mysql:host={$conf['host']};dbname={$conf['dbname']};charset=utf8",$conf["user"], $conf["password"]);   
} catch(PDOException $e){
    echo "Připojení k databází selhalo";
    exit;
}
session_start();
include("database_scripts.php");