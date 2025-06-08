<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login/login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "skema_nyoba");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];

// Ambil nama file
$stmt = $conn->prepare("SELECT profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($profileImage);
$stmt->fetch();
$stmt->close();

if (!empty($profileImage) && $profileImage !== './img/default.jpg' && file_exists($profileImage)) {
    unlink($profileImage);
}

// Kosongkan di database
$update = $conn->prepare("UPDATE users SET profile_image = NULL WHERE id = ?");
$update->bind_param("i", $user_id);
$update->execute();
$update->close();

$conn->close();
header("Location: profile.php");
exit();
?>
