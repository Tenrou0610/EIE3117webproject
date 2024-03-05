<?php
//database connection
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'pforumsignup';




$connection = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);
$connection->set_charset("UTF8");








if (!$connection) {
   echo "Connection failed:";
}
