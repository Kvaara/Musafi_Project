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

        <div id="to-signin">
            <h2>Already have an account?</h2>
            <span>Please sign in to your account below</span>
        </div>

        <div id="signin-container" style="display: none;">
            <?php echo "<div id='signin-error-msg'>" . $account->getError(Constants::$loginFailure) . "</div>" ?>
            <form id="signin-form" action="login-signup.php" method="POST">
                <p>
                    <label for="signin-username">Username:</label>
                    <input type="text" id="signin-username" name="signin-username" placeholder="Enter your username..." required>
                </p>
                <p>
                    <label for="signin-password">Password:</label>
                    <input type="password" id="signin-password" name="signin-password" placeholder="Enter your password..." required>
                </p>

                <button type="submit" name="signin-btn" id="signin-btn">SIGN IN</button>
                <button type="button" name="back-btn" class="back-btn" id="signin-back-btn"><span class="arrow-back-span">&#8678; </span> BACK</BUTTON>
            </form>
        </div>


        <div id="to-signup">
            <h2>Don't have an account?</h2>
            <span>Please sign up with your email and password</span>
        </div>

        <div id="signup-container" style="display: none;">
            <form id="signup-form" action="login-signup.php" method="POST">
                <p>
                    <?php echo $account->getError(Constants::$usernameExists); ?>
                    <?php echo $account->getError(Constants::$usernameNotInRange); ?>
                    <label for="signup-username">Username &#8594;</label>
                    <input type="text" id="signup-username" name="signup-username" placeholder="A desired username..." value='<?php saveInputValue("signup-username") ?>' required>
                </p>

                <p>
                    <?php echo $account->getError(Constants::$firstNameNotInRange); ?>
                    <label for="signup-fname">First name &#8594;</label>
                    <input type="text" id="signup-fname" name="signup-fname" placeholder="What's your first name?" value='<?php saveInputValue("signup-fname") ?>' required>
                </p>

                <p>
                    <?php echo $account->getError(Constants::$lastNameNotInRange); ?>
                    <label for="signup-lname">Last name &#8594;</label>
                    <input type="text" id="signup-lname" name="signup-lname" placeholder="What's your last?" value='<?php saveInputValue("signup-lname") ?>' required>
                </p>

                <p>
                    <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <?php echo $account->getError(Constants::$emailIncorrectForm); ?>
                    <label for="signup-email">Email &#8594;</label>
                    <input type="email" id="signup-email" name="signup-email" placeholder="Enter your email..." value='<?php saveInputValue("signup-email") ?>' required>
                </p>

                <p>
                    <label for="signup-email-confirm">Confirm email &#8594;</label>
                    <input type="email" id="signup-email-confirm" name="signup-email-confirm" placeholder="Confirm the email..." required>
                </p>

                <p>
                    <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                    <?php echo $account->getError(Constants::$passwordsTooShort); ?>
                    <label for="signup-password">Password &#8594;</label>
                    <input type="password" id="signup-password" name="signup-password" placeholder="A strong password..." required maxlength="25">
                </p>

                <p>
                    <label for="signup-password-confirm">Confirm password &#8594;</label>
                    <input type="password" id="signup-password-confirm" name="signup-password-confirm" placeholder="Confirm the password..." required maxlength="25">
                </p>

                <button type="submit" name="signup-btn" id="signup-btn">SIGN UP</button>
                <button type="button" name="back-btn" class="back-btn" id="signup-back-btn"><span class="arrow-back-span">&#8678; </span> BACK</BUTTON>
            </form>

        </div>

    </div>


</body>

<?php

if (isset($_POST["signup-btn"])) {
    echo "<script> 
    const toSignInPost = document.querySelector('#to-signin');
    const toSignUpPost = document.querySelector('#to-signup');
    
    const signInFormPost = document.querySelector('#signin-container');
    const signUpFormPost = document.querySelector('#signup-container');

    toSignUpPost.style.display = 'none';
    toSignInPost.style.display = 'none';

    signUpFormPost.style.display = 'flex';
    </script>";
} else if (isset($_POST["signin-btn"])) {
    echo "<script> 
    const toSignInPost = document.querySelector('#to-signin');
    const toSignUpPost = document.querySelector('#to-signup');
    
    const signInFormPost = document.querySelector('#signin-container');
    const signUpFormPost = document.querySelector('#signup-container');
    
    toSignUpPost.style.display = 'none';
    toSignInPost.style.display = 'none';

    signInFormPost.style.display = 'flex';
    </script>";
}
?>

<script src="./assets/js/register.js"></script>

</html>