<?php
ini_set("session.cookie_httponly", 1);
require_once 'config.php';
session_start();
if(isset($_SESSION['username'])){
   unset($_SESSION['username']);
   //set the cookie to the past time to make the cookie expired 
   setcookie('username_cookie', '', time() - 3600, '/', NULL, NULL, TRUE);
   setcookie('password_cookie', '', time() - 3600, '/', NULL, NULL, TRUE);
   setcookie('userid_cookie', '', time() - 3600, '/', NULL, NULL, TRUE);
   setcookie('nickname_cookie', '', time() - 3600, '/', NULL, NULL, TRUE);
   header("Location: login.php");
   exit();
}

?>
