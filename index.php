<?php
require("connection.php");
require_once("template_scripts.php");

PageHeader("ChatApp");
if(!isset($_SESSION["email"])){
    include_once("form_login.php");
    include_once("form_register.php");
} else {
    $user = GetCurrentUser();
    include_once("form_logout.php");
}


//print_r(GetFromTable("user", "h@h.h"));


PageFooter();
