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

    <style>
        /* Style the navigation bar */
        nav {
            width: 100%;
            height: 60px;
            background-color: black;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Hidden button in the center miso */
        #hidden-button {
            width: 100px;
            height: 40px;
            background-color: black;
            border: none;
            color: #150c0c;
            display: none;
            cursor: pointer;
        }
    </style>
    </head>
    

<body>
<nav>
    <button id="hidden-button">Secret</button>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // the hidden button Miso JS
        const nav = document.querySelector('nav');
        const hiddenButton = document.getElementById('hidden-button');


        nav.addEventListener('click', (event) => {

            const navRect = nav.getBoundingClientRect();
            const navCenterX = navRect.width / 2;
            const clickX = event.clientX - navRect.left;

            const range = 50;


            if (clickX >= navCenterX - range && clickX <= navCenterX + range) {

                hiddenButton.style.display = 'block';
                hiddenButton.style.backgroundColor = 'darkgray';
            }
        });
    });
</script>
    
<header>
    <div class="headerLeft">
        <p class="headerLeftText">CyberNoir</p>
    </div>

    <div class="headerRight">
        <div class="headerRightPart">
            <a class="headerRightText" href="html/signup.html">Sign In</a>
        </div>
        <div class="headerRightPart">
            <a class="headerRightText" href="html/login.html">Log In</a>
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
                    <button><a class="buttonlink" href="php/checkout.php?id=<?= htmlentities($onderdeel['id']) ?>">Buy</a></button>

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
