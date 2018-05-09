<?php
require_once('../../../private/credential/initialize.php');
session_start();
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
            echo 'Success';
        } else {
            echo '<p class="error col s12 center">Invalid email or password</p>';
        }
    }
 db_disconnect($conn);
