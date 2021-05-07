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

function GetAllChatRoomsWithoutCurrentUser(){
    global $db;
    $sql = $db->prepare("SELECT userchat.chat_id, GROUP_CONCAT(user.nick ORDER BY user.nick SEPARATOR ', ') AS users 
        FROM (SELECT chat_id FROM user_in_chat WHERE user_id = ?) userchat
        JOIN user_in_chat ON userchat.chat_id = user_in_chat.chat_id
        JOIN user ON user.id = user_id
            AND user.id != ?
        GROUP BY userchat.chat_id");
    $sql->execute([GetCurrentUserID(),GetCurrentUserID()]);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
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
    $sql = $db->prepare("insert into user (email, nick, password) values (?,?,?)");
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

    $sql = $db->prepare("SELECT message.id AS message_id, user_id, chat_id, text, DATETIME, nick FROM message 
        JOIN user ON user.id = user_id
        WHERE chat_id = ?");

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

function UpdateAvatar($newurl){
    global $db;
    $sql = $db->prepare("update user set avatar = ? where id = ?");
    return $sql->execute([$newurl, GetCurrentUserID()]);
}

function GetChatAvatar($chatid){
    global $db;
    $sql = $db->prepare("SELECT avatar FROM user_in_chat
        JOIN user ON user.id = user_id
        WHERE user.id != ? AND chat_id = ? 
        ORDER BY user.id asc LIMIT 1;");
    $sql->execute([GetCurrentUserID(), $chatid]);
    return $sql->fetch(PDO::FETCH_ASSOC)["avatar"];    
}

function IsChatMultiUser($chatid){
    global $db;
    $sql = $db->prepare("SELECT COUNT(*) as num FROM user_in_chat WHERE chat_id = ?;");
    $sql->execute([$chatid]);
    if($sql->fetch(PDO::FETCH_ASSOC)["num"] > 2){
        return true;
    }  
    return false;
}

function AddUserToGroup($userid, $chatid){
    global $db;
    $sql = $db->prepare("insert into user_in_chat values (?, ?)");
    return $sql->execute([$chatid, $userid]);
}

function LeaveGroup($chatid){
    global $db;
    $sql = $db->prepare("delete from user_in_chat where chat_id = ? and user_id = ?");
    return $sql->execute([$chatid, GetCurrentUserID()]);
}