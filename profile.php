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
    <link rel="stylesheet" href="css/bootstrap.min.css">
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

    <script src="scripts/jquery-3.2.1.slim.min.js"</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="scripts/bootstrap.min.js"></script>
</body>

</html>