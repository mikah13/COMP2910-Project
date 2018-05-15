<?php
require_once('../../../private/credential/initialize.php');
session_start();
    // Prepare

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Set variables

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if ($stmt->execute() == true) {
        $result = $stmt->get_result();
        $result =  mysqli_fetch_assoc($result);
        if (password_verify($password,$result['password'])) {
            $_SESSION['id'] = $result['id'];
            $stmt->close();
            echo 'Success';
        } else {
            echo '<p class="error col s12 center">Invalid email or password</p>';
        }
    }
 db_disconnect($conn);
