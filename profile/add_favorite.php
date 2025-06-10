<?php
session_start();
require 'koneksi.php'; // Sesuaikan path ke koneksi.php

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login&register/login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["detail_id"])) {
    $detail_id = intval($_POST["detail_id"]);

    // Cek apakah favorit sudah ada
    $check = $conn->prepare("SELECT * FROM favorites WHERE user_id = ? AND detail_id = ?");
    $check->bind_param("ii", $user_id, $detail_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows === 0) {
        // Tambahkan ke favorit
        $stmt = $conn->prepare("INSERT INTO favorites (user_id, detail_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $detail_id);
        $stmt->execute();
        $stmt->close();
    }

    $check->close();
}

header("Location: ../home/detail.php?id=$detail_id");
exit();
// Redirect kembali ke detail film
?>
