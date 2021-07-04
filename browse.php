<?php include("./includes/includedNavbar.php") ?>

<header id="application-page-header" class="browse-header">
    <h1>Browse the finest tunes:</h1>
    <input placeholder="Search by album name" id="browse-search-input">
</header>

<section id="application-page-section">
    <?php
    $albumsQuery = mysqli_query($con, "SELECT * FROM albums");
    while ($row = mysqli_fetch_assoc($albumsQuery)) {
        echo "<div id='application-page-albums'>
                            <span onclick='openPage(\"album.php?id=" . $row['id'] . "\")' role='link' tabindex='0' class='span-link'>
                            <div id='{$row['id']}' class='albums'>
                            <img class='album-img' src={$row['artworkPath']} alt='album img'>
                            <span class='album-info'>{$row['title']}</span>
                            </div>
                            </span>
                            </div";
    }
    ?>
</section>

</div>

<script>
    var browseInput = document.querySelector("#browse-search-input");
    browseInput.focus();
    var everyAlbum = [...document.querySelector("#application-page-albums").children];

    browseInput.addEventListener("keyup", (event) => {
        var browseInputValue = event.target.value;
        var filteredAlbums = everyAlbum.filter((album) => album.querySelector(".album-info").textContent.toLowerCase().includes(browseInputValue.toLowerCase()));

        document.querySelector("#application-page-albums").textContent = "";
        filteredAlbums.forEach((album, index) => {
            document.querySelector("#application-page-albums").appendChild(album);
        })
    })
</script>

<?php include("./includes/includedFooterPlayer.php") ?>