<?php
// Sign in button was pressed
if (isset($_POST["signin-btn"])) {
    $username = $_POST["signin-username"];
    $password = $_POST["signin-password"];

    $result = $account->login($username, $password);

    if ($result) {
        $_SESSION["userSignedIn"] = $username;
        header("Location: index.php");
    }
}
