<?php

include("./includes/includedNavbar.php");

if (isset($_GET['id'])) {
    $albumId = $_GET['id'];

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
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);

$albumTitle = $album->getTitle();
$albumArtWorkPath = $album->getArtworkPath();
$artist = $album->getArtist();
$artistName = $artist->getName();

?>

<header id="application-page-header">
    <h1 id="header-album-title">
        <?php echo $albumTitle ?>
        <span id="header-album-artist"> by <?php echo $artistName ?>, 2021</span>
    </h1>
</header>

<section id="application-page-section">

    <!-- BELOW IS THE SECTION FOR THE MODAL CONTAINERS -->
    <div id="album-to-playlist-modal-container">

        <div id="album-to-playlist-header">
            <h1>
                Select songs
            </h1>
        </div>

        <div id="album-to-playlist-content">
            <ul id="album-select-songs-list">
                <label><input type="checkbox">Doom</label>
                <label><input type="checkbox">Slayer</label>
                <label><input type="checkbox">Pager</label>
                <label><input type="checkbox">Naked Eye</label>
                <label><input type="checkbox">Eyeshit</label>
                <label><input type="checkbox">Eyeshit</label>
                <label><input type="checkbox">Eyeshit</label>
            </ul>

            <div id="album-select-all-container">
                <input id="album-select-all-input" type="checkbox">
                <label for="album-select-all-input">Select all</label>
            </div>

            <div id="album-new-or-existing">
                <button id="album-to-new">New</button>
                <button id="album-to-existing">Existing</button>
            </div>

            <div id="album-to-new-content">
                <span id="album-to-new-error-msg"></span>
                <input id="album-to-new-input" type="text" placeholder="e.g Album 1337">
            </div>

            <div class="album-success-content">
                <span id="album-to-new-result">Album created and songs added!</span>
                <a id="album-just-created-name" class="span-link">To albumname&#10142;</a>
            </div>

            <div id="album-to-existing-content">
                <div>
                    <div class="album-existing-hover-info">
                        <span>Songs 13</span>
                    </div>
                    <span class="album-existing-name"> The Album 13</span>
                </div>
                <div>
                    <div class="album-existing-hover-info">
                        <span>Songs 5</span>
                    </div>
                    <span class="album-existing-name">The order of songs</span>
                </div>
                <div>
                    <div class="album-existing-hover-info">
                        <span>Songs 20</span>
                    </div>
                    <span class="album-existing-name">Scamaz</span>
                </div>
                <div>
                    <div class="album-existing-hover-info">
                        <span>Songs 3</span>
                    </div>
                    <span class="album-existing-name">Tester</span>
                </div>
                <div>
                    <div class="album-existing-hover-info">
                        <span>Songs 9</span>
                    </div>
                    <span class="album-existing-name">Tester</span>
                </div>
                <div>
                    <div class="album-existing-hover-info">
                        <span>Songs 2</span>
                    </div>
                    <span class="album-existing-name">Tester</span>
                </div>
                <div>
                    <div class="album-existing-hover-info">
                        <span>Songs 200</span>
                    </div>
                    <span class="album-existing-name">Tester</span>
                </div>
                <div>
                    <div class="album-existing-hover-info">
                        <span>Songs 100</span>
                    </div>
                    <span class="album-existing-name">Tester</span>
                </div>
                <div>
                    <div class="album-existing-hover-info">
                        <span>Songs 1000</span>
                    </div>
                    <span class="album-existing-name">Tester</span>
                </div>


            </div>

            <div class="album-success-content">
                <span id="album-to-new-result">Songs added to the playlist!</span>
                <a id="album-just-created-name" class="span-link">To albumname&#10142;</a>
            </div>

        </div>

        <div class="progress-bar-container" id="album-to-playlist-progressbar-container">

            <div class="progress-bar progress-bar-0" id="album-to-playlist-progressbar">

            </div>

        </div>

        <div id="next-or-previous-container">
            <button id="previous-button">Previous</button>
            <button id="next-button">Next</button>
        </div>

    </div>
    <!-- END OF MODAL CONTAINER SECTION -->




    <div id="application-page-album">
        <img id="album-artwork" src="<?php echo $album->getArtworkPath(); ?>" alt="Album image">
        <div id="album-songs-wrapper">
            <div id="album-info">
                <span id="album-songs-count"> <?php echo $album->getNumberOfSongs(); ?></span>
                <div class="album-info-container" id="album-play-all-container">
                    <img class="album-info-image" src="./assets/img/album_add_to_queue.svg" alt="To queue" title="Add album to playlist">
                    <span class="album-info-text">Play all</span>
                </div>
                <span class="album-info-container-split-line">&#10072;</span>
                <div class="album-info-container" id="album-to-playlist-container">
                    <div id="add-to-playlist-button-container">
                        <img class="album-info-image" src="./assets/img/album_add_to_playlist.svg" alt="To playlist" title="Add album to playlist">
                        <span class="album-info-text">To playlist</span>
                    </div>
                    <div id="add-to-playlist-input-container">
                        <button id="to-new-playlist-btn" class="to-new-or-existing-btn" type="button">NEW</button>
                        &#8212;
                        <button id="to-old-playlist-btn" class="to-new-or-existing-btn" type="button">OLD</button>
                    </div>
                </div>
                <span class="album-info-container-split-line">&#10072;</span>
                <div class="album-info-container" id="album-favorite-container">
                    <img class="album-info-image" src="./assets/img/album_add_to_favorites.svg" alt="To favorite" title="Add album to playlist">
                    <span class="album-info-text">Favourite</span>
                </div>
                <span class="album-info-container-split-line">&#10072;</span>
                <div class="album-info-container" id="album-share-container">
                    <img class="album-info-image" src="./assets/img/album_share.svg" alt="To share" title="Add album to playlist">
                    <span class="album-info-text">Share</span>
                </div>
            </div>
            <div id="album-songs-list-container">

                <?php
                $songIdArray = $album->getSongIds();

                foreach ($songIdArray as $songId) {

                    $albumSong = new Song($con, $songId);

                    echo "<div class='album-song'>
                                <img class='album-song-play' src='./assets/img/album_song_play.svg' alt='Play'>
                                <img id='album-song-pause-button' class='album-song-play' src='./assets/img/album_song_pause.svg' alt='Pause' style='display: none;'>
                                <div class='album-song-lineup'></div>
                                <span class='album-song-number'>{$albumSong->getOrderInAlbum()}</span>
                                <div class='album-song-lineup'></div>
                                <div class='album-song-info'>
                                    <span class='album-song-name'>{$albumSong->getTitle()}</span>
                                    <span class='album-song-duration'>{$albumSong->getDuration()}</span>
                                </div>
                            </div>
                            ";
                }
                ?>
            </div>

            <div id="album-tags-container">
                <h2 id="album-tags-text">TAGS:</h2>
                <div id="album-tags-list-container">
                    <?php
                    $albumGenres = $album->getAlbumGenres();
                    foreach ($albumGenres as $genre) {
                        echo "<span>{$genre}</span>";
                    }
                    ?>
                </div>
                <div id="expand-list-btn-container" onclick="expandAlbumList()">
                    <span>EXPAND LIST</span>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="./assets/js/album-play-buttons.script.js"></script>
<script src="./assets/js/add-album-to-playlist.script.js"></script>

<script>
    var albumPlayAllContainer = document.querySelector("#album-play-all-container");
    albumPlayAllContainer.addEventListener("click", () => {
        addAlbumToQueue(audioElement, <?php echo $albumId ?>)
    })

    var albumAddToPlaylistModal = document.querySelector("#album-to-playlist-modal-container");

    var toPlaylistButtonContainer = document.querySelector(
        "#add-to-playlist-button-container"
    );

    toPlaylistButtonContainer.addEventListener("click", (event) => {
        albumAddToPlaylistModal.style.display = "flex";
    });

    document.addEventListener("mouseup", (event) => {
        if (!event.target.closest("#album-to-playlist-modal-container")) {
            albumAddToPlaylistModal.style.display = "none";
        }
    })

    var songsToNewPlaylistBtn = document.querySelector("#to-new-playlist-btn");

    var currentSongImage = document.querySelector("#current-song-img");
    var currentSongInfo = document.querySelector("#current-song-info");
    var playerControlContainer = document.querySelector("#player-control-container");


    var albumButtonsArray = makeAlbumPlayPauseButtonsArray();

    var albumSongTitles = <?php echo $songsTitleArrayJson ?>;
    var albumSongPaths = <?php echo $songsPathArrayJson ?>;

    var resetButtonStates = (pauseButtonsArray = albumButtonsArray.pauseButtons, playButtonsArray = albumButtonsArray.playButtons) => {
        pauseButtonsArray.forEach((pauseButton) => {
            pauseButton.style.display = "none";
        })

        playButtonsArray.forEach((playButton) => {
            playButton.style.display = "inline";
        })
    }

    var updateButtonStates = (currentTrack, isPlayPressed) => {
        const trackAlbumId = currentTrack.album;
        const orderInAlbum = currentTrack.albumOrder;
        const pageAlbumId = <?php echo $_GET["id"] ?>;

        if (trackAlbumId === pageAlbumId && isPlayPressed) {
            albumButtonsArray.playButtons[orderInAlbum - 1].style.display = "none";
            albumButtonsArray.pauseButtons[orderInAlbum - 1].style.display = "inline";
            albumButtonsArray.pauseButtons[orderInAlbum - 1].style.visibility = "visible";
        } else if (trackAlbumId === pageAlbumId && !isPlayPressed) {
            albumButtonsArray.pauseButtons[orderInAlbum - 1].style.display = "none";
            albumButtonsArray.playButtons[orderInAlbum - 1].style.display = "inline";
        }
    }

    albumButtonsArray.playButtons.forEach((playButton, index) => {
        playButton.addEventListener("click", () => {
            resetButtonStates(albumButtonsArray.pauseButtons, albumButtonsArray.playButtons);

            setNewTrack(audioElement, index + 1, <?php echo $albumId ?>, () => {
                doPlayAudio(audioElement, true);
                updateFooterPlayerTrackInfo(audioElement);
                buildQueueList(audioElement)
            })

            playButton.style.display = "none";
            albumButtonsArray.pauseButtons[index].style.display = "inline";
            albumButtonsArray.pauseButtons[index].style.visibility = "visible";
        })
    })

    albumButtonsArray.pauseButtons.forEach((pauseButton, index) => {
        pauseButton.addEventListener("click", () => {
            doPlayAudio(audioElement, false);
            pauseButton.style.display = "none";
            albumButtonsArray.playButtons[index].style.display = "inline";
        })
    })

    // Checks at the start if a song is playing and updates the buttons
    // Useful because the application is a SPA and the button states reset automatically when the content page loads again.
    try {
        if (!audioElement.paused && audioElement.currentTrack.album === <?php echo $albumId ?>) {
            albumButtonsArray.playButtons[audioElement.currentTrack.albumOrder - 1].style.display = "none";
            albumButtonsArray.pauseButtons[audioElement.currentTrack.albumOrder - 1].style.display = "inline";
            albumButtonsArray.pauseButtons[audioElement.currentTrack.albumOrder - 1].style.visibility = "visible";
        }
    } catch (e) {
        // Catches an error if the audioElement is not defined 
        // (Which it isn't at the start if user navigates to an album page by typing in the url and pressing enter)
    }
</script>

<?php include("./includes/includedFooterPlayer.php") ?>