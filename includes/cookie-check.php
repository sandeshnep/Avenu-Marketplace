<?php

function check_cookie(){
    require_once('db.php');

    //if the cookie is set, use those values to login!
    if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {

     session_start();
     
    //using cookies to set the session variables!
    $username = $_SESSION['username'] = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $_SESSION['loggedin'] = true;

    $query = "SELECT * FROM `users` WHERE username='$username' and password = '$password'";

    $result = mysqli_query($connect, $query) or die(mysqli_error());
        $rows = mysqli_num_rows($result);
            if ($rows == 1) {

                $profile = mysqli_fetch_assoc($result);
                $_SESSION['firstname'] = $profile['firstname'];
                $_SESSION['lastname'] = $profile['lastname'];
                $_SESSION['email'] = $profile['email'];}

     }
    }

    //for pages like login.php. If there is a cookie, then the redirect function takes to index.php.
    //Note: must be run after check_cookie function. 
    function redirect(){
          if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            header( 'Location: index.php' ) ;
          }
    }
?>
