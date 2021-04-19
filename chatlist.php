
<main class="main">
    <nav>
        <header>
            <a><i class="fas fa-search"></i></a>          
            <span></span> 
            <span></span> 
            <a href="#usersettings" rel="modal:open"><i class="fas fa-user"></i></a>           
        </header>
        <div class="chatlist">
        <?php 
            GenerateMultiple("ChatRoom", 10); 

            /*$chatrooms = GetUserChatRooms();
            foreach($chatrooms as $room){
                ChatRoom($room["chat_id"], $room["chat_id"]);
            }*/
        ?>
        </div>
    </nav>
    <section id="rightpanel" class="messagelist">
        <section id="messagelist">
        <?php 
            GenerateMultiple("Message", 20) 
            //include_once("script_getmessages.php");
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
<script>
    $("#rightpanel").ready(function() {
        ScrollToBottom("#rightpanel");
        EmojiMenu();
    });  

    $("#textarea").keydown(function(event){
        if(event.which == 13){
            event.preventDefault();    
            let searchParams = new URLSearchParams(window.location.search)
            //alert(searchParams.get("chatid") + " / " + $("#textarea").val());
            SendMessage(searchParams.get("chatid"), $("#textarea").val());   
            RefreshMessages();
        }
    });

    setInterval(function() {
        RefreshMessages();
    }, 1000);

    $('#textarea').focus();
</script>

