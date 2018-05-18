<?php
require_once('../../../private/credential/initialize.php');
function getName($conn, $sessId)
{
    $id = $sessId;
    $stmt = "SELECT first, last FROM user WHERE id = {$id}";
    $result = mysqli_query($conn, $stmt);
    $result = mysqli_fetch_assoc($result);
    return $result['first'].' '.$result['last'];
}

session_start();
if (!isset($_SESSION['id'])) {
    echo '<li style="white-space: nowrap;"><a href="login.php" class="button">Login</a></li>
        <li style="white-space: nowrap;"><a href="register.php" class="button">Sign Up</a></li>';
} else {
    echo'<li><a href="profile.php" id="profile" class="button alt">'.getName($conn, $_SESSION['id']).'</a></li>';
}

db_disconnect($conn);
