<?php
/**
* Copyright (C) 2021 Stanislav Zdych
* 
* This file is part of the ChatApp.
* 
* ChatApp is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <https://www.gnu.org/licenses/>.
**/
?>
<?php
if(isset($_GET["chatid"])) {
    $id = $_SESSION["user"];
    if(CheckIfUserInChat($_GET["chatid"])){
        $multiuser = IsChatMultiUser($_GET["chatid"]);
        foreach(GetChatRoomMessages($_GET["chatid"]) as $message){
            Message($id, $message["user_id"], $message["text"], $message["nick"], $multiuser);
        }
    } else{
        echo "<h1>Přístup odepřen</h1>";
    }
}
