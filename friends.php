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

<h2>Friends</h2>

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
    echo "<span class='lead'>$name2 mutual friends</span>\n<ul>\n";
    foreach ($mutual as $friend) {
        echo "<li><a href='members.php?view=$friend'>$friend</a>\n";
    }
    echo "</ul>\n";
    $friends = true;
}

if (sizeof($followers)) {
    echo "<span class='lead'>$name2 followers</span>\n<ul>\n";
    foreach ($followers as $friend) {
        echo "<li><a href='members.php?view=$friend'>$friend</a>\n";
    }
    echo "</ul>\n";
    $friends = true;
}

if (sizeof($following)) {
    echo "<span class='lead'>$name3 following</span>\n<ul>\n";
    foreach ($following as $friend) {
        echo "<li><a href='members.php?view=$friend'>$friend</a>\n";
    }
    echo "</ul>\n";
    $friends = true;
}

if (!$friends) {
    echo "<p class='lead'>You don't have any friends yet.</p>\n<br>\n";
}

  echo "<a class='btn btn-info' href='messages.php?view=$view'>" .
       "View $name2 messages</a>\n<br>\n";
?>
<br>
<br>
</div>

<?php
require_once("includes/footer.php");
?>
