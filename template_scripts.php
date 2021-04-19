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
            <!-- General style file -->
            <link rel="stylesheet" href="style.css">
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
    ?>
    <span class="chatroom" onclick="OpenChat(<?= $id ?>)">
        <img class="chatphoto" src="<?= ($photo == "") ? RandomFromArray($photos) : $photo ?>">
        <h3><?= ($name == "") ? RandomFromArray($names) : $name ?></h3>
    </span>
    <?php
}
function Message($currentuser = null, $user = null, $content = null){
    global $messages;
    $class = "message";
    if($currentuser != null && $user == $currentuser){
        $class .= " user";
    } else {
        if(rand(0,1) == 1){
            $class .= " user";
        }
    }
    
    if($content == null){
        $content = RandomFromArray($messages);
    }
    ?>
    <span class="<?= $class ?>"><?= $content ?></span>
    <?php
}