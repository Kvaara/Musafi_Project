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

function validateUsername($username)
{
}

function validateFirstName($fname)
{
}

function validateLastName($lname)
{
}

function validateEmails($email, $confirmEmail)
{
}

function validatePasswords($password, $confirmPassword)
{
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

    validateUsername($username);
    validateFirstName($fname);
    validateLastName($lname);
    validateEmails($email, $confirmEmail);
    validatePasswords($password, $confirmPassword);
}
