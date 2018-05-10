window.fbAsyncInit = function() {
    FB.init({appId: '154511015392915', cookie: true, xfbml: true, version: 'v3.0'});

    FB.AppEvents.logPageView();

};

(function(d, s, id) {
    var js,
        fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=154511015392915';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

function statusChangeCallback(response) {
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        FB.api('/me?fields=name,email,birthday,location', function(res) {
            if (res && !res.error) {

                let data = {
                    first: res.name.split(' ')[0],
                    last: res.name.split(' ')[1],
                    email: res.id.toString(),
                    password: res.id.toString()
                }

                $.post('assets/php/facebookRegister.php', data, function(a) {
                    if (a === 'Success') {
                        location.href='menu.php';
                    } else {
                        $('.error').html('Please login to Facebook');
                    }
                })
            }

        });
    } else {
        $('.error').html('Please login to Facebook');
    }
}
