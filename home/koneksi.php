<?php
// Menyimpan detail koneksi database
$host = "localhost";  // Nama host database, biasanya "localhost" jika server dan database di mesin yang sama
$user = "root";       // Username database MySQL, default XAMPP biasanya "root"
$pass = "";           // Password database, default XAMPP biasanya kosong ("")
$db   = "skema_nyoba"; // Nama database yang ingin digunakan

// Membuat koneksi ke MySQL menggunakan mysqli
$conn = mysqli_connect($host, $user, $pass, $db);

// Mengecek apakah koneksi berhasil atau tidak
if (!$conn) {
    // Jika gagal, tampilkan pesan error dan hentikan eksekusi
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
