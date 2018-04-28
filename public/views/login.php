<?php require_once('../../private/credential/initialize.php');
        session_start();
        ob_start();
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

  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<style type="text/css">
.red{
    background-color: #61c200 !important;;
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
</style>
<link rel="shortcut icon" href="images/logo.png" />

</head>

<body class="green">


  <div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
      <form class="login-form" method="POST">
        <?php


        if (isset($_POST['login'])) {

 	    // Prepare

 	     $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
 	     $stmt->bind_param("ss", $email, $password);

 	     // Set variables

 	    $email = mysqli_real_escape_string($conn, $_POST['email']);
 	    $password = mysqli_real_escape_string($conn, $_POST['password']);
 	        if ($stmt->execute() == true) {
 		        $result = $stmt->get_result();
 		        $num_rows = $result->num_rows;
 		        if ($num_rows == 1) {
 			        $user = mysqli_fetch_assoc($result);
 			        $_SESSION['id'] = $user['id'];
                    $stmt->close();
                    header('Location: dashboard.php');
 		        }
 		        else {

 			        header('Location: login.php');
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
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input class="validate" id="email" type="email" name="email">
            <label for="email" data-error="wrong" data-success="right" class="center-align">Email</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password" name="password">
            <label for="password">Password</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light col s12" name="login">Login</button>

          </div>
        </div>

        <hr>



        <div class="row">
          <div class="input-field col s12">
            <a href="https://www.facebook.com/v2.6/dialog/oauth?client_id=447101349023173&state=16b6ce93121b514e68588fde6f89c24a&response_type=code&sdk=php-sdk-5.0.0&redirect_uri=https%3A%2F%2Fimmense-brushlands-25104.herokuapp.com%2Fsocial_auth%2Ffacebook&scope=email"><img src="https://immense-brushlands-25104.herokuapp.com/assets/img/flogin.png" alt="facebook" class="responsive-img valign profile-image-login"/></a>
          </div>
        </div>


        <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="register.php">Register Now!</a></p>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"><a href="https://immense-brushlands-25104.herokuapp.com/forgot_password">Forgot password?</a></p>
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
          <div class="footer-copyright center">
            <div class="container">
            © 2018 JMAN

            </div>
          </div>
  </footer>
</body>

</html>
<?php db_disconnect($conn);
?>
