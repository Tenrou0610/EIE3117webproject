<?php
   //hash password for both login and sign in
   function hashed_password($password){
       return password_hash($password, PASSWORD_DEFAULT);
   }
?>