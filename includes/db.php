<?php

$host = "localhost"; // Host name
$db_username = "team24"; // Mysql username
$password = "marketplace"; // Mysql password
$db_name = "registration"; // Database name

$connect = mysqli_connect($host, $db_username, $password, $db_name);
// Check connection
if (!$connect) {
    die("Database Connection Failed" . mysqli_error());
}

?>