<?php
include("includes/config.php");

//session_destroy(); SIGN OUT

if (isset($_SESSION["userSignedIn"])) {
    $userSignedIn = $_SESSION["userSignedIn"];
} else {
    header("Location: login-signup.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/index.styles.css">
    <title>Document</title>
</head>

<body>

    <div id="flex-wrapper">

        <div id="application-section">
            <h1>section</h1>
        </div>

        <div id="footer-player">
            <h1>footer</h1>
        </div>

    </div>


</body>

</html>