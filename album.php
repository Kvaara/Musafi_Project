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

                    <div id="application-page-album">
                        <img id="album-artwork" src="<?php echo $album->getArtworkPath(); ?>" alt="Album image">
                        <div id="album-songs-wrapper">
                            <div id="album-info">
                                <span id="album-songs-count"> <?php echo $album->getNumberOfSongs(); ?></span>
                                <div class="album-info-container" id="album-play-all-container" onclick="addAlbumToQueue(audioElement, <?php echo $albumId ?>)">
                                    <img class="album-info-image" src="./assets/img/album_add_to_queue.svg" alt="To queue" title="Add album to playlist">
                                    <span class="album-info-text">Play all</span>
                                </div>
                                <div class="album-info-container" id="album-to-playlist-container">
                                    <img class="album-info-image" src="./assets/img/album_add_to_playlist.svg" alt="To playlist" title="Add album to playlist">
                                    <span class="album-info-text">To playlist</span>
                                </div>
                                <div class="album-info-container" id="album-favorite-container">
                                    <img class="album-info-image" src="./assets/img/album_add_to_favorites.svg" alt="To favorite" title="Add album to playlist">
                                    <span class="album-info-text">Favourite</span>
                                </div>
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
                                <img class='album-song-play' src='./assets/img/album_song_pause.svg' alt='Pause' style='display: none;'>
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

            const isSongTheSame = audioElement.src.includes(albumSongPaths[index].slice(1));
            if (!isSongTheSame) {
                audioElement.src = albumSongPaths[index];
            }

            setNewTrack(audioElement, index + 1, () => {
                doPlayAudio(audioElement, true);
                updateFooterPlayerTrackInfo(audioElement);

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