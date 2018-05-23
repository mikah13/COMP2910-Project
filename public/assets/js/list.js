$(document).ready(function() {
    $('#up').click(function() {
        window.scrollTo(0, 0);
    })
    function round(num) {
        return Math.round(num * 100) / 100;
    }
    function display(data, week) {
        data = JSON.parse(data);
        data.forEach(e => {

            e.data = JSON.parse(e.data.split("'").join(' ')).nutrition.ingredients;
        })
        let arr = [];

        data.forEach((e, i) => {

            if (e.week === week) {

                let qty = e.quantity;

                e.data.forEach(a => {
                    delete a.nutrients;
                    a.amount = round(a.amount * qty);
                    arr.push(a);
                })
            }
        })

        let list = arr.reduce((a, b) => {
            let index = a.findIndex(i => i.name === b.name);
            if (index === -1) {
                a.push(b)
            } else {
                a[index].amount += b.amount;
            }
            return a;
        }, [])

        $('.table').empty();
        list.forEach((a, i) => {
            $('.table').append(`<div id="row${i}" class="row">
                    <div class="6u"> <input type="checkbox" id="item${i}"> <label id="label${i}" for="item${i}">${a.name}</label></div>
                    <div class="6u">${a.amount} ${a.unit}</div>
                </div>`)
        })
        $('input').click(function() {
            let id = $(this).attr('id').split('item')[1];
            if (!$(`#label${id}`).hasClass('lineThru')) {
                $(`#label${id}`).addClass('lineThru')
            } else {
                $(`#label${id}`).removeClass('lineThru')
            }
            // console.log($('.table').html());
        })
    }

    $.post('assets/php/shoplist.php', function(data) {
        display(data, 'Week 1');

        $(".wk").click(function() {
            let week = $(this).text().trim();
            for (let i = 0; i < $('.wk').length; i++) {
                $('.wk')[i].className = "wk";
            }
            $(this).addClass('selected')
            display(data, week);
        })
    })
})
