<?php
/** @var mysqli $db*/

require_once 'php/database.php';

$query = "SELECT * FROM onderdelen";
$result = mysqli_query($db, $query) or die('Error'.mysqli_error($db).'with query'.$query);
$onderdelen = [];
while($onderdeel = mysqli_fetch_assoc($result)) {
    $onderdelen[] = $onderdeel;
}
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>TLE</title>
</head>
<body>
<header>
    <div class="headerLeft">
        <p class="headerLeftText">CyberNoir</p>
    </div>

    <div class="headerRight">
        <div class="headerRightPart">
            <a class="headerRightText" href="signup.html">Sign In</a>
        </div>
        <div class="headerRightPart">
            <a class="headerRightText" href="login.html">Log In</a>
        </div>

    </div>
</header>
<main>
    <section>
         <h1>CyberNoir</h1>
        <h2> KOOP CYBERPARTS!!!!!!!!!</h2>
    </section>
    <section>
        <div class="items">
            <div>
                <?php foreach ($onderdelen as $index => $onderdeel) { ?>
                    <div><?= $index + 1 ?></div>
                    <div class="image"> <img   src="images/<?= htmlentities($onderdeel['images'])?>" alt="foto"> </div>
                    <div> <?= htmlentities($onderdeel['name']) ?></div>
                    <div> <?= htmlentities($onderdeel['price']) ?></div>
                    <div> <?= htmlentities($onderdeel['description']) ?></div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<footer>
    <p>E</p>
</footer>



</body>
</html>