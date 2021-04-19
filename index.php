<?php
require_once("connection.php");
require_once("template_scripts.php");

PageHeader("ChatApp");
if(!isset($_SESSION["user"])){
    include_once("welcomepage.php");   
} else {
    $user = GetCurrentUser();
    include_once("chatlist.php");
}


//print_r(GetFromTable("user", "h@h.h"));


PageFooter();
