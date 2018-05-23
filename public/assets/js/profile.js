$(document).ready(function(){
    $.post('/assets/php/getUserData.php',function(data){
        data = JSON.parse(data);
        console.log(data);
        $("#gender").html(data.gender);
        $("#name").html(data.first +" "+ data.last);
        $("#location").html(data.location);
        $("#age").html(data.age);
        $("#prefer").html(data.favourite);
    })
})
