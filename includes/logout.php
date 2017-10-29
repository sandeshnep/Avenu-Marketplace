<?php
session_start();
session_unset();
session_destroy();

//deleting cookies
setcookie("username", "", time()-1, "/" );
setcookie("password", "", time()-1, "/" );



header("Location: ../login.php");



?>