<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login&register/login.php");
    exit();
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "skema_nyoba");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];

// Ambil data user dari database
$username = $_SESSION['username'];
$email = $_SESSION['email'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SKEMA - Admin Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="adminprofile.css">
</head>

<body>
  <!-- Header -->
  <div class="header">
    <div class="logo">SKE<span class="m">MA</span></div>
  </div>

  <!-- Content -->
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
            <h2>Admin Profile</h2>

            <div class="sidebar-item favorites-item">
              <a href="profile.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.557 2.75H4.682A1.93 1.93 0 0 0 2.75 4.682v3.875a1.94 1.94 0 0 0 1.932 1.942h3.875a1.94 1.94 0 0 0 1.942-1.942V4.682A1.94 1.94 0 0 0 8.557 2.75m10.761 0h-3.875a1.94 1.94 0 0 0-1.942 1.932v3.875a1.943 1.943 0 0 0 1.942 1.942h3.875a1.94 1.94 0 0 0 1.932-1.942V4.682a1.93 1.93 0 0 0-1.932-1.932m0 10.75h-3.875a1.94 1.94 0 0 0-1.942 1.933v3.875a1.94 1.94 0 0 0 1.942 1.942h3.875a1.94 1.94 0 0 0 1.932-1.942v-3.875a1.93 1.93 0 0 0-1.932-1.932M8.557 13.5H4.682a1.943 1.943 0 0 0-1.932 1.943v3.875a1.93 1.93 0 0 0 1.932 1.932h3.875a1.94 1.94 0 0 0 1.942-1.932v-3.875a1.94 1.94 0 0 0-1.942-1.942"/>
                </svg>
                <span>Dashboard</span>
              </a>
            </div>

            <div class="sidebar-item favorites-item">
              <a href="favorites.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><rect width="20" height="20" x="2" y="2" rx="3" ry="3"/><path d="M7 2v20M17 2v20M2 12h20M2 7h5m15 0h-5M2 17h5m15 0h-5"/></g>
                </svg>
                <span>Film</span>
              </a>
            </div>

            <div class="sidebar-item active">
              <a href="favorites.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-dasharray="28" stroke-dashoffset="28" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M4 21v-1c0 -3.31 2.69 -6 6 -6h4c3.31 0 6 2.69 6 6v1" stroke-dashoffset="0"/><path d="M12 11c-2.21 0 -4 -1.79 -4 -4c0 -2.21 1.79 -4 4 -4c2.21 0 4 1.79 4 4c0 2.21 -1.79 4 -4 4Z" stroke-dashoffset="0"/></g>
                </svg>
                <span>Account</span>
              </a>
            </div>




            <div class="sidebar-item logout-item">
              <a href="../login&register/login.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                  <path fill="none" stroke="#421720" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.496 21H6.5c-1.105 0-2-1.151-2-2.571V5.57c0-1.419.895-2.57 2-2.57h7M16 15.5l3.5-3.5L16 8.5m-6.5 3.496h10"/>
                </svg>
                <span>Log Out</span>
              </a>
            </div>
          </div>

    <!-- Main Content -->
    <div class="main-content"> 
      <div class="profile-header">
        <img src="" alt="Profile Picture" class="profile-image">
        <div class="profile-info">
          <h1>ACCOUNT</h1>
          <p>Email, Username, Password</p>
        </div>
      </div>
      <div class="profile-fields">
        <div class="field-group">
          <div class="field-label">Email</div>
          <div class="field-value"><?= htmlspecialchars($email) ?></div>
        </div>
        <div class="field-group">
          <div class="field-label">Username</div>
          <div class="field-value"><?= htmlspecialchars($username) ?></div>
        </div>
        <div class="field-group">
          <div class="field-label">Password</div>
          <div class="field-value">•••••••••••</div>
        </div>
      </div>
      
    </div>



</body>
</html>
