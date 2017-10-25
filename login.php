<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>

<body>

    
    <?php
include("includes/navigation-bar.php");
?>

    <div class="container">
    <br>

    <?php
        require_once('includes/db.php');
        session_start();
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
    
    <form action="" method="post" name="login">
        <div class="form-group">
    <label for="username">User Name</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
        </div>
        <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Login</button>
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

    <?php include("includes/footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <?php                                                                                                                                                                                                                         } ?>
</body>
</html>
