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
            location.href="preference.php";
        } else {
            $('.error').html('Please login to Google');
        }
    })
};

function renderButton() {
    gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 260,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSignIn,
    });
}

document.getElementById('google').addEventListener('click', function() {
    var auth2; // The Sign-In object.
var googleUser; // The current user.

/**
 * Calls startAuth after Sign in V2 finishes setting up.
 */
var appStart = function() {
  gapi.load('auth2', initSigninV2);
};

/**
 * Initializes Signin v2 and sets up listeners.
 */
var initSigninV2 = function() {
  auth2 = gapi.auth2.init({
      client_id: '774938428856-cbtk2lkmktvvgqj7kcnimdl44d15armi.apps.googleusercontent.com',
      scope: 'profile email'
  });

  // Listen for sign-in state changes.
  auth2.isSignedIn.listen(signinChanged);

  // Listen for changes to current user.
  auth2.currentUser.listen(userChanged);

  // Sign in the user if they are currently signed in.
  if (auth2.isSignedIn.get() == true) {
    auth2.signIn();
  }

  // Start with the current live values.
  refreshValues();
};

/**
 * Listener method for sign-out live value.
 *
 * @param {boolean} val the updated signed out state.
 */
var signinChanged = function (val) {
  console.log('Signin state changed to ', val);
  document.getElementById('signed-in-cell').innerText = val;
};

/**
 * Listener method for when the user changes.
 *
 * @param {GoogleUser} user the updated user.
 */
var userChanged = function (user) {
  console.log('User now: ', user);
  googleUser = user;
  updateGoogleUser();
  document.getElementById('curr-user-cell').innerText =
    JSON.stringify(user, undefined, 2);
};

/**
 * Updates the properties in the Google User table using the current user.
 */
var updateGoogleUser = function () {
  if (googleUser) {
    document.getElementById('user-id').innerText = googleUser.getId();
    document.getElementById('user-scopes').innerText =
      googleUser.getGrantedScopes();
    document.getElementById('auth-response').innerText =
      JSON.stringify(googleUser.getAuthResponse(), undefined, 2);
  } else {
    document.getElementById('user-id').innerText = '--';
    document.getElementById('user-scopes').innerText = '--';
    document.getElementById('auth-response').innerText = '--';
  }
};

/**
 * Retrieves the current user and signed in states from the GoogleAuth
 * object.
 */
var refreshValues = function() {
  if (auth2){
    console.log('Refreshing values...');

    googleUser = auth2.currentUser.get();

    document.getElementById('curr-user-cell').innerText =
      JSON.stringify(googleUser, undefined, 2);
    document.getElementById('signed-in-cell').innerText =
      auth2.isSignedIn.get();

    updateGoogleUser();
  }
}

}, false);




