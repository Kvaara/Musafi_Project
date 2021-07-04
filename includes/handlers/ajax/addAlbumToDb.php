<?php
include("../../config.php");
include("../../../mp3file.class.php");

if (isset($_POST["albumName"])) {
}


// $files = $_POST["formData"];

$accepted_file_types = ["audio/mpeg", "audio/wav"];

// if (!(in_array($_FILES["file"]["type"], $accepted_file_types))) {
//     echo "false";
//     return;
// }

// if (!file_exists("uploads")) {
//     mkdir("../../../assets/songs/uploads/", 0777);
// }

move_uploaded_file($_FILES["file"]["tmp_name"], "../../../assets/songs/Niklas_Puganen/" . "puganen-" . $_FILES["file"]["name"]);


$mp3file = new MP3File("../../../assets/songs/Niklas_Puganen/" . "puganen-" . $_FILES["file"]["name"]);
$duration = $mp3file->getDuration();

$hours = floor($duration / 3600);
$minutes = floor(($duration - ($hours * 3600)) / 60);
$seconds = $duration - ($hours * 3600) - ($minutes * 60);

$fileName = $_FILES["file"]["name"];
$formattedDuration = "{$minutes}:$seconds";

$pathFriendlyFileName = str_replace("#", "", $fileName);
$path = "./assets/songs/Niklas_Puganen/" . "puganen-" . $pathFriendlyFileName;

$maxValue = mysqli_query($con, "SELECT MAX(albumOrder) FROM songs WHERE artist = 1");
$row = mysqli_fetch_assoc($maxValue);
$maxValue2 = intval($row["MAX(albumOrder)"]) + 1;

$query = mysqli_query($con, "INSERT INTO songs (title, artist, album, genre, duration, path, albumOrder, plays) VALUES ('{$fileName}', 2, 1, 7, '{$formattedDuration}', '{$path}', {$maxValue2}, 0)");

// INSERT INTO songs (title, artist, album, genre, duration, path, plays) VALUES ({$fileName}, 2, 1, 7, {$formattedDuration}, {$path}, 0);

echo "File uploaded succesfully!";

// No need to convert because it's a string
// $albumName = $_POST["albumName"];

// $filesConverted = json_decode($files);



// echo json_encode($files);
