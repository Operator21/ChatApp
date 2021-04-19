<?php
function HashPassword($password){
    return password_hash($password, PASSWORD_DEFAULT);
}

function GetFromTable($table, $id = null, $identifier = "id"){
    global $db;
    if($id != null){
        /*$sql = $db->prepare("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");
        $sql->execute();
        $identifier = $sql->fetch(PDO::FETCH_ASSOC)["Column_name"];*/
        //print_r($identifier);

        $sql = $db->prepare("select * from $table where $identifier = ?");
        $sql->execute([$id]);
        //print_r($db->errorInfo());
        return $sql->fetch(PDO::FETCH_ASSOC);
    } else {
        $sql = $db->prepare("select * from $table");
        $sql->execute();
        return $sql->fetchAll();
    }   
}

function GetUser($id){
    return GetFromTable("user", $id);
}

function GetUserByEmail($email){
    return GetFromTable("user", $email, "email");
}

function GetCurrentUser(){
    if(isset($_SESSION["user"])){
        return GetUser($_SESSION["user"]);
    }
    return null;
}

function GetCurrentUserID(){
    if(isset($_SESSION["user"])){
        return $_SESSION["user"];
    }
    return null;
}

function LoginUser($email, $password){
    $user = GetUserByEmail($email, "email");
    return password_verify($password, $user["password"]);
}

function RegisterUser($email, $nick, $password){
    global $db;
    if(CheckIfUserExists($email)){
        return false;
    }
    $sql = $db->prepare("insert into user values (?,?,?,0)");
    if($sql->execute([$email, $nick, HashPassword($password)])){
        return true;
    }
    return false;
}

function CheckIfUserExists($id){
    if(!isset($id)){
        return false;
    }
    
    if(GetUser($id) != null){
        return true;
    }
    return false;
}

function GetUserChatRooms(){
    global $db;

    $sql = $db->prepare("SELECT chat_id, user_id FROM chat 
        JOIN user_in_chat ON chat.id = chat_id WHERE user_id = ?");

    $sql->execute([$_SESSION["user"]]);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function GetChatRoomMessages($chatid){
    global $db;

    $sql = $db->prepare("SELECT * FROM message WHERE chat_id = ?");

    $sql->execute([$chatid]);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function SendMessage($chatid, $content){
    global $db;
    $datetime = new DateTime("now");
    $sql = $db->prepare("insert into message values (0,?,?,?,?)");
    if($sql->execute([GetCurrentUserID(), $chatid, $content, $datetime->format("Y-m-d H:i:s")])){
        return true;
    }
    return false;
}