<?php
include("includes/auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/profile.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>

<body>

   
    <?php
include("includes/navigation-bar.php");
?>

    <div class="jumbotron p-tron">
        <div class="container">
            <div class="hero-image">
            <div class="hero-text">
            <h1><?php echo ' I am ' . $_SESSION['firstname'] ?></h1>
            <button class = "btn btn-edit" onclick ="myEdit()">Edit Profile</button>
        </div>
    </div>
            <!-- <h2>Profile page</h2>
            <p class="text-lead">Welcome <?php echo $_SESSION['firstname']; ?>!</p>
            <p><a href="logout.php">Logout</a></p> -->
        </div>
    </div> 

    <script>
        function myEdit()
        {

        }
    </script>



    <div class="container">

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?php echo $_SESSION['username'] ?></td>
            </tr>
            <tr>
                <th>Email address</th>
                <td><?php echo $_SESSION['email'] ?></td>
            </tr>
        </table>

        <br>
        <br>
        <br>
        <br>
        <br>

    </div>

    <br>

    <?php include("includes/footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>