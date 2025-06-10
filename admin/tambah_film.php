<?php
require_once "koneksi.php"; // pastikan koneksi DB aktif

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul     = $_POST['judul'] ?? '';
    $sinopsis  = $_POST['sinopsis'] ?? '';
    $duration  = $_POST['duration'] ?? '';
    $actor     = $_POST['actor'] ?? '';
    $direktor  = $_POST['direktor'] ?? '';

    // Upload file poster
    $poster = $_FILES['poster']['name'];
    $poster_tmp = $_FILES['poster']['tmp_name'];
    $poster_dest = "../home/uploads/poster/" . basename($poster);

    // Upload file banner
    $banner = $_FILES['banner']['name'];
    $banner_tmp = $_FILES['banner']['tmp_name'];
    $banner_dest = "../home/uploads/banner/" . basename($banner);

    // Cek dan upload file
    if (move_uploaded_file($poster_tmp, $poster_dest) && move_uploaded_file($banner_tmp, $banner_dest)) {
        // Insert ke database
        $stmt = $conn->prepare("INSERT INTO detail (judul, sinopsis, duration, poster, gambar, actor, direktor, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

        $stmt->bind_param("sssssss", $judul, $sinopsis, $duration, $poster, $banner, $actor, $direktor);

        if ($stmt->execute()) {
            header("Location: film.php?status=sukses");
            exit;
        } else {
            echo "Gagal menyimpan data film.";
        }

        $stmt->close();
    } else {
        echo "Gagal upload file.";
    }

    $conn->close();
}
?>
