$(document).ready(function() {

    $('#up').click(function(){
        $('html').animate({ scrollTop: -100 ,opacity:'0.03'}, 2500);
        $('html').fadeOut(800);
        setTimeout(function(){
        location.href='eastereggyouwillnotfind.html'
    },3300)
    })
})
