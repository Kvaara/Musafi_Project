<?php
class Constants
{
    public static $passwordsDoNotMatch = "Passwords don't match!";
    public static $passwordNotAlphanumeric = "Password can only contain numbers and letters!";
    public static $passwordsTooShort = "Password can't be shorter than 8 letters!";

    public static $emailIncorrectForm = "Email is not in the correct form!";
    public static $emailsDoNotMatch = "Emails don't match!";
    public static $emailTaken = "Email is already in use!";

    public static $lastNameNotInRange = "Last name must be between 2 and 20 characters long!";
    public static $firstNameNotInRange = "First name must be between 2 and 20 characters long!";

    public static $usernameNotInRange = "Username must be between 4 and 20 characters long!";
    public static $usernameExists = "Username already exists!";

    public static $loginFailure = "Username and/or password was incorrect";
}
