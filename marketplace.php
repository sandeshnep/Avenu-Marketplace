<?php
if(!isset($_SESSION['username'])) {
    session_start();
}

require_once('includes/cookie-check.php');
check_cookie();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    
    <?php
    include("includes/navigation-bar.php");
    ?>

    <div class="jumbotron rounded-0">
        <h2>Common Marketplace</h2>
        <p class="lead">Click here to view the Marketplace.</p>  
    </div>
    
    <script src="scripts/jquery-3.2.1.slim.min.js"</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="scripts/bootstrap.min.js"></script>
</body>
</html>