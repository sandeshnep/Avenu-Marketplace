<?php
require_once('includes/cookie-check.php');
check_cookie();

include("includes/auth.php");

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

    <div class="jumbotron rounded-0 p-tron">
        <div class="container">
            <div class="hero-image">
            <div class="hero-text">
            <h1><?php echo ' I am ' . $_SESSION['firstname'] ?></h1>
            <button class ="btn btn-edit" id ="edit-btn">Edit Profile</button>
        </div>
    </div>
            <!-- <h2>Profile page</h2>
            <p class="text-lead">Welcome <?php echo $_SESSION['firstname']; ?>!</p>
            <p><a href="logout.php">Logout</a></p> -->
        </div>
    </div> 

    <script>
    $("#edit-btn").attr("onclick","myEdit()");
    </script>

    <script>
        function myEdit()
        {
        
        document.getElementById('edit-btn').style.visibility = 'hidden';   
        window.alert("Changey");
        $('#profile-table')
        .html('<div id="update"> <div class="container"> <table class="table table-bordered"> <tr> <th>Name</th> <td><input type="text" id="full-name" name="fullname" placeholder="<?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];  ?>"></td> </tr> <tr> <th>Username</th> <td><?php echo $_SESSION['username'] ?></td> </tr> <tr> <th>Email address</th> <td><?php echo $_SESSION['email'] ?></td> </tr> </table> <button class ="btn btn-submit" id ="submit-btn" onclick="myUpdate()">Submit</button>  <br> <br> <br> <br> <br> </div> </div> }');
        }

         

       

        function myUpdate()
        {
        
        $name = $('#full-name').val();

        <?php
        require_once('includes/db.php');

    
        $username = $_SESSION["username"];

        // $sql = "UPDATE users SET firstname='$name' WHERE username='$username'";
        
        ?>
        document.getElementById('edit-btn').style.visibility = 'visible';  
        $('#update')
        .html('<div id="profile-table"> <div class="container"> <table class="table table-bordered"> <tr> <th>Name</th> <td><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></td> </tr> <tr> <th>Username</th> <td><?php echo $_SESSION['username'] ?></td> </tr> <tr> <th>Email address</th> <td><?php echo $_SESSION['email'] ?></td> </tr> </table> <br> <br> <br> <br> <br> </div> </div> }');
        
        window.alert($name);
        }
    </script>

    


    <div id = "profile-table">

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
    </div>

    <div class="container">

        <table class="table table-bordered">
            <tr>
                <th>Item 1</th>
                <td></td>
            </tr>
            <tr>
                <th>Item 2</th>
                <td></td>
            </tr>
            <tr>
                <th>Item 3</th>
                <td></td>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <script src="scripts/bootstrap.min.js"></script>
</body>

</html>