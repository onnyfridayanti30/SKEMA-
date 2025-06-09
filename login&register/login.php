<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "skema_nyoba");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    if (empty($username) || empty($password)) {
        $error_message = "Username dan password wajib diisi.";
    } else {
        // Ambil data user dari database
        $stmt = $conn->prepare("SELECT id, username, email, password, role, profile_image FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $db_username, $email, $hashed_password, $role, $profile_image);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                // Simpan ke session
                $_SESSION["user_id"] = $id;
                $_SESSION["username"] = $db_username;
                $_SESSION["email"] = $email;
                $_SESSION["role"] = $role;
                $_SESSION["profile_image"] = $profile_image; // simpan foto profil

                // Arahkan ke halaman home
                header("Location: ../home/home.php");
                exit();
            } else {
                $error_message = "Password salah.";
            }
        } else {
            $error_message = "Username tidak ditemukan.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
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