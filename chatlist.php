
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
<form id="changeavatar" class="modal">
<?php
    include_once("changeavatar.php");
?>
</form>
<script>
    $("#rightpanel").ready(function() {
        let searchParams = new URLSearchParams(window.location.search)
        if(searchParams.has("chatid")){
            ScrollToBottom("#rightpanel");
            $('#textarea').focus();
        }
        EmojiMenu();
    });  

    $("#textarea").keydown(function(event){
        if(event.which == 13){
            event.preventDefault(); 
            if($("#textarea").val() != ""){
                let searchParams = new URLSearchParams(window.location.search)
                //alert(searchParams.get("chatid") + " / " + $("#textarea").val());
                SendMessage(searchParams.get("chatid"), $("#textarea").val());   
                RefreshMessages();
            }
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

