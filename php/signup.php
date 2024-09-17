<?php
// signup.php

// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Use the password you set for MySQL, or leave blank if no password is set
$dbname = "tle_1"; // The database you created

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $blood_type = $_POST['blood_type'];
    $notes = $_POST['notes'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure the password

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, age, email, blood_type, notes, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $name, $age, $email, $blood_type, $notes, $password);

    if ($stmt->execute()) {
        echo "Account created successfully!";
        echo '<br><a href="/login.html">Log in</a>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
