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
            <h1>section</h1>
        </div>

        <div id="footer-player-container">
            <div id="current-song">

                <div>

                </div>

            </div>

            <div id="player-control-container">
                <div id="player-controls">
                    <img id="player-shuffle" src="./assets/img/player_shuffle.svg" alt="shuffle">
                    <img id="player-left" src="./assets/img/player_left.svg" alt="previous">
                    <img class="player-play-pause" src="./assets/img/player_play.svg" alt="play">
                    <img class="player-play-pause" src="./assets/img/player_pause.svg" alt="pause" hidden>
                    <img id="player-right" src="./assets/img/player_right.svg" alt="next">
                    <img id="player-repeat" src="./assets/img/player_repeat.svg" alt="repeat">
                </div>

                <div id="player-progress">
                    <span id="current-time">0.00</span>
                    <div id="progress-bar">hello----------------------------------</div>
                    <span id="current-time-left">4.00</span>
                </div>
            </div>

            <div id="volume-control-container">

            </div>
        </div>

    </div>


</body>

</html>