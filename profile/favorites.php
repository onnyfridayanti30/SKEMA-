<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login/login.php");
    exit();
}

$username = $_SESSION["username"];
$email = $_SESSION["email"];
$profileImage = $_SESSION["profile_image"] ?? 'default_user.png'; // fallback jika kosong
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SKEMA - Favorites</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="favorites.css">
</head>
<body>

<div class="header">
    <div class="logo">SKE<span class="m">MA</span></div>
    <a href="../home/home.php"><button class="home-btn">Home</button></a>
  </div>

  <!-- Content -->
  
    <!-- Sidebar -->
   

<div class="container">

 <div class="sidebar">
      <h2>User Profile</h2>
      <div class="sidebar-item active"><i class='bx bx-user'></i><a href="favorites.php">User Info</a > </div>
      <div class="sidebar-item Favorites"><i class='bx bx-heart'></i><a href="favorites.php">Favorites</a ></div>
      <div class="sidebar-item logout-item"><i class='bx bx-log-out'></i> <a href="../login&register/login.php">Log Out</a></div>
    </div>

  <div class="main-content">

    <div class="profile-section">
      <img src="./img/<?= htmlspecialchars($profileImage) ?>" alt="Profile" class="profile-pic" />
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
