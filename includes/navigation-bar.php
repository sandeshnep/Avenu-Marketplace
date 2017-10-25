
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><h1>LOGO</h1></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
        <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Home</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php
            if(!isset($_SESSION["username"])) {
                    echo 
                '<li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>';
            }
            ?>
            <?php 
            if(isset($_SESSION["username"])) {
                ?>
                <li class="nav-item">
                <a class="nav-link" href="profile.php"><?php echo $_SESSION['firstname'] ?></a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="includes/logout.php">Logout</a>
                </li>
          <?php ;  }
            ?>
        </ul>
        </div>
    </nav>
