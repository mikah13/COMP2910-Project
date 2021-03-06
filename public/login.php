<?php
        session_start();
        ob_start();
        if (isset($_SESSION['id'])) {
            header("Location: menu.php");
        }
        ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Cache-Control" content="max-age=600" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta name="author" content="JMAN">
        <meta name="description" content="Food Tracking Application">
        <meta name="copyright" content="2018 JMAN, Inc. All rights reserved.">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id" content="774938428856-cbtk2lkmktvvgqj7kcnimdl44d15armi.apps.googleusercontent.com">
        <title>JustPerfect</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/social.css" />



        <style type="text/css">
            .red {
                background-color: #61c200 !important;
                ;
            }

            html,
            body {
                height: 100%;
            }

            html {
                display: table;
                margin: auto;
            }

            body {
                display: table-cell;
                vertical-align: middle;
            }

            .margin {
                margin: 0 !important;
            }

            .error {
                color: #F94D3C;
            }

            .success {
                color: #61c200;
            }

            .abcRioButton.abcRioButtonBlue {
                margin: 0 auto;
            }
        </style>
        <link rel="shortcut icon" href="images/logo.png" />

    </head>

    <body class="green">

        <div id="login-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <form class="login-form" method="POST">

                    <div class="row">
                        <div class="input-field col s12 center">
                            <a href="index.php"><img src="images/full_logo.png" alt="logo" class="responsive-img valign profile-image-login"></a>
                        </div>
                    </div>
                    <p class="msg">

                    </p>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input class="validate" id="email" type="email" name="email" autocomplete="username email">
                            <label for="email" data-error="wrong" class="center-align">Email</label>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="password" type="password" name="password" autocomplete="current-password">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button id="login" type="submit" name="login" class="btn waves-effect waves-light col s12">Log In</button>
                        </div>



                        <div class="input-field col s12 " style="margin-bottom:10px;">
                            <p class="center">Haven't created an account? <a href="register.php">Register Now!</a></p>
                        </div>
                        <!-- Google login button -->
                        <div id="my-signin2" style="margin-bottom:10px;" data-onsuccess="onSignIn"></div>

                        <!-- Twitter login button -->
                        <div style="text-align:center; margin-bottom : 10px;">
                            <a href="assets/php/twitterRegister.php" class="waves-effect waves-light btn social twitter">
                            <i class="fa fa-twitter"></i>Sign In with Twitter</a>
                        </div>

                        <!-- Facebook login button -->
                        <div style="text-align:center; margin-bottom : 10px;">
                            <a class="waves-effect waves-light btn social facebook" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" scope="public_profile,email" onclick="checkLoginState();">
                            <i class="fa fa-facebook"></i>Sign In with Facebook</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>



        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/materialize.min.js"></script>
        <script src="assets/js/login.js"></script>
        <script src="assets/js/facebook.js"></script>
        <script src="assets/js/google.js"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>

    </body>

    </html>
