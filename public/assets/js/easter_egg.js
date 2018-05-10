$(document).ready(function(){
    let isMouseDown = false;
    $('#rope').mousedown(function(e){
        isMouseDown = true;

    })
    $('#rope').mouseup(function(e){
        isMouseDown = false;
    })
    $('body').mousemove(function(e){
        if(isMouseDown){

            console.log(e.pageX);

        $('#rope').css({ left: e.pageX, position:'absolute'});
            console.log($('#rope').position());
        }


    })
})
