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
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $stmt = "SELECT summary FROM recipe  WHERE recipe_id = {$id}";
    $result = mysqli_query($conn, $stmt);
    echo mysqli_fetch_assoc($result)['summary'];
}
db_disconnect($conn);
