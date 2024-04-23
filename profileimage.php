<?php
ini_set("session.cookie_httponly", 1);
require_once 'config.php';
session_start();
include 'connect.php';

if (isset($_SESSION['userid'])) {
    $SESSIONID = $_SESSION['userid'];
    $userResult = mysqli_query($connection, "SELECT * FROM `registration` WHERE id = $SESSIONID");
    $user = mysqli_fetch_assoc($userResult);
    $profileimage = $user['profileimage'];
}
?>