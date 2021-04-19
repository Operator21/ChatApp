<?php
if(isset($_GET["chatid"])) {
    $id = $_SESSION["user"];
    if(CheckIfUserInChat($_GET["chatid"])){
        foreach(GetChatRoomMessages($_GET["chatid"]) as $message){
            Message($id, $message["user_id"], $message["text"]);
        }
    } else{
        echo "<h1>Přístup odepřen</h1>";
    }
}
