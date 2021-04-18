function ReloadPageContent(){
    $(".jquery-modal").remove();
    $("#body").load(location.href + " #body");
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
            ReloadPageContent();
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
        if(data == 1){
            ReloadPageContent();
        } else {
            alert("Email je již zaregistrován");
        }        
    });
    //alert("user doesn't exist");
}