<?php
include("includes/config.php");

include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");

//session_destroy(); SIGN OUT

if (isset($_SESSION["userSignedIn"])) {
    $userSignedIn = $_SESSION["userSignedIn"];
} else {
    header("Location: login-signup.php");
}

if (isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);

$albumTitle = $album->getTitle();
$albumArtWorkPath = $album->getArtworkPath();
$artist = $album->getArtist();
$artistName = $artist->getName();

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
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./assets/js/album-page.script.js"></script>
</head>

<body>

    <div id="flex-wrapper">

        <div id="application-section-container">

            <?php include("./includes/index-html/nav-bar.php") ?>


            <div id="application-page">
                <header id="application-page-header">
                    <h1 id="header-album-title">
                        <?php echo $albumTitle ?>
                        <span id="header-album-artist"> by <?php echo $artistName ?>, 2021</span>
                    </h1>
                </header>

                <section id="application-page-section">

                    <!-- BELOW IS THE SECTION FOR THE MODAL CONTAINERS -->

                    <!-- <div class="add-to-existing-playlist-container">
                        <div id="add-to-existing-header">
                            <h1 class="add-to-playlist-header" id="first-step-title">
                                What songs do you want?
                            </h1>
                            <h1 class="add-to-playlist-header" id="second-step-title">
                                To a new or existing playlist?
                            </h1>
                            <h1 class="add-to-playlist-header" id="to-new-playlist-title">
                                What's a good name?
                            </h1>
                            <h1 class="add-to-playlist-header" id="to-existing-playlist-title">
                                Where do you want to add?
                            </h1>
                        </div>

                        <div id="button-options-container">
                            <button id="add-to-new-btn" class="button-options-btn">
                                NEW
                            </button>

                            <button id="choose-songs-btn" class="button-options-btn">
                                Select songs
                            </button>
                            <div id="choose-songs-list-container">
                                <ul id="choose-songs-list">
                                    <label><input type="checkbox">Breaking Nuts</label>
                                    <label><input type="checkbox">Holy Fire</label>
                                    <label><input type="checkbox">Kakarot</label>
                                    <label><input type="checkbox">FireSmooth</label>
                                    <label><input type="checkbox">Playing Kinderellaasdasdsadasdasdasd</label>
                                    <label><input type="checkbox">Playing Kinderellaasdasdsadasdasdasd</label>
                                    <label><input type="checkbox">Playing Kinderellaasdasdsadasdasdasd</label>
                                    <label><input type="checkbox">Playing Kinderellaasdasdsadasdasdasd</label>
                                    <label><input type="checkbox">Playing Kinderellaasdasdsadasdasdasd</label>
                                </ul>
                                <div id="choose-songs-buttons">
                                    <button id="choose-songs-add">
                                        ADD
                                    </button>
                                    <button id="choose-songs-add-all">
                                        CHECK ALL
                                    </button>
                                </div>
                            </div>

                            <button id="add-to-existing-btn" class="button-options-btn">
                                EXISTING
                            </button>
                        </div>

                        <div id="to-existing-playlists-container">
                            <ul id="existing-playlists-list">
                                <li>
                                    Album 1
                                    <div class="existing-playlists-info-popup">
                                        <span>The Order</span>
                                        <span>By Niklas Puganen</span>
                                        <span>18 songs</span>
                                        <button class="existing-playlists-info-popup-btn" type="button">ADD</button>
                                    </div>
                                </li>

                                <li>
                                    The order
                                    <div class="existing-playlists-info-popup">
                                        <span>The Order</span>
                                        <span>By Niklas Puganen</span>
                                        <span>18 songs</span>
                                        <button class="existing-playlists-info-popup-btn" type="button">ADD</button>
                                    </div>
                                </li>


                                <li>Justified At
                                    <div class="existing-playlists-info-popup">
                                        <span>The Order</span>
                                        <span>By Niklas Puganen</span>
                                        <span>18 songs</span>
                                        <button class="existing-playlists-info-popup-btn" type="button">ADD</button>
                                    </div>
                                </li>

                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                                <li>Bloom Sight</li>
                            </ul>

                        </div>

                        <div id="to-new-playlist-container">
                            <label for="playlist-name">Playlist name</label>
                            <input type="text" name="playlist-name" id="to-new-playlist-input" placeholder="e.g Album 1337" maxlength="30">
                            <button id="add-to-new-playlist-btn" type="button">CREATE</button>
                        </div>
                    </div> -->


                    <div id="album-to-playlist-modal-container">

                        <div id="album-to-playlist-action-container">
                            <button>Select songs</button>
                            <button style="display: none;"></button>
                            <button style="display: none;"></button>
                        </div>

                        <div id="album-to-playlist-content">
                            <!-- <label><input type="checkbox" id="add-all-checkbox">ADD ALL</label> -->
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

                            <div id="album-to-new-success-content">
                                <span id="album-to-new-result">Album created and songs added!</span>
                                <a id="album-just-created-name">To albumname&#10142;</a>
                            </div>

                            <div id="album-to-existing-content">

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
                                        <!-- <input type="text" maxlength="30" placeholder="Playlist name">
                                        <img src="./assets/img/album_add_to_playlist_submit.svg" alt="Submit" title="Create playlist with album"> -->
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
            </div>

        </div>


        <?php include("./includes/index-html/footer-player.php") ?>


    </div>


</body>

<script src="./assets/js/index.script.js"></script>
<script src="./assets/js/album-play-buttons.script.js"></script>
<script src="./assets/js/footer-player.script.js"></script>
<script src="./assets/js/add-album-to-playlist.script.js"></script>

<script>
    const albumPlayAllContainer = document.querySelector("#album-play-all-container");
    albumPlayAllContainer.addEventListener("click", () => {
        addAlbumToQueue(audioElement, <?php echo $albumId ?>)
    })
</script>

<script>
    // const songsToNewPlaylistModal = document.querySelector("#add-to-new-modal-container");
    // const albumAddToPlaylistModal = document.querySelector(".add-to-existing-playlist-container");
    const albumAddToPlaylistModal = document.querySelector("#album-to-playlist-modal-container");

    const toPlaylistButtonContainer = document.querySelector(
        "#add-to-playlist-button-container"
    );
    // albumAddToPlaylistModal
    // const addToNewOrOldPlaylistContainer = document.querySelector("#add-to-playlist-input-container");

    toPlaylistButtonContainer.addEventListener("click", (event) => {
        // addToNewOrOldPlaylistContainer.classList.add("visible");
        albumAddToPlaylistModal.style.display = "flex";
    });

    document.addEventListener("mouseup", (event) => {
        // if (!event.target.closest(".add-to-existing-playlist-container")) {
        //     addToNewOrOldPlaylistContainer.classList.remove("visible");
        // }
        if (!event.target.closest("#album-to-playlist-modal-container")) {
            albumAddToPlaylistModal.style.display = "none";
        }
    })

    const songsToNewPlaylistBtn = document.querySelector("#to-new-playlist-btn");


    songsToNewPlaylistBtn.addEventListener("click", () => {
        // songsToNewPlaylistModal.classList.add("visible");
        // songsToNewPlaylistModal.children[1].focus();
        // addToNewOrOldPlaylistContainer.classList.remove("visible");
        // albumAddToPlaylistModal.style.display = "flex";
    })
</script>

<script>
    const currentSongImage = document.querySelector("#current-song-img");
    const currentSongInfo = document.querySelector("#current-song-info");
    const playerControlContainer = document.querySelector("#player-control-container");


    const albumButtonsArray = makeAlbumPlayPauseButtonsArray();

    const albumSongTitles = <?php echo $songsTitleArrayJson ?>;
    const albumSongPaths = <?php echo $songsPathArrayJson ?>;

    const resetButtonStates = (pauseButtonsArray = albumButtonsArray.pauseButtons, playButtonsArray = albumButtonsArray.playButtons) => {
        pauseButtonsArray.forEach((pauseButton) => {
            pauseButton.style.display = "none";
        })

        playButtonsArray.forEach((playButton) => {
            playButton.style.display = "inline";
        })
    }

    const updateButtonStates = (currentTrack, isPlayPressed) => {
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
</script>

</html>