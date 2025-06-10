<?php
require_once "koneksi.php";

if (isset($_POST['id_film'])) {
    $id_film = $_POST['id_film'];

    // Ambil nama file dulu
    $query = $conn->query("SELECT poster, gambar FROM detail WHERE id_film = $id_film");
    $data = $query->fetch_assoc();

    // Hapus record dari database
    $conn->query("DELETE FROM detail WHERE id_film = $id_film");

    // Hapus file dari folder (jika ada)
    if (!empty($data['poster']) && file_exists("../home/uploads/poster/" . $data['poster'])) {
        unlink("../home/uploads/poster/" . $data['poster']);
    }
    if (!empty($data['gambar']) && file_exists("../home/uploads/banner/" . $data['gambar'])) {
        unlink("../home/uploads/banner/" . $data['gambar']);
    }

    header("Location: film.php?status=deleted");
    exit;
} else {
    echo "ID film tidak ditemukan.";
}
?>
