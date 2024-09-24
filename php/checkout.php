<?php
require_once 'database.php';

//get ID
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

//select query
$query = "SELECT * FROM onderdelen WHERE id=".$id;

//connect query and database
$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

//set query to individual item
$part = mysqli_fetch_assoc($result);

// Verbinding stoppen
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="headerLeft">
            <a class="headerLeftText" href="../index.php">CyberNoir</a>
        </div>

        <div class="headerRight">
            <div class="headerRightPart">
                <a class="blueText" class="headerRightText" href="../html/signup.html">Sign Up</a>
            </div>
            <div class="headerRightPart">
                <a class="headerRightText" href="../html/login.html">Log In</a>
            </div>
        </div>
    </header>
    <main>

        <section class="mainCheckout">
            <div class="checkoutInformation">
                <div>
                    <h2 class="checkoutName"><?= $part['name']?></h2>
                </div>
                <div>
                    <p class="checkoutPrice">₿<?= $part['price']?> BTC</p>
                </div>
                <div class="checkoutImage">
                    <img src="<?= $part['images']?>" alt="Image">
                </div>
            </div>
            <div class="checkoutForm">
                <p>Meep right</p>
            </div>
        </section>
    </main>
    <footer>
        <p class="footerP">© 2074 CyberNoir</p>
    </footer>
</body>
</html>