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
    <link rel="stylesheet" href="css/forms.css" />
</head>

<body>

   
    <?php
    include("includes/navigation-bar.php");
    ?>

    <div class="jumbotron rounded-0 p-tron">
        <div class="container">
            <h1><?php echo ' I am ' . $_SESSION['firstname'] ?></h1>
        </div>
    </div> 

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

    </div>

    <br>

    <div class="container">

        <?php
        require('includes/db.php');
        // If form submitted, insert values into the database.
        if (isset($_POST['submit'])) {
            $username = $_SESSION['username'];
            
            $firstname = stripslashes($_POST['firstname']);
            $lastname = stripslashes($_POST['lastname']);
            $email = stripslashes($_POST['email']);
            $password = stripslashes(md5($_POST['password']));

            $query = "UPDATE users 
            SET
            firstname = '$firstname', 
            lastname = '$lastname', 
            password = '$password'
            WHERE username = '$username'
            ";
            
            $result = mysqli_query($connect, $query);
            if (mysqli_query($connect, $query)) {
                echo '<div class="alert alert-success">
                <h3>Profile updated successfully.</h3>
                </div>';
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['email'] = $email;
                header("Location: profile.php");
            } else {
                echo '<div class="alert alert-success">
                <h3>Error updating profile.</h3>
                <div>Error: ' . mysqli_error($connect); 
                echo '</div></div>';
            }
        }
        ?>

        <h3>Update account Information</h3>
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
                <label for="password">New password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter desired password">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </form>

    </div>

    <br>

    <?php include("includes/footer.php"); ?>

    <script src="scripts/jquery-3.2.1.min.js"</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <script src="scripts/bootstrap.min.js"></script>

</body>
</html>
