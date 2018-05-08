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

$stmt = "DELETE FROM user_recipe WHERE recipe_id = {$_POST['old_recipe_id']} AND day = '{$_POST['old_day']}' AND week = '{$_POST['old_week']}'";
mysqli_query($conn, $stmt);

db_disconnect($conn);

//  }
