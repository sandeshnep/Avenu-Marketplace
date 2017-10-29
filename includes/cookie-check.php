<?php
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];

    require_once('db.php');

    $query = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
    $result = mysqli_query($connect, $query) or die(mysqli_error());
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $profile = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        $_SESSION['firstname'] = $profile['firstname'];
        $_SESSION['lastname'] = $profile['lastname'];
        $_SESSION['email'] = $profile['email'];
    }
}
?>
