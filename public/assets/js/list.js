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
            e.data = JSON.parse(e.data).nutrition.ingredients;
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
        $.post('/assets/php/getItemBought.php', function(bought) {

            let boughtArr = JSON.parse(bought).split(", ");
            console.log(boughtArr);
            list.forEach((a, i) => {
                let input = `<input id="item${i}" type="checkbox" value="${a.name}" ${boughtArr.indexOf(a.name) === -1
                    ? ""
                    : "checked"}>`;
                let label = boughtArr
                    ? `<label id="label${i}" for="item${i}" class="${boughtArr.indexOf(a.name) === -1
                        ? ""
                        : 'lineThru'}">${a.name}</label>`
                    : ` <label id="label${i}" for="item${i}">${a.name}</label>`;

                $('.table').append(`<div id="row${i}" class="row" style="">
                            <div class="6u"> ${input}${label}</input></div>
                            <div class="6u">${round(a.amount)} ${a.unit}</div>
                        </div>`)
            })

            $('input').on('click', function() {
                let id = $(this).attr('id').split('item')[1];
                if ($(`#label${id}`).hasClass('lineThru')) {
                    $.post('/assets/php/removeItemBought.php', {
                        item: $(this).val()
                    }, function(d) {
                        console.log(d);
                        $(`#label${id}`).removeClass('lineThru');
                    })

                } else {
                    $.post('/assets/php/addItemBought.php', {
                        item: $(this).val()
                    }, function(d) {
                        console.log(d);
                        $(`#label${id}`).addClass('lineThru');
                    })

                }
            })
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
