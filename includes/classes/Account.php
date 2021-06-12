<?php

class Account
{
    private $error;

    public function __construct()
    {
        $this->error = [];
    }

    public function register($username, $fname, $lname, $email, $confirmEmail, $password, $confirmPassword)
    {
        $this->validateUsername($username);
        $this->validateFirstName($fname);
        $this->validateLastName($lname);
        $this->validateEmails($email, $confirmEmail);
        $this->validatePasswords($password, $confirmPassword);
    }

    private function validateUsername($username)
    {
        if (strlen($username) > 20 || strlen($username) < 4) {
            array_push($this->error, "Username must be between 4 and 20 characters long!");
            return;
        }

        // TODO: Check if username exists
    }

    private function validateFirstName($fname)
    {
        if (strlen($fname) > 20 || strlen($fname) < 2) {
            array_push($this->error, "First name must be between 2 and 20 characters long!");
            return;
        }
    }

    private function validateLastName($lname)
    {
        if (strlen($lname) > 20 || strlen($lname) < 2) {
            array_push($this->error, "Last name must be between 2 and 20 characters long!");
            return;
        }
    }

    private function validateEmails($email, $confirmEmail)
    {
        if ($email != $confirmEmail) {
            array_push($this->error, "Emails don't match!");
            return;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL,)) {
            array_push($this->error, "Email is not in the correct form!");
            return;
        }

        // TODO Check that username hasn't already been used
    }

    private function validatePasswords($password, $confirmPassword)
    {
    }
}
