<?php 
session_start();
require_once('../../../private/credential/initialize.php');
$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("ss", $email);
if ($stmt->execute() == true) {
        $result = $stmt->get_result();
        $num_rows = $result->num_rows;  
        if ($num_rows == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $user['id'];
            $stmt->close();
}else{
        $stmt = $conn->prepare("INSERT INTO user (first, last, email, password) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $first, $last, $email, $password);

    // Execute
    if ($stmt->execute()) {
        $stmt3 = $conn->prepare("SELECT id FROM user WHERE email = ?");
        $stmt3->bind_param("s", $email);
        if ($stmt3->execute() == true) {
            $result = $stmt3->get_result();
            $row = mysqli_fetch_assoc($result);
            $stmt3->close();
        }
        $id = $row['id'];
        $weekNo = 1;
        $stmt2 = $conn->prepare("INSERT INTO user_activity(id, lastWeekNo) VALUES(?,?) ");
        $stmt2->bind_param('ii',$id,$weekNo);
        $stmt2->execute();
        $stmt2->close();
        //Close
        $stmt->close();
        $_SESSION['id'] = $user['id'];
        // header('Location: ../../../login.php');
    }  
        }
}
        echo "Success";
 db_disconnect($conn);
