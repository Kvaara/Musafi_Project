<?php

// HTTP_X_REQUESTED_WITH means that the request was made by ajax. Ajax requests include that.
if (isset($_SERVER["HTTP_X_REQUESTED_WITH"])) {
    // print_r("CAME FROM AJAX SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS");
} else {
    include("./includes/html/main-footer-player.php");

    $url = $_SERVER["REQUEST_URI"];
    echo "<script>openPage('{$url}')</script>";
    exit();
}
