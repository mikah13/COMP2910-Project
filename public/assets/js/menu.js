$(document).ready(function() {

    let quote = [
        {
            quote: "All you need is love. But a little chocolate now and then doesn't hurt.",
            author: "Charles M. Schulz"
        }, {
            quote: "If more of us valued food and cheer and song above hoarded gold, it would be a merrier world.",
            author: "J.R.R. Tolkien"
        }, {
            quote: "I love you like a fat kid loves cake!",
            author: "Scott Adams"
        }, {
            quote: "Ask not what you can do for your country. Ask what’s for lunch.",
            author: "Orson Welles"
        }, {
            quote: "One cannot think well, love well, sleep well, if one has not dined well.",
            author: "Virginia Woolf, A Room of One's Own"
        }, {
            quote: "There are people in the world so hungry, that God cannot appear to them except in the form of bread.",
            author: "Mahatma Gandhi"
        }
    ]
    let i = Math.floor(Math.random() * quote.length);
    $('.blockquote').html(`<blockquote>
        ${quote[i].quote}
        <footer>—
            <a href="https://www.goodreads.com/quotes/tag/food">
                ${quote[i].author}
            </a>
        </footer>
    </blockquote>`)
    setInterval(function() {
        $('.blockquote').fadeOut(800, function() {
            let i = Math.floor(Math.random() * quote.length);
            $('.blockquote').html(`<blockquote>
                ${quote[i].quote}
                <footer>—
                    <a href="https://www.goodreads.com/quotes/tag/food">
                        ${quote[i].author}
                    </a>
                </footer>
            </blockquote>`)
            $('.blockquote').fadeIn();
        });
    }, 7000)



    function fetchData(id) {
        return $.ajax({
            url: `https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/informationBulk?ids=${id}&includeNutrition=true`,
            headers: {
                'X-Mashape-Key': 'yVNtwOy4YwmshW4SiqM6RgMT9S7ep1oWIcbjsnIe4j5rd3ZqiX',
                'Accept': 'application/json'
            }
        });
    }

    $('#up').click(function() {
        window.scrollTo(0, 0);
    })
    $("#search").one('click', function(e) {
        e.preventDefault();
        $('#result').html('<section class="box"> <h2>Result</h2><div class="row alt result"></div></section>');
        $('.result').empty();
        let getRecipeListUrl = 'https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/search?limitLicense=false&number=60&offset=0&query=';
        $.ajax({
            url: getRecipeListUrl + $('#query').val(),
            headers: {
                'X-Mashape-Key': 'yVNtwOy4YwmshW4SiqM6RgMT9S7ep1oWIcbjsnIe4j5rd3ZqiX',
                'Accept': 'application/json'
            }
        }).done(d => {
            let imgUri = d.baseUri;
            if (d.results.length !== 0) {
                d.results.forEach((a, b) => {
                    let div = `
            <div class="4u 12u(mobilep) recipe" >
                <div class="collapse" id="collapseExample-${b}" style="margin-bottom:10px">
                    <div class=" card card-body 12u 12u(mobilep) " style="color:black">
                   <form class="" method="POST">
                       <div class="row uniform 50%">
                           <input id="recipe_id_${b}" name="recipe_id" value="${a.id}" type="hidden"/>
                           <input id="recipe_title_${b}" name="recipe_title" value="${a.title}" type="hidden"/>
                           <div class="12u">
                               <label for="quantity">Quantity <span style="float:right"><i class="fa fa-close close" style="color:red;font-size:1rem;cursor:pointer" id="close${b}"></i></span></label>
                               <input id="quantity_${b}" type="number" name="quantity" value="1" placeholder="" min="1" class="form-control"/>
                           </div>
                           <div class="12u">
                               <label for="day">Select Day</label>
                               <select name="day" class="form-control" id="day_${b}">
                                   <option>Monday</option>
                                   <option>Tuesday</option>
                                   <option>Wednesday</option>
                                   <option>Thursday</option>
                                   <option>Friday</option>
                                   <option>Saturday</option>
                                   <option>Sunday</option>
                               </select>
                           </div>
                           <div class="12u">
                               <label for="week">Select Week</label>
                               <select name="week" class="form-control" id="week_${b}">
                                   <option>Week 1</option>
                                   <option>Week 2</option>
                                   <option>Week 3</option>
                                   <option>Week 4</option>
                               </select>
                           </div>
                           <div class="12u">
                               <button name="add" id="add_recipe_${b}" class="button alt  add-recipe" style="text-align:center" value="Add">Submit</button>
                           </div>
                       </div>
                   </form>

               </div>
            </div>
                    <div id="recipe${b}">
                        <header class="recipe-img" style="text-align:center"><img src="${imgUri}${a.imageUrls[a.imageUrls.length - 1]}" class="img-fluid" style="height:250px"/></header>
                   <h4 class="center"  style="margin-top:10px; text-align:center; height:65px">${a.title}</h4>
                   <div class="row">
                    <p class="6u" style="text-align:center"><a class=" icon fa-cutlery"> ${a.servings} ${a.servings > 1
                        ? 'people'
                        : 'person'}</a></p>
                    <p class="6u" style="text-align:center"><a class=" icon  fa-clock-o"> ${a.readyInMinutes} mins</a></p>
                   </div>

                     <button class="button special fit toggleBtn" id="toggle${b}" type="button" data-toggle="collapse" data-target="#collapseExample-${b}" aria-expanded="false" aria-controls="collapseExample" >
                         Add
                     </button>
                    </div>

         </div>`;
                    $('.result').append(div);
                })
            } else {
                $('.result').append(`<h3>No results for ${$('#query').val()}</h3>`);
            }

            $('.add-recipe').click(function(a) {
                a.preventDefault();
                let id = $(this).attr('id').split('add_recipe_')[1];

                let params = {
                    recipe_id: $(`#recipe_id_${id}`).val(),
                    recipe_title: $(`#recipe_title_${id}`).val(),
                    quantity: $(`#quantity_${id}`).val(),
                    day: $(`#day_${id}`).val(),
                    week: $(`#week_${id}`).val()
                };

                if ($(`#quantity_${id}`).val() > 0) {
                    $.post('/assets/php/addRecipe.php', params, function(d) {
                        console.log(d);
                        if (d === 'insert') {
                            fetchData($(`#recipe_id_${id}`).val()).done(function(e) {
                                let strData = JSON.stringify(e[0]).replace(/'/g, "''");
                                params = {
                                    recipe_id: $(`#recipe_id_${id}`).val(),
                                    recipe_title: $(`#recipe_title_${id}`).val(),
                                    data: strData
                                };
                                $.post('/assets/php/addRecipeData.php', params, function(a) {
                                    $(`#collapseExample-${id}`).collapse('hide');
                                    $('#myModal').modal('show');
                                    setTimeout(function() {
                                        $('#myModal').modal('hide');
                                    }, 1000);
                                    $(`#recipe${id}`).css('display', 'block');
                                });
                            });
                        } else {
                            $(`#collapseExample-${id}`).collapse('hide');
                            $('#myModal').modal('show');
                            setTimeout(function() {
                                $('#myModal').modal('hide');
                            }, 1000);
                            $(`#recipe${id}`).css('display', 'block');
                        }

                    });
                }
            })

            $('.recipe-img').click(function() {
                let id = $(this).parent().parent().find('input')[0].value;
                let strID = JSON.stringify([id]);
                $.post('/assets/php/getRecipeData.php', {
                    data: strID
                }, function(d) {
                    d = JSON.parse(d);
                    if (d.length === 0) {
                        fetchData(id).done(data => {
                            data = data[0];
                            let params = {
                                recipe_id: id,
                                recipe_title: data.title,
                                data: JSON.stringify(data).replace(/'/g, "''")
                            }
                            $.post('/assets/php/addRecipeData.php', params, function(d) {
                                window.open(`recipe.php?id=${id}`);
                            })

                        })
                    } else {
                        window.open(`recipe.php?id=${id}`);
                    }
                })
            })
            $('.toggleBtn').click(function() {
                let id = $(this).attr('id').split('toggle')[1];
                $(`#recipe${id}`).css('display', 'none');
            })
            $('.close').click(function() {
                let id = $(this).attr('id').split('close')[1];
                $(`#recipe${id}`).css('display', 'block');
                $(`#collapseExample-${id}`).collapse('toggle')
            })

        })

    })
})
