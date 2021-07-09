<?php
include("../../config.php");
include("../../s3config.php");
include("../../classes/mp3file.class.php");
include("../../wavDurationReader.php");
// if (isset($_POST["albumName"])) {
// }


$accepted_file_types = ["audio/mpeg", "audio/wav"];

if (sizeof($_FILES) > 10) {
    echo "Only 10 files per upload is allowed!";
    return;
}

foreach ($_FILES as $fileArray => $file) {
    if (!(in_array($file["type"], $accepted_file_types))) {
        echo "Only .mp3 and .wav files are accepted!";
        return;
    } else if ($file["size"] > 150000000) {
        echo "Only files less than 150MB are allowed!";
        return;
    }

    $fileName = $file["name"];

    // Put the file into the aws provided s3 storage
    $result = $s3->putObject([
        "ACL" => "public-read",
        "Bucket" => "musafi",
        "Key" => $fileName,
        "SourceFile" => $file["tmp_name"]
    ]);
    $url = $result["ObjectURL"];

    if ($file["type"] == "audio/mpeg") {
        $mp3file = new MP3File($file["tmp_name"]);
        $duration = $mp3file->getDuration();
        $hours = floor($duration / 3600);
        $minutes = floor(($duration - ($hours * 3600)) / 60);
        $seconds = $duration - ($hours * 3600) - ($minutes * 60);

        if ($seconds < 10) {
            $formattedDuration = "{$minutes}:0{$seconds}";
        } else {
            $formattedDuration = "{$minutes}:{$seconds}";
        }

        // remove the .mp3 at the end of the string
        $fileNameWithoutType = str_replace(".mp3", "", $fileName);
    } else if ($file["type"] == "audio/wav") {
        $formattedDuration = wavDur($file["tmp_name"]);
        // remove the .wav at the end of the string
        $fileNameWithoutType = str_replace(".wav", "", $fileName);
    }

    $maxValue = mysqli_query($con, "SELECT MAX(albumOrder) FROM songs WHERE artist = 1");
    $row = mysqli_fetch_assoc($maxValue);
    $maxValue = intval($row["MAX(albumOrder)"]) + 1;

    $artistId = 1;
    $albumId = 1;
    $genre = 7;
    $plays = 0;

    $query = mysqli_prepare($con, "INSERT INTO songs (title, artist, album, genre, duration, path, albumOrder, plays) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, "siiissii", $fileNameWithoutType, $artistId, $albumId, $genre, $formattedDuration, $url, $maxValue, $plays);
    mysqli_stmt_execute($query);
}

echo "File uploaded succesfully!";
