<?php
if(!isset($_SESSION['username'])) {
    session_start();
}
$pagename = "PROFILE";
require_once('includes/functions.php');
check_cookie();
authenticate();

require_once('includes/header.php');
?>
    <html>
    <div class="jumbotron rounded-0 p-tron">
        <div class="container">
            <div id="refreshpic">
            <h1>
                <?php echo ' I am ' . '<span id="firstname">' . $_SESSION['firstname'] . '</span>' ?>
            </h1>
            <?php
                $user = $_SESSION['username'];
                $query = "SELECT * FROM `users` WHERE username='$user'";
                $result = mysqli_query($connect, $query);
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    if(is_null($row['profimg'])){
                        echo'<img src="img/profimg/generic-profile.jpg" height="200" width="200">';
                    }
                    else{
                        echo'<img src="'.$row['profimg'].'" height="200" width="200">';
                    }
                }
            ?>
        </div>
    </div>
    </div>

    <div class='container'>

        <table class="table table-bordered" id="profile_table">
            <tr>
                <th>Name</th>
                <td>
                    <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>
                </td>
            </tr>
            <tr>
                <th>Username</th>
                <td>
                    <?php echo $_SESSION['username'] ?>
                </td>
            </tr>
            <tr>
                <th>Email address</th>
                <td>
                    <?php echo $_SESSION['email'] ?>
                </td>
            </tr>
        </table>

    </div>

    <br>

<?php 
    
    if(isset($_POST['delete'])){

        echo'<div class="container"><h2>Are you sure you want to delete your account? This cannot be undone.</h2>
        <form method="POST">
            <button type="submit" name="deleteyes" class="btn btn-danger btn-sm float-left">Yes, Delete My Account.</button>
        </form>
        <form method="POST">
            <button type="submit" name="deleteno" class="btn btn-danger btn-sm float-right">No, Keep My Account.</button>
        </form>
        </div>
        ';
    }
?>

<?php
    require_once('includes/db.php');
    
    if(isset($_POST['deleteyes'])){
        //Delete a username in the database
        $iddelete = $_SESSION['username'];

        //SQL command to delete a product on to the database
        $query2 = "DELETE FROM `users` WHERE username='$iddelete'";
        $result2 = mysqli_query($connect, $query2);

        session_destroy();
        header("Location: index.php");
    }
    elseif(isset($_POST['deleteno'])){
        header("Location: profile.php");
    }
?>

    <div class="container">
        <form method="POST">
            <button type="submit" name="delete" class="btn btn-danger btn-sm float-left">Delete Account</button>
        </form>

    <br>
    <br>
    <br>
    <br>
<?php
    $user = $_SESSION['username'];

    echo'
    <h3>Update account Information</h3>
    <!-- Upload image form -->
    <h4 class="lead">Upload Profile Picture</h4>
        <form action="includes/profupload.php" method="POST" enctype="multipart/form-data" class="picupload form-inline">
            <input type = "file" name ="image" class = "image form-control-file"/>
            <button type="submit" class="uploadsubmit btn btn-info">Upload</button>
            <input type="hidden" name="idprofimg" value="'.$user.'">
        </form>
    <br>
    <!--Delete Button !-->
    <button name="delete" id="'.$user.'" class="btn btn-danger btn-sm float-left">Delete Profile Photo</button>
    <br>
    <form class="form" id="update_form">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" name="firstname" id="xfirstname" placeholder="Enter your first name">
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
        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
    </form>

    </div>
    
    <br>'; ?>

    <?php
    include("includes/footer.php");
    ?>

        <script>
            $(document).ready(function () {
                $('#update_form').on("submit", function (event) {
                    event.preventDefault();

                    $.ajax({
                        url: "pform.php",
                        method: "POST",
                        data: $('#update_form').serialize(),
                        beforeSend: function () {
                            $('#insert').val("Updating...");
                        },
                        success: function (data) {

                            $('#insert').val("Insert");
                            $('#update_form')[0].reset();
                            $('#profile_table').html(data);


                        }
                    })
                });
            });
            //-----------------------ajax for uploading pictures
            $("body").on("submit", ".picupload", function (e) {

                e.preventDefault();

                //if an image is selected, run ajax
                if ($(this).children('input')[0].files.length > 0) {

                    $.ajax({
                        type: "POST",
                        url: "includes/profupload.php",
                        data: new FormData(this),
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response, textStatus, jqXHR) {
                            $result = $(response).find("#refreshpic");
                            $("#refreshpic").html($result);
                        }
                    })
                }
            });
        </script>
        <script>
            function action() {
                document.getElementById('deleteprof').style.visibility = 'hidden';
            };
        </script>
        </body>
    </html>