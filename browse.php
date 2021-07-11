<?php include("./includes/includedNavbar.php") ?>

<header id="application-page-header" class="browse-header">
    <input id="browse-search-input">
    <h1>Filter by album</h1>
    <button id="toggle-show-content">Show artists</button>
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

    <div id="application-page-artists">
        <?php
        $artistsQuery = mysqli_query($con, "SELECT * FROM artists");
        while ($row = mysqli_fetch_assoc($artistsQuery)) {
            echo "<div id='application-page-artists' style='display: none;'>
                            <span onclick='openPage(\"album.php?id=" . $row['id'] . "\")' role='link' tabindex='0' class='span-link'>
                            <div id='{$row['id']}' class='artists'>
                            <img class='artist-img' src='./assets/img/profile-pics/frog_pic.png ' alt='artist img'>
                            <span class='artist-info'>{$row['name']}</span>
                            </div>
                            </span>
                            </div";
        }
        ?>
    </div>

</section>

</div>

<script>
    var browseInput = document.querySelector("#browse-search-input");
    var everyAlbum = [...document.querySelector("#application-page-albums").children];
    var everyArtist = [...document.querySelector("#application-page-artists").children];
    var browseHeader = document.querySelector(".browse-header");
    var browseHeaderH1 = browseHeader.querySelector("h1");
    var toggleShowContent = document.querySelector("#toggle-show-content");

    browseInput.addEventListener("keyup", (event) => {
        var browseInputValue = event.target.value;
        if (!toggleShowContent.classList.contains("show-artists")) {
            var filteredAlbums = everyAlbum.filter((album) => album.querySelector(".album-info").textContent.toLowerCase().includes(browseInputValue.toLowerCase()));

            document.querySelector("#application-page-albums").textContent = "";
            filteredAlbums.forEach((album, index) => {
                document.querySelector("#application-page-albums").appendChild(album);
            })
        } else {
            var filteredArtists = everyArtist.filter((artist) => artist.querySelector(".artist-info").textContent.toLowerCase().includes(browseInputValue.toLowerCase()));
            document.querySelector("#application-page-artists").textContent = "";
            filteredArtists.forEach((artist, index) => {
                document.querySelector("#application-page-artists").appendChild(artist);
            })
        }

        // if (browseInputValue.length > 0) {
        //     browseHeader.querySelector("h1").classList.add("active");
        // }
        browseInputValue.length > 0 ? browseHeaderH1.classList.add("active") : browseHeaderH1.classList.remove("active");
    })

    browseInput.addEventListener("mouseover", (event) => {
        if (!toggleShowContent.classList.contains("show-artists")) {
            event.target.placeholder = "Search by artist name...";
        } else {
            event.target.placeholder = "Search by album name...";
        }
    })

    browseInput.addEventListener("mouseout", () => {
        event.target.placeholder = "";
    })

    browseInput.addEventListener("focus", () => {
        if (!toggleShowContent.classList.contains("show-artists")) {
            event.target.placeholder = "Search by artist name...";
        } else {
            event.target.placeholder = "Search by album name...";
        }
    })

    browseInput.addEventListener("blur", () => {
        event.target.placeholder = "";
    })

    toggleShowContent.addEventListener("click", () => {
        if (!toggleShowContent.classList.contains("show-artists")) {
            toggleShowContent.classList.add("show-artists");
            document.querySelector("#application-page-albums").style.display = "none";
            document.querySelector("#application-page-artists").style.display = "grid";
            toggleShowContent.textContent = "Show albums";
            browseHeaderH1.textContent = "Filter by artist"
        } else {
            toggleShowContent.classList.remove("show-artists");
            document.querySelector("#application-page-artists").style.display = "none";
            document.querySelector("#application-page-albums").style.display = "grid";
            toggleShowContent.textContent = "Show artists";
            browseHeaderH1.textContent = "Filter by album";
        }
    })
</script>

<?php include("./includes/includedFooterPlayer.php") ?>