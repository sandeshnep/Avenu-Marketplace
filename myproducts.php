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

		//INSERTION--------------------------------------------------------
		if (isset($_POST['productname']) && isset($_POST['description'])) {

			$username = $_SESSION['username'];
			$prodname = stripslashes($_POST['productname']);
			$description = stripslashes($_POST['description']);
            

            //SQL command to add a product on to the database
			$query = "INSERT INTO products VALUES (productid, '$username', '$prodname', '$description', CURRENT_TIMESTAMP, img1, img2, img3)";

			$result = mysqli_query($connect, $query);

		} 


        //DELETION-------------------------------------------------------
        if(isset($_POST['delete']) and is_numeric($_POST['delete'])){

        //gets the value of the productid to be deleted from the form (check the <button></button> tag attributes)
        $iddelete = $_POST['delete'];

        //SQL command to delete a product on to the database
        $query2 = "DELETE FROM `products` WHERE productid='$iddelete'";
        $result2 = mysqli_query($connect, $query2);


        }


        ?>




    <h1> Your Products: </h1>

    <div id="refreshajax">

    <?php 
        if(isset($_SESSION['username'])){
        	$username = $_SESSION['username'];

            $query = "SELECT * FROM `products` WHERE username='$username'";
            $result = mysqli_query($connect, $query) or die(mysqli_error());
       	    $rows = mysqli_num_rows($result);

       	    echo'<ul>';
       	    
       	    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){


                $currentprodid= $row['productid'];
                


                //SQL commands for pulling ratings from reviews table
                //select avg from the raitngs column
                $query3 = "SELECT AVG(`rating`) as avg_rating FROM `reviews` WHERE productid='$currentprodid'";
                $result3=mysqli_query($connect, $query3);
                $row3 = mysqli_fetch_assoc($result3);



       	    	echo '<li> <b>Productid : </b> ' . $row['productid'] . '<br><b>Product name: </b>' . $row['name']  . 
                '<br><b>Product Description: </b>' . $row['description']  . '<br><b>Date Posted: </b>' . $row['timesql'] . '<br><b>Average Rating: ' . $row3['avg_rating'] . '</b>

                <br>
                <b>
                Comments :</b>

                </li>

                
                ';

                //SQL commands for pulling commentsfrom reviews table
                $query5 = "SELECT * FROM `reviews` WHERE productid='$currentprodid'";
                $result5=mysqli_query($connect, $query5);
                

                 while($row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)){

                    if(isset($row5["comments"])){
                    echo'
                    <br>• by User: ' . $row5["authorid"] . '<br> &nbsp &nbsp &nbsp' . $row5["comments"];}
                 }



                 echo'<br>

                 <b>Pictures: </b>';

                if(isset($row['img1'])){

                    echo'<img src="'.$row['img1'].'" height="200" width="200">';
                }
                if(isset($row['img2'])){

                    echo'<img src="'.$row['img2'].'" height="200" width="200">';
                }
                if(isset($row['img3'])){

                    echo'<img src="'.$row['img3'].'" height="200" width="200">';
                }



                 echo'
                 <!----UPLOAD IMAGE HTML FORM !-->
                 <form action ="includes/upload.php" method = "POST" enctype = "multipart/form-data" class="upload">
                <input type = "file" name = "image" />
                <input type = "submit" class = "uploadsubmit"/>
                <input type = "hidden" name ="idproductimg" value="'.$currentprodid.'">

                </form>


                <!--Delete Button !-->
                 <button name="delete" id="'.$currentprodid.'" class="btn btn-danger">Delete Item</button>

                 ';


       	    }

           echo '</ul>';
        }
        ?>

       

    </div>


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


    
<script>

    //------------------------ajax for deleting items
    $("body").on('click', '.btn.btn-danger', function(e){

                                                     
        $.ajax({
            url: "myproducts.php",
            method: "POST",
            dataType:"html",
            data:{delete:e.target.id},
                
            success:function(response, textStauts, jqXHR){

                $result = $(response).find("#refreshajax");
                $("#refreshajax").html($result);  
                                           
            }
        })

        });


    //-----------------------ajax for uploading pictures
    $(document).on("click" , ".uploadsubmit", function(e){
    $('.upload').on("submit", function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "includes/upload.php",
            data: new FormData(this),             
            cache: false,
            contentType: false, 
            processData: false,
            success: function(response, textStatus, jqXHR)
            {
                $result = $(response).find("#refreshajax");
                $("#refreshajax").html($result);  
            }
    });
    });
    
});






  //---------------------------ajax for adding items
  $('#add-item-form').on("submit", function(event) {

    event.preventDefault(); //prevents refresh
                                     
   $.ajax({
   url: "myproducts.php",
   method: "POST",
   dataType:'html',
   data:$('#add-item-form').serialize(),

   success:function(response, textStauts, jqXHR){
       $result = $(response).find('#refreshajax');
       $('#refreshajax').html($result);  
                           
       }
    })
  });


            
</script>



    <?php
    require_once('includes/header.php'); ?>