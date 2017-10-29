<?php
if(!isset($_SESSION['username'])) {
    session_start();
}
?>


<?php
require_once('includes/db.php');

//testing cookies!
//print cookie status:
//$cookie_name = "username";
/*if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}*/

//if the cookie is set, use those values to login!
if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
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
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home | CSC210 Project</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <?php
    include("includes/navigation-bar.php");
    ?>


    <div class="jumbotron rounded-0">
        <div class="container">
            <?php 
            if(!empty($_SESSION["username"])) {
                echo '<h1>Welcome Back to Avenu</h1> 
                <p class="text-lead">Go to your profile to begin!</p>';
            }
            ?>
            <?php 
            if(!isset($_SESSION["username"])) {
                echo '<h1>Welcome to Avenu</h1>
                <p class="text-lead">Login to begin buying and selling.</p>
                <a class="btn btn-dark" href="login.php">Login</a>
                <a class="btn btn-primary" href="register.php">Register</a>';
            }
            ?>
        </div>
    </div>

    <div class="container">

        <article>
            <p>
                Avenu is the first online marketplace desgined specifically for high school students. Upload
                items to your profile that you want to sell, or browse others' profiles for things to buy.
            </p>
            <p>See something you like? Simply click "BUY NOW" and fill in your purchase info. We'll take care of the rest.</p>
            <p>For a complete list of rules and regulations, click <a href="rules.php">here.</a></p>
        </article>

    </div>

    <?php include("includes/footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>