<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home | CSC210 Project</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>

<body>

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
                echo 
                '<li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="includes/logout.php">Logout</a>
                </li>';
            }
            ?>
        </ul>
        </div>
    </nav>


    <div class="jumbotron rounded-0">
        <div class="container">
            <h2>Home Page</h2>
            <p class="text-lead">This will be our landing page</p>
            <?php 
            if(!isset($_SESSION["username"])) {
                echo '<a class="btn btn-dark" href="login.php">Login</a>
                <a class="btn btn-primary" href="register.php">Register</a>';
            }
            ?>
        </div>
    </div>

    <div class="container">

        <article>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo quis ad reprehenderit vel debitis. Corporis fuga illo magnam, dolores eos reprehenderit quod quas culpa officiis repellat iste soluta non asperiores alias sapiente tenetur sit earum dolorem quia quo itaque odit ratione. Harum quisquam, ipsam voluptate obcaecati voluptas minima iste rem quam ea modi hic id! Suscipit itaque distinctio officiis, nisi quas quasi recusandae eius culpa similique veritatis vitae reiciendis nemo quaerat consequuntur quisquam fuga aspernatur ad magni. Exercitationem, explicabo illum nemo velit reprehenderit tenetur quibusdam quasi, quod eligendi voluptates enim sed nihil maiores dignissimos voluptatem consectetur dicta. Eveniet error ad suscipit fuga necessitatibus repellendus obcaecati. Dolore rerum reprehenderit dolorem consequatur, tempora adipisci necessitatibus maiores, expedita quia fugit est accusamus libero cupiditate. Est at commodi error id cupiditate sapiente, deserunt vel? Modi similique id doloribus suscipit mollitia. Dolorem, ullam fugiat animi eius veritatis officiis sapiente placeat aperiam eaque ea debitis ab ut quibusdam aut corrupti molestias quia inventore quas illo tenetur harum autem! Quis, reiciendis. Excepturi, aspernatur! Unde, numquam quas quaerat magnam ipsam saepe eveniet aut qui sunt non ab recusandae quod porro cumque enim facilis cum laborum illum quo inventore temporibus, at magni praesentium? Maxime modi soluta illum ipsum ipsa officiis magnam culpa numquam error. Sit repellendus sed optio id, facere, quo vero sapiente saepe aut, animi ex nemo veritatis magni cum? Dignissimos quasi accusamus numquam sit quod ullam dolorum voluptatum eos obcaecati similique, inventore rerum, magni ab dolor ratione ex consectetur nobis dicta provident? Distinctio incidunt aut quibusdam commodi.
            </p>
        </article>

    </div>

    <footer class="bg-dark pt-3 pb-3">
        <div class="container">
            <div class="text-muted">
                <h3>Contact us <a href="contact.php">here</a></h3>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>