$(document).ready(function() {

    let data = JSON.parse($('#data').text());
    let totalCost = data.totalCost;
    let totalCal = data.totalCal;
    let arr = data.data
    arr.forEach(a => {
        let row = `<tr><td style="padding:.5rem;cursor:pointer" class="title" id="${a.recipe_id}">${a.title}</td><td style="padding:.5rem">$ ${a.price}</td><td style="padding:.5rem">${a.calorie} cal</td></tr>`;
        $('#tb-body').append(row);
    })
    $('#totalPrice').html(`$ ${totalCost}`);
    $('#totalCal').html(` ${totalCal} cal`);
    $('.title').click(function() {
        let id = $(this).attr('id');
        window.open(`recipe.php?id=${id}`, '_blank')
    })
    $('.title').mouseover(function() {
        $(this).css('color', '#55CD48')
    })
    $('.title').mouseout(function() {
        $(this).css('color', 'black')
    })

})
