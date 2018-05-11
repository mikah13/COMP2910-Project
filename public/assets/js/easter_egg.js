$(document).ready(function() {

    $('#up').click(function(){
        console.log(1);

        $('html').animate({ scrollTop: -100 ,opacity:'0.03'}, 2500);
        $('html').fadeOut(800);
    })
})
