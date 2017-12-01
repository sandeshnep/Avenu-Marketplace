<nav class="navbar navbar-expand-sm">
    <a class="navbar-brand" href="index.php">
        <img src="img/logo.png" alt="Logo" width="100" height="35">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <div class="navbar-nav">
            <?php
            if (isset($_SESSION["username"])) {
                echo
                "<a class='nav-item nav-link' href='members.php'>Members</a>\n 
                <a class='nav-item nav-link' href='friends.php'>Friends</a>\n
                <a class='nav-item nav-link' href='messages.php'>Messages</a>\n
                ";
            }
            ?>
        </div>
        <ul class="navbar-nav ml-auto">
            <?php
                if (!isset($_SESSION["username"])) {
                        echo
                        "<li class='nav-item'>
                        <a class='nav-link' href='login.php'>Login</a>\n
                        </li>\n
                        <li class='nav-item'>\n
                        <a class='nav-link' href='register.php'>Register</a>\n
                        </li>\n";
                }
                ?>
                <?php
                if (isset($_SESSION["username"])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="marketplace.php">Common Marketplace</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="myproducts.php">My Marketplace</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="navname" href="profile.php">
                            <?php echo $_SESSION['firstname'] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="includes/logout.php">Logout</a>
                    </li>
                    <?php ;
                }
                ?>
        </ul>
    </div>
</nav>
