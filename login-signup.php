<?php
// Include the config file that connects to the database
include("./includes/config.php");

// We create a class name Constants that's used for the error messages
include("./includes/classes/Constants.php");

// We create a class named Account here and include it
include("./includes/classes/Account.php");
$account = new Account($con);

include("./includes/handlers/signup-handler.php");
include("./includes/handlers/signin-handler.php");

// This saves the inputs from the user if form submission has invalid inputs and doesn't go through
function saveInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/login-signup.styles.css">
</head>

<body>
    <div id="input-container">

        <div id="signin-container">
            <form id="signin-form" action="login-signup.php" method="POST">
                <h2>Already have an account?</h2>
                <span>Please sign in to your account below</span>
                <p>
                    <?php echo $account->getError(Constants::$loginFailure) ?>
                    <label for="signin-username">Username</label>
                    <input type="text" id="signin-username" name="signin-username" placeholder="Type in here..." required>
                </p>
                <p>
                    <label for="signin-password">Password</label>
                    <input type="password" id="signin-password" name="signin-password" placeholder="Type in here..." required>
                </p>
                <button type="submit" name="signin-btn" id="signin-btn">SIGN IN</button>
            </form>

        </div>

        <div id="signup-container">
            <form id="signup-form" action="login-signup.php" method="POST">
                <h2>Don't have an account?</h2>
                <span>Please sign up with your email and password:</span>
                <p>
                    <?php echo $account->getError(Constants::$usernameExists); ?>
                    <?php echo $account->getError(Constants::$usernameNotInRange); ?>
                    <label for="signup-username">Username</label>
                    <input type="text" id="signup-username" name="signup-username" placeholder="Type in here..." value='<?php saveInputValue("signup-username") ?>' required>
                </p>

                <p>
                    <?php echo $account->getError(Constants::$firstNameNotInRange); ?>
                    <label for="signup-fname">First name</label>
                    <input type="text" id="signup-fname" name="signup-fname" placeholder="Type in here..." value='<?php saveInputValue("signup-fname") ?>' required>
                </p>

                <p>
                    <?php echo $account->getError(Constants::$lastNameNotInRange); ?>
                    <label for="signup-lname">Last name</label>
                    <input type="text" id="signup-lname" name="signup-lname" placeholder="Type in here..." value='<?php saveInputValue("signup-lname") ?>' required>
                </p>

                <p>
                    <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <?php echo $account->getError(Constants::$emailIncorrectForm); ?>
                    <label for="signup-email">Email</label>
                    <input type="email" id="signup-email" name="signup-email" placeholder="Type in here..." value='<?php saveInputValue("signup-email") ?>' required>
                </p>

                <p>
                    <label for="signup-email-confirm">Confirm your email</label>
                    <input type="email" id="signup-email-confirm" name="signup-email-confirm" placeholder="Type in here..." required>
                </p>

                <p>
                    <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                    <?php echo $account->getError(Constants::$passwordsTooShort); ?>
                    <label for="signup-password">Password</label>
                    <input type="password" id="signup-password" name="signup-password" placeholder="Type in here..." required maxlength="25">
                </p>

                <p>
                    <label for="signup-password-confirm">Confirm your password</label>
                    <input type="password" id="signup-password-confirm" name="signup-password-confirm" placeholder="Type in here..." required maxlength="25">
                </p>

                <button type="submit" name="signup-btn" id="signup-btn">SIGN UP</button>
            </form>

        </div>

    </div>


</body>

</html>