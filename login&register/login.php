<?php
session_start(); // 🔐 Mulai sesi — buat menyimpan data user yang login (supaya bisa diakses di halaman lain)

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "skema_nyoba"); // 🔌 Koneksi ke MySQL lokal (pakai username 'root', tanpa password, ke DB 'skema_nyoba')
if ($conn->connect_error) { // ❌ Kalau koneksi gagal
    die("Koneksi gagal: " . $conn->connect_error); // ⛔ Tampilkan pesan error & hentikan program
}

$error_message = ""; // 🪧 Buat nyimpen pesan error (kalau ada)

if ($_SERVER["REQUEST_METHOD"] == "POST") { // 📩 Cek apakah form dikirim (pakai POST)
    $username = $_POST["username"] ?? ''; // ✏️ Ambil input username dari form (kalau gak ada, isi kosong)
    $password = $_POST["password"] ?? ''; // ✏️ Ambil input password dari form

    if (empty($username) || empty($password)) { // ⚠️ Kalau salah satu kosong
        $error_message = "Username dan password wajib diisi."; // 🔔 Tampilkan pesan error
    } else {
        // 🔎 Ambil data user dari database berdasarkan username
        $stmt = $conn->prepare("SELECT id, username, email, password, role, profile_image FROM users WHERE username = ?");
        $stmt->bind_param("s", $username); // 🧷 Masukkan username ke query secara aman (biar gak bisa disisipi SQL Injection)
        $stmt->execute(); // ▶️ Jalankan query
        $stmt->store_result(); // 📦 Simpan hasil ke memori untuk bisa dicek nanti

        if ($stmt->num_rows === 1) { // ✅ Kalau ada 1 user yang cocok
            // 🧩 Ambil hasil query ke variabel
            $stmt->bind_result($id, $db_username, $email, $hashed_password, $role, $profile_image);
            $stmt->fetch(); // 🔄 Ambil datanya

            if (password_verify($password, $hashed_password)) { // 🔐 Cek apakah password yang diketik cocok sama yang di-hash di database
                // 💾 Simpan data user ke sesi supaya bisa dipakai di halaman lain
                $_SESSION["user_id"] = $id;
                $_SESSION["username"] = $db_username;
                $_SESSION["email"] = $email;
                $_SESSION["role"] = $role;
                $_SESSION["profile_image"] = $profile_image;

                // 🚪 Arahkan ke halaman sesuai role-nya
                if ($role === 'admin') { // 👑 Kalau dia admin
                    header("Location: ../admin/dashboard.php"); // ⏩ Masuk ke dashboard admin
                } else { // 👤 Kalau bukan admin
                    header("Location: ../home/home.php"); // ⏩ Masuk ke halaman home user
                }
                exit(); // 🛑 Hentikan script setelah redirect
            } else {
                $error_message = "Password salah."; // ❌ Kalau password gak cocok
            }
        } else {
            $error_message = "Username tidak ditemukan."; // ❌ Kalau username gak ditemukan di database
        }

        $stmt->close(); // ✅ Tutup statement setelah selesai
    }

    $conn->close(); // ✅ Tutup koneksi database setelah semua proses selesai
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
    <link rel="stylesheet" href="login.css">
    
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
            <h2 class="form-title">Sign In</h2>
            
            <form method="POST" action="">
                <?php if (!empty($error_message)): ?>
                <div style="color: red; margin-bottom: 10px;">
                <?= htmlspecialchars($error_message) ?>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="checkbox-row">
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember_me" name="remember_me">
                        <label for="remember_me">Remember Me</label>
                    </div>
                    
                </div>
                
                <button type="submit" class="login-btn">Sign In</button>
                
                <p class="signup-link">Create A New Account? <a href="register.php">Sign Up</a></p>
            </form>
        </div>
    </div>
</body>
</html>