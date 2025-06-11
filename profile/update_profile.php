<?php
session_start(); // Mulai session untuk akses data user login
require_once 'koneksi.php'; // Menghubungkan ke database

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php"); // Kalau belum login, arahkan ke login
    exit;
}

$userId = $_SESSION['user_id']; // Ambil user ID dari session
$username = $_POST['username']; // Ambil input username baru dari form
$email = $_POST['email'];       // Ambil input email baru dari form
$newPassword = $_POST['password']; // Ambil input password baru (kalau diisi)
$newProfilePicture = null; // Inisialisasi variabel foto profil baru

// ==== PROSES UPLOAD FOTO PROFIL JIKA ADA ====
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_image']['tmp_name']; // File sementara
    $fileName = $_FILES['profile_image']['name'];        // Nama file asli
    $fileType = $_FILES['profile_image']['type'];        // Tipe file (image/jpeg, dll)
    
    // Hanya izinkan gambar JPG, PNG, WEBP
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    if (!in_array($fileType, $allowedTypes)) {
        die("Tipe file tidak diperbolehkan. Hanya JPG, PNG, atau WEBP.");
    }

    $destPath = '../uploads/profile_pictures/' . $fileName; // Lokasi tujuan penyimpanan file

    if (move_uploaded_file($fileTmpPath, $destPath)) {
        // Hapus foto lama jika ada
        if (!empty($_SESSION['profile_image'])) {
            $oldPath = '../uploads/profile_pictures/' . $_SESSION['profile_image'];
            if (file_exists($oldPath)) {
                unlink($oldPath); // Hapus file lama dari server
            }
        }

        $newProfilePicture = $fileName; // Simpan nama foto baru
    }
}

// ==== PERSIAPAN QUERY UPDATE ====
$query = "UPDATE users SET username = ?, email = ?"; // Update username dan email dulu
$params = [$username, $email]; // Parameter untuk query

// Tambahkan update password jika user mengisi password baru
if (!empty($newPassword)) {
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Enkripsi password
    $query .= ", password = ?"; // Tambah ke query
    $params[] = $hashedPassword;
}

// Tambahkan update foto profil jika user upload foto baru
if ($newProfilePicture !== null) {
    $query .= ", profile_image = ?"; // Tambah ke query
    $params[] = $newProfilePicture;
}

$query .= " WHERE id = ?"; // Filter berdasarkan user ID
$params[] = $userId; // Tambahkan user ID ke parameter

// ==== JALANKAN QUERY UPDATE ====
$stmt = $conn->prepare($query);
if ($stmt->execute($params)) {
    // ✅ UPDATE BERHASIL — PERBARUI SESSION
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    if ($newProfilePicture !== null) {
        $_SESSION['profile_image'] = $newProfilePicture;
    }

    header("Location: profile.php?success=1"); // Redirect ke halaman profil
    exit;
} else {
    echo "Gagal update data."; // Jika gagal update
}
?>
