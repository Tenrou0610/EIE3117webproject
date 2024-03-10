<?php
session_start();
include 'connect.php';

if (isset($_SESSION['userid'])) {
    $SESSIONID = $_SESSION['userid'];
    $userResult = mysqli_query($connection, "SELECT * FROM `registration` WHERE id = $SESSIONID");
    $user = mysqli_fetch_assoc($userResult);
    $profileimage = $user['profileimage'];
}
?>