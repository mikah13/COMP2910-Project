<?php
require_once('../../../private/credential/initialize.php');

function getDay($day)
{
    $result = '';
    $sql = "SELECT * FROM user_recipe WHERE day = '{$day}'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $result .= '<a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-info text-white" title="Test Event 1">'.$row["recipe_title"].'</a>';
    }
    return $result;
}



 db_disconnect($conn);
