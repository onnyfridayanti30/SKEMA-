<?php
session_start();

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    if (empty($email) || empty($username) || empty($password)) {
        $error_message = "Semua field harus diisi.";
    } else {
        $conn = new mysqli("localhost", "root", "", "skema_nyoba");

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

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
                $success_message = "Registrasi berhasil! Silakan login.";
            } else {
                $error_message = "Terjadi kesalahan saat menyimpan data.";
            }

            $stmt->close();
        }

        $check->close();
        $conn->close();

        if (empty($error_message)) {
            header("Location: login.php");
            exit();
        }
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

                <div class="checkbox-row">
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember_me" name="remember_me">
                        <label for="remember_me">Remember Me</label>
                    </div>
                </div>

    <button type="submit" class="login-btn">Sign Up</button>
</form>

        </div>
    </div>
</body>
</html>