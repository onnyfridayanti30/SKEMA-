<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login&register/login.php");
    exit();
}

// Ambil data statistik
$total_film = $conn->query("SELECT COUNT(*) as total FROM detail")->fetch_assoc()['total'];
$total_user = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];

// Ambil 5 film terbaru
$film_terbaru = $conn->query("SELECT judul, gambar, created_at FROM detail ORDER BY created_at DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard - SKEMA</title>
  <link rel="stylesheet" href="dashboard.css" />
</head>
<body>
<div class="container">
  <div class="sidebar">
            <h2>User Profile</h2>

            <div class="sidebar-item dashboard-item ">
              <a href="profile.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                    <path fill="none" stroke="#421720" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.557 2.75H4.682A1.93 1.93 0 0 0 2.75 4.682v3.875a1.94 1.94 0 0 0 1.932 1.942h3.875a1.94 1.94 0 0 0 1.942-1.942V4.682A1.94 1.94 0 0 0 8.557 2.75m10.761 0h-3.875a1.94 1.94 0 0 0-1.942 1.932v3.875a1.943 1.943 0 0 0 1.942 1.942h3.875a1.94 1.94 0 0 0 1.932-1.942V4.682a1.93 1.93 0 0 0-1.932-1.932m0 10.75h-3.875a1.94 1.94 0 0 0-1.942 1.933v3.875a1.94 1.94 0 0 0 1.942 1.942h3.875a1.94 1.94 0 0 0 1.932-1.942v-3.875a1.93 1.93 0 0 0-1.932-1.932M8.557 13.5H4.682a1.943 1.943 0 0 0-1.932 1.943v3.875a1.93 1.93 0 0 0 1.932 1.932h3.875a1.94 1.94 0 0 0 1.942-1.932v-3.875a1.94 1.94 0 0 0-1.942-1.942"/>
                </svg>
                <span>Dashboard</span>
              </a>
            </div>

            <div class="sidebar-item film-item">
              <a href="fim.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="#421720" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"><rect width="18" height="18" x="3" y="3" rx="2"/>
                  <path d="M7 3v18M3 7.5h4M3 12h18M3 16.5h4M17 3v18m0-13.5h4m-4 9h4"/></g>
                </svg>
                <span>Film</span>
              </a>
            </div>

            <div class="sidebar-item account-item">
              <a href="account.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="0 0 24 24">
                  <path fill="#421720" d="M12 12.25a3.75 3.75 0 1 1 3.75-3.75A3.75 3.75 0 0 1 12 12.25m0-6a2.25 2.25 0 1 0 2.25 2.25A2.25 2.25 0 0 0 12 6.25m7 13a.76.76 0 0 1-.75-.75c0-1.95-1.06-3.25-6.25-3.25s-6.25 1.3-6.25 3.25a.75.75 0 0 1-1.5 0c0-4.75 5.43-4.75 7.75-4.75s7.75 0 7.75 4.75a.76.76 0 0 1-.75.75" />
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

  <div class="main-content">
    <div class="header">
      <h2>Welcome Back!!</h2>
      <h1>Admin <?= htmlspecialchars($_SESSION['username']) ?></h1>
    </div>

    <div class="stats">
      <div class="card"><h3><?= $total_film ?></h3><p>Total Film</p></div>
      <div class="card"><h3><?= number_format($total_user, 0, ',', '.') ?></h3><p>Users</p></div>
      <div class="card"><h3>8</h3><p>Film Terbaru Bulan Ini</p></div>
    </div>

    <div class="recent-films">
      <h3>FILM TERBARU</h3>
      <?php while ($film = $film_terbaru->fetch_assoc()): ?>
        <div class="film-item">
          <img src="../home/image/<?= htmlspecialchars($film['gambar']) ?>" alt="<?= htmlspecialchars($film['judul']) ?>" width="80">
          <div>
            <strong><?= htmlspecialchars($film['judul']) ?></strong><br>
            <small>Ditambahkan <?= date('d F Y', strtotime($film['created_at'])) ?></small>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
</body>
</html>
