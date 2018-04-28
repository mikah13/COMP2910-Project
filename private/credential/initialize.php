<?php
    ob_start();
    require_once('database.php');
    $conn = db_connect();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }   

?>
