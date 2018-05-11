    $(document).ready(function(){
        $.post('/assets/php/index.php',function(d){
            $('#nav-list').append(d);
        })
    })