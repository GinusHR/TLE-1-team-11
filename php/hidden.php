<?php
session_start();

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
        $error_message = "Please enter a valid crypto wallet address and email.";
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

<div id="page-wrapper" class="<?= !$has_paid ? 'blurred' : '' ?>">
    <!-- Hier komt alle inhoud van je pagina -->
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

<div id="main-content" class="<?= !$has_paid ? 'blurred' : '' ?>">
    <div id="hidden-content">
    </div>
    <section class="webcam-grid">
    </section>
</div>

    
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <video id="modal-video" controls >
                <source src="" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div id="modal-text" class="modal-text"></div>
        </div>
    </div>

  <section class="webcam-grid">
    <div class="webcam" data-video="../images/webcam 7.mp4"
        data-naam="Mirjan Barb Kaap"  
        data-leeftijd="32"
        data-email="Mirjan35@hotmail.com" 
        data-bloedgroep="A"
        data-notities="Her Mothter is really sick" 
        data-wachtwoord="skipper1402">
        <div class="webcam-container">
            <div class="live-indicator">
                <div class="indicator"></div>
                <div class="text">Live</div>
            </div>
            <video muted loop>
                <source src="../images/webcam 7.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <h3>Mirjan Kaap</h3>
    </div>

    <div class="webcam" data-video="../images/webcam 8.mp4"
        data-naam="Lisa van Hoof"  
        data-leeftijd="40"
        data-email="Vanhoof@gmail.com" 
        data-bloedgroep="B"
        data-notities="Recently divorced" 
        data-wachtwoord="password1234">
        <div class="webcam-container">
            <div class="live-indicator">
                <div class="indicator"></div>
                <div class="text">Live</div>
            </div>
            <video muted loop>
                <source src="../images/webcam 8.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <h3>Lisa van Hoof</h3>
    </div>

    <div class="webcam" data-video="../images/webcam 3.mp4"
        data-naam="Bob Snoek"  
        data-leeftijd="54"
        data-email="Bobsnoek@icloud.com" 
        data-bloedgroep="A"
        data-notities="Always goes 8:30AM running" 
        data-wachtwoord="Runforest1970">
        <div class="webcam-container">
            <div class="live-indicator">
                <div class="indicator"></div>
                <div class="text">Live</div>
            </div>
            <video muted loop>
                <source src="../images/webcam 3.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <h3>Bob Snoek</h3>
    </div>

    <div class="webcam" data-video="../images/webcam.mp4"
        data-naam="Jack Trifon"  
        data-leeftijd="23"
        data-email="Jacktheripper@gmail.com" 
        data-bloedgroep="AB"
        data-notities="Killed his little brother" 
        data-wachtwoord="Arsenal2001">
        <div class="webcam-container">
            <div class="live-indicator">
                <div class="indicator"></div>
                <div class="text">Live</div>
            </div>
            <video muted loop>
                <source src="../images/webcam.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <h3>Jack Trifon</h3>
    </div>

    <div class="webcam" data-video="../images/webcam 6.mp4"
        data-naam="Selena Carp"  
        data-leeftijd="26"
        data-email="Selen0208@email.com" 
        data-bloedgroep="A"
        data-notities="Dog got run over" 
        data-wachtwoord="Doglover0208">
        <div class="webcam-container">
            <div class="live-indicator">
                <div class="indicator"></div>
                <div class="text">Live</div>
            </div>
            <video muted loop>
                <source src="../images/webcam 6.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <h3>Selena Carp</h3>
    </div>



    <div class="webcam" data-video="../images/webcam 2.mp4"
        data-naam="Yasmin Antonely"  
        data-leeftijd="29"
        data-email="Antonely@gmail.com" 
        data-bloedgroep="O"
        data-notities="Has a drugs addiction" 
        data-wachtwoord="MDMAyasmin95">
        <div class="webcam-container">
            <div class="live-indicator">
                <div class="indicator"></div>
                <div class="text">Live</div>
            </div>
            <video muted loop>
                <source src="../images/webcam 2.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <h3>Yasmin Antonely</h3>
    </div>

    
    <div class="webcam" data-video="../images/webcam 5.mp4"
        data-naam="Taylor Honeytomb"  
        data-leeftijd="36"
        data-email="Honeybeetaylor@icloud.com" 
        data-bloedgroep="AB"
        data-notities="Her father runaway when she was three years old" 
        data-wachtwoord="honeybee0906">
        <div class="webcam-container">
            <div class="live-indicator">
                <div class="indicator"></div>
                <div class="text">Live</div>
            </div>
            <video muted loop>
                <source src="../images/webcam 5.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <h3>Taylor Honeytomb</h3>
    </div>


    <div class="webcam" data-video="../images/webcam 4.mp4"
        data-naam="William Snake"  
        data-leeftijd="30"
        data-email="Williamsnake@hotmail.com" 
        data-bloedgroep="A"
        data-notities="He beat teens for fun" 
        data-wachtwoord="Viper@1996!">
        <div class="webcam-container">
            <div class="live-indicator">
                <div class="indicator"></div>
                <div class="text">Live</div>
            </div>
            <video muted loop>
                <source src="../images/webcam 4.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <h3>William Snake</h3>
    </div>

    
    <div class="webcam" data-video="../images/webcam 9.mp4"
        data-naam="Jeremy White"  
        data-leeftijd="38"
        data-email="WhiteJeremey@hotmail.com" 
        data-bloedgroep="O"
        data-notities="He tries to lure childeren in" 
        data-wachtwoord="AmericaN1!">
        <div class="webcam-container">
            <div class="live-indicator">
                <div class="indicator"></div>
                <div class="text">Live</div>
            </div>
            <video muted loop>
                <source src="../images/webcam 9.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <h3>Jeremy White</h3>
    </div>
    </section>

   

    
    <footer>
        <p class="footerP">© 2074 CyberNoir Webcams</p>
    </footer>
</div>

<?php if (!$has_paid): ?>
    <div class="paywall-overlay"></div>
    <div class="paywall-popup">
        <h2>Premium Content</h2>
        <p>To access this content, please make a "payment".</p>
        <form id="payment-form" method="POST">
            
            <input type="text" id="crypto-wallet" name="crypto_wallet" placeholder="Enter crypto wallet address" required>
            <button type="submit">Pay Now</button>
        </form>
        <?php if (!empty($error_message)): ?>
            <p style="color:red;"><?= $error_message ?></p>
        <?php endif; ?>
    </div>
<?php endif; ?>


<script src="../js/main.js" defer></script>

</body>
</html>