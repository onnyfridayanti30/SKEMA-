<?php
session_start(); // 🔓 Mulai session agar bisa akses data user yang sedang login

// 🔍 Cek apakah user sudah login
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login/login.php"); // 🔄 Kalau belum login, arahkan ke halaman login
    exit(); // 🛑 Stop script
}

// 🔌 Koneksi ke database
$conn = new mysqli("localhost", "root", "", "skema_nyoba");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error); // ❌ Jika gagal koneksi, tampilkan pesan error
}

$user_id = $_SESSION["user_id"]; // 🆔 Ambil ID user dari session (user yang sedang login)

// 📥 Ambil nama file foto profil dari database
$stmt = $conn->prepare("SELECT profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id); // Masukkan parameter ID user
$stmt->execute(); // Jalankan query
$stmt->bind_result($profileImage); // Simpan hasil ke variabel $profileImage
$stmt->fetch(); // Ambil hasilnya
$stmt->close(); // Tutup statement

// 🗂️ Path folder tempat menyimpan foto profil
$uploadDir = "../uploads/profile_pictures/";

// ❌ Hapus file jika:
// - Tidak kosong/null
// - Bukan file default (default.jpg)
if (!empty($profileImage) && $profileImage !== "default.jpg") {
    $fullPath = $uploadDir . $profileImage; // 🔗 Gabungkan folder dan nama file jadi path lengkap

    if (file_exists($fullPath)) { // 🔎 Cek apakah file ada di server
        unlink($fullPath); // 🧹 Hapus file dari server
    }
}

// 🧾 Kosongkan kolom profile_image di database (karena file sudah dihapus)
$update = $conn->prepare("UPDATE users SET profile_image = NULL WHERE id = ?");
$update->bind_param("i", $user_id);
$update->execute(); // Jalankan update
$update->close(); // Tutup statement

$conn->close(); // 🔒 Tutup koneksi ke database

// 🔁 Kembali ke halaman profil setelah menghapus foto
header("Location: profile.php");
exit(); // 🛑 Stop script
?>
