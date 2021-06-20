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
                <?php include("./includes/index-html/nav-bar.php") ?>
            </div>


            <div id="application-page">
                <header id="application-page-header">
                    <h1> Welcome, <?php echo $userSignedIn ?>!</h1>
                </header>

                <section id="application-page-section">
                    <?php
                    $albumsQuery = mysqli_query($con, "SELECT * FROM albums");
                    while ($row = mysqli_fetch_assoc($albumsQuery)) {
                        echo "<div id='application-page-albums'>
                            <div id='{$row['id']}' class='albums'>
                            <img class='album-img' src={$row['artworkPath']} alt='album img'>
                            <span class='album-info'>{$row['title']}</span>
                            </div>
                            </div";
                    }
                    ?>
                </section>
            </div>

        </div>

        <div id="footer-player-container">

            <?php include("./includes/index-html/footer-player.php") ?>

        </div>

    </div>


</body>

<script src="./assets/js/index.script.js"></script>

</html>