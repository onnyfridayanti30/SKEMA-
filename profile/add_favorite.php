<?php
session_start(); // 🧠 Mulai session supaya kita bisa ambil data user yang sedang login

require 'koneksi.php'; // 🔌 Menghubungkan ke database (file ini harus berisi $conn = mysqli_connect...)

if (!isset($_SESSION["user_id"])) { // 🚧 Kalau user belum login (tidak ada user_id di session)
    header("Location: ../login&register/login.php"); // 🔄 Arahkan ke halaman login
    exit(); // 🛑 Hentikan eksekusi kode selanjutnya
}

$user_id = $_SESSION["user_id"]; // 🆔 Ambil ID user dari session (user yang sedang login)

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["detail_id"])) { 
    // ✅ Kalau request dari form (POST) dan ada data detail_id (ID film)

    $detail_id = intval($_POST["detail_id"]); // 🎞️ Ambil ID film dari form, pastikan jadi integer (aman)

    // 🔍 Cek dulu apakah film ini sudah jadi favorit user atau belum
    $check = $conn->prepare("SELECT * FROM favorites WHERE user_id = ? AND detail_id = ?");
    $check->bind_param("ii", $user_id, $detail_id); // Isi parameter dengan user_id dan id film
    $check->execute(); // Jalankan query
    $result = $check->get_result(); // Ambil hasil query

    if ($result->num_rows === 0) { // ❌ Kalau belum pernah difavoritkan
        // ➕ Masukkan film ini ke tabel favorites
        $stmt = $conn->prepare("INSERT INTO favorites (user_id, detail_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $detail_id); // Isi parameter
        $stmt->execute(); // Jalankan query insert
        $stmt->close(); // Tutup prepared statement
    }

    $check->close(); // Tutup prepared statement untuk pengecekan
}

header("Location: ../home/detail.php?id=$detail_id"); // 🔁 Kembalikan user ke halaman detail film yang barusan difavoritkan
exit(); // 🛑 Hentikan script setelah redirect
?>
