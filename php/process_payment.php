<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tle_1';

// Maak een verbinding met de database
$db = mysqli_connect($host, $username, $password, $dbname);

if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}

/** @var mysqli $db */

// Controleer of het formulier is ingediend via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal de gegevens op uit het formulier
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $zip = mysqli_real_escape_string($db, $_POST['zip']);
    $product_id = mysqli_real_escape_string($db, $_POST['product_id']);

    // Controleer of e-mailadres al bestaat
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // E-mailadres bestaat al, haal de user_id op
        $user = $result->fetch_assoc();
        $user_id = $user['id'];
    } else {
        // Voeg gebruiker toe aan de database
        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if (!$stmt->execute()) {
            echo "Fout bij het aanmaken van het account: " . mysqli_error($db);
            $stmt->close();
            mysqli_close($db);
            exit();
        }

        $user_id = $stmt->insert_id; // Haal de ID van de nieuwe gebruiker op
    }

    // Voeg bestelling toe aan de database
    $stmt = $db->prepare("INSERT INTO orders (user_id, product_id, address, city, zip) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $user_id, $product_id, $address, $city, $zip);

    if (!$stmt->execute()) {
        echo "Fout bij het plaatsen van de bestelling: " . mysqli_error($db);
    }

    // Sluit de statement en de database
    $stmt->close();
    mysqli_close($db);

    // Redirect naar de berichtpagina na verwerking
    header("Location: messagepage.php");
    exit();
} else {
    // Als het formulier niet via POST is ingediend, ga terug naar de checkout pagina
    header("Location: checkout.php");
    exit();
}
?>
