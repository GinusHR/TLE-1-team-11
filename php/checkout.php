<?php
/** @var mysqli $db */
require_once 'database.php';

// Verkrijg de product_id uit de URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    // Haal de gegevens van het geselecteerde product op
    $query = "SELECT * FROM onderdelen WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
} else {
    // Product_id is niet geldig, stuur de gebruiker terug naar de homepage of een foutpagina
    header("Location: ../index.php");
    exit();
}

mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/checkout.css">
    <title>Checkout</title>
</head>
<body>
<header>
    <div class="headerLeft">
        <p class="headerLeftText">CyberNoir</p>
    </div>

    <div class="headerRight">
        <div class="headerRightPart">
            <a class="blueText" href="../html/signup.html">Sign Up</a>
        </div>
        <div class="headerRightPart">
            <a href="../html/login.html">Log In</a>
        </div>
    </div>
</header>

<main>
    <section>
        <h1 class="mainTitle">Checkout</h1>
        <form action="process_payment.php" method="post" class="mainText">
            <input type="hidden" id="product_id" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
            
            <div class="form-group">
                <label for="product_name">Productnaam:</label>
                <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($product['name']) ?>" readonly>
            </div>

            <div class="form-group">
                <label for="product_price">Productprijs:</label>
                <input type="text" id="product_price" name="product_price" value="<?= htmlspecialchars($product['price']) ?> BTC" readonly>
            </div>

            <div class="form-group">
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">E-mailadres:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="address">Adres:</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="form-group">
                <label for="city">Stad:</label>
                <input type="text" id="city" name="city" required>
            </div>

            <div class="form-group">
                <label for="zip">Postcode:</label>
                <input type="text" id="zip" name="zip" required>
            </div>

            <button type="submit" class="mainButton">Afrekenen</button>
        </form>
    </section>
</main>

<footer>
    <p class="footerP">"Bedankt voor uw aankoop bij CyberNoir!"</p>
</footer>
</body>
</html>
