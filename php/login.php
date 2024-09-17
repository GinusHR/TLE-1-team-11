<?php
// login.php

// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "tle_1";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($name, $hashed_password);
    $stmt->fetch();

    if ($name && password_verify($password, $hashed_password)) {
        echo "Welcome back, $name!";
    } else {
        echo "Invalid email or password.";
        echo '<br><a href="login.html">Try again</a>';
    }

    $stmt->close();
}

$conn->close();
?>
