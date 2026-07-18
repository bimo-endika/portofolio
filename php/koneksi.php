<?php
$servername = "localhost";
$username = "admin";
$password = "passwordadmin";
$dbname = "db_movieproject2";

$koneksi = new mysqli($servername, $username, $password, $dbname);

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
$koneksi->set_charset("utf8mb4");
?>