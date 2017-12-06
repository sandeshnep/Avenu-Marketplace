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
    </div>

    <div class="container">
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
                
                //pulling the current product information
                $query2 = "SELECT * FROM `products` WHERE productid='$currentprodid'";
                $result2 = mysqli_query($connect, $query2) or die(mysqli_error());
                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);


                //pulling the ratings from the reviews table
                //select avg from the raitngs column
                $query3 = "SELECT AVG(`rating`) as avg_rating FROM `reviews` WHERE productid='$currentprodid'";
                $result3=mysqli_query($connect, $query3);
                $row3 = mysqli_fetch_assoc($result3);


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
                        refresh();

                    } else {
                        //INSERT rating into the database
                        $query4 = "REPLACE INTO `reviews` (`productid`, `rating`, `authorid`) VALUES ('$idreview', '$ratingval' , '$username')";
                        $result4=mysqli_query($connect, $query4);
                        refresh();
                    }
                }
                
                if($row2['productid']!='') {
                    echo '
                    <div class="card">' . "\r\n" .
                    '<div class="card-body">' . "\r\n" .
                    '<h4 class="card-title">' . $row['name'] . '</h4>' . "\r\n" .
                    '<hr>' . "\r\n";
                    
                    if(isset($row2['img1'])) {
                        echo'<img src="'.$row['img1'].'" height="200" width="200">'. "\r\n";
                    }
                    if(isset($row2['img2'])) {
                        echo'<img src="'.$row['img2'].'" height="200" width="200">'. "\r\n";
                    }
                    if(isset($row2['img3'])) {
                        echo'<img src="'.$row2['img3'].'" height="200" width="200">'. "\r\n";
                    }
                    ;
                    
                    echo
                    '<ul>' .
                    '<li><b>Username: </b>' . '<a href="members.php?view="'.$row2['username'].'">'.$row2['username'].'</a></li>' . "\r\n" . 
                    '<li><b>Date Posted: </b>' . $row2['timesql'] . '</li>' . "\r\n" .
                    '<li><b>Description: </b>' . $row2['description'] . '</li>' . "\r\n" .
                    '<li><b>Average Rating: </b>' . $row3['avg_rating'] . '</li>' . "\r\n" . 
                    '</ul>' . 
                    '<br><b>Pictures: </b><br> ';
                    
                    echo'
                    <br><b>Your Rating: </b>
                    <!-- UPDATE RATINGS - MOVE TO COMMON MARKET!--> 
                    <form method="POST">
                    <select name = "ratingval">
                    <option type ="number" value = "1">1</option>
                    <option type ="number" value = "2">2</option>
                    <option type ="number" value = "3">3</option>
                    <option type ="number" value = "4">4</option>
                    <option type ="number" value = "5">5</option>
                    </select>
                    ' .
                    '
                    <button type="submit" name="rating" method ="POST" value="' . $row2['productid'] .'" class="btn btn-info">Update Rating</button>
                    </form>
                    <!-- UPDATE RATINGS - MOVE TO COMMON MARKET END!-->
                    <br>

                    <b>Comments :</b>';
                    
                    //SQL commands for pulling comments from reviews table
                    $query5 = "SELECT * FROM `reviews` WHERE productid='$currentprodid'";
                    $result5=mysqli_query($connect, $query5);
                    $rows5 = mysqli_num_rows($result5);
                    
                    while($row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)) {
                        if(isset($row5["comments"])) {
                            echo'
                            <br>•  ' . $row5["comments"] . '<span class="small text-muted"> by: ' . $row5["authorid"] . '</span>';
                        }
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
                                refresh();
                            } else {
                                //INSERT the rating into the database
                                $query6 = "REPLACE INTO `reviews` (`productid`, `comments`, `authorid`) VALUES ('$idcomment', '$commentinput' , '$username')";
                                $result6=mysqli_query($connect, $query6);
                                refresh();
                            }
                        }
                    }
                    echo '
                    <!-- form for adding a comment !-->
                    <br> <br> <b> Add Comment: </b>
                    <form name = "comment" method = "POST">
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

    <script src="scripts/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous">
    </script>
    <script src="scripts/bootstrap.min.js"></script>

    <?php
    require_once('includes/footer.php');
    ?>
</body>
</html>