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
    <title>JustPerfect</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        .blue {
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
                        <p class="center login-form-text">One Step Closer To Being Perfect</p>
                    </div>
                </div>
                <p class='error col s12 center'></p>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="first" type="text" class="validate" name="first" autocomplete="given-name">
                        <label for="first" class="center-align">First Name</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="last" type="text" class="validate" name="last" autocomplete="family-name">
                        <label for="last">Last Name</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-communication-email prefix"></i>
                        <input id="email" type="email" class="validate" name="email" autocomplete="email">
                        <label for="email" class="center-align">Email</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="password" type="password" class="validate" name="password" autocomplete="current-password">
                        <label for="password">Password</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light col s12" id="register" name="signup">Register Now</button>
                    </div>



                    <div class="input-field col s12" style="margin-bottom:10px;">
                        <!-- Facebook login button -->

                        <p class="margin center medium-small sign-up">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                    <div style="text-align:center">
                        <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" scope="public_profile,email" onlogin="checkLoginState();">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- ================================================
    Scripts
    ================================================ -->

    <!-- jQuery Library -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/facebook.js"></script>
    <!--materialize js-->
    <script src="assets/js/materialize.min.js"></script>
    <script src="assets/js/register.js"></script>


    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container center">
                © 2018 JMAN
            </div>
        </div>
    </footer>
</body>

</html>
