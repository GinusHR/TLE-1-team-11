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
            box-shadow: 0 0 15px 5px rgba(0, 128, 255, 0.75);
        }

        #hidden-button:hover {
            box-shadow: 0 0 25px 10px rgba(0, 128, 255, 1);
        }
    </style>
    </head>
    

<body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // the hidden button Miso JS
        const nav = document.querySelector('header');
        const hiddenButton = document.getElementById('hidden-button');


        nav.addEventListener('click', (event) => {

            const navRect = nav.getBoundingClientRect();
            const navCenterX = navRect.width / 2;
            const clickX = event.clientX - navRect.left;

            const range = 50;


            if (clickX >= navCenterX - range && clickX <= navCenterX + range) {

                hiddenButton.style.display = 'block';
                hiddenButton.style.backgroundColor = 'black';
                hiddenButton.style.color = 'white';
                hiddenButton.style.border = '2px solid #00CCFF'
                hiddenButton.style.fontWeight = 'heavy'


            }
        });
    });
</script>
    
<header>
    <div class="headerLeft">
         <a class="headerLeftText" href="index.php">CyberNoir</a>
    </div>

    <button id="hidden-button"><a href="./php/hidden.php">Secret</a></button>
    <button id="hidden-button"><a href="./php/hidden.php">Secret</a></button>

    <div class="headerRight">
        <div class="headerRightPart">
            <a class ="blueText" class="headerRightText" href="html/signup.html">Sign Up</a>
        </div>
        <div class="headerRightPart">
            <a class="headerRightText" href="html/login.html">Log In</a>
        </div>

    </div>
</header>
<main>
    <section class="mainText">
        <div>
            <h1 class="mainTitle">CyberNoir</h1>
        </div>
        <div>
            <h2 class="mainSubtitle"> All your boinic parts at nightmaringishly low prices</h2>
        </div>

    </section>
    <div class="invisiDiv">
        <h2>Scroll for parts</h2>
    </div>
    
    <section >
        <div class="items">

        <?php foreach ($onderdelen as $index => $onderdeel) { ?>
            <div class="item">
                <img class="image" src="images/<?= htmlentities($onderdeel['images']) ?>" alt="foto">
                
            
                <div class="product-name"><?= htmlentities($onderdeel['name']) ?></div>
                
                
                <div class="product-price">₿ <?= htmlentities($onderdeel['price']) ?> BTC</div>
                
                
                <div class="product-description"><?= htmlentities($onderdeel['description']) ?></div>
                
        
                <button class="buyButton">
                    <a class="buttonLink" href="php/checkout.php?id=<?= htmlentities($onderdeel['id']) ?>">Buy</a>
                </button>
            </div>
        <?php } ?>

    </div>
</section>

    </section>
</main>
<footer>
    <p class="footerP">
        "Amidst the <p class="viP"> navigation</p> <p class="footerP">, calm and still,
        Lies a secret at the </p> <p class="viP"> center</p><p class="footerP">, for those with the will.
        Seek the heart where paths converge,
        A single click, and secrets emerge."
    </p>
</footer>



</body>
</html>
