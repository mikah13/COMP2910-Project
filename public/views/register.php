<?php session_start();
        require_once('../../private/credential/initialize.php');
        require_once('../../private/credential/validation.php');
        $_SESSION['log-error'] = '';

        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
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
        .error{
            color:#F94D3C;
        }
    </style>
    <link rel="shortcut icon" href="images/logo.png" />
</head>

<body class="green">

    <div id="login-page" class="row">
        <div class="col s12 z-depth-6 card-panel">
            <form class="login-form" method="POST">
             <?php
                if (isset($_POST['signup'])) {
                    // Prepare
                    $stmt = $conn->prepare("INSERT INTO user (first, last, email, password) VALUES (?,?,?,?)");
                    $stmt->bind_param("ssss", $first, $last, $email,$password);

                    // Set variables
                    $first = mysqli_real_escape_string($conn,$_POST['first']);
                    $last = mysqli_real_escape_string($conn,$_POST['last']);
                    $email = mysqli_real_escape_string($conn,$_POST['email']);
                    $password = mysqli_real_escape_string($conn,$_POST['password']);

                    if (!emailChk($conn, $email)) {
                        $_SESSION["reg-error"] = "Invalid Email";
                    } elseif (!passChk($password)) {
                        $_SESSION["reg-error"] = "Password must contain at least 8 characters, <br /> one Uppercase, one Lowercase and one Number";
                    } elseif (!nameChk($first,$last)){
                        $_SESSION["reg-error"] = "Invalid First and Last name";
                    } else {
                        $_SESSION["reg-error"] = '';
                        // Execute
                        if($stmt->execute()){
                            //Close
                            $stmt->close();
                            $_SESSION['log-error'] = "<p class='success col s12 center'>Account Created Successfully!</p>";
                            header('Location: login.php');
                        }
                        else{
                            header('Location: register.php');
                        }

                    }
                }
                 ?>
                <div class="row">
                    <div class="input-field col s12 center">
                        <a href="index.php"><img src="images/full_logo.png" alt="logo" class="responsive-img valign profile-image-login"></a>
                        <p class="center login-form-text">One Step Closer To Being Perfect</p>
                    </div>
                </div>
                <?php
                    echo "<p class='error col s12 center'>".$_SESSION["reg-error"]."</p>";
                ?>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="first" type="text" class="validate" name="first">
                        <label for="first" class="center-align">First Name</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="last" type="text" class="validate" name="last">
                        <label for="last">Last Name</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-communication-email prefix"></i>
                        <input id="email" type="email" class="validate" name="email">
                        <label for="email" class="center-align">Email</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="password" type="password" class="validate" name="password">
                        <label for="password">Password</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light col s12" name="signup">Register Now</button>
                    </div>
                    <div class="input-field col s12">
                        <p class="margin center medium-small sign-up">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- ================================================
    Scripts
    ================================================ -->

    <!-- jQuery Library -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!--materialize js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>



    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container center">
                © 2018 JMAN
            </div>
        </div>
    </footer>
</body>

</html>
<?php db_disconnect($conn);
?>
