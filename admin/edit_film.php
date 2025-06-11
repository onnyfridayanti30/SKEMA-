<?php
require_once "koneksi.php"; // Menghubungkan ke file koneksi database (agar bisa akses $conn)

// Cek apakah request-nya metode POST (berarti data dikirim dari form update)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ambil semua data dari form yang dikirim via POST
    $id_film  = $_POST['id_film'];           // ID film yang akan diedit
    $judul    = $_POST['judul'];             // Judul baru film
    $sinopsis = $_POST['sinopsis'];          // Sinopsis baru
    $duration = $_POST['duration'];          // Durasi baru
    $actor    = $_POST['actor'];             // Aktor baru
    $direktor = $_POST['direktor'];          // Direktur baru

    // Cek apakah user mengupload file baru
    $poster  = $_FILES['poster']['name'];    // Nama file poster baru (kalau ada)
    $banner  = $_FILES['banner']['name'];    // Nama file banner baru (kalau ada)

    // Buat query dasar UPDATE tanpa file
    $sql = "UPDATE detail SET judul=?, sinopsis=?, duration=?, actor=?, direktor=?";

    // Kalau user upload poster baru, simpan file dan tambahkan ke query
    if (!empty($poster)) {
        $poster_tmp = $_FILES['poster']['tmp_name']; // File sementara
        $poster_dest = "../home/uploads/poster/" . basename($poster); // Tujuan penyimpanan
        move_uploaded_file($poster_tmp, $poster_dest); // Simpan file ke folder tujuan

        // Tambahkan ke bagian query
        $sql .= ", poster='$poster'";
    }

    // Kalau user upload banner baru, simpan file dan tambahkan ke query
    if (!empty($banner)) {
        $banner_tmp = $_FILES['banner']['tmp_name'];
        $banner_dest = "../home/uploads/banner/" . basename($banner);
        move_uploaded_file($banner_tmp, $banner_dest);

        // Tambahkan ke bagian query
        $sql .= ", gambar='$banner'";
    }

    // Tutup query update dengan WHERE untuk menentukan film mana yang diubah
    $sql .= " WHERE id_film=?";

    // Siapkan statement SQL dan ikat parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $judul, $sinopsis, $duration, $actor, $direktor, $id_film);

    // Eksekusi statement (jalankan update)
    if ($stmt->execute()) {
        // Kalau berhasil, redirect ke halaman film dengan status sukses
        header("Location: film.php?status=updated");
        exit;
    } else {
        // Kalau gagal, tampilkan pesan error
        echo "Gagal memperbarui data film.";
    }

    // Tutup statement dan koneksi database
    $stmt->close();
    $conn->close();
}
?>
