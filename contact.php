<?php
session_start();
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

    
    <?php
include("includes/navigation-bar.php");
?>

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