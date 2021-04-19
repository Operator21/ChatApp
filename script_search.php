<?php
if(!isset($_POST["search"]) || $_POST["search"] == ""){
    die("Search error");
}
require_once("connection.php");
require_once("template_scripts.php");
$users = GetUsersLike($_POST["search"]);
//print_r($users);
foreach($users as $user){
    UserProfile($user);
}