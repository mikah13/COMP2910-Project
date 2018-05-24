$(document).ready(function() {
    $.post('/assets/php/getUserData.php', function(data) {
        data = JSON.parse(data);
        console.log(data);
        $("#gender").html(data.gender);
        $("#country").html(data.country);
        $("#age").html(data.age);
        if(data.favourite){

            let list = data.favourite.split(',');
            list.forEach(a=>{
                $("#prefer").append(`<li>${a}</li>`)
            })
        }
        else{
            $("#prefer").html('');
        }


    })
})
