<?php
session_start();
require_once 'koneksi.php';

$userId = $_SESSION['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$newPassword = $_POST['password'];
$newProfilePicture = null;

// Handle upload foto profil
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_image']['tmp_name'];
    $fileName = $_FILES['profile_image']['name'];
        $fileType = $_FILES['profile_image']['type'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    if (!in_array($fileType, $allowedTypes)) {
        die("Tipe file tidak diperbolehkan. Hanya JPG, PNG, atau WEBP.");
    }

    $destPath = '../uploads/profile_pictures/' . $fileName;

    move_uploaded_file($fileTmpPath, $destPath);
    $newProfilePicture = $fileName;

    if (move_uploaded_file($fileTmpPath, $destPath)) {
    // Hapus foto lama jika ada
    if (!empty($_SESSION['profile_image'])) {
        $oldPath = '../uploads/profile_pictures/' . $_SESSION['profile_image'];
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }
    $newProfilePicture = $fileName;
}

}

// Buat query UPDATE
$query = "UPDATE users SET username = ?, email = ?";
$params = [$username, $email];

if (!empty($newPassword)) {
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $query .= ", password = ?";
    $params[] = $hashedPassword;
}

if ($newProfilePicture !== null) {
    $query .= ", profile_image = ?";
    $params[] = $newProfilePicture;
}

$query .= " WHERE id = ?";
$params[] = $userId;

// Eksekusi query
$stmt = $conn->prepare($query);
if ($stmt->execute($params)) {
    // ✅ UPDATE session setelah data berhasil diubah
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    if ($newProfilePicture !== null) {
        $_SESSION['profile_image'] = $newProfilePicture;
    }

    header("Location: profile.php?success=1");
    exit;
} else {
    echo "Gagal update data.";
}
?>
