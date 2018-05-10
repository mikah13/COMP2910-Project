function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    let last;
    if (!profile.getFamilyName()) {
        last = ''
    } else {
        last = profile.getFamilyName();
    }
    console.log(profile.getAuthResponse().id_token);
    let data = {
        first: profile.getGivenName(),
        last: last,
        email: profile.getEmail(),
        password: profile.getId().toString()
    }

    $.post('assets/php/facebookRegister.php', data, function(a) {
        if (a === 'Success') {
            location.href = 'menu.php';
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
