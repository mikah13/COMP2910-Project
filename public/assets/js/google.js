function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    let data = {
        first: profile.getName().split(' ')[0],
        last: profile.getName().split(' ')[1],
        email: profile.getId().toString(),
        password: profile.getId().toString()
    }

    $.post('assets/php/facebookRegister.php', data, function (a) {
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
        'onsuccess': onSignIn,
      });
    }
