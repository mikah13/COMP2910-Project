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
                let form = $('<form>', {
                    method: 'post',
                    action: 'login.php'
                });
                form.append('<input value="Account created successfully" name="msg"/>')

                $('body').append(form);
                form.submit();

            } else {
                $('.error').html(a);
                $('#email').val('');
                $('#password').val('')
            }
        })
    })
})
