<?php
session_start();
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
            <h1>Welcome to Avenu</h1>
            <p class="text-lead">Login to begin buying and selling.</p>
            <?php 
            if(!isset($_SESSION["username"])) {
                echo '<a class="btn btn-dark" href="login.php">Login</a>
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