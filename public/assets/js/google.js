function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log(profile);
    let data = {
        first: profile.getName().split(' ')[0],
        last: profile.getName().split(' ')[1],
        email: profile.getId().toString(),
        password: profile.getId().toString()
    }
    console.log(profile.getName());
    console.log(profile.getEmail());
    console.log(profile.getFamilyName());
    console.log(profile.getGivenName());
    console.log(data);

    $.post('assets/php/facebookRegister.php', data, function(a) {
        console.log(a);
        if (a === 'Success') {
            // location.href = 'menu.php';
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
