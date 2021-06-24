<?php
include("../../config.php");

if (isset($_POST["artistId"])) {
    $artistId = $_POST["artistId"];

    $query = mysqli_prepare($con, "SELECT name FROM artists WHERE id = ?");
    mysqli_stmt_bind_param($query, "i", $artistId);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $data = mysqli_fetch_assoc($result);

    $dataJson = json_encode($data);

    echo $dataJson;
}
