$(document).ready(function(){
    $.post('/assets/php/getUserData.php',function(data){
      console.log(data);
    })
})
