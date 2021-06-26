<?php
if (isset($_GET['id'])) {
    $songsQuery = mysqli_query($con, "SELECT * FROM songs WHERE album = {$_GET['id']}");

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
        const currentPlaylist = <?php echo $songsJson ?>;
        audioElement = new Audio();
        audioElement.volume = 0.1;
        audioElement.currentPlaylist = currentPlaylist;
        // setTrack(currentPlaylist[0], currentPlaylist, false);
        updateVolumeIcon(10, true);
        userProgressBarControl(audioElement);
        userVolumeBarControl(audioElement);
        onAudioEnd(audioElement);
        setAlbumTracks(audioElement, <?php echo $_GET["id"] ?>);
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
        trackId: 1,
        albumId: <?php echo $_GET["id"] ?>
    }, (result) => {
        const trackData = JSON.parse(result);


        audioElement.src = trackData.path;
        audioElement.currentTrack = trackData;

        updateCurrentTimeLeft(audioElement);
        updateCurrentTimeAndProgressBar(audioElement);

        document.querySelector("#current-song-name").textContent = trackData.title;

        $.post("./includes/handlers/ajax/getArtistJson.php", {
            artistId: trackData.artist
        }, (result) => {
            const artistName = JSON.parse(result);

            document.querySelector("#current-song-author").textContent = `by ${artistName.name}`;
        })

        $.post("./includes/handlers/ajax/getAlbumJson.php", {
            albumId: trackData.album
        }, (result) => {
            const albumData = JSON.parse(result);

            document.querySelector("#current-song-img").src = albumData.artworkPath;
        })

    })
</script>

<div id="footer-player-container">

    <div id="current-song-container">

        <span id="current-song-link">
            <img id="current-song-img" alt="Link to song">
        </span>
        <div id="current-song-info">
            <span id="current-song-name"></span>
            <br>
            <span id="current-song-author"></span>
        </div>

    </div>

    <div id="player-control-container">
        <div id="player-controls">
            <img id="player-shuffle" src="./assets/img/player_shuffle.svg" onclick="isShuffleOn(audioElement, true, this)" alt="shuffle" title="Shuffle playlist">
            <img id="player-left" src="./assets/img/player_left2.svg" onclick="previousOrNextSong(audioElement, false)" alt="previous" title="Previous song">
            <img id="player-play" class="player-play-pause" src="./assets/img/player_play2.svg" onclick="doPlayAudio(audioElement, true)" alt="Play" title="Play">
            <img id="player-pause" class="player-play-pause" src="./assets/img/player_pause.svg" onclick="doPlayAudio(audioElement, false)" alt="Pause" title="Pause" style="display: none;">
            <img id="player-right" src="./assets/img/player_right2.svg" onclick="previousOrNextSong(audioElement, true)" alt="next" title="Next song">
            <img id="player-repeat" src="./assets/img/player_repeat.svg" onclick="isRepeatOn(audioElement, true, this)" alt="repeat" title="Repeat on/off">
        </div>

        <div id="player-progress">
            <span id="current-time">00:00</span>
            <div id="progress-bar">
                <div id="progress-bar-bg">
                    <div id="progress">

                    </div>
                </div>
            </div>
            <span id="current-time-left"></span>
        </div>
    </div>

    <div id="volume-control-container">
        <span id="volume-control-btn">
            <img class="volume-control-button-img" id="volume-100" onclick="muteToggleVolume(true)" src="./assets/img/player_volume100.svg" alt="Volume 100%">
            <img class="volume-control-button-img" id="volume-50" onclick="muteToggleVolume(true)" src="./assets/img/player_volume50.svg" alt="Volume 50%" style="display: none;">
            <img class="volume-control-button-img" id="volume-0" onclick="muteToggleVolume(false)" src="./assets/img/player_volume0.svg" alt="Volume 0%" style="display: none;">
        </span>
        <div id="volume-control-bar">
            <div id="volume-control-bar-bg">
                <div id="volume-control-bar-progress">

                </div>
            </div>
        </div>
    </div>

</div>