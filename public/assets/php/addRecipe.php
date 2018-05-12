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

$stmt = "SELECT * FROM user_recipe WHERE recipe_id = {$_POST['recipe_id']} AND day = '{$_POST['day']}' AND week = '{$_POST['week']}'";
$result = mysqli_query($conn, $stmt);
if (mysqli_num_rows($result) === 0) {
    $stmt = "INSERT INTO user_recipe(id, recipe_id, recipe_title ,day, week, quantity) VALUES({$_SESSION['id']}, {$_POST['recipe_id']},'{$_POST['recipe_title']}','{$_POST['day']}', '{$_POST['week']}', {$_POST['quantity']})";
    mysqli_query($conn, $stmt);
    echo 'insert';

} else {
    $quantity = mysqli_fetch_assoc($result) ['quantity'] + $_POST['quantity'];
    $stmt = "UPDATE user_recipe SET quantity = {$quantity} WHERE recipe_id = {$_POST['recipe_id']} AND day = '{$_POST['day']}' AND day = '{$_POST['day']}'";
    mysqli_query($conn, $stmt);
    echo 'update';
}
db_disconnect($conn);

//  }
