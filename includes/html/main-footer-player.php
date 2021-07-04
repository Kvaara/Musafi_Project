<script src="./assets/js/footer-player.script.js"></script>

<script>
    let audioElement;

    document.addEventListener("DOMContentLoaded", () => {
        audioElement = new Audio();
        audioElement.volume = 0.1;
        // audioElement.currentPlaylist = currentPlaylist;
        // setTrack(currentPlaylist[0], currentPlaylist, false);
        updateVolumeIcon(10, true);
        updateCurrentTimeLeft(audioElement);
        updateCurrentTimeAndProgressBar(audioElement);
        userProgressBarControl(audioElement);
        userVolumeBarControl(audioElement);
        onAudioEnd(audioElement);


        // TODO do this later
        // TODO this checks from the cache or memory if the user has had a previous queue if they have then do this
        // if (audioElement.currentPlaylist.length > 0) {

        // }
    })



    // const setTrack = (trackId, newPlaylist, play) => {
    //     audioElement.src = "./assets/songs/Niklas_Puganen/puganen-somesht.mp3";
    //     if (play) {
    //         audioElement.play();
    //     } else {
    //         audioElement.pause();
    //     }
    // }

    // $.post("./includes/handlers/ajax/getSongJson.php", {
    //     trackId: 1,
    //     albumId:
    // }, (result) => {
    //     const trackData = JSON.parse(result);


    //     audioElement.src = trackData.path;
    //     audioElement.currentTrack = trackData;

    //     updateCurrentTimeLeft(audioElement);
    //     updateCurrentTimeAndProgressBar(audioElement);

    //     document.querySelector("#current-song-name").textContent = trackData.title;

    //     $.post("./includes/handlers/ajax/getArtistJson.php", {
    //         artistId: trackData.artist
    //     }, (result) => {
    //         const artistName = JSON.parse(result);

    //         document.querySelector("#current-song-author").textContent = `by ${artistName.name}`;
    //     })

    //     $.post("./includes/handlers/ajax/getAlbumJson.php", {
    //         albumId: trackData.album
    //     }, (result) => {
    //         const albumData = JSON.parse(result);

    //         document.querySelector("#current-song-img").src = albumData.artworkPath;
    //     })

    // })
</script>

</div>

</div>
<!-- </div> -->

<div id="footer-player-container">


    <div id="current-song-container">
        <div id="show-queue-container">
            <span id="songs-in-queue-span">Queue is empty</span>
            <ul id="queue-ul-list">
                <li style="margin: auto;">It's quiet in here . . . &#9738;</li>
                <li id="queue-list-column-names" style="display: none;">
                    <span>&#8470;</span>
                    <span>Title</span>
                    <span>Duration</span>
                </li>
            </ul>
        </div>
        <span id="current-song-link">
            <img src="./assets/img/queue_is_empty.svg" id="current-song-img" alt="Link to song">
        </span>
        <div id="current-song-info">
            <span id="current-song-name">NOTHING IN QUEUE</span>
            <br>
            <span id="current-song-author">select a song from an album</span>
        </div>

    </div>

    <div id="player-control-container">
        <div id="player-controls">
            <img id="player-shuffle" src="./assets/img/player_shuffle.svg" onclick="audioElement.currentTrack ? (audioElement, true, this) : '' " alt="shuffle" title="Shuffle playlist">
            <img id="player-left" src="./assets/img/player_left2.svg" onclick="audioElement.currentTrack ? previousOrNextSong(audioElement, false) : '' " alt="previous" title="Last song">
            <img id="player-play" class="player-play-pause" src="./assets/img/player_play2.svg" onclick="audioElement.currentTrack ? doPlayAudio(audioElement, true) : '' " alt="Play" title="Play">
            <img id="player-pause" class="player-play-pause" src="./assets/img/player_pause.svg" onclick="doPlayAudio(audioElement, false)" alt="Pause" title="Pause" style="display: none;">
            <img id="player-right" src="./assets/img/player_right2.svg" onclick="audioElement.currentTrack ? previousOrNextSong(audioElement, true) : '' " alt="next" title="Next song">
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

</div>


</body>

<script src="./assets/js/index.script.js"></script>

</html>