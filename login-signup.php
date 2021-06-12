<?php
include("./includes/classes/Account.php");

$account = new Account();

include("./includes/handlers/signup-handler.php");
include("./includes/handlers/signin-handler.php");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div id="input-container">
        <form id="signin-form" action="login-signup.php" method="POST">
            <h2>Already have an account?</h2>
            <span>Please sign in to your account below ⇩</span>
            <p>
                <label for="signin-username">Username:</label>
                <input type="text" id="signin-username" name="signin-username" placeholder="Type in here..." required>
            </p>
            <p>
                <label for="signin-password">Password :</label>
                <input type="password" id="signin-password" name="signin-password" placeholder="Type in here..." required>
            </p>
            <button type="submit" name="signin-btn" id="signin-btn">LOGIN</button>
        </form>

        <form id="signup-form" action="login-signup.php" method="POST">
            <h2>Don't have an account?</h2>
            <span>Please sign up with your email and password ⇩</span>
            <p>
                <label for="signup-username">Username:</label>
                <input type="text" id="signup-username" name="signup-username" placeholder="Type in here..." required>
            </p>

            <p>
                <label for="signup-fname">First name:</label>
                <input type="text" id="signup-fname" name="signup-fname" placeholder="Type in here..." required>
            </p>

            <p>
                <label for="signup-lname">Last name:</label>
                <input type="text" id="signup-lname" name="signup-lname" placeholder="Type in here..." required>
            </p>

            <p>
                <label for="signup-email">Email:</label>
                <input type="email" id="signup-email" name="signup-email" placeholder="Type in here..." required>
            </p>

            <p>
                <label for="signup-email-confirm">Confirm your email:</label>
                <input type="email" id="signup-email-confirm" name="signup-email-confirm" placeholder="Type in here..." required>
            </p>

            <p>
                <label for="signup-password">Password :</label>
                <input type="password" id="signup-password" name="signup-password" placeholder="Type in here..." required>
            </p>

            <p>
                <label for="signup-password-confirm">Confirm your password :</label>
                <input type="password" id="signup-password-confirm" name="signup-password-confirm" placeholder="Type in here..." required>
            </p>

            <button type="submit" name="signup-btn" id="signup-btn">SIGN UP</button>
        </form>

    </div>



</body>

</html>