<?php
$host = "localhost";
$user = "root";
$pass = ""; // Kosong untuk XAMPP default
$dbname = "skema_nyoba";

$conn = new mysqli("localhost", "root", "", "skema_nyoba");


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

