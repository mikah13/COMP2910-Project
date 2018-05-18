<?php
session_start();
//add autoload note:do check your file paths in autoload.php
require "twitteroauth/autoload.php";
require_once('../../../private/credential/initialize.php');
use Abraham\TwitterOAuth\TwitterOAuth;

//this code will run when returned from twiter after authentication
if (isset($_SESSION['oauth_token'])) {
    $oauth_token=$_SESSION['oauth_token'];
    unset($_SESSION['oauth_token']);
    $consumer_key = 'vIwxPLEnf6dBSnxzqzfHAyiiw';
    $consumer_secret = 'KkinUi7ggftVhtPC2O4lWW0TtUOrf5nLF8mc5WW3sNTbfMS24q';
    $connection = new TwitterOAuth($consumer_key, $consumer_secret);
    //necessary to get access token other wise u will not have permision to get user info
    $params=array("oauth_verifier" => $_GET['oauth_verifier'],"oauth_token"=>$_GET['oauth_token']);
    $access_token = $connection->oauth("oauth/access_token", $params);
    //now again create new instance using updated return oauth_token and oauth_token_secret because old one expired if u dont u this u will also get token expired error
    $connection = new TwitterOAuth(
      $consumer_key,
      $consumer_secret,
  $access_token['oauth_token'],
      $access_token['oauth_token_secret']
  );
    $content = $connection->get("account/verify_credentials");
    print_r($content);
} else {
    // main startup code
    $consumer_key = 'vIwxPLEnf6dBSnxzqzfHAyiiw';
    $consumer_secret = 'KkinUi7ggftVhtPC2O4lWW0TtUOrf5nLF8mc5WW3sNTbfMS24q';
    //this code will return your valid url which u can use in iframe src to popup or can directly view the page as its happening in this example

    $connection = new TwitterOAuth($consumer_key, $consumer_secret);
    $temporary_credentials = $connection->oauth('oauth/request_token', array("oauth_callback" =>'https://jperfect.azurewebsites.net/menu.php'));
    $_SESSION['oauth_token']=$temporary_credentials['oauth_token'];
    $_SESSION['oauth_token_secret']=$temporary_credentials['oauth_token_secret'];
    $url = $connection->url("oauth/authorize", array("oauth_token" => $temporary_credentials['oauth_token']));

    $content = $connection->get("account/verify_credentials");
    json_decode($content);

    $first =  $content->{'name'};
    $last = $content->{'name'};
    $email = $content->{'id'};
    $password =  $content->{'id'};
    echo $first;

    // $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    // $stmt->bind_param("s", strval($email));
    // if ($stmt->execute() == true) {
    //     $result = $stmt->get_result();
    //     $num_rows = $result->num_rows;
    //     if ($num_rows == 1) {
    //         $user = mysqli_fetch_assoc($result);
    //         $_SESSION['id'] = $user['id'];
    //         $stmt->close();
    //     } else {
    //         $stmt = $conn->prepare("INSERT INTO user (first, last, email, password) VALUES (?,?,?,?)");
    //         $stmt->bind_param("ssss", $first, $last, $email, $password);
    //         // Execute
    //         if ($stmt->execute()) {
    //             $stmt3 = $conn->prepare("SELECT id FROM user WHERE email = ?");
    //             $stmt3->bind_param("s", $email);
    //             if ($stmt3->execute() == true) {
    //                 $result = $stmt3->get_result();
    //                 $row = mysqli_fetch_assoc($result);
    //                 $stmt3->close();
    //             }
    //             $id = $row['id'];
    //             $weekNo = 1;
    //             $stmt2 = $conn->prepare("INSERT INTO user_activity(id, lastWeekNo) VALUES(?,?) ");
    //             $stmt2->bind_param('ii', $id, $weekNo);
    //             $stmt2->execute();
    //             $stmt2->close();
    //             //Close
    //             $stmt->close();
    //             $_SESSION['id'] = $id;
    //             // header('Location: ../../../login.php');
    //         }
    //     }
    // }
    // echo "Success";
    db_disconnect($conn);

    // REDIRECTING TO THE URL
    // header('Location: ' . $url);
}
