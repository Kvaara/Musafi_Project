<?php

// HTTP_X_REQUESTED_WITH means that the request was made by ajax. Ajax requests include that.
if (isset($_SERVER["HTTP_X_REQUESTED_WITH"])) {
    include("./includes/config.php");
    include("./includes/classes/Artist.php");
    include("./includes/classes/Album.php");
    include("./includes/classes/Song.php");
    $userSignedIn = $_SESSION["userSignedIn"];
    // print_r("CAME FROM AJAX SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS");
} else {
    // This means that the request was made by the user entering the url and pressing enter (Loading the page first)
    include("./includes/html/main-nav-bar.php");
}
