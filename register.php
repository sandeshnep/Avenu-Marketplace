<?php
require_once('includes/cookie-check.php');
check_cookie();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    
    <?php
    include("includes/navigation-bar.php");
    ?>
    <div class="container">

        <br>

        <?php
        require('includes/db.php');
        // If form submitted, insert values into the database.
        if (isset($_POST['username']) && (isset($_POST['password']) == isset($_POST['password2']))){
            $firstname = stripslashes($_POST['firstname']);
            $lastname = stripslashes($_POST['lastname']);
            $username = stripslashes($_POST['username']);
            $email = stripslashes($_POST['email']);
            $password = stripslashes(md5($_POST['password']));
    
            $query = "INSERT INTO `users` (firstname, lastname, username, password, email) VALUES ('$firstname', '$lastname', '$username', '$password', '$email')";
            $usercheck = "SELECT * FROM `users` WHERE username='$username'";
            $result = mysqli_query($connect, $usercheck);
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                echo '<div class="lead text-danger">Please use another username</div>
                <div class="lead">Click here to <a href="register.php">try again</a></div>';
            } else {
                $result = mysqli_query($connect, $query);
                if($result){
                    echo '<div class="jumbotron alert-success">
                    <h3>Registered successfully.</h3>
                    <div class="lead">Click here to <a href="login.php">login</a></div>
                    </div>';
                } else { 
                    echo '<div class="jumbotron alert-danger">
                    <h3>Failed to register.</h3>
                    <div class="lead">Click here to <a href="register.php">try again</a></div>
                    </div>';
                }
            }
        } else {
        ?>

        <h2>Register for an account</h2>
        <br>

        <form action="" method="POST" name="registration">
            <div class="row">
            <div class="col">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your first name">
            </div>
            </div>
            <div class="col">
            <div class="form-group" method="POST">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your last name">
            </div>
            </div>
            </div>
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter desired username">
                <span id="usernameResult"></span>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter your email address">
                <small id="emailHelp" class="form-text text-muted">We won't share your email with anyone.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter desired password">
            </div>
            <div class="form-group">
                <label for="password2">Verify password</label>
                <input type="password" class="form-control" name="password2" id="password2" placeholder="Re-enter password">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Register</button>
        </form>
    </div>

    <br>

    <?php include("includes/footer.php"); ?>

    <script src="scripts/jquery-3.2.1.slim.min.js"</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="scripts/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#usernameLoading').hide();
            $('#username').keyup(function () {
                $('#usernameLoading').show();
                $.post("includes/check.php", {
                    username: $('#username').val()
                }, function (response) {
                    $('#usernameResult').fadeOut();
                    setTimeout("finishAjax('usernameResult', '" + escape(response) + "')", 400);
                });
                return false;
            });
        });

        function finishAjax(id, response) {
            $('#usernameLoading').hide();
            $('#' + id).html(unescape(response));
            $('#' + id).fadeIn();
        } //finishAjax
    </script>
<?php } ?>
</body>
</html>
