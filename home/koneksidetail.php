<?php
// Konfigurasi database
$host = "localhost";   // Nama host database
$user = "root";        // Username database
$pass = "";            // Password database
$db   = "skema_nyoba"; // Nama database

// --- Koneksi dengan gaya prosedural ---
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi prosedural
if (!$conn) {
    die("Koneksi prosedural gagal: " . mysqli_connect_error());
}

// --- Koneksi dengan gaya objek (OOP) ---
$koneksi = new mysqli($host, $user, $pass, $db);

// Cek koneksi OOP
if ($koneksi->connect_error) {
    die("Koneksi OOP gagal: " . $koneksi->connect_error);
}
?>
