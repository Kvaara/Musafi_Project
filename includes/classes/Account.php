<?php

class Account
{
    private $con;
    private $error;

    public function __construct($con)
    {
        $this->con = $con;
        $this->error = [];
    }

    public function login($username, $password)
    {
        $password = sha1($password);

        $query = mysqli_query($this->con, "SELECT * FROM users WHERE  username='$username' AND password='$password'");

        if (mysqli_num_rows($query) == 1) {
            return true;
        } else {
            array_push($this->error, Constants::$loginFailure);
            return false;
        }
    }

    public function register($username, $fname, $lname, $email, $confirmEmail, $password, $confirmPassword)
    {
        $this->validateUsername($username);
        $this->validateFirstName($fname);
        $this->validateLastName($lname);
        $this->validateEmails($email, $confirmEmail);
        $this->validatePasswords($password, $confirmPassword);

        if (empty($this->error)) {
            //If no error insert user into db
            return $this->insertUserDetails($username, $fname, $lname, $email, $password);
        } else {
            return false;
        }
    }

    public function getError($errors)
    {
        if (!in_array($errors, $this->error)) {
            $errors = "";
        }
        return "<span class='error-msg'>{$errors}</span>";
    }

    private function insertUserDetails($username, $fname, $lname, $email, $password)
    {
        $encryptedPassword = sha1($password);
        $profilePic = "./assets/img/profile-pics/frog_pic.png";
        $date = date("d-m-Y");

        $result = mysqli_query($this->con, "INSERT INTO users VALUE ('', '$username', '$fname', '$lname', '$email', '$encryptedPassword', '$date', '$profilePic')");

        return $result;
    }

    private function validateUsername($username)
    {
        if (strlen($username) > 20 || strlen($username) < 4) {
            array_push($this->error, Constants::$usernameNotInRange);
            return;
        }

        // Checks if the username has been taken
        $usernameCheckQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$username'");
        if (mysqli_num_rows($usernameCheckQuery) != 0) {
            array_push($this->error, Constants::$usernameExists);
            return;
        }
    }

    private function validateFirstName($fname)
    {
        if (strlen($fname) > 20 || strlen($fname) < 2) {
            array_push($this->error, Constants::$firstNameNotInRange);
            return;
        }
    }

    private function validateLastName($lname)
    {
        if (strlen($lname) > 20 || strlen($lname) < 2) {
            array_push($this->error, Constants::$lastNameNotInRange);
            return;
        }
    }

    private function validateEmails($email, $confirmEmail)
    {
        if ($email != $confirmEmail) {
            array_push($this->error, Constants::$emailsDoNotMatch);
            return;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL,)) {
            array_push($this->error, Constants::$emailIncorrectForm);
            return;
        }

        // Checks if the email is already in use
        $emailCheckQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$email'");
        if (mysqli_num_rows($emailCheckQuery) != 0) {
            array_push($this->error, Constants::$emailTaken);
            return;
        }
    }

    private function validatePasswords($password, $confirmPassword)
    {
        if ($password != $confirmPassword) {
            array_push($this->error, Constants::$passwordsDoNotMatch);
            return;
        } else if (preg_match("/[^A-Za-z0-9]/", $password)) {
            array_push($this->error, Constants::$passwordNotAlphanumeric);
            return;
        } else if (strlen($password) < 8) {
            array_push($this->error, Constants::$passwordsTooShort);
            return;
        }
    }
}
