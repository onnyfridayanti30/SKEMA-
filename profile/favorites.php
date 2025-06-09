<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: profile.php");
    exit();
}

$username = $_SESSION["username"];
$email = $_SESSION["email"];
$profile_image = $_SESSION["profile_image"] ?? './img/desault.jpg'; // fallback jika kosong
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SKEMA - Favorites</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="favorites.css">
</head>
<body>



<div class="header">
    <div class="logo">SKE<span class="m">MA</span></div>
    <a href="../home/home.php"><button class="home-btn">Home</button></a>
</div>
   

<div class="container">

          <div class="sidebar">
            <h2>User Profile</h2>

            <div class="sidebar-item active">
              <a href="profile.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="0 0 24 24">
                  <path fill="#421720" d="M12 12.25a3.75 3.75 0 1 1 3.75-3.75A3.75 3.75 0 0 1 12 12.25m0-6a2.25 2.25 0 1 0 2.25 2.25A2.25 2.25 0 0 0 12 6.25m7 13a.76.76 0 0 1-.75-.75c0-1.95-1.06-3.25-6.25-3.25s-6.25 1.3-6.25 3.25a.75.75 0 0 1-1.5 0c0-4.75 5.43-4.75 7.75-4.75s7.75 0 7.75 4.75a.76.76 0 0 1-.75.75" />
                </svg>
                <span>User Info</span>
              </a>
            </div>

            <div class="sidebar-item favorites-item">
              <a href="favorites.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                  <path fill="none" stroke="#421720" stroke-width="1.5" d="m4.45 13.908l6.953 6.531c.24.225.36.338.5.366a.5.5 0 0 0 .193 0c.142-.028.261-.14.5-.366l6.953-6.53a5.203 5.203 0 0 0 .549-6.983l-.31-.399c-1.968-2.536-5.918-2.111-7.301.787a.54.54 0 0 1-.974 0C10.13 4.416 6.18 3.99 4.212 6.527l-.31.4a5.203 5.203 0 0 0 .549 6.981Z"/>
                </svg>
                <span>Favorites</span>
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

            <div class="profile-section">
              <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile" class="profile-pic" />
              <div class="user-info">
                <h2><?= htmlspecialchars($username) ?></h2>
                <p><?= htmlspecialchars($email) ?></p>
              </div>
            </div>

            <h3 class="fav-title">Favorites</h3>
            <hr>

            <div class="favorites-carousel">
              <div class="favorite-item">
                <img src="./img/clarity.jpg" alt="Clarity">
                <p>Clarity</p>
              </div>
              <div class="favorite-item">
                <img src="./img/suara-lukisan.jpg" alt="Suara Lukisan">
                <p>Suara Lukisan</p>
              </div>
            </div>

            <div class="carousel-dots">
              <span class="dot active"></span>
              <span class="dot"></span>
            </div>
          </div>
</div>

</body>
</html>
