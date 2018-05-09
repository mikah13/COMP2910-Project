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

function getDay($conn, $id, $day, $week)
{
    $sql = "SELECT recipe_id, quantity FROM user_recipe WHERE id = {$id} AND day = '{$day}' AND week = '${week}'";
    $result = mysqli_query($conn, $sql);
    $str = '[';
    while ($row = mysqli_fetch_assoc($result)) {
        $str.=printID($row).',';
    }
    $str = rtrim($str,',');
    $str.=']';
    return $str;
}

function printID($row) {
     return '{"recipe_id":'."{$row['recipe_id']},".'"quantity":'.$row['quantity']. '}';
}

function getRecentWeek($conn)
{
    $stmt = $conn->prepare("SELECT lastWeekNo FROM user_activity WHERE id = ?");
    $stmt->bind_param("s", $_SESSION['id']);
    if ($stmt->execute() == true) {
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $stmt->close();
    }
    return $row['lastWeekNo'];
}
$week = 'Week '.getRecentWeek($conn);
$table = array(
'Monday'  => getDay($conn, $_SESSION['id'], 'Monday', $week),
'Tuesday' =>  getDay($conn, $_SESSION['id'], 'Tuesday', $week),
'Wednesday' =>  getDay($conn, $_SESSION['id'], 'Wednesday', $week),
'Thursday' =>  getDay($conn, $_SESSION['id'], 'Thursday', $week),
'Friday' =>  getDay($conn, $_SESSION['id'], 'Friday', $week),
'Saturday' =>  getDay($conn, $_SESSION['id'], 'Saturday', $week),
'Sunday' =>  getDay($conn, $_SESSION['id'], 'Sunday', $week),

);

echo  json_encode($table);

db_disconnect($conn);
