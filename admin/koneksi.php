<?php
$host = "localhost";       // Ganti jika hosting beda
$user = "root";            // Username MySQL
$password = "Kevinbi13_";            // Password MySQL (kosong jika default XAMPP)
$database = "skema_nyoba";    // Ganti dengan nama database kamu

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
