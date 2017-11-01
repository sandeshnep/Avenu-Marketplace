<?php
if(!isset($_SESSION['username'])) {
    session_start();
}
if(!isset($_SESSION['username'])) {
    header("Location: login.php"); 
}
?>