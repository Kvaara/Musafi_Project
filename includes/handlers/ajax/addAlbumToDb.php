<?php
include("../../config.php");
include("../../s3config.php");
include("../../../mp3file.class.php");

// if (isset($_POST["albumName"])) {
// }


// $accepted_file_types = ["audio/mpeg", "audio/wav"];

// if (!(in_array($_FILES["file"]["type"], $accepted_file_types))) {
//     echo "false";
//     return;
// }


$fileName = $_FILES["file"]["name"];

$result = $s3->putObject([
    "ACL" => "public-read",
    "Bucket" => "musafi",
    "Key" => $fileName,
    "SourceFile" => $_FILES["file"]["tmp_name"]
]);
$url = $result["ObjectURL"];

$mp3file = new MP3File($_FILES["file"]["tmp_name"]);

$duration = $mp3file->getDuration();
$hours = floor($duration / 3600);
$minutes = floor(($duration - ($hours * 3600)) / 60);
$seconds = $duration - ($hours * 3600) - ($minutes * 60);

if ($seconds < 10) {
    $formattedDuration = "{$minutes}:0{$seconds}";
} else {
    $formattedDuration = "{$minutes}:{$seconds}";
}

// remove the .mp3 at the end
$fileNameWithoutType = str_replace(".mp3", "", $fileName);


$maxValue = mysqli_query($con, "SELECT MAX(albumOrder) FROM songs WHERE artist = 1");
$row = mysqli_fetch_assoc($maxValue);
$maxValue2 = intval($row["MAX(albumOrder)"]) + 1;

$query = mysqli_query($con, "INSERT INTO songs (title, artist, album, genre, duration, path, albumOrder, plays) VALUES ('{$fileNameWithoutType}', 1, 1, 7, '{$formattedDuration}', '{$url}', {$maxValue2}, 0)");

echo "File uploaded succesfully!";

// No need to convert because it's a string
// $albumName = $_POST["albumName"];

// $filesConverted = json_decode($files);



// echo json_encode($files);
