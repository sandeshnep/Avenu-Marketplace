<?php

$host = "localhost"; // Host name
$db_username = "root"; // Mysql username
$password = ""; // Mysql password
$db_name = "register"; // Database name

$con = mysqli_connect($host, $db_username, $password, $db_name);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>