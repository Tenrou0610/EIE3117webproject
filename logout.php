<?php
session_start();
if(isset($_SESSION['username'])){
   unset($_SESSION['username']);
   //set the cookie to the past time to make the cookie expired 
   setcookie('username_cookie', '', time() - 3600, '/');
   setcookie('password_cookie', '', time() - 3600, '/');
   header("Location: login.php");
   exit();
}


