<?php
require_once('includes/cookie-check.php');
check_cookie();

include("includes/auth.php");

        require('includes/db.php');
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

    <div class="jumbotron rounded-0 p-tron">
        <div class="container">
            <h1><?php echo ' I am ' . '<span id="firstname">' . $_SESSION['firstname'] . '</span>' ?></h1>
        </div>
    </div> 

    <div class="container">

        <table class="table table-bordered" id="profile_table">
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