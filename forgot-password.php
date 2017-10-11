<?php
require_once('includes/db.php');
require('includes/php-mailer-autoload.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
        crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <h1>LOGO</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php
            if (!isset($_SESSION["username"])) {
                    echo
                '<li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>';
            }
            ?>
                    <?php
            if (isset($_SESSION["username"])) {
                echo
                '<li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="includes/logout.php">Logout</a>
                </li>';
            }
            ?>
            </ul>
        </div>
    </nav>

    <div class="jumbotron">
        <h2>Password retrieval</h2>
        <p class="lead">Type in your username to retrieve password</p>
    </div>

    <div class="container">
        <br>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Forgot Password</button>
        </form>

    <?php
        if (isset($_POST) & !empty($_POST)) {
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $query = "SELECT * FROM `users` WHERE username='$username'";
        $res = mysqli_query($connect, $query);
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $r = mysqli_fetch_assoc($res);
            $password = $r['password'];
            $to = $r['email'];
            $subject = "Your Recovered Password";
            $message = 'Please use this password to login ' . $password;
            $headers = 'From: zabaziz@u.rochester.edu';
            if (mail($to, $subject, $message, $headers)) {
                echo '<div class="text-success">Your password has been sent to your email id</div>';
            } else {
                echo '<div class="text-danger">Failed to recover your password, try again</div>';
            }
        } else {
            echo '<div class="text-danger">User name does not exist in database</div>';
        }
    }
    ?>

    </div>

    <footer class="bg-dark pt-3 pb-3">
        <div class="container">
            <div class="text-muted">
                <h3>Contact us <a href="contact.php">here</a></h3>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>