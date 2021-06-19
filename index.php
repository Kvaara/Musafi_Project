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

        <div id="application-section-container">
            <div id="application-nav-bar">

            </div>
            <div id="application-page">

            </div>
        </div>

        <div id="footer-player-container">
            <div id="current-song-container">

                <span id="current-song-link">
                    <img id="current-song-img" src="./assets/img/profile-pics/frog_pic.png" alt="Link to song">
                </span>
                <div id="current-song-info">
                    <span id="current-song-name">Seventh Road Ahead</span>
                    <br>
                    <span id="current-song-author">By Niklas Puganen</span>
                </div>

            </div>

            <div id="player-control-container">
                <div id="player-controls">
                    <img id="player-shuffle" src="./assets/img/player_shuffle.svg" alt="shuffle">
                    <img id="player-left" src="./assets/img/player_left2.svg" alt="previous">
                    <img class="player-play-pause" src="./assets/img/player_play2.svg" alt="play">
                    <img class="player-play-pause" src="./assets/img/player_pause.svg" alt="pause" style="display: none;">
                    <img id="player-right" src="./assets/img/player_right2.svg" alt="next">
                    <img id="player-repeat" src="./assets/img/player_repeat.svg" alt="repeat">
                </div>

                <div id="player-progress">
                    <span id="current-time">0.00</span>
                    <div id="progress-bar">
                        <div id="progress-bar-bg">
                            <div id="progress">

                            </div>
                        </div>
                    </div>
                    <span id="current-time-left">4.00</span>
                </div>
            </div>

            <div id="volume-control-container">
                <span id="volume-control-btn">
                    <img class="volume-control-button-img" src="./assets/img/player_volume100.svg" alt="Volume 100%">
                    <img class="volume-control-button-img" src="" alt="Volume 50%" style="display: none;">
                    <img class="volume-control-button-img" src="" alt="Volume 0%" style="display: none;">
                </span>
                <div id="volume-control-bar">
                    <div id="volume-control-bar-bg">
                        <div id="volume-control-bar-progress">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</body>

<script src="./assets/js/index.script.js"></script>

</html>