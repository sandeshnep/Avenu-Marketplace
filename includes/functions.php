<?php

$db_host = "localhost"; // Host name
$db_username = "team24"; // Mysql username
$db_password = "marketplace"; // Mysql password
$db_name = "registration"; // Database name

$connect = mysqli_connect($db_host, $db_username, $db_password, $db_name);
// Check connection
if (!$connect) {
    die("Database Connection Failed" . mysqli_error());
}

function createTable($name, $query) {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.";
}

function queryMysql($query) {
    global $connect;
    $result = $connect->query($query);
    if (!$result) {
        die($connect->error);
    }
    return $result;
}

function destroySession() {
    session_start();
    $_SESSION = array();
    session_unset();
    session_destroy();
    //deleting cookies
    setcookie("username", "", time()-1, "/" );
    setcookie("password", "", time()-1, "/" );
    header("Location: ../login.php");
}

function sanitizeString($var) {
    global $connect;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connect->real_escape_string($var);
}

function showProfile($username) {
    $result = queryMysql("SELECT * FROM users WHERE username='$username'");
    
    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row['firstname']) . " " . stripslashes($row['lastname']) .
        "<br>" .
        "Username: " . stripslashes($row['username']) .
        "<br style='clear:left;'><br>";
    }
}

function authenticate() {
    if (!isset($_SESSION['username'])) {
        session_start();
    }
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }
}

function check_cookie() {
    require_once('db.php');

    //if the cookie is set, use those values to login!
    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        if (!isset($_SESSION)) {
            session_start();
        }

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
            $_SESSION['email'] = $profile['email'];
        }
    }
}

    //for pages like login.php. If there is a cookie, then the redirect function takes to index.php.
    //Note: must be run after check_cookie function.
function redirect() {
    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        header( 'Location: index.php' ) ;
    }
    if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
        header( 'Location: index.php' ) ;
    }
}

function refresh() {
    header("Refresh:0");
}
