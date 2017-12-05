<?php
if(!isset($_SESSION['username'])) {
    session_start();
}
$pagename = "HOME";
require_once('includes/functions.php');
check_cookie();

require_once('includes/header.php');
?>

    <div class="jumbotron rounded-0">
        <div class="container">
            <?php 
            if(!empty($_SESSION["username"])) {
                echo '<h1>Welcome Back to Avenu</h1> 
                <p class="text-lead">Go to your <a href="profile.php">profile</a> to begin!</p>';
            }
            ?>
            <?php 
            if(!isset($_SESSION["username"])) {
                echo '<h1>Welcome to Avenu</h1>
                <p class="text-lead">Login to begin buying and selling.</p>
                <a class="btn btn-info" href="login.php">Login</a>
                <a class="btn btn-dark" href="register.php">Register</a>';
            }
            ?>
        </div>
    </div>

    <div class="container">

        <article>
            <p>
                Avenu is the first online marketplace desgined specifically for high school students. Upload items to your profile that you
                want to sell, or browse others' profiles for things to buy.
            </p>
            <p>
                See something you like? Simply click "BUY NOW" and fill in your purchase info. We'll take care of the rest.
            </p>
            <p>
                For a complete list of rules and regulations, click
                <a href="rules.php">here.</a>
            </p>
        </article>

    </div>

<?php
require_once("includes/footer.php");
?>
</body>
</html>