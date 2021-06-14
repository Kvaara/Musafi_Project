<?php

function sanitizeFormUsername($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
}

function sanitizeFormNamesAndEmail($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}

function sanitizeFormPassword($inputText)
{
    $inputText = strip_tags($inputText);
    return $inputText;
}


if (isset($_POST["signup-btn"])) {
    // Sign up button was pressed

    $username = sanitizeFormUsername($_POST["signup-username"]);

    $fname = sanitizeFormNamesAndEmail($_POST["signup-fname"]);
    $lname = sanitizeFormNamesAndEmail($_POST["signup-lname"]);

    $email = sanitizeFormNamesAndEmail($_POST["signup-email"]);
    $confirmEmail = sanitizeFormNamesAndEmail($_POST["signup-email-confirm"]);

    $password = sanitizeFormPassword($_POST["signup-password"]);
    $confirmPassword = sanitizeFormPassword($_POST["signup-password-confirm"]);

    $registerationWasDone = $account->register($username, $fname, $lname, $email, $confirmEmail, $password, $confirmPassword);

    if ($registerationWasDone) {
        $_SESSION["userSignedIn"] = $username;
        header("Location: index.php");
    } else {
        die("There was an error inserting data into the database");
    }
}
