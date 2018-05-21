<?php
require_once('../../../private/credential/initialize.php');
session_start();
$stmt = $conn->prepare("SELECT id FROM user WHERE id = ?");
$stmt->bind_param("s", $_SESSION['id']);
if ($stmt->execute() == true) {
    $result = $stmt->get_result();
    $user = mysqli_fetch_assoc($result);
    $stmt->close();
}


// $login_session = $row['username'];

if (!isset($_SESSION['id'])) {
    header("Location:../../login.php");
}
if(isset($_SESSION['register'])){
    $age = $_POST['age'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $favStr = $_POST['favStr'];

    $stmt = "UPDATE user
            SET age = {$age},
                gender = '{$gender}',
                country = '{$country}',
                favourite = '{$favStr}'
            WHERE id = {$_SESSION['id']}";
    if(mysqli_query($conn, $stmt)){
        unset($_SESSION['register']);
    }

}
