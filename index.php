<?php

    $dbhost = '127.0.0.1';
    $dbuser = 'mikah';
    $dbpass = '29071308';
    $dbname = 'food';

    // Create connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "CREATE TABLE food_track(x INT(1))";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
    mysqli_close($conn);
