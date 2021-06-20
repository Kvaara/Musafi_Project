<?php

class Album
{

    private $con;
    private $id;

    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id = $id;
    }

    public function getTitle()
    {
        $albumsQuery = mysqli_prepare($this->con, "SELECT title FROM albums WHERE id = ?");
        mysqli_stmt_bind_param($albumsQuery, "i", $this->id);
        mysqli_stmt_execute($albumsQuery);
        $result = mysqli_stmt_get_result($albumsQuery);
        $albums = mysqli_fetch_assoc($result);
        return $albums["title"];
    }
}
