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
        require_once('includes/db.php');

        if(isset($_POST['delete'])){

            echo'<h1>DELETE BUTTON PRESSED </h1>';

            $username = $_SESSION['username'];
            echo 'username : '. $username ;


               //Delete a username in the database
                $query2 = "DELETE * FROM `users` WHERE username='$username'";
                $result2 = mysqli_query($connect, $query2);
                session_start();
                 $_SESSION = array();
                session_unset();
                session_destroy();
                //deleting cookies
                setcookie("username", "", time()-1, "/" );
                setcookie("password", "", time()-1, "/" );
                header("Location:term-project-group-24/term-project-group-24/login.php");
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
        </body>
    </html>