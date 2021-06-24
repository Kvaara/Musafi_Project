<?php
include("../../config.php");

if (isset($_POST["trackId"])) {
    $trackId = $_POST["trackId"];

    $query = mysqli_prepare($con, "UPDATE songs SET plays = plays + 1 where id = ?");
    mysqli_stmt_bind_param($query, "i", $trackId);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $data = mysqli_fetch_assoc($result);
}
