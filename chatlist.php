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
<main class="main">
    <nav>
        <header>
            <a onclick="SearchUsers()"><i class="fas fa-search"></i></a> 
            <input type="text" id="usersearch" placeholder="Vyhledat uživatele">               
            <a href="#usersettings" rel="modal:open"><i class="fas fa-user"></i></a>           
        </header>
        <div class="chatlist">
        <?php 
            //GenerateMultiple("ChatRoom", 10); 

            $chatrooms = GetAllChatRoomsWithoutCurrentUser();
            foreach($chatrooms as $room){
                ChatRoom($room["chat_id"], $room["users"], GetChatAvatar($room["chat_id"]));
            }
        ?>
        </div>
    </nav>
    <section id="rightpanel" class="messagelist">
        <section id="messagelist">
        <?php 
            //GenerateMultiple("Message", 20) 
            include_once("script_getmessages.php");
        ?>
        </section>
        <div class="inputdiv">
            <span class="textfield"><textarea id="textarea"></textarea></span>
            <a href="#emojimenu" rel="modal:open"><i class="far fa-grin-alt"></i></a>
            <?php if(isset($_GET["chatid"])) { ?>
                <a href="#roomsettings" rel="modal:open"><i class="fas fa-user-cog"></i></a>
            <?php } ?>
        </div>
    </section>
</main>
<div id="emojimenu" class="modal"></div>
<div id="usersettings" class="modal">
<?php
    $user = GetCurrentUser();
    include_once("usermenu.php");
?>
</div>
<div id="userlist" class="modal"></div>
<div id="roomsettings" class="modal">
    <?php
        include_once("roomsettings.php");
    ?>
</div>
<form id="changeavatar" class="modal">
<?php
    include_once("changeavatar.php");
?>
</form>
<script>
    $("#rightpanel").ready(function() {
        if(GetParameterExists("chatid")){
            ScrollToBottom("#rightpanel");            
            $('#textarea').focus();
        }
        EmojiMenu();
    });  

    $("#textarea").keydown(function(event){
        if(event.which == 13){
            event.preventDefault(); 
            if($("#textarea").val() != ""){
                SendMessage(GetParameter("chatid"), $("#textarea").val());   
                RefreshMessages();
            }
        }
    });
    $("#usersearch").keydown(function(event){
        if(event.which == 13){
            event.preventDefault(); 
            SearchUsers();
        }
    });

    setInterval(function() {
        RefreshMessages();
    }, 3000);

    $("#preview").onerror = function(){
        $("#preview").attr('src' , "img/notfound.jpg");
    }
    /*window.onpopstate = function(){
        document.location = window.location.pathname;
    };
    history.pushState({}, "");*/
</script>

