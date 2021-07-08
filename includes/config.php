<?php
// ob_start();
session_start();

$timezone = date_default_timezone_set("Europe/Helsinki");

if (getenv("production")) {
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"], 1);
    $active_group = 'default';
    $query_builder = TRUE;
    $con = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
} else if (getenv("EC2_DB_PASSWORD")) {
    $con = mysqli_connect("localhost", "root", getenv("EC2_DB_PASSWORD"), "musafy");
} else {
    $con = mysqli_connect("localhost", "root", "", "musafy");
}


if (mysqli_connect_errno()) {
    echo "Connection failed: " . mysqli_connect_errno();
    die;
}
