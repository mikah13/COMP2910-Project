<?php
require_once('../../../private/credential/initialize.php');
require_once('validation.php');
$stmt = $conn->prepare("INSERT INTO user (first, last, email, password) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $first, $last, $email, $password);

// Set variables
$first = mysqli_real_escape_string($conn, $_POST['first']);
$last = mysqli_real_escape_string($conn, $_POST['last']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!emailChk($conn, $email)) {
    echo "Invalid Email";
} elseif (!passChk($password)) {
    echo "Password must contain at least 8 characters, <br /> one Uppercase, one Lowercase and one Number";
} elseif (!nameChk($first, $last)) {
    echo "Invalid First and Last name";
} else {
    $_SESSION["reg-error"] = '';
    // Execute
    if ($stmt->execute()) {
        //Close
        $stmt->close();
        echo "Success";
        // header('Location: ../../../login.php');
    }
}
 db_disconnect($conn);
