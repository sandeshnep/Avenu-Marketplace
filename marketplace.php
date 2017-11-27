<?php
if (!isset($_SESSION)) {
    session_start();
}
$pagename = "MARKETPLACE";
require_once('includes/functions.php');
check_cookie();
authenticate();
require_once('includes/header.php');

?>

    <div class="jumbotron rounded-0">
        <h2>Common Marketplace</h2>

        <?php 
        require_once('includes/db.php');
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];

            $query = "SELECT * FROM `users`";
            $result = mysqli_query($connect, $query) or die(mysqli_error());
            $rows = mysqli_num_rows($result);
           
            for($i=0; $i<=$rows+2; $i++){

            	$query = "SELECT * FROM `users` WHERE id='$i'";
            	$result = mysqli_query($connect, $query) or die(mysqli_error());
            	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            	if($row['id']!=''){

            		$tempuser = $row['username'];

            		$query2 = "SELECT * FROM `products` WHERE username='$tempuser'";
            		$result2 = mysqli_query($connect, $query2) or die(mysqli_error());
            		$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                
	                echo '<ul><li><b>Name: </b>' . $row['firstname'] . ' ' . $row['lastname']. '</li><li><b>Username: </b>' .
	                $row['username'] . '</li><li><b>Product name: </b>' . $row2['name'] . 
	                '</li><li><b>Description: </b>' . $row2['description'] . '</ul>'; 
	                // '<br><b>product description: </b>' . $row['description']  . '<br><b>by user: </b>' . $row['username'] . '<br><b>date posted: </b>' . $row['date'] . '
	                // </li>
	                // <form name = "delete" method = "POST">
	                // <button type="submit" name="delete" value = "' . $row['productid'].'" class="btn btn-success">Delete</button>
	                // </form><hr>';

            	}
            }

           echo '</ul>';

        }
        ?>
    </div>

    <script src="scripts/jquery-3.2.1.slim.min.js" </script>
        < script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity = "sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin = "anonymous" >
    </script>
    <script src="scripts/bootstrap.min.js"></script>
    </body>

    </html>

    <?php
    require_once('includes/footer.php');
?>