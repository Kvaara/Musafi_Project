<?php
// ob_start();
session_start();

$timezone = date_default_timezone_set("Europe/Helsinki");

$con = mysqli_connect("localhost", "root", "", "musafy");

if (mysqli_connect_errno()) {
    echo "Connection failed: " . mysqli_connect_errno();
    die;
}
