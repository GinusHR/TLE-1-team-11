<?php
/** @var mysqli $db*/

require_once 'database.php';

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
    <link rel="stylesheet" href="/css/style.css">
    <title>TLE</title>
</head>
<body>
<header>
    <div><p>CyberNoir</p></div>
    <div class="in">
        <a href="signin.php">Sign In</a>
        <a href="login.php">Log In</a>
    </div>
</header>
<main>
    <section>
        <div> <h1>CyberNoir</h1></div>
    </section>
    <section>
        <div class="items">
            <div>
                <?php foreach ($onderdelen as $index => $onderdeel) { ?>

                    <div><?= $index + 1 ?></div>
                    <div> <?= htmlentities($onderdeel['name']) ?></div>
                    <div> <?= htmlentities($onderdeel['price']) ?></div>
                    <div><?= htmlentities($onderdeel['description']) ?></div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>




</body>
</html>