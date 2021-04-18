<?php
function HashPassword($password){
    return password_hash($password, PASSWORD_DEFAULT);
}

function GetFromTable($table, $id = null){
    global $db;
    if($id != null){
        $sql = $db->prepare("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");
        $sql->execute();
        $identifier = $sql->fetch(PDO::FETCH_ASSOC)["Column_name"];
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

function GetUser($email){
    return GetFromTable("user",$email);
}

function GetCurrentUser(){
    if(isset($_SESSION["email"])){
        return GetUser($_SESSION["email"]);
    }
    return null;
}

function LoginUser($email, $password){
    $user = GetUser($email);
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

function CheckIfUserExists($email){
    if(!isset($email)){
        return false;
    }
    
    if(GetUser($email) != null){
        return true;
    }
    return false;
}