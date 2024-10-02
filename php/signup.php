<?php
/** @var mysqli $db */
session_start();

require_once "../php/database.php";

if(isset($_POST['submit'])) {
    $nameError = '';
    $ageError = '';
    $emailError = '';
    $passwordError = '';
    $bloodTypeError = '';
    $addressError = '';
    $zipcodeError = '';


    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $bloodType = $_POST['blood_type'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $age = $_POST['age'];
    $notes= $_POST['notes'];

    if ($_POST['name'] === '') {
        $nameError = 'Enter your name!';
    }
    if ($_POST['age'] === '') {
        $ageError = 'Enter your age!';
    }
    if ($_POST['email'] === '') {
        $emailError = 'Enter your email!';
    }
    if ($_POST['password'] === '') {
        $passwordError = 'Enter a password!';
    }
    if ($_POST['blood_type'] === '') {
        $bloodTypeError = 'Fil in your blood type!';
    }
    if ($_POST['address'] === '') {
        $addressError = 'Enter your address!';
    }
    if ($_POST['zipcode'] === '') {
        $zipcodeError = 'Enter your zipcode!';
    }
    if (empty($nameError) && empty($ageError) && empty($emailError) && empty($passwordError) && empty($bloodTypeError) && empty($addressError) && empty($zipcodeError)) {
        $emailCheckQuery = "SELECT * FROM users2 WHERE email = '$email'";
        $emailCheckResult = mysqli_query($db, $emailCheckQuery);

        if (mysqli_num_rows($emailCheckResult) > 0) {
            $emailTaken = 'This email is already taken!';
        } else {
            try {
                $hashPassword = md5($password);
                $query = "INSERT INTO users2 (name, age, email, password, blood_type, address, postal_code, notes)
                          VALUES ('$name', '$age', '$email', '$hashPassword', '$bloodType', '$address', '$zipcode', '$notes')";
                $result = mysqli_query($db, $query);

                if ($result) {
                    header('Location: ../index.php');
                    exit;
                }
            } catch (mysqli_sql_exception $e) {
                $emailTaken = 'This email is already taken!';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
<h2 class="signupTitle">Sign up</h2>
<form action="" method="post">
    <div class="formWhole">
        <div class="formLeft">
            <div class="inputField">
                <label for="name">Name:</label>
                <input placeholder="Insert name" type="text" id="name" name="name"  required>

            </div>

            <div class="inputField">
                <label for="age">Age:</label>
                <input placeholder="Insert age" type="number" id="age" name="age" required>

            </div>


            <div class="inputField">
                <label for="email">E-mail:</label>
                <input placeholder="Insert E-mail" type="email" id="email" name="email"  required>
                <?php if(isset($emailTaken)) { ?>
                    <div class="signupError">
                        <?=$emailTaken?>
                    </div>
                <?php } ?>
            </div>

            <div class="inputField">
                <label for="password">Password:</label>
                <input placeholder="Insert password" type="password" id="password" name="password"  required>

            </div>
        </div>
        <div class="formRight">
            <div class="inputField">
                <label for="blood_type">Blood Type:</label>
                <input placeholder="Insert blood type" type="text" id="blood_type" name="blood_type"  required>

            </div>

            <div class="inputField">
                <label for="address">Address:</label>
                <input placeholder="Insert address" type="text" id="address" name="address"  required>
            </div>


            <div class="inputField">
                <label for="zipcode">Zipcode:</label>
                <input placeholder="Insert zipcode" type="text" id="zipcode" name="zipcode" required>

            </div>


            <div class="inputField">
                <label for="notes">Notes:</label>
                <textarea placeholder="Add notes" id="notes" name="notes"></textarea>
            </div>


        </div>
    </div>
    <div class="submitButtonHolder">
        <button class="submitButton" type="submit" name="submit">Sign up</button>
    </div>
</form>

<p class="submitButtonHolder">Already have an account?  <a href="../php/login.php">Log in here</a>.</p>
<footer>
    <p class="footerP">© 2074 CyberNoir</p>
</footer>

</body>
</html>
