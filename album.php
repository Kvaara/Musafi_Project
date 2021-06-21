<?php
include("includes/config.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");

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
                    </div>
                </section>
            </div>

        </div>


        <?php include("./includes/index-html/footer-player.php") ?>


    </div>


</body>

<script src="./assets/js/index.script.js"></script>

</html>