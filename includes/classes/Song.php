<?php

class Song
{
    private $con;
    private $id;
    private $songsData;
    private $title;
    private $artistId;
    private $albumId;
    private $genreId;
    private $duration;
    private $path;
    private $orderInAlbum;

    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id = $id;

        $albumsQuery = mysqli_prepare($this->con, "SELECT * FROM songs WHERE id = ?");
        mysqli_stmt_bind_param($albumsQuery, "i", $this->id);
        mysqli_stmt_execute($albumsQuery);
        $result = mysqli_stmt_get_result($albumsQuery);
        $data = mysqli_fetch_assoc($result);
        $this->songsData = $data;
        $this->title = $data["title"];
        $this->artistId = $data["artist"];
        $this->albumId = $data["album"];
        $this->genreId = $data["genre"];
        $this->duration = $data["duration"];
        $this->path = $data["path"];
        $this->orderInAlbum = $data["albumOrder"];
    }

    public function getSongsData()
    {
        return $this->songsData;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSongArtist()
    {
        return new Artist($this->con, $this->artistId);
    }

    public function getAlbumId()
    {
        return $this->albumId;
    }

    public function getGenreId()
    {
        return $this->genreId;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getOrderInAlbum()
    {
        return $this->orderInAlbum;
    }
}
