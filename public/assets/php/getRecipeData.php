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

$str = '[';
$data = json_decode($_POST['data']);

foreach ($data as $item ) {
    $str.=getRecipeData($conn, $item).',';
}
$str = rtrim($str,',');
$str.=']';
echo $str;
function getRecipeData($conn, $id)
{
    $stmt = "SELECT  data FROM recipe WHERE recipe_id = {$id}";
    $result = mysqli_query($conn, $stmt);
    return mysqli_fetch_assoc($result)['data'];
}
//
//
//
// echo json_encode( getRecipeData($conn, $_POST['recipe_id']));

db_disconnect($conn);
