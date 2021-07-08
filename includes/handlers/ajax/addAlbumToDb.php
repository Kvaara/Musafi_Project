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
    $maxValue2 = intval($row["MAX(albumOrder)"]) + 1;

    $query = mysqli_query($con, "INSERT INTO songs (title, artist, album, genre, duration, path, albumOrder, plays) VALUES ('{$fileNameWithoutType}', 1, 1, 7, '{$formattedDuration}', '{$url}', {$maxValue2}, 0)");
}

echo "File uploaded succesfully!";
// if (!(in_array($_FILES["file"]["type"], $accepted_file_types))) {
//     echo "Only .mp3 and .wav files are accepted!";
//     return;
// } else if ($_FILES["file"]["size"] > 150000000) {
//     echo "Only files less than 150MB are allowed!";
// }
// $fileName = $_FILES["file"]["name"];

// Put the file into the aws provided s3 storage
// $result = $s3->putObject([
//     "ACL" => "public-read",
//     "Bucket" => "musafi",
//     "Key" => $fileName,
//     "SourceFile" => $_FILES["file"]["tmp_name"]
// ]);
// $url = $result["ObjectURL"];

// if ($_FILES["file"]["type"] == "audio/mpeg") {
//     $mp3file = new MP3File($_FILES["file"]["tmp_name"]);
//     $duration = $mp3file->getDuration();
//     $hours = floor($duration / 3600);
//     $minutes = floor(($duration - ($hours * 3600)) / 60);
//     $seconds = $duration - ($hours * 3600) - ($minutes * 60);

//     if ($seconds < 10) {
//         $formattedDuration = "{$minutes}:0{$seconds}";
//     } else {
//         $formattedDuration = "{$minutes}:{$seconds}";
//     }

//     // remove the .mp3 at the end of the string
//     $fileNameWithoutType = str_replace(".mp3", "", $fileName);
// } else if ($_FILES["file"]["type"] == "audio/wav") {
//     $formattedDuration = wavDur($_FILES["file"]["tmp_name"]);
//     // remove the .wav at the end of the string
//     $fileNameWithoutType = str_replace(".wav", "", $fileName);
// }



// $maxValue = mysqli_query($con, "SELECT MAX(albumOrder) FROM songs WHERE artist = 1");
// $row = mysqli_fetch_assoc($maxValue);
// $maxValue2 = intval($row["MAX(albumOrder)"]) + 1;

// $query = mysqli_query($con, "INSERT INTO songs (title, artist, album, genre, duration, path, albumOrder, plays) VALUES ('{$fileNameWithoutType}', 1, 1, 7, '{$formattedDuration}', '{$url}', {$maxValue2}, 0)");

// echo "File uploaded succesfully!";

// No need to convert because it's a string
// $albumName = $_POST["albumName"];

// $filesConverted = json_decode($files);



// echo json_encode($files);
