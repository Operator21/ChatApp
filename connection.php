<?php
try{
    $conf = parse_ini_file("../db/db.ini");
    $db = new PDO("mysql:host={$conf['host']};dbname={$conf['dbname']};charset=utf8",$conf["user"], $conf["password"]);   
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo "Připojení k databází selhalo";
    exit;
}
session_start();
include_once("database_scripts.php");