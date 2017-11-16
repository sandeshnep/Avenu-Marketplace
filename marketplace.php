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
        <p class="lead">Click here to view the Marketplace.</p>  
    </div>
    
<?php
    require_once('includes/footer.php');
?>