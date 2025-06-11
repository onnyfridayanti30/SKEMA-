<?php
session_start();

// Aktifkan error reporting (opsional untuk debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan normalisasi input
    $email = strtolower(trim($_POST["email"] ?? ''));
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if (empty($email) || empty($username) || empty($password)) {
        $error_message = "Semua field harus diisi.";
    } else {
        $conn = new mysqli("localhost", "root", "", "skema_nyoba");

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Cek duplikat email/username
        $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $check->bind_param("ss", $email, $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error_message = "Email atau username sudah digunakan.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $username, $hashed_password);

            if ($stmt->execute()) {
                $success_message = "Registrasi berhasil! <a href='login.php'>Silakan login di sini</a>.";
            } else {
                $error_message = "Terjadi kesalahan saat menyimpan data.";
            }

            $stmt->close();
        }

        $check->close();
        $conn->close();
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