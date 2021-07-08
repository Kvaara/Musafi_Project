<?php
include("./includes/config.php");
include("./includes/classes/Artist.php");
include("./includes/classes/Album.php");
include("./includes/classes/Song.php");

//session_destroy(); SIGN OUT

if (isset($_SESSION["userSignedIn"])) {
    $userSignedIn = $_SESSION["userSignedIn"];
    echo "<script>const userSignedIn = '{$userSignedIn}'</script>";
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
    <link rel="stylesheet" href="./assets/css/album.styles.css">
    <link rel="stylesheet" href="./assets/css/album-addtoplaylist.modal.css">
    <link rel="stylesheet" href="./assets/css/browse.styles.css">
    <link rel="stylesheet" href="./assets/css/mymusic.styles.css">
    <link rel="stylesheet" href="./assets/css/upload.styles.css">

    <title>Home - Musafi</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./assets/js/album-page.script.js"></script>
</head>

<body>

    <div id="flex-wrapper">

        <div id="application-section-container">

            <div id="application-nav-bar">

                <div id="nav-bar-title" role="link" tabindex="0" onclick="openPage('index.php')">
                    <img id="musafy-logo" src="./assets/img/musafy_logo.svg" alt="Musafy logo">
                    <span id="nav-bar-title-text" class="nav-bar-text">Musafi</span>
                </div>

                <div id="nav-bar-home" class="nav-bar-item" role="link" tabindex="0">
                    <img id="nav-bar-home-img" class="nav-bar-img" src="./assets/img/nav_bar_home.svg" alt="Home">
                    <span id="nav-bar-home-text" class="nav-bar-text">Home</span>
                </div>

                <div id="nav-bar-search" class="nav-bar-item" role="link" tabindex="0">
                    <img id="nav-bar-search-img" class="nav-bar-img" src="./assets/img/nav_bar_search.svg" alt="Search">
                    <span id="nav-bar-search-text" class="nav-bar-text">Search</span>
                </div>

                <div id="nav-bar-browse" class="nav-bar-item" role="link" tabindex="0">
                    <img id="nav-bar-browse-img" class="nav-bar-img" src="./assets/img/nav_bar_browse.svg" alt="Browse">
                    <span id="nav-bar-browse-text" class="nav-bar-text">Browse</span>
                </div>

                <div id="nav-bar-your-music" class="nav-bar-item" role="link" tabindex="0">
                    <img id="nav-bar-yourmusic-img" class="nav-bar-img" src="./assets/img/nav_bar_yourmusic.svg" alt="Your music">
                    <span id="nav-bar-yourmusic-text" class="nav-bar-text">Your music</span>
                </div>

                <div id="nav-bar-upload-music" class="nav-bar-item" role="link" tabindex="0">
                    <img id="nav-bar-uploadmusic-img" class="nav-bar-img" src="./assets/img/nav_bar_uploadmusic.svg" alt="Upload music">
                    <span id="nav-bar-uploadmusic-text" class="nav-bar-text">Upload</span>
                </div>

                <div id="nav-bar-settings" class="nav-bar-item" role="link" tabindex="0">
                    <img id="nav-bar-settings-img" class="nav-bar-img" src="./assets/img/nav_bar_settings.svg" alt="Settings">
                    <span id="nav-bar-settings-text" class="nav-bar-text">Settings</span>
                </div>

            </div>
            <div id="application-page">