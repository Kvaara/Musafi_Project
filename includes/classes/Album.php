<?php

class Album
{

    private $con;
    private $id;
    private $title;
    private $artistId;
    private $genre;
    private $artworkPath;

    // Just after creating an instance of an album class, assign the corresponding album's id data to private variables above
    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id = $id;


        $albumsQuery = mysqli_prepare($this->con, "SELECT * FROM albums WHERE id = ?");
        mysqli_stmt_bind_param($albumsQuery, "i", $this->id);
        mysqli_stmt_execute($albumsQuery);
        $result = mysqli_stmt_get_result($albumsQuery);
        $album = mysqli_fetch_assoc($result);

        $this->title = $album["title"];
        $this->artistId = $album["artist"];
        $this->genre = $album["genre"];
        $this->artworkPath = $album["artworkPath"];
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getArtist()
    {
        return new Artist($this->con, $this->artistId);
    }

    public function getArtworkPath()
    {
        return $this->artworkPath;
    }

    public function getNumberOfSongs()
    {
        $songsQuery = mysqli_prepare($this->con, "SELECT * FROM songs WHERE album = ?");
        mysqli_stmt_bind_param($songsQuery, "i", $this->id);
        mysqli_stmt_execute($songsQuery);
        $result = mysqli_stmt_get_result($songsQuery);
        $numberOfSongs = mysqli_num_rows($result);

        if ($numberOfSongs == 1) {
            return "1 song";
        } else {
            return "{$numberOfSongs} songs";
        }
    }

    public function getSongIds()
    {
        $songsQuery = mysqli_prepare($this->con, "SELECT id FROM songs WHERE album = ? ORDER BY albumOrder ASC");
        mysqli_stmt_bind_param($songsQuery, "i", $this->id);
        mysqli_stmt_execute($songsQuery);
        $result = mysqli_stmt_get_result($songsQuery);

        $songIdArray = [];

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($songIdArray, $row["id"]);
        }

        return $songIdArray;
    }
}
