<?php
$host = "localhost";
$user = "root";
$pass = "Kevinbi13_";
$db = "skema_nyoba";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
