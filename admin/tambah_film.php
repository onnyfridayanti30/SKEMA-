<?php
require_once "koneksi.php"; // Menghubungkan ke file koneksi database ($conn)

// Pastikan request berasal dari method POST (form dikirim)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ambil data input dari form (pakai null coalescing untuk fallback ke string kosong jika tidak ada)
    $judul     = $_POST['judul'] ?? '';       // Judul film
    $sinopsis  = $_POST['sinopsis'] ?? '';    // Sinopsis film
    $duration  = $_POST['duration'] ?? '';    // Durasi film
    $actor     = $_POST['actor'] ?? '';       // Aktor film
    $direktor  = $_POST['direktor'] ?? '';    // Sutradara film

    // Ambil informasi file poster dari form
    $poster = $_FILES['poster']['name'];                        // Nama file poster
    $poster_tmp = $_FILES['poster']['tmp_name'];                // File sementara
    $poster_dest = "../home/uploads/poster/" . basename($poster); // Lokasi tujuan upload poster

    // Ambil informasi file banner dari form
    $banner = $_FILES['banner']['name'];
    $banner_tmp = $_FILES['banner']['tmp_name'];
    $banner_dest = "../home/uploads/banner/" . basename($banner);

    // Lakukan upload file poster dan banner
    if (move_uploaded_file($poster_tmp, $poster_dest) && move_uploaded_file($banner_tmp, $banner_dest)) {
        
        // Jika berhasil upload file, insert data ke tabel `detail`
        $stmt = $conn->prepare("
            INSERT INTO detail (
                judul, sinopsis, duration, poster, gambar, actor, direktor, created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");

        // Binding nilai parameter ke query
        $stmt->bind_param("sssssss", $judul, $sinopsis, $duration, $poster, $banner, $actor, $direktor);

        // Jalankan query
        if ($stmt->execute()) {
            // Berhasil: redirect ke halaman film dengan status sukses
            header("Location: film.php?status=sukses");
            exit;
        } else {
            // Gagal menyimpan ke database
            echo "Gagal menyimpan data film.";
        }

        $stmt->close();
    } else {
        // Gagal upload file
        echo "Gagal upload file.";
    }

    // Tutup koneksi database
    $conn->close();
}
?>
