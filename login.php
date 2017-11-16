<?php

//redirects from login to index.php if cookie is valid
if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){  //without this, there will me a sql conflict
    include('includes/cookie-check.php');
    check_cookie();
    redirect();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/forms.css" />
</head>

<body>

    
    <?php
    include("includes/navigation-bar.php");
    ?>

    <div class="container">
    <br>

    <?php
        require_once('includes/db.php');
        if(!isset($_SESSION['username'])) {
            session_start();
        }
        // If form submitted, insert values into the database.
    if (isset($_POST['submit']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        //Checking if user exists in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
        $result = mysqli_query($connect, $query) or die(mysqli_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;

            $profile = mysqli_fetch_assoc($result);
            $_SESSION['firstname'] = $profile['firstname'];
            $_SESSION['lastname'] = $profile['lastname'];
            $_SESSION['email'] = $profile['email'];

            if (isset($_POST['remember'])) {
                //setting the relevant cookies
                setcookie("username", $username, time()+86400, "/");
                setcookie("password", md5($password), time()+86400, "/");
            }

            header("Location: index.php");
        } else {
            echo '<div class="jumbotron alert-danger">
            <h3>Failed to login.</h3>
            <div class="lead">Incorrect username or password</div>
            <div class="lead">Click here to <a href="login.php">try again</a></div>
            </div>';
        }
    } else {
        ?>

    <h2>Login to your account</h2>
    <br>
    
    <form class="form" action="" method="post" name="login">
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
    </div>
    <div class="form-group">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label>
    </div>
    <button type="submit" name="submit" class="btn btn-success">Login</button>
    </form>

    <br>

    <p>Forgot your password? <a href="forgot-password.php">Retrieve password here</a></p>
    <p>Not registered yet? <a href="register.php">Register Here</a></p>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php } ?>

    <?php include("includes/footer.php"); ?>

    <script src="scripts/jquery-3.2.1.slim.min.js"</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="scripts/bootstrap.min.js"></script>
    
</body>
</html>
