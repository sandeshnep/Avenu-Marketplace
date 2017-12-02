<?php
if (!isset($_SESSION)) {
    session_start();
}
$pagename = "MY MARKETPLACE";
require_once('includes/functions.php');
check_cookie();
authenticate();

require_once('includes/header.php');

?>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

    <div class="jumbotron rounded-0">
        <h2>
            <?php echo $_SESSION['firstname'] ."'s Marketplace" . '</span>' ?>
        </h2>
        <p class="lead">Add, Update or Remove Products!</p>
    </div>

    <br>

    <div class="container">


        <?php
    	require_once('includes/db.php');

		//add products, if the add product form is submitted
		if (isset($_POST['productname']) && isset($_POST['description'])) {

			$username = $_SESSION['username'];
			$prodname = stripslashes($_POST['productname']);
			$description = stripslashes($_POST['description']);
            

            //SQL command to add a product on to the database
			$query = "INSERT INTO products VALUES (productid, '$username', '$prodname', '$description', CURRENT_TIMESTAMP)";

			$result = mysqli_query($connect, $query);

		} ?>


            <h1> Your Products: </h1>

    <?php 
        if(isset($_SESSION['username'])){
        	$username = $_SESSION['username'];

            $query = "SELECT * FROM `products` WHERE username='$username'";
            $result = mysqli_query($connect, $query) or die(mysqli_error());
       	    $rows = mysqli_num_rows($result);

       	    echo'<ul>';
       	    
       	    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

                $currentprodid= $row['productid'];
                

                //Runs if DELETE button is pressed
                if(isset($_POST['delete']) and is_numeric($_POST['delete'])){

                //gets the value of the productid to be deleted from the form (check the <button></button> tag attributes)
                $iddelete = $_POST['delete'];

               //SQL command to delete a product on to the database
                $query2 = "DELETE FROM `products` WHERE productid='$iddelete'";
                $result2 = mysqli_query($connect, $query2);
                refresh();

                }


                //-----------TRANSFER OVER TO COMMON MARKETPLACE FOR UPDATE REVIEWS AND COMMENTS----------------------

                //SQL commands for pulling ratings from reviews table
                //select avg from the raitngs column
                $query3 = "SELECT AVG(`rating`) as avg_rating FROM `reviews` WHERE productid='$currentprodid'";
                $result3=mysqli_query($connect, $query3);
                $row3 = mysqli_fetch_assoc($result3);



                //--------END OF TRANSFER OVER TO COMMON MARKETPLACE------------------------------------------------



       	    	echo '<li> <b>Productid : </b> ' . $row['productid'] . '<br><b>Product name: </b>' . $row['name']  . 
                '<br><b>Product Description: </b>' . $row['description']  . '<br><b>Date Posted: </b>' . $row['timesql'] . '<br><b>Average Rating: ' . $row3['avg_rating'] . '</b>

                </li>

                <br>
                <b>
                Comments :</b>
                
                ';

                //SQL commands for pulling comments from reviews table
                $query5 = "SELECT * FROM `reviews` WHERE productid='$currentprodid'";
                $result5=mysqli_query($connect, $query5);
                $rows5 = mysqli_num_rows($result5);

                 while($row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)){

                    if(isset($row5["comments"])){
                    echo'
                    <br>• by User: ' . $row5["authorid"] . '<br> &nbsp &nbsp &nbsp' . $row5["comments"];}
                 }


                 
                 echo '
                <!-- form buttons for DELETE !-->

                <form name = "delete" method = "POST">
                <button type="submit" name="delete" value = "' . $row['productid'].'" class="btn btn-success">Delete Item</button>
                </form><hr>';
       	    }

           echo '</ul>';
        }
        ?>

            <h1> Add Products: </h1>

            <form id="add-item-form">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="productname">Product Name</label>
                            <input type="text" class="form-control" name="productname" id="productname" placeholder="Enter Product Name">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="Enter product description">
                        </div>
                    </div>
                </div>

                <button type="submit" id="insert" name="submit" class="btn btn-success">Add Product</button>
            </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#add-item-form').on("submit", function (event) {
                event.preventDefault();


                $.ajax({
                    url: "iform.php",
                    method: "POST",
                    data: $('#add-item-form').serialize(),
                    beforeSend: function () {
                        $('#insert').val("Adding...");
                    },
                    success: function (data) {
                        $('#insert').val("Insert");
                        $('#add-item-form')[0].reset();
                        $('.container').html(data);
                    }
                })
            });
        });
    </script>



    <?php
    require_once('includes/header.php');
?>