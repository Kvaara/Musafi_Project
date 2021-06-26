<?php
include("../../config.php");

if (isset($_POST["albumId"])) {
    $albumId = $_POST["albumId"];

    $query = mysqli_prepare($con, "SELECT * FROM songs WHERE album = ?");
    mysqli_stmt_bind_param($query, "i", $albumId);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    $songs = [];

    while ($row = mysqli_fetch_array($result)) {
        array_push($songs, $row);
    }

    $songsJson = json_encode($songs);

    echo $songsJson;
}
