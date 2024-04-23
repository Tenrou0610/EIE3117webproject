<?php
// config.php

// Set session cookie parameters
session_set_cookie_params(0, '/', null, true, true);

$cookie_timeout = 3600; 
$cookie_domain = ''; 
$session_secure = false; 
$cookie_httponly = true; 

session_set_cookie_params([
    'lifetime' => $cookie_timeout,
    'path' => '/',
    'domain' => $cookie_domain,
    'secure' => $session_secure,
    'httponly' => $cookie_httponly,
    'samesite' => 'Lax'
]);
?>