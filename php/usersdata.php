<?php
session_start();

// Schakelaar voor paywall (true = paywall aan, false = paywall uit)
$paywall_enabled = true;

// Controleer of de gebruiker heeft betaald
$has_paid = isset($_SESSION['has_paid']) ? $_SESSION['has_paid'] : false;

// Na POST-aanvraag verwerken
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crypto_wallet = $_POST['crypto_wallet'] ?? '';

    // Controleer of zowel een walletadres als een e-mailadres is ingevoerd
    if (!empty($crypto_wallet)) {
        // Markeer de betaling als voltooid in de sessie
        $_SESSION['has_paid'] = true;

        // Redirect om formulier opnieuw indienen te voorkomen
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    } else {
        $error_message = "Please enter a valid crypto wallet address.";
    }
}

/** @var mysqli $db*/

require_once 'database.php';    

$users = [];
if ($has_paid && $paywall_enabled) {
    $query = "SELECT * FROM users";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    } else {
        $error_message = "No users found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberNoir Webcams</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div id="page-wrapper" class="<?= (!$has_paid && $paywall_enabled) ? 'blurred' : '' ?>">

    <header>
        <div class="headerLeft">
            <a class="headerLeftText" href="../index.php">CyberNoir</a>
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


    <div id="main-content" class="<?= (!$has_paid && $paywall_enabled) ? 'blurred' : '' ?>">
    <div id="hidden-content">
        <?php if ($has_paid && !empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <div class="user-info card">
                   
                    <ul class="user-details">
                    <li><strong>Name:</strong> <?= $user['name'] ?></li>
                    <li><strong>Age:</strong> <?= $user['age'] ?></li>
                        <li><strong>Email:</strong> <?= $user['email'] ?></li>
                        <li><strong>Password:</strong> <?= $user['password'] ?></li>
                        <li><strong>Blood Type:</strong> <?= $user['blood_type'] ?></li>
                        <li><strong>Address:</strong> <?= $user['address'] ?></li>
                        <li><strong>Zipcode:</strong> <?= $user['postal_code'] ?></li>
                        <li><strong>Notes:</strong> <?= $user['notes'] ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php elseif ($has_paid): ?>
            <p class="no-users-message">Er zijn geen gebruikersgegevens beschikbaar.</p>
        <?php endif; ?>
    </div>
</div>


    <footer>
        <p class="footerP">© 2074 CyberNoir Webcams</p>
    </footer>
</div>

<?php if (!$has_paid && $paywall_enabled): ?>
    <div class="paywall-overlay"></div>
    <div class="paywall-popup">
        <h2>Premium Content</h2>
        <p>To access this content, please make a "payment".</p>
        <form id="payment-form" method="POST">
            <input type="text" id="crypto-wallet" name="crypto_wallet" placeholder="Enter crypto wallet address" required>
            <button class="buyButton" type="submit">Pay Now</button>
        </form>
        <?php if (!empty($error_message)): ?>
            <p><?= $error_message ?></p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<script src="../js/main.js" defer></script>

</body>
</html>
