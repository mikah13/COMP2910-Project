<?php
session_start();
require_once('../../../private/credential/initialize.php');
require_once('validation.php');
$stmt = $conn->prepare("INSERT INTO user (first, last, email, password) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $first, $last, $email, $password);

// Set variables
$first = mysqli_real_escape_string($conn, $_POST['first']);
$last = mysqli_real_escape_string($conn, $_POST['last']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$options = [
    'cost' => 12,
];
$password = password_hash($password, PASSWORD_BCRYPT, $options);

if (!emailChk($conn, $email)) {
    echo "Invalid Email";
} elseif(!existedChk($conn, $email)){
    echo "Email is existed";
} elseif (!passChk($password)) {
    echo "Password must contain at least 8 characters, <br /> one Uppercase, one Lowercase and one Number";
} elseif (!nameChk($first, $last)) {
    echo "Invalid First and Last name";
} else {

    // Execute
    if ($stmt->execute()) {
        $stmt3 = $conn->prepare("SELECT id FROM user WHERE email = ?");
        $stmt3->bind_param("s", $email);
        if ($stmt3->execute() == true) {
            $result = $stmt3->get_result();
            $row = mysqli_fetch_assoc($result);
            $stmt3->close();
        }
        $id = $row['id'];
        $weekNo = 1;
        $stmt2 = $conn->prepare("INSERT INTO user_activity(id, lastWeekNo) VALUES(?,?) ");
        $stmt2->bind_param('ii',$id,$weekNo);
        $stmt2->execute();
        $stmt2->close();
        //Close
        $stmt->close();
        $_SESSION['id'] = $id;
        $_SESSION['register'] = 0;
        echo "Success";
        // header('Location: ../../../login.php');
    }
}
 db_disconnect($conn);
