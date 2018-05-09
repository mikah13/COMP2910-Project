$(document).ready(function() {
    $('#register').click(function(e) {
        e.preventDefault();
        let data = {
            first: $('#first').val(),
            last: $('#last').val(),
            email: $('#email').val(),
            password: $('#password').val()
        }

        $.post('assets/php/register.php', data, function(a) {
            if (a === 'Success') {
                location.href="menu.php";

            } else {
                $('.error').html(a);
                $('#password').val('')
            }
        })
    })
})
