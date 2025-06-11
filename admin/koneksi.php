<?php
$host = "localhost";       // Ganti jika hosting beda
$user = "root";            // Username MySQL
$password = "";            // Password MySQL (kosong jika default XAMPP)
$database = "skema_nyoba";    // database kamu

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
