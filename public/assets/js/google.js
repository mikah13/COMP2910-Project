function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    let last;
    if (!profile.getFamilyName()) {
        last = ''
    } else {
        last = profile.getFamilyName();
    }

    let data = {
        first: profile.getGivenName(),
        last: last,
        email: profile.getEmail(),
        password: profile.getId().toString()
    }

    $.post('assets/php/googleRegister.php', data, function(a) {
        if (a === 'Success') {
            gapi.auth2.getAuthInstance().disconnect();
            location.href = 'menu.php';
        } else if (a === 'New') {
            gapi.auth2.getAuthInstance().disconnect();
            var form = $('<form action="preference.php" method="post">' + '<input type="text" name="data" value="' + data.first + '" />' + '</form>');
            $('body').append(form);
            form.submit();
        } else {
            $('.error').html('Please login to Google');
        }
    })
};

function renderButton() {
    gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 220,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSignIn
    });
}
