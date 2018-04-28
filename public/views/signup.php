<?php require_once('../../private/credential/initialize.php');
        require_once('../../private/credential/validation.php')

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
    <link rel="shortcut icon" href="images/logo.png" />
    <link href="assets/css/signup.css" rel="stylesheet" />
  </head>

  <body>
      <div class="app">
	<button class="login">
		<i class="fa fa-lock"></i>
		Login
	</button>
	<button for="signup" class="signup">
		<i class="fa fa-user-plus"></i>
		Signup
	</button>

	<form class="login-form hide">
        <?php
        if (isset($_POST['login'])) {

            // Prepare
            $stmt = $conn->prepare("INSERT INTO user (first, last, email, password) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $first, $last, $email,$password);

            // Set variables
            $email = mysqli_real_escape_string($conn,$_POST['login-email']);
            $password = mysqli_real_escape_string($conn,$_POST['signup-password']);

            if (!emailChk($conn, $email)) {
                echo "Invalid Email";
            } elseif (!passChk($password)) {
                echo "Password must be at a minimum of 8 character long and contain at least one Uppercase, one Lowercase and one Number";
            } elseif (!nameChk($first,$last)){
                echo "Invalid Name";
            } else {
                // Execute
                $stmt->execute();
                //Close
                $stmt->close();
                $url = 'dashboard.php';
                header('Location: '.$url);
            }
        }
         ?>
		<h2>Login</h2>
		<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
			<circle class="circle" cx="25" cy="25" r="25"/>
			<polygon class="mountains" points="34.1,25 27.7,13.9 21.3,25 19.2,28.7 16.5,24 13,30 9.5,36.1 14.9,36.1 16.5,36.1 23.5,36.1 27.7,36.1 40.5,36.1"/>
		</svg>
		<input type="text" placeholder="email address" name="login-email">
		<input type="password" placeholder="password" name="login-password">
		<button class="button" name="login">Login</button>
		<!-- <p>Forgot your password?</p> -->
	</form>

	<form class="signup-form hide" method="POST">
        <?php
        if (isset($_POST['signup'])) {

            // Prepare
            $stmt = $conn->prepare("INSERT INTO user (first, last, email, password) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $first, $last, $email,$password);

            // Set variables
            $first = mysqli_real_escape_string($conn,$_POST['first']);
            $last = mysqli_real_escape_string($conn,$_POST['last']);
            $email = mysqli_real_escape_string($conn,$_POST['signup-email']);
            $password = mysqli_real_escape_string($conn,$_POST['signup-password']);

            if (!emailChk($conn, $email)) {
                echo "Invalid Email";
            } elseif (!passChk($password)) {
                echo "Password must be at a minimum of 8 character long and contain at least one Uppercase, one Lowercase and one Number";
            } elseif (!nameChk($first,$last)){
                echo "Invalid Name";
            } else {
                // Execute
                $stmt->execute();
                //Close
                $stmt->close();
                $url = 'signup.php';
                header('Location: '.$url);
            }
        }
         ?>
		<h2>Sign Up</h2>
		<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
			<circle class="circle" cx="25" cy="25" r="25"/>
			<polygon class="mountains" points="34.1,25 27.7,13.9 21.3,25 19.2,28.7 16.5,24 13,30 9.5,36.1 14.9,36.1 16.5,36.1 23.5,36.1 27.7,36.1 40.5,36.1"/>
		</svg>
		<input type="text" placeholder="first name" class="half" name="first">
		<input type="text" placeholder="last name" class="half" name="last">
		<input type="text" placeholder="email address" name="signup-email">
		<input type="password" placeholder="password" name="signup-password">
		<button name ="signup" class="button">Create Account</button>
		<!-- <p>Already a Member?</p> -->
	</form>
</div>
    <!-- <div class="container">

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

    </div> -->

    <script src="assets/js/signup.js"></script>
  </body>
</html>

<?php db_disconnect($conn);
?>
