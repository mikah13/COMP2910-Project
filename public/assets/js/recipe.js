$(document).ready(function() {
    function fetchData(id) {
        return $.ajax({
            url: `https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/${id}/summary`,
            headers: {
                'X-Mashape-Key': 'yVNtwOy4YwmshW4SiqM6RgMT9S7ep1oWIcbjsnIe4j5rd3ZqiX',
                'Accept': 'application/json'
            }
        })
    }
    let id = window.location.href.split('?')[1].split('=')[1];
    let strId = JSON.stringify([id]);
    $.post('/assets/php/getRecipeData.php', {
        data: strId
    }, function(d) {
        d = JSON.parse(d)
        if (d.length !== 0) {
            fetchData(id).done(summary => {
                summary = summary.summary;
                let data = d[0];
                console.log(data);
                let title = data.title;
                let img = data.image;
                let price = Math.round(data.pricePerServing*100)/100;
                let calorie = data.nutrition.nutrients[0].amount;
                $('#recipe_title').html(title);
                $('#recipe_img').attr('src', img)
                $('#summary').html(summary);
            })

        } else {
            location.href = 'menu.php';
        }
    })
})
