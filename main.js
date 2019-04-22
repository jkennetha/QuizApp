$(document).ready(function(){
    $('.loginCredentials').hide();
})

function login(){
    $('.homePageButtons').hide(1000);
    $('.loginCredentials').show(1000);
}

function signup(){
    console.log("signup");
}

function goBackToHome(){
    $('.homePageButtons').show(1000);
    $('.loginCredentials').hide(1000);
}