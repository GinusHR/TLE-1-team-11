<?php

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    $username = $_POST['username'];
//    $password = $_POST['password'];
//
//    // Example static login check, replace with a database check
//    if ($username === 'admin' && $password === 'password123') {
//        $_SESSION['user_logged_in'] = true;
//        header("Location: index.php");
//        exit();
//    } else {
//        echo "Invalid login credentials.";
//    }
//}

/** @var mysqli $db */

session_start();

require_once 'database.php';

if(!isset($_SESSION['user'])) {
    $login = false;

    $emailError = '';
    $passwordError = '';



    if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($_POST['email'])) {
            $emailError = 'Email cannot be empty!';

        }
        if (empty($_POST['password'])) {
            $passwordError = 'Password cannot be empty!';
        }
        if (empty($emailError) && empty($passwordError)) {
            $query = "SELECT * FROM users2 WHERE email = '$email'";
            $result = mysqli_query($db, $query);
            mysqli_escape_string($db, $_POST['password']);
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                    ];
                    $login = true;
                    header('Location: ../index.php');
                } else {
                    $errors['loginFailed'] = 'Incorrect login credentials';
                }
            } else {
                $errors['loginFailed'] = 'Incorrect login credentials';
            }
        }

    }
} else {
    $login = true;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
<h2 class="signupTitle">Log In</h2>
<?php if ($login) { ?>
        <div class="loginDiv">
            <p>You're logged In!</p>
            <p><a href="../php/logout.php">Log out</a> / <a href="../index.php">Time to make a purchase</a></p>
        </div>

<?php } else { ?>
<form action="../php/login.php" method="post">
    <div class="loginWhole">
        <div class="loginLabel">
            <label for="email">E-mail:</label>
            <input placeholder="Insert E-mail" type="email" id="email" name="email" value="<?= htmlentities($email ?? '') ?>"required>
        </div>

        <div class="loginInput">
        <label for="password">Password:</label>
            <input placeholder="Insert password" type="password" id="password" name="password" required>
        </div>
    </div>
    <div class="submitButtonHolder">
        <button class="submitButton" type="submit" name="submit">Log in</button>
    </div>
</form>
    <?php if(isset($errors['loginFailed'])) { ?>
        <div class="error">
            <?=$errors['loginFailed']?>
        </div>
    <?php } ?>
<p class="submitButtonHolder">
    Don't have an account? <a href="signup.php">Sign up here</a>.
</p>
<?php } ?>
<footer>
    <p class="footerP">© 2074 CyberNoir</p>
</footer>
</body>


</html>
