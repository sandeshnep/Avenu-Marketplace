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
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

    <div class="jumbotron rounded-0">
        <h2>Common Marketplace</h2>
    </div>

    
    <?php
    //runs if the UPDATE RATING button is pressed, updates the rating from the logged in user
    if(isset($_POST['rating'])) {

        $idreview = $_POST['rating'];
        $ratingval = $_POST['ratingval'];


        $search = "SELECT `comments` FROM `reviews` WHERE productid='$idreview'";

        $searchresult= mysqli_query($connect, $search) or die(mysqli_error());
        $searchrows = mysqli_num_rows($searchresult);

            //if an entry of comment exists, UPDATE the rating
            if ($searchrows>0){


                $query7 = "UPDATE `reviews` SET rating = '$ratingval' WHERE productid='$idreview' AND authorid='$username'";

                $result7=mysqli_query($connect, $query7);
               // refresh();

            } else {
                //INSERT rating into the database
                $query4 = "REPLACE INTO `reviews` (`productid`, `rating`, `authorid`) VALUES ('$idreview', '$ratingval' , '$username')";
                $result4=mysqli_query($connect, $query4);
                //refresh();
            }
        }
        ?>

        <?php //if the post comment is clicked
        if(isset($_POST['postcomment'])) {
            $idcomment = $_POST['postcomment'];
            $commentinput = $_POST['commentinput'];

            $search2 = "SELECT 'rating' FROM `reviews` WHERE productid='$idcomment'";
            $searchresult= mysqli_query($connect, $search2) or die(mysqli_error());
            $searchrows = mysqli_num_rows($searchresult);
            
            //if an entry of rating exists, UPDATE comment
            if ($searchrows > 0) {
                $query8 = "UPDATE `reviews` SET comments = '$commentinput' WHERE productid='$idcomment' AND authorid='$username'";
                $result8=mysqli_query($connect, $query8);
               //refresh();
            } else {

                //INSERT the comment into the database
                $query6 = "REPLACE INTO `reviews` (`productid`, `comments`, `authorid`) VALUES ('$idcomment', '$commentinput' , '$username')";
                $result6=mysqli_query($connect, $query6);
                //refresh();
            }
        }?>



    <div id = "container" class="container">
        <div id="refreshajax">
        <?php 
        require_once('includes/db.php');
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];

            $query = "SELECT * FROM `products`";
            $result = mysqli_query($connect, $query) or die(mysqli_error());
            $rows = mysqli_num_rows($result);
           
             while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo'<br><br>';

                $currentprodid= $row['productid'];
                


                //pulling the ratings from the reviews table
                //select avg from the raitngs column
                $query3 = "SELECT AVG(`rating`) as avg_rating FROM `reviews` WHERE productid='$currentprodid'";
                $result3=mysqli_query($connect, $query3);
                $row3 = mysqli_fetch_assoc($result3);

                
                if(isset($row['productid'])) {
                    echo '
                    <div class="card">' . "\r\n" .
                    '<div class="card-body">' . "\r\n" .
                    '<h4 class="card-title">' . $row['name'] . '</h4>' . "\r\n" .
                    '<hr>' . "\r\n";
                    
                    if(isset($row['img1'])) {
                        echo'<img src="'.$row['img1'].'" height="200" width="200">'. "\r\n";
                    }
                    if(isset($row['img2'])) {
                        echo'<img src="'.$row['img2'].'" height="200" width="200">'. "\r\n";
                    }
                    if(isset($row['img3'])) {
                        echo'<img src="'.$row['img3'].'" height="200" width="200">'. "\r\n";
                    }
                    ;
                    
                    echo
                    '<ul>' .
                    '<li><b>Username: </b>' . $row['username'] . '</li>' . "\r\n" . 
                    '<li><b>Date Posted: </b>' . $row['timesql'] . '</li>' . "\r\n" .
                    '<li><b>Description: </b>' . $row['description'] . '</li>' . "\r\n" .
                    '<li><b>Average Rating: </b>' . $row3['avg_rating'] . '</li>' . "\r\n" . 
                    '</ul>' . 
                    '<br><b>Pictures: </b><br> ';
                    
                    echo'
                    <br><b>Your Rating: </b>
                    <!-- UPDATE RATINGS - MOVE TO COMMON MARKET!--> 
                    <form method="POST" class="form_rating">
                    <select name = "ratingval">
                    <option type ="number" value = "1">1</option>
                    <option type ="number" value = "2">2</option>
                    <option type ="number" value = "3">3</option>
                    <option type ="number" value = "4">4</option>
                    <option type ="number" value = "5">5</option>
                    </select>
                    ' .
                    '
                    <button type="submit" name="rating" method ="POST" value="' . $row['productid'] .'" class="btn btn-info">Update Rating</button>
                    </form>
                    <!-- UPDATE RATINGS - MOVE TO COMMON MARKET END!-->
                    <br>
                    

                    <b>Comments :</b> ';
                    
                    //SQL commands for pulling comments from reviews table
                    $query5 = "SELECT * FROM `reviews` WHERE productid='$currentprodid'";
                    $result5=mysqli_query($connect, $query5);
                    $rows5 = mysqli_num_rows($result5);
                    
                    while($row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)) {
                        if(isset($row5["comments"])) {
                            echo'
                            <br>•  ' . $row5["comments"] . '<span class="small text-muted"> by: ' . $row5["authorid"] . '</span>';
                        }
                    }


                    echo '
                    <!-- form for adding a comment !-->
                    <br> <br> <b> Add Comment: </b>
                    <form id = "' . $row['productid'].'" name = "comment" method = "POST" class="form_comment">
                    <input name="commentinput" type = "text">
                    <br>
                    <br>
                    <button type="submit" name="postcomment" value = "' . $row['productid'].'" class="btn btn-info">Post Comment</button>
                    </form>
                    <br>
                    '; 
                }
                echo '
                </div>
                </div>
                <br>
                <br>';
            }
        }
        ?>
    </div>

    </div>




<script type="text/Javascript">
//ajax for adding comments items
    $("body").on("submit", ".form_comment", function (e) {
        e.preventDefault();
        var commentinputv = $(this).find('input').val();
        var postcommentv = e.target.id;


    $.ajax({
         url: "marketplace.php",
         method: "POST",
         dataType: "html",
         data: {postcomment: postcommentv, commentinput:commentinputv},
        
         success: function (response) {
           //alert(response);
           $result = $(response).find("#refreshajax");
           $(document).find('#refreshajax').html($result);
           //$('#refreshajax').html($result);

        }
    })

    });



//ajax for adding comments items
    $("body").on("submit", ".form_rating", function (e) {
        e.preventDefault();
        var ratingvalv = $(this).find('select').val();
        var ratingv = $(this).find('button').attr("value");
       // alert(ratingv);


    $.ajax({
         url: "marketplace.php",
         method: "POST",
         dataType: "html",
         data: {rating: ratingv, ratingval: ratingvalv},
        
         success: function (response) {
           //alert(response);
           $result = $(response).find("#refreshajax");
           $(document).find('#refreshajax').html($result);
        }
        })

    });
    




</script>

    <?php
    require_once('includes/footer.php');
    ?>
</body>
</html>