<?php
$pagename = "PASSWORD RETRIEVAL";
require_once('includes/functions.php');
check_cookie();

require_once('includes/header.php');
?>

    <div class="jumbotron rounded-0">
        <h2>Password retrieval</h2>
        <p class="lead">Type in your username to retrieve password</p>
    </div>

    <div class="container">
        <br>
        <form class="form" method="POST">
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
            $row = mysqli_fetch_assoc($res);
            $password = $r['password'];
            $to = $row['email'];
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

    <br>
    <br>
    </div>

    <?php
    require_once("includes/footer.php");
    ?>