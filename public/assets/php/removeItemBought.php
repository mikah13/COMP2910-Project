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

$stmt = "SELECT boughtItem FROM user_activity WHERE id = {$_SESSION['id']}";
$result = mysqli_query($conn, $stmt);
$items = mysqli_fetch_assoc($result)['boughtItem'];
$array = explode(', ', $items);
$index =  array_search($_POST['item'], $array);
array_splice($array,$index,1);
$items = implode(", ",$array);
$stmt = "UPDATE user_activity SET boughtItem = '{$items}' WHERE id = {$_SESSION['id']}";
mysqli_query($conn, $stmt);

db_disconnect($conn);

//  }
