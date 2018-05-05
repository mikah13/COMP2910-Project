<?php
    require_once('db_credentials.php');
    function db_connect() {
        $conn = new mysqli('localhost', 'nirajan', 'Dontfearm3', 'food')
        or die($conn->connect_error);
        return $conn;
    }

    function db_disconnect($conn) {
        if(isset($conn)) {
        $conn->close();
        }
    }
?>
