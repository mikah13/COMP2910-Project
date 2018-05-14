<?php
require_once('../private/credential/initialize.php');
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
$id = $_SESSION['id'];
$stmt = "SELECT first, last FROM user WHERE id = {$id}";
$result = mysqli_query($conn, $stmt);
echo mysqli_fetch_assoc($result)['first'].' '.mysqli_fetch_assoc($result)['last'];
