<?php

   require_once('db.php');

   if(isset($_FILES['image'])){

      

      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));



    //insert imageurl to the database
    $username = $_SESSION['username'];
    $profurl = "img/profimg/".$file_name;

         
    $query2 = "UPDATE users SET profpic='$profurl' WHERE username='$username'";
    $result2 = mysqli_query($connect, $query2);

    $expensions= array("jpeg","jpg","png");
      
     /* if(in_array($file_ext, $expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }*/
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"../img/profimg/".$file_name);
         header( 'Location: ../profile.php' ) ;
      }else{
         print_r($errors);
      }
   }
?>