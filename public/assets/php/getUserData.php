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


$userdata = "SELECT age, gender, country, favourite, picture FROM user WHERE id = {$_SESSION["id"]}";
$results = mysqli_query($conn, $userdata);
echo json_encode(mysqli_fetch_assoc($results));
db_disconnect($conn);
