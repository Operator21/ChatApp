<?php
include("template_data.php");

function RandomFromArray($array){
    return $array[rand(0, sizeof($array)-1)];
}

function GenerateMultiple($func, $num){
    for($x = 0; $x < $num; $x++){
        $func();
    }
}

function PageHeader($title = "Nadpis stránky"){
    ?>
    <!DOCTYPE html>
    <html lang="cs">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- Roboto import -->
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
            <!-- jQuery JS 3.1.0 -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <!-- jQuery Modal -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
            <!-- Page title in  format of *Current Page | ChatApp* -->           
            <title><?= $title ?> | ChatApp</title>
            <!-- Color Palette -->
            <!-- <link rel="stylesheet" href="colors/default.css"> -->
            <link rel="stylesheet" href="colors/sienna.css">
            <!-- General style file -->
            <link rel="stylesheet" href="style.css">
            <!-- Mobile style file -->
            <link rel="stylesheet" href="style_mobile.css">
            <!-- General script functions -->
            <script src="javascript.js"></script>
            <!-- Font Awesome link -->
            <link rel="stylesheet" href="css/all.css">
        </head>
        <body>
            <div id="body">
    <?php
}

function PageFooter(){
    ?>
            </div>
        </body>
    </html>
    <?php
}

function ChatRoom($id = 0, $name = "", $photo= ""){
    global $names, $photos;   
    $class = "";
    if(isset($_GET["chatid"]) && $id == $_GET["chatid"]){
        $class = "selected";
    } 
    ?>
    <span class="chatroom <?= $class ?>" onclick="OpenChat(<?= $id ?>)">
        <img class="chatphoto" src="<?= ($photo == "") ? RandomFromArray($photos) : $photo ?>">
        <h3><?= ($name == "") ? RandomFromArray($names) : $name ?></h3>
    </span>
    <?php
}
function UserProfile($user, $chatid){ 
    ?>
    <span class="chatroom">
        <img class="chatphoto" src="<?= $user["avatar"] ?>">
        <h3><?= $user["nick"] ?></h3>
        
        <span class="useroptions">
            <i class="fas fa-user-plus" onclick="StartChat(<?= $user["id"] ?>)"></i>
            <?php if($chatid != -1) { ?>
            <i class="fas fa-users" onclick="AddToCurrentChat(<?= $user["id"] ?>)"></i>
            <?php } ?>
        </span>
        
    </span>
    <?php
}
function Message($currentuser, $user, $content, $nick, $multiuser = false){
    $class = "message";
    $nick_class = "nick";
    if($currentuser != null && $user == $currentuser){
        $class .= " user";
    } else {
        if($multiuser) {
            ?><span class="<?= $nick_class ?>"><?= $nick ?></span><?php
        }
    }
    ?>   
    <span class="<?= $class ?>"><?= $content ?></span>
    <?php
}