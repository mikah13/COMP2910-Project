<?php require_once('../../private/credential/initialize.php');
        require_once('../../private/credential/validation.php');
        $msg = "First line of text\nSecond line of text";


    $msg = wordwrap($msg, 70);

    mail("anhminhhoang13@gmail.com", "My subject", $msg);
        ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="FOOD TRACKING APP">
    <meta name="author" content="GROUP 7">
    <link rel="icon" href="http://v4-alpha.getbootstrap.com/favicon.ico">
    <title>FOOD TRACKING APP</title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/signin/signin.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </head>

  <body>

    <div class="container">
        <?php
        if (isset($_POST['submit'])) {
            $sql = "INSERT INTO user ( first, last, email, password)
            VALUES ('Mike','Hoang','{$_POST['email']}','{$_POST['password']}')";
            if (!emailChk($conn, $_POST['email'])) {
                echo "Email already used";
            } elseif (!passChk($_POST['password'])) {
                echo "Password must be at a minimum of 8 character long and contain at least one Uppercase, one Lowercase and one Number";
            } else {
                if (mysqli_query($conn, $sql)) {
                    $url = 'dashboard.php';
                    header('Location: '.$url);
                }
            }
        }
         ?>
      <form method="POST" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="email" class="form-control" name="email" placeholder="Email address">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" class="form-control" name="password" placeholder="Password">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>
  </body>
</html>

<?php db_disconnect($conn);
?>
