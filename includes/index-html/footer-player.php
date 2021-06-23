<?php
if (isset($_GET['id'])) {
    $songsQuery = mysqli_query($con, "SELECT * FROM songs ORDER BY RAND() LIMIT 10");

    $songsArray = [];

    $songsQuery2 = mysqli_query($con, "SELECT * FROM songs where album = {$albumId} ORDER BY albumOrder ASC");

    while ($row = mysqli_fetch_assoc($songsQuery)) {
        array_push($songsArray, $row["path"]);
    }

    $songsTitleArray = [];
    $songsPathArray = [];

    while ($row = mysqli_fetch_assoc($songsQuery2)) {
        array_push($songsTitleArray, $row["title"]);
        array_push($songsPathArray, $row["path"]);
    }

    $songsJson = json_encode($songsArray);

    $songsTitleArrayJson = json_encode($songsTitleArray);
    $songsPathArrayJson = json_encode($songsPathArray);
}

?>

<script>
    let audioElement;

    document.addEventListener("DOMContentLoaded", () => {
        currentPlaylist = <?php echo $songsJson ?>;
        audioElement = new Audio();
        // setTrack(currentPlaylist[0], currentPlaylist, false);
    })

    const setTrack = (trackId, newPlaylist, play) => {
        audioElement.src = "./assets/songs/Niklas_Puganen/puganen-somesht.mp3";
        if (play) {
            audioElement.play();
        } else {
            audioElement.pause();
        }
    }

    $.post("./includes/handlers/ajax/getSongJson.php", {
        trackId: 1
    }, (result) => {
        const data = JSON.parse(result);
        audioElement.src = data.path;
    })

    const play = () => {
        audioElement.play();

        document.querySelector("#player-play").style.display = "none"
        document.querySelector("#player-pause").style.display = "inline";
    }

    const pause = () => {
        audioElement.pause();

        document.querySelector("#player-pause").style.display = "none";
        document.querySelector("#player-play").style.display = "inline";
    }
</script>

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
            <img id="player-play" class="player-play-pause" src="./assets/img/player_play2.svg" onclick="play()" alt="Play" title="Play">
            <img id="player-pause" class="player-play-pause" src="./assets/img/player_pause.svg" onclick="pause()" alt="Pause" title="Pause" style="display: none;">
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