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
    //alert(data);
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
    passwordAgain = $("#registerPasswordCheck").val();

    if(email.length < 1 || nick.length < 1 || password.length < 1){
        alert("Je nutné vyplnit všechny údaje");
        return;
    }
    if(passwordAgain != password){
        alert("Hesla se neshodují");
        return;
    }
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
    searchParams = new URLSearchParams(window.location.search)
    chatid = -1;
    if(searchParams.has("chatid")){
        chatid = searchParams.get("chatid");
        //alert(chatid);
    }
    //input.length
    if(input != ""){
        $.post("script_search.php", {
            search: input,
            chatid: chatid
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

function ChangeAvatar(){
    $("#changeavatar").modal();
}

function RefreshPreview(){
    $("#preview").attr('src' , $("#imageurl").val());
}

function SaveAvatar(){
    url = $("#imageurl").val();
    if(url.length < 1){
        alert("URL nesmí být prázdná");
        return;
    }
    $.post("script_updateavatar.php", {
        url: url
    },
    function(data) {
        //alert(data);
        if(data > 0) {
            ReloadPage();
        } else{
            alert("Uložení se nezdařilo, ujistěte se, že odkaz není příliš dlouhý");
        }    
    });
}

function AddToCurrentChat(userid){
    chatid = GetParameter("chatid");
    //alert(userid + " do chatu " + GetParameter("chatid"))
    $.post("script_addtogroup.php", { 
        chatid: chatid,
        userid: userid
    },
    function(data){
        if(data == 1){
            ReloadPage();
        } else {
            alert("Uživatel už ve skupině je");
        }
    });
}

function GetParameter(name){
    searchParams = new URLSearchParams(window.location.search)
    return searchParams.get(name);
}

function GetParameterExists(name){
    searchParams = new URLSearchParams(window.location.search)
    return searchParams.has(name);
}

function LeaveCurrentChat(){
    var result = confirm("Určitě? Tato operace nelze vrátit.");
    if(!result){
        return;
    }
    chatid = GetParameter("chatid");
    $.post("script_leavegroup.php", { 
        chatid: chatid
    },
    function(data){
        window.location.replace("index.php");
    });
}