$(document).ready(function(){

    let data = JSON.parse($('#data').text());
    console.log(data);
    let totalCost = data.totalCost;
    let totalCal = data.totalCal;
    let arr = data.data
    arr.forEach(a=>{
        console.log(a);
        let row = `<tr><td style="padding:.5rem">${a.title}</td><td style="padding:.5rem">$ ${a.price}</td><td style="padding:.5rem">${a.calorie} cal</td></tr>`;
        $('#tb-body').append(row);
    })
    $('#totalPrice').html(`$ ${totalCost}`);
    $('#totalCal').html(` ${totalCal} cal`);
})
