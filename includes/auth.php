<?php
session_start();

$cookie_name = "user";
$cookie_value = $_SESSION['username'];
setcookie($cookie_name, $cookie_value, time()+86400); //expires in one day

if(!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}
?>