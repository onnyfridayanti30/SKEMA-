<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login/login.php");
    exit();
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "skema_nyoba");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];

// Ambil nama file profile_image dari database
$stmt = $conn->prepare("SELECT profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($profileImage);
$stmt->fetch();
$stmt->close();

// Path folder penyimpanan foto profil
$uploadDir = "../uploads/profile_pictures/";

// Hapus file jika ada, bukan kosong/null, dan bukan default.jpg
if (!empty($profileImage) && $profileImage !== "default.jpg") {
    $fullPath = $uploadDir . $profileImage;

    if (file_exists($fullPath)) {
        unlink($fullPath); // Hapus file dari server
    }
}

// Kosongkan kolom profile_image di database
$update = $conn->prepare("UPDATE users SET profile_image = NULL WHERE id = ?");
$update->bind_param("i", $user_id);
$update->execute();
$update->close();

$conn->close();

// Kembali ke halaman profil
header("Location: profile.php");
exit();
?>
