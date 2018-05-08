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
    $sql = "SELECT recipe_id, recipe_title, quantity FROM user_recipe WHERE id = {$id} AND day = '{$day}' AND week = '${week}'";
    $result = mysqli_query($conn, $sql);
    $start = "09:00";
    $end = "10:00";
    $str = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $str.=printRecipes($row, $start, $end);
        $start = $end;
        $end = addTime($end);
    }
    return $str;
}
function printRecipes($str, $start, $end)
{
    return '<li class="single-event" data-start="'.$start.'" data-end="'.$end.'" data-content="event-rowing-as" data-event="event-2">
    <a href="#0"><em class="event-name">'.$str['recipe_title'].'</em><p class="qty" style="color:aqua;margin-top:5px">Quantity: '.$str['quantity'].'</p><span style="display:none" class="recipe_id">'.$str['recipe_id'].'</span> </a></li>';
}

function addTime($time)
{
    $old =  substr($time, 0, 2);
    $new = intval($old);
    $new++;
    $new = strval($new);
    return str_replace($old, $new, $time);
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
