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
</head>

<body>

    <div id="flex-wrapper">

        <div id="application-section-container">

            <?php include("./includes/index-html/nav-bar.php") ?>


            <div id="application-page">
                <header id="application-page-header">
                    <h1 id="header-album-title">
                        <?php echo $albumTitle ?>
                        <span id="header-album-artist"> by <?php echo $artistName ?></span>
                    </h1>
                </header>

                <section id="application-page-section">

                    <div id="application-page-album">
                        <img id="album-artwork" src="<?php echo $album->getArtworkPath(); ?>" alt="Album image">
                        <div id="album-songs-wrapper">
                            <span id="album-songs-count"> <?php echo $album->getNumberOfSongs(); ?></span>
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
                        </div>
                    </div>
                </section>
            </div>

        </div>


        <?php include("./includes/index-html/footer-player.php") ?>


    </div>


</body>

<script src="./assets/js/index.script.js"></script>
<script src="./assets/js/play-pause.script.js"></script>

<script>
    const currentSongImage = document.querySelector("#current-song-img");
    const currentSongInfo = document.querySelector("#current-song-info");
    const playerControlContainer = document.querySelector("#player-control-container");


    const albumButtonsArray = makeAlbumPlayPauseButtonsArray();

    const albumSongTitles = <?php echo $songsTitleArrayJson ?>;
    const albumSongPaths = <?php echo $songsPathArrayJson ?>;

    const resetButtonStates = (pauseButtonsArray, playButtonsArray) => {
        pauseButtonsArray.forEach((pauseButton) => {
            pauseButton.style.display = "none";
        })

        playButtonsArray.forEach((playButton) => {
            playButton.style.display = "inline";
        })
    }

    albumButtonsArray.playButtons.forEach((playButton, index) => {
        playButton.addEventListener("click", () => {
            resetButtonStates(albumButtonsArray.pauseButtons, albumButtonsArray.playButtons);

            currentSongImage.src = "<?php echo $albumArtWorkPath ?>";
            currentSongInfo.firstElementChild.textContent = albumSongTitles[index];
            currentSongInfo.lastElementChild.textContent = "<?php echo $artistName ?>";
            audioElement.src = albumSongPaths[index];
            audioElement.play();

            playButton.style.display = "none";
            albumButtonsArray.pauseButtons[index].style.display = "inline";
            albumButtonsArray.pauseButtons[index].style.visibility = "visible";

            playerPlayButton.style.display = "none";
            playerPauseButton.style.display = "inline";
        })
    })

    albumButtonsArray.pauseButtons.forEach((pauseButton, index) => {
        pauseButton.addEventListener("click", () => {
            audioElement.pause();
            pauseButton.style.display = "none";
            albumButtonsArray.playButtons[index].style.display = "inline";
        })
    })
</script>

</html>