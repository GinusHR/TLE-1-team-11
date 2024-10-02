<?php
/** @var mysqli $db*/
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
                <a class="blueText" class="headerRightText" href="../php/signup.php">Sign Up</a>
            </div>
            <div class="headerRightPart">
                <a class="headerRightText" href="../php/login.php">Log In</a>
            </div>
        </div>
    </header>
    <main>

        <section class="mainCheckout">
            <div class="checkoutInformation">
                <div>
                    <h1 class="checkoutName"><?= $part['name']?></h1>
                </div>
                <div>
                    <h2 class="checkoutPrice"><?= $part['description']?></h2>
                </div>
                <div>
                <img class="image" src="../images/<?= $part['images']?>" alt="foto">
                </div>
                <div>
                    <p class="checkoutPrice"><?= $part['price']?> BTC</p>
                </div>
            </div>
            <div class="checkoutHolder">
                <form class="checkoutForm" action="../php/signup.php" method="post">
                    <div class="checkoutMain">
                        <div class="inputField">
                            <label for="name">Name:</label>
                            <input placeholder="Insert name" type="text" id="name" name="name" required>
                        </div>
                        <div class="inputField">
                            <label for="email">E-mail:</label>
                            <input placeholder="Insert E-mail" type="email" id="email" name="email" required>
                        </div>
                        <div class="inputField">
                            <label for="password">Password:</label>
                            <input placeholder="Insert password" type="text" id="password" name="password" required>
                        </div>
                        <div class="inputField">
                            <label for="address">Address:</label>
                            <input placeholder="Insert address" type="text" id="address" name="address" required>
                        </div>
                        <div class="inputField">
                            <label for="zipcode">Zipcode:</label>
                            <input placeholder="Insert zipcode" type="text" id="zipcode" name="zipcode" required>
                        </div>
                    </div>
                    <div class="purchaseButtonHolder">
                        <a id="popupBtn" class="submitButton">Buy now!</a>
                        <p class="disclaimerText">Subscription required</p>
                    </div>
                </form>
            </div>
        </section>
    </main>

<div id="myModal" class="modal">
  <div class="modal-content-checkout">
    <div>
        <h1 class="centeredText">Subscribe now</h1>
    </div>
    <div>
        <p class="centeredText">This product requires a subscription to work</p>
    </div>
    <div class="bottomDiv" >
        <p class="centeredText">₿0.2 BTC per month</p>
    </div>
    <div class="bottomDiv" >
        <p class="centeredTextDisclaimer">When you start a subscription, you agree to our Privacy Policy and our Terms of Conditions. If you take on a subscription, you agree to use the product for at least 12 months, if you decide to cancel early, you must pay the remainder of the subscription as a termination fee.</p>
    </div>
        <div class="bottomDiv">
        <a href="../index.php" id="popupBtn" class="submitButton" type="submit">Buy now!</a>
    </div>
  </div>
</div>

<script>
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var modalButton = document.getElementById("popupBtn");

  // When the user clicks the button, open the modal
  modalButton.onclick = function() {
    modal.style.display = "block";
  }

</script>
    <footer>
        <p class="footerP">© 2074 CyberNoir</p>
    </footer>
</body>
</html>