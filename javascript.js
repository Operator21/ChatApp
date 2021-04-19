inputs = [
    "registerEmail",
    "registerNick",
    "registerPassword",
    "registerPasswordCheck",
    "loginEmail",
    "loginPassword"
];

function ReloadPageContent(){
    $.modal.close();
    $("#body").load(location.href + " #body");   
}

function ReloadPage(){
    location.reload();
}

function Logout(){
    $.post("script_logout.php", function(data) {
        //alert(data);
        ResetInputs();
        ReloadPageContent();
    });
}

function Login(){
    email = $("#loginEmail").val();
    password = $("#loginPassword").val();

    $.post("script_login.php", {
        email : email,
        password : password
    },
    function(data) {
        //alert(data);
        if(data == 1){
            ReloadPage();
        } else {
            alert("Nesprávné přihlašovací údaje");
        }        
    });
}

function Register(){
    email = $("#registerEmail").val();
    nick = $("#registerNick").val();
    password = $("#registerPassword").val();

    $.post("script_register.php", {
        email : email,
        nick : nick,
        password : password
    },
    function(data) {
        //alert(data);
        if(data == 1){
            ReloadPage();
        } else {
            alert("Email je již zaregistrován");
        }        
    });
    //alert("user doesn't exist");
}

function ScrollToBottom(element){
    var d = $(element);
    d.scrollTop(d.height());
}

function EmojiMenu(){
    for(x = 128512; x <= 128591; x++){
        $("#emojimenu").append("<span onclick='AppendEmoji(" + x + ")'>&#" + x + "</span>");
    }   
}

function AppendEmoji(code){
    emoji = String.fromCodePoint(code);
    $("#textarea").val($("#textarea").val() + emoji);
}

function OpenChat(id) {
    //alert(id);
    var url = window.location.pathname +"?chatid=" + id;
    document.location = url;
}

function RefreshMessages(){
    $("#messagelist").load(location.href + " #messagelist");
    //console.log($("#messagelist").height());

    /*if($(window).height() < height){
        console.log("   posun");
        ScrollToBottom("#rightpanel");
    }*/
}

function SendMessage(chatid, content){
    $.post("script_newmessage.php", {
        chatid : chatid,
        content : content
    },
    function(data) {
        //alert(data);   
        $("#textarea").val("");
        RefreshMessages(); 
    });
}

function ResetInputs(){
    inputs.forEach(input => {
        $(input).val("");
    });
}

function SearchUsers(){
    input = $("#usersearch").val();
    //input.length
    if(input != ""){
        $.post("script_search.php", {
            search: input
        },
        function(data) {
            //alert(data);   
            $("#userlist").html(data);
            $("#usersearch").val("");
            $("#userlist").modal();
        });
    } else {
        alert("Musíte nejdříve zadat uživatele");
    }
}

function StartChat(selected){
    if(selected != null)
    $.post("script_newchat.php", {
        selected: selected
    },
    function(data) {
        //alert(data);   
        $.modal.close();
        if(data > 0){
            OpenChat(data);
        }
    });
}

