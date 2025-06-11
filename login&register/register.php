<?php
session_start(); // 🔐 Mulai sesi, walau belum digunakan di sini, tapi bisa dipakai kalau nanti perlu menyimpan data user

// Aktifkan error reporting (opsional untuk debugging saat development)
error_reporting(E_ALL); // 📣 Tampilkan semua jenis error
ini_set('display_errors', 1); // 💡 Pastikan error ditampilkan di browser

$error_message = "";  // 🪧 Variabel untuk menyimpan pesan error (jika ada)
$success_message = ""; // 🥳 Variabel untuk menyimpan pesan sukses (jika pendaftaran berhasil)

if ($_SERVER["REQUEST_METHOD"] == "POST") { // 📥 Cek apakah form dikirim lewat POST
    // Ambil data dari form dan rapikan inputnya
    $email = strtolower(trim($_POST["email"] ?? '')); // 📧 Ambil email, ubah jadi huruf kecil, dan hapus spasi depan/belakang
    $username = trim($_POST["username"] ?? '');       // 👤 Ambil username dan hapus spasi
    $password = trim($_POST["password"] ?? '');       // 🔒 Ambil password dan hapus spasi

    // ❗ Validasi: semua field harus diisi
    if (empty($email) || empty($username) || empty($password)) {
        $error_message = "Semua field harus diisi.";
    } else {
        // 🔌 Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "skema_nyoba");

        if ($conn->connect_error) { // ❌ Kalau gagal konek
            die("Koneksi gagal: " . $conn->connect_error); // Hentikan dan tampilkan pesan error
        }

        // 🔍 Cek apakah email atau username sudah pernah dipakai
        $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $check->bind_param("ss", $email, $username); // Amankan query dari SQL injection
        $check->execute(); // Jalankan query
        $check->store_result(); // Simpan hasilnya untuk dicek jumlah baris

        if ($check->num_rows > 0) { // ❌ Kalau sudah ada user dengan email/username itu
            $error_message = "Email atau username sudah digunakan.";
        } else {
            // 🔐 Enkripsi password sebelum disimpan ke database
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // 📝 Siapkan query insert user baru
            $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $username, $hashed_password);

            if ($stmt->execute()) { // ✅ Kalau berhasil disimpan
                $success_message = "Registrasi berhasil! <a href='login.php'>Silakan login di sini</a>.";
            } else {
                $error_message = "Terjadi kesalahan saat menyimpan data."; // ❌ Kalau gagal simpan
            }

            $stmt->close(); // ✅ Tutup prepared statement
        }

        $check->close(); // ✅ Tutup query cek duplikat
        $conn->close();  // ✅ Tutup koneksi database
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKEMA - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="register.css">
    
</head>


<body>
    <div class="container">
        <div class="left-section">
            <div class="logo">
                SKE<span class="m">MA</span>
            </div>
            <div class="welcome-text">Welcome !</div>
            <div class="subtitle">To Our Website</div>
        </div>
        
        <div class="right-section">
            <h2 class="form-title">Sign Up</h2>

            <?php if (!empty($error_message)): ?>
    <div class="notif error"><?= htmlspecialchars($error_message) ?></div>
<?php endif; ?>

<?php if (!empty($success_message)): ?>
    <div class="notif success"><?= $success_message ?></div>
<?php endif; ?>

            
           <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>


    <button type="submit" class="login-btn">Sign Up</button>
</form>

        </div>
    </div>
</body>
</html>