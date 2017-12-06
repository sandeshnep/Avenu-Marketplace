<?php
if (!isset($_SESSION)) {
    session_start();
}
$pagename = "FRIENDS";
require_once('includes/functions.php');
check_cookie();
authenticate();

require_once('includes/header.php');
?>

    <div class="jumbotron rounded-0">
        <h2>Friends</h2>
        <div class="lead">See your friends profiles</div>
    </div>

<?php

if (isset($_GET['view'])) {
    $view = sanitizeString($_GET['view']);
} else {
    $view = $username;
}

if ($view == $username) {
    $name1 = $name2 = "Your";
    $name3 =          "You are";
} else {
    $name1 = "<a href='members.php?view=$view'>$view</a>'s";
    $name2 = "$view's";
    $name3 = "$view is";
}
?>

        <div class="container">

<?php

  // Uncomment this line if you wish the user’s profile to show here
  // showProfile($view);

  $followers = array();
  $following = array();

  $result = queryMysql("SELECT * FROM friends WHERE username='$view'");
  $num    = $result->num_rows;

for ($j = 0; $j < $num; ++$j) {
    $row           = $result->fetch_array(MYSQLI_ASSOC);
    $followers[$j] = $row['friend'];
}

  $result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
  $num    = $result->num_rows;

for ($j = 0; $j < $num; ++$j) {
    $row           = $result->fetch_array(MYSQLI_ASSOC);
    $following[$j] = $row['username'];
}

  $mutual    = array_intersect($followers, $following);
  $followers = array_diff($followers, $mutual);
  $following = array_diff($following, $mutual);
  $friends   = false;

if (sizeof($mutual)) {
    echo "<h3>$name2 mutual friends</h3>\n<ul>\n";
    foreach ($mutual as $friend) {
        echo "<li><i class='fa fa-caret-right' aria-hidden='true'></i><a class='lead' href='members.php?view=$friend'>$friend</a>\n";
    }
    echo "</ul>\n";
    $friends = true;
}

if (sizeof($followers)) {
    echo "<h3>$name2 followers</h3>\n<ul>\n";
    foreach ($followers as $friend) {
        echo "<li><i class='fa fa-caret-right' aria-hidden='true'></i><a class='lead' href='members.php?view=$friend'>$friend</a>\n";
    }
    echo "</ul>\n";
    $friends = true;
}

if (sizeof($following)) {
    echo "<h3>$name3 following</h3>\n<ul>\n";
    foreach ($following as $friend) {
        echo "<li><i class='fa fa-caret-right' aria-hidden='true'></i><a class='lead' href='members.php?view=$friend'>$friend</a>\n";
    }
    echo "</ul>\n";
    $friends = true;
}

if (!$friends) {
    echo "<h3>You don't have any friends yet.</h3>\n<br>\n";
}

  echo "<br><a class='lead btn btn-info' href='messages.php?view=$view'>" .
       "<i class='fa fa-envelope' aria-hidden='true'></i> View $name2 messages</a>\n<br>\n";
?>
                <br>
                <br>
        </div>

<?php
require_once("includes/footer.php");
?>
</body>
</html>