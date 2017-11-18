<?php
if (!isset($_SESSION['username'])) {
    session_start();
}
$pagename = "MEMBERS";
require_once('includes/functions.php');
check_cookie();
authenticate();

require_once('includes/header.php');
?>

<div class="container">
<br>

<?php

require_once('includes/db.php');

if (isset($_GET['view'])) {
    $view = $_GET['view'];
    if ($view == $username) {
        $name = "Your";
    } else {
        $name = "$view's";
    }
    echo "<h3>$name Profile</h3>";
    showProfile($view);
    echo "<a class='button' href='messages.php?view=$view'>".
        "View $name messages</a><br><br>";
    die("</div></body></html>");
}

if (isset($_GET['add'])) {
    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT * FROM friends WHERE username='$add' AND friend='$username'");
    if (!$result->num_rows) {
        queryMysql("INSERT INTO friends VALUES ('$add', '$username')");
    }
} elseif (isset($_GET['remove'])) {
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends WHERE username='$remove' AND friend='$username'");
}

$result = queryMysql("SELECT username FROM users ORDER BY username");
$num    = $result->num_rows;

echo "<h3>Other Members</h3><ul>";

for ($j = 0; $j < $num; ++$j) {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['username'] == $username) {
        continue;
    }
    
    echo "<li><a href='members.php?view=" .
    $row['username'] . "'>" . $row['username'] . "</a>";
    $follow = "follow";

    $result1 = queryMysql("SELECT * FROM friends WHERE
      username='" . $row['username'] . "' AND friend='$username'");
    $t1      = $result1->num_rows;
    $result1 = queryMysql("SELECT * FROM friends WHERE
      username='$username' AND friend='" . $row['username'] . "'");
    $t2      = $result1->num_rows;

    if (($t1 + $t2) > 1) {
        echo " &harr; is a mutual friend";
    } elseif ($t1) {
        echo " &larr; Already following";
    } elseif ($t2) {
        echo " &rarr; is following you";
        $follow = "recip";
    }
    
    if (!$t1) {
        echo " [<a href='members.php?add="   .$row['username'] . "'>$follow</a>]";
    } else {
        echo " [<a href='members.php?remove=".$row['username'] . "'>drop</a>]";
    }
}
?>

</div>

<?php
require_once("includes/footer.php");
?>