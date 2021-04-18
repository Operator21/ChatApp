function ReloadPageContent(){
    $(".jquery-modal").remove();
    $("#body").load(location.href + " #body");   
}

function ReloadPage(){
    location.reload();
}

function Logout(){
    $.post("script_logout.php", function(data) {
        //alert(data);
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
        alert(data);
        if(data == 1){
            ReloadPage();
        } else {
            alert("Email je již zaregistrován");
        }        
    });
    //alert("user doesn't exist");
}