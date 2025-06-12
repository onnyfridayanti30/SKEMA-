<?php
session_start();
require 'koneksi.php'; // ganti path jika perlu

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$film_id = $_POST['film_id'] ?? null;

if (!$film_id) {
    echo json_encode(['status' => 'error', 'message' => 'Film ID missing']);
    exit;
}

// Cek apakah film sudah ada di daftar favorit
$check_sql = "SELECT * FROM favorites WHERE user_id = ? AND detail_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ii", $user_id, $film_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    echo json_encode(['status' => 'exists', 'message' => 'Already in favorites']);
    exit;
}

// Simpan ke tabel favorites
$sql = "INSERT INTO favorites (user_id, detail_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $film_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Added to favorites']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add']);
}
?>
