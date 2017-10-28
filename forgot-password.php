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
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    
    <?php
include("includes/navigation-bar.php");
?>

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

    <?php include("includes/footer.php"); ?>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>