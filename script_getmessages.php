<?php
if(isset($_GET["chatid"])) {
    $id = $_SESSION["user"];
    foreach(GetChatRoomMessages($_GET["chatid"]) as $message){
        Message($id, $message["user_id"], $message["text"]);
    }
}
