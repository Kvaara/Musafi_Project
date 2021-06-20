<?php

class Artist
{
    private $con;
    private $id;

    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id = $id;
    }

    // Get the name of the artist who composed the album
    public function getName()
    {
        $artistQuery = mysqli_prepare($this->con, "SELECT name FROM artists WHERE id = ?");
        mysqli_stmt_bind_param($artistQuery, "i", $this->id);
        mysqli_stmt_execute($artistQuery);
        $result = mysqli_stmt_get_result($artistQuery);
        $artist = mysqli_fetch_assoc($result);
        return $artist["name"];
    }
}
