$(document).ready(function() {
    let old_recipe_id = $('#recipe_id').val();
    let old_day = $('#day').val();
    let old_week = $('#week').val();
    $('#remove').click(function(e) {
        e.preventDefault();
        data = {
            old_recipe_id: old_recipe_id,
            old_day: old_day,
            old_week: old_week
        }
        $.post('/assets/php/removeRecipe.php', data, function(d) {
            $('#msg').html('Recipe succesfully removed!');
            $('#myModal').modal('show');
            setTimeout(function() {
                $('#myModal').modal('hide');
            }, 1200);
        })

    })
    $('.detail').click(function() {
        window.open('recipe.php?id=' + $('#recipe_id').val(), '_blank');
    })
    $('.detail').mouseover(function() {
        $(this).css('color', '#55CD48')
    })
    $('.detail').mouseout(function() {
        $(this).css('color', 'black')
    })
    $(".add-recipe").click(function(e) {
        e.preventDefault();
        let recipe_id = $('#recipe_id').val();
        let recipe_title = $('#recipe_title').val();
        let quantity = $('#quantity').val();
        let day = $('#day').val();
        let week = $('#week').val();

        if (quantity >= 0) {
            data = {
                recipe_id: recipe_id,
                recipe_title: recipe_title,
                quantity: quantity,
                day: day,
                week: week,
                old_recipe_id: old_recipe_id,
                old_day: old_day,
                old_week: old_week
            }

            //
            $.post('/assets/php/updateRecipe.php', data, function(d) {
                // console.log(d);
                $('#myModal').modal('show');
                setTimeout(function() {
                    $('#myModal').modal('hide');
                }, 1200);
                // setTimeout(function(){
                //     window.location='schedule.php'
                // },1300);

            });
        }
    });
})
