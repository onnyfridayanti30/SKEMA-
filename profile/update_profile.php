<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$newPassword = $_POST['password'];
$newProfilePicture = null;

// === UPLOAD FOTO PROFIL ===
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_image']['tmp_name'];
    $fileName = time() . '_' . basename($_FILES['profile_image']['name']); // Hindari nama duplikat
    $fileType = $_FILES['profile_image']['type'];
    
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    if (!in_array($fileType, $allowedTypes)) {
        die("Tipe file tidak diperbolehkan.");
    }

    $destPath = '../uploads/profile_pictures/' . $fileName;

    if (move_uploaded_file($fileTmpPath, $destPath)) {
        if (!empty($_SESSION['profile_image'])) {
            $oldPath = '../uploads/profile_pictures/' . $_SESSION['profile_image'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }
        $newProfilePicture = $fileName;
    }
}

// === BANGUN QUERY ===
$query = "UPDATE users SET username = ?, email = ?";
$params = [$username, $email];

if (!empty($newPassword)) {
    $query .= ", password = ?";
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $params[] = $hashedPassword;
}

if ($newProfilePicture !== null) {
    $query .= ", profile_image = ?";
    $params[] = $newProfilePicture;
}

$query .= " WHERE id = ?";
$params[] = $userId;

// === PREPARE, BIND & EXECUTE ===
$stmt = $conn->prepare($query);
$types = str_repeat('s', count($params)); // semua string
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    if ($newProfilePicture !== null) {
        $_SESSION['profile_image'] = $newProfilePicture;
    }

    header("Location: profile.php?success=1");
    exit;
} else {
    echo "Gagal update data: " . $stmt->error;
}
?>
