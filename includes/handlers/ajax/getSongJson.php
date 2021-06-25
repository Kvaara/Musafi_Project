<?php
include("../../config.php");

if (isset($_POST["trackId"])) {
    $trackId = $_POST["trackId"];
    $albumId = $_POST["albumId"];

    $query = mysqli_prepare($con, "SELECT * FROM songs WHERE albumOrder = ? AND album = ?");
    mysqli_stmt_bind_param($query, "ii", $trackId, $albumId);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $data = mysqli_fetch_assoc($result);

    $dataJson = json_encode($data);

    echo $dataJson;
}
