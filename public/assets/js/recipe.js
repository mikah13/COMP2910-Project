$(document).ready(function() {
    let ingredientArr;
    let price;
    function getIngredients() {
        let str = '';
        for (let i = 0; i < $('.name').length; i++) {
            str += $('.amt')[i].innerHTML + " " + $('.name')[i].innerHTML + "\n";
        }
        return str;
    }

    function round(num) {
        return Math.round(num * 100) / 100;
    }
    function fetchData(id) {
        return $.ajax({
            url: `https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/${id}/summary`,
            headers: {
                'X-Mashape-Key': 'yVNtwOy4YwmshW4SiqM6RgMT9S7ep1oWIcbjsnIe4j5rd3ZqiX',
                'Accept': 'application/json'
            }
        })
    }
    function camelCase(str) {
        return str.split(' ').map(a => a.charAt(0).toUpperCase() + a.slice(1)).join(' ')

    }
    function displayInstruction(arr) {
        let instr = arr[0].steps;
        instr.forEach(step => {
            $('#instruction').append(`<li>${step.step}</li>`)
        })
    }
    function displayIngredients(arr, qty) {
        $('#people').val(qty);
        $('#ingredients').empty();
        $('#total-clr').empty();
        arr.forEach(a => {
            $('#ingredients').append(`
        <tr>
            <td class="name">${camelCase(a.name)}</td>
            <td class="amt">${round(a.amount * qty)} ${a.unit}</td>
            <td class="clr">${round(a.nutrients[0].amount * qty)} cal</td>
        </tr>`);
        })
    }
    function displayCost(serving, costperServing) {
        $('#cost-calculation').empty();
        $('#total').empty();
        let c = getIngredients();
        let a = "https://spoonacular.com:8443";
        $.ajax({
            type: "POST",
            url: a + "/recipes/visualizePriceEstimator",
            data: "servings=" + 6 + "&mode=" + 1 + "&ingredientList=" + encodeURIComponent(c),
            dataType: "html"
        }).done(e => {
            e = e.toString();
            let b = e.match(/<script[\s\S]*?>[\s\S]*?<\/script>/gi);
            let data = b[0].split(',]}]});chart')[0].split('dataPoints: [{ ')[1];
            let data1 = data.replace(/:/g, '":').replace(/, /g, ', "').replace(/image/g, '"image')
            data1 = '[{' + data1 + ']';
            data1 = JSON.parse(data1);
            data1.forEach(d => {
                $('#cost-calculation').append(`
            <tr>
                <td class="cost-name">${camelCase(d.indexLabel)}</td>
                <td class="cost-amt">${d.amount}</td>
                <td class="cost-total">${d.price}</td>
            </tr>`);
            })
            $('#total-desc').html(
                "Total (For " + serving + ` ${serving > 1
                ? "people"
                : "person"}` + "):");
            $('#total').html("$" + round(costperServing * serving));
        })
    }

    $('#people').on('input', function() {
        displayIngredients(ingredientArr, $(this).val());
    })
    function displayData(data, summary) {
        let title = data.title;
        let img = data.image;
        price = Math.round(data.pricePerServing) / 100;
        let calorie = data.nutrition.nutrients[0].amount;
        let serving = data.servings;
        let duration = data.readyInMinutes;
        ingredientArr = data.nutrition.ingredients;
        $('#recipe_title').html(title);
        $('#recipe_img').attr('src', img);
        $('#summary').html(summary.replace(/spoonacular/gi,''));
        $('#cost').html(`$${price}/serving`);
        $('#calorie').html(`${calorie} cal/serving`);
        $('#duration').html(`${duration} minutes`);
        $('#serving').html(
            `${serving} ${serving > 1
            ? 'people'
            : 'person'}`);
        displayInstruction(data.analyzedInstructions);
        displayIngredients(ingredientArr, serving);
        displayCost(serving, price);
    }

    let id = window.location.href.split('?')[1].split('=')[1];
    let strId = JSON.stringify([id]);
    $.post('/assets/php/getRecipeData.php', {
        data: strId
    }, function(d) {
        d = JSON.parse(d)
        if (d.length !== 0) {
            let data = d[0];
            $.post('/assets/php/getRecipeSummary.php', {
                id: id
            }, function(a) {
                if (a === '') {
                    fetchData(id).done(summary => {
                        summary = summary.summary;
                        $.post('/assets/php/addRecipeSummary.php', {
                            id: id,
                            summary: summary.replace(/'/g, "''")
                        }, function(res) {
                            displayData(data, summary);
                        })
                    });
                } else {
                    displayData(data, a);
                }
            })
        } else {
            location.href = 'menu.php';
        }
    })
})
