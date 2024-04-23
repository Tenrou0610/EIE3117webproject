<?php
ini_set("session.cookie_httponly", 1);
require_once 'config.php';
session_start();
include 'connect.php';
date_default_timezone_set('Asia/Singapore');

// if the send chat button is pressed, the data should be insert into the table message
if (isset($_GET['sendchat'])) {
    $content = $_GET['content'];
    $group_id = $_GET['group_id'];
    $nickname = $_COOKIE['nickname_cookie'];
    $user_id = $_GET['session_id'];
    $posted_at = date('Y-m-d H:i:s');

    if (empty($content)) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Warning!</strong> You need write something!
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
        exit;
    }
    $insert_message_query = "INSERT INTO `message` (group_id, user_id, nickname, content, posted_at) VALUES ('$group_id', '$user_id', '$nickname','$content', '$posted_at')";
    $message_query_result = mysqli_query($connection, $insert_message_query);
    if ($message_query_result) {
        $_SESSION['comment_message']= "You have successfully commented.";
        header("Location: index.php");
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Warning!</strong> Something Wrong!
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
        die(mysqli_error($connection));
    }
}

?>

