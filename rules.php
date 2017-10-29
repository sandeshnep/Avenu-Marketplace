<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rules</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <?php
    include("includes/navigation-bar.php");
    ?>


    <div class="jumbotron rounded-0">
        <div class="container">
            <h1>Avenu Rules and Regulations</h1>
        </div>
    </div>

    <div class="container">

        <article>
            <h2>Basic Rules</h2>
            <ol>
                <li>You must be a student at the host school in order to participate.</li>
                <li>You must provide valid credit card information upon purchase.</li>
                <li>You must provide a clear, honest, and accurate description of your item.</li>
                <li>The item delivered must match the item described.</li>
                <li>You must abide by the terms of delivery set forth by the seller.</li>
            </ol>
            <h2>Prohibited Items</h2>
            <ol>
                <li>Chance listings that promote giveaways, random drawings, raffles, or prizes.</li>
                <li>Firearms, weapons, and knives.</li>
                <li>Offensive material, which includes items that are racially or ethnically inappropriate.</li>
                <li>Drugs and medications.</li>
                <li>Alcohol.</li>
                <li>Replicas, counterfeit items, and unauthorized copies.</li>
            </ol>
        </article>

    </div>

    <?php include("includes/footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>