<?php

?>

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

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><h1>LOGO</h1></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
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

    <div class="jumbotron rounded-0">
        <h2>Contact us</h2>
        <p class="lead">Send us an email and we will get back to you.</p>  
    </div>

    <br>

    <div class="container">

        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required="required" />
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required" />
                </div>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <div class="input-group">
                    <textarea name="message" id="message" class="form-control" rows="9" required="required" placeholder="Message"></textarea>
                </div>
                <br>
                <div class="input-group">
                    <input type="submit" id="submit" name="submit" value="Send Message" class="btn btn-primary">
                </div>
            </div>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>