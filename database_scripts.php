<?php
function HashPassword($password){
    return password_hash($password, PASSWORD_DEFAULT);
}

function GetFromTable($table, $id = null, $identifier = "id", $operator = "=", $mode = "single"){
    global $db;
    if($id != null){
        $sql = $db->prepare("select * from $table where $identifier $operator ?");
        $sql->execute([$id]);
        //print_r($db->errorInfo());   
        if($mode == "multiple"){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $sql->fetch(PDO::FETCH_ASSOC);
    } else {
        $sql = $db->prepare("select * from $table");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
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
    $sql = $db->prepare("insert into (email, nick, password) user values (?,?,?)");
    if($sql->execute([$email, $nick, HashPassword($password)])){
        return true;
    }
    return false;
}

function CheckIfUserExists($email){
    if(!isset($email)){
        return false;
    }
    
    if(GetUserByEmail($email) != null){
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

function GetUsersLike($nick){
    return GetFromTable("user", "%$nick%", "nick",  "like", "multiple");
}

function CheckIfUserInChat($chatid){
    global $db;
    $userid = GetCurrentUserID();
    $sql = $db->prepare("select count(*) as num from user_in_chat where chat_id = ? and user_id = ?");
    $sql->execute([$chatid, $userid]);
    $num = $sql->fetch(PDO::FETCH_ASSOC)["num"];
    if($num > 0){
        return true;
    }
    return false;
}

function CreateChat($selected){
    global $db;
    try {
        $sql = $db->prepare("insert into chat values (null)");
        $sql->execute();
        $chatid = $db->lastInsertId();
    
        $sql = $db->prepare("insert into user_in_chat values (?,?)");
        $sql->execute([$chatid, $selected]);
        $sql->execute([$chatid, GetCurrentUserID()]);

        return $chatid;
    } catch (PDOException $e){
        return false;
    }
    
}