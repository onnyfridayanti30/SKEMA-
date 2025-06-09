<?php
$host = "localhost";
$user = "root";
$password = "Kevinbi13_";
$dbname = "detail_film";  // ← UBAH INI

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>