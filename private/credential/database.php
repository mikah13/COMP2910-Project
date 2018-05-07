<?php
    require_once('db_credentials.php');
    function db_connect() {
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    function db_disconnect($conn) {
        if(isset($conn)) {
        $conn->close();
        }
    }
?>
