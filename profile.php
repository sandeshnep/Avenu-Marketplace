<?php
$pagename = "PROFILE";
require_once('includes/functions.php');
check_cookie();

authenticate();

        require('includes/db.php');
<<<<<<< HEAD
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/profile.css" />
    <link rel="stylesheet" href="css/forms.css" />
</head>

<body>

   
    <?php
    include("includes/navigation-bar.php");
    ?>
=======
        // If form submitted, insert values into the database.
        if (isset($_POST['submit'])) {
            $username = $_SESSION['username'];

            $query = "SELECT * FROM `users` WHERE username='$username'";
            $result = mysqli_query($connect, $query) or die(mysqli_error());
            $profile = mysqli_fetch_assoc($result);
            $passwordcheck = $profile['password'];

            $passwordconfirm = stripslashes(md5($_POST['oldpassword']));

            if ($passwordconfirm == $passwordcheck) {

                if(empty($_POST['firstname'])){
                    $firstname = $profile['firstname'];
                }
                else{
                    $firstname = stripslashes($_POST['firstname']);
                }
                if(empty($_POST['lastname'])){
                    $lastname = $profile['lastname'];
                }
                else{
                    $lastname = stripslashes($_POST['lastname']);
                }
                if(empty($_POST['password'])){
                    $password = $profile['password'];
                }
                else{
                    $password = stripslashes(md5($_POST['password']));
                    $oldpassword = stripslashes(md5($_POST['oldpassword']));
                }
                
                $update = "UPDATE users 
                SET
                firstname = '$firstname', 
                lastname = '$lastname', 
                password = '$password'
                WHERE username = '$username'
                ";

                $result2 = mysqli_query($connect, $update);
                if (mysqli_query($connect, $update)) {
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $lastname;
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Profile updated successfully.</h3>
                    </div>';
                    // header("Refresh:1");
                    // header("Location: profile.php");
                } else {
                    echo '<div class="alert alert-danger">
                    <h3>Error updating profile.</h3>
                    <div>Error: ' . mysqli_error($connect); 
                    echo '</div></div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h3>Incorrect Password.</h3>
                <div>Please verify changes with your current password</div>
                </div>';
            }
        }

        
require_once('includes/header.php');
?>
>>>>>>> ece5471f2fa9667a1c66205736db519f1a3695d1

    <div class="jumbotron rounded-0 p-tron">
        <div class="container">
            <h1><?php echo ' I am ' . '<span id="firstname">' . $_SESSION['firstname'] . '</span>' ?></h1>
        </div>
    </div> 

    <div class='container'>

<<<<<<< HEAD
        <table class="table table-bordered" id="profile_table">
=======
        <table class='table table-bordered'>
>>>>>>> ece5471f2fa9667a1c66205736db519f1a3695d1
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

        <h3>Update account Information</h3>
        <br>

        <form  id="update_form">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your first name">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group" method="">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your last name">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="password">New password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter desired password">
            </div>
            <br>
            <div class="form-group">
                <h4>Verify changes with current password</h4>
                <label for="oldpassword">Current password</label>
                <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Enter current password">
            </div>
            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
        </form>

    </div>

    <br>

<<<<<<< HEAD
    <?php
    include("includes/footer.php");
    ?>

    <script>
            $(document).ready(function () {
                $('#update_form').on("submit", function(event) {
                    event.preventDefault();
                    
                   $.ajax({
                       url: "pform.php",
                       method: "POST",
                       data:$('#update_form').serialize(),
                       beforeSend:function() { $('#insert').val("Updating...");},
                       success:function(data)
                       {
                            $('#insert').val("Insert");
                            $('#update_form')[0].reset(); 
                            $('#profile_table').html(data); 
                           
                       }
                   })
                });
            });

            
        </script>
</body>
</html>
=======
<?php
include("includes/footer.php");
?>
>>>>>>> ece5471f2fa9667a1c66205736db519f1a3695d1
