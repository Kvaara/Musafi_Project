<?php
include("../../config.php");

if (isset($_POST["albumId"])) {
    $albumId = $_POST["albumId"];
    $query = mysqli_prepare($con, "SELECT * FROM songs WHERE album = ? ORDER BY RAND()");
    mysqli_stmt_bind_param($query, "i", $albumId);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    $albumRandomized = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($albumRandomized, $row);
    }


    echo json_encode($albumRandomized);
}
