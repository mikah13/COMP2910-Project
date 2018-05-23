$(document).ready(function(){
    $('.content').html("alo");
    $.ajax({
        url:'https://jperfect.azurewebsites.net/api/',

    }).done(e=>{
    $('.content').html(e);
    })
})
