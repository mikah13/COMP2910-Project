$(document).ready(function() {
    $('#login').click(function(e) {
        e.preventDefault();
        let data = {
            email: $('#email').val(),
            password: $('#password').val()
        }
        $.post('assets/php/login.php', data, function(a) {
            if (a === 'Success') {
                location.href = 'menu.php';
            } else {
                $('.msg').html(a);
                $('#password').val('');
            }
        })
    })


})
