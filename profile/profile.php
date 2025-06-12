<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login/login.php");
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
$profile_image = $_SESSION['profile_image'] ?? '';

// Cek apakah profile_image valid dan file-nya ada
if (!empty($profile_image) && file_exists("../uploads/profile_pictures/" . $profile_image)) {
    $profile_image_path = "../uploads/profile_pictures/" . $profile_image;
} else {
    $profile_image_path = "img/default.jpg";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SKEMA - User Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="profile.css" />
  
</head>
<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #523336;
      min-height: 100vh;
      color: white;
    }

    .header {
      padding: 2px 130px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 1000;
      background: transparent;
    }

    .logo {
      font-family: "Rammetto One", sans-serif;
      font-size: 40px;
      color: white;
      letter-spacing: 8px;
    }

    .logo .m {
      color: #E94560;
    }

    .home-btn {
      background: #E94560;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      font-size: 14px;
      transition: background 0.3s ease;
    }

    .home-btn:hover {
      background: #FF4081;
    }

    .menu-toggle {
      background: #E94560;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      font-size: 14px;
      display: none;
      transition: background 0.3s ease;
    }

    .menu-toggle:hover {
      background: #FF4081;
    }

    .container {
      margin-top: 10px;
      display: flex;
      flex-direction: row;
      max-width: 1324px;
      margin-left: auto;
      margin-right: auto;
      background: #421720;
      border-radius: 15px;
      height: 650px;
      overflow: hidden;
      flex-wrap: wrap;
    }

    .sidebar {
      background: white;
      width: 250px;
      min-height: 100vh;
      text-align: left;
      color: #333;
      display: flex;
      flex-direction: column;
      padding: 25px 30px 20px;
      box-sizing: border-box;
    }

    .sidebar h2 {
      font-size: 25px;
      font-weight: 700;
      margin: 0 0 25px 0;
      color: #421720;
      text-align: center;
    }

    .sidebar-item {
      margin-bottom: 20px;
    }

    .sidebar-item a {
      display: flex;
      align-items: center;
      text-decoration: none;
      font-weight: 700;
      color: #421720;
      gap: 10px;
      transition: background 0.2s ease;
      padding: 10px 15px;
      border-radius: 10px;
    }

    .sidebar-item a:hover {
      background-color: #f9f1f1;
    }

    .sidebar-item.active a {
      background-color: #ffecf1;
    }

    .sidebar-item svg {
      flex-shrink: 0;
    }

    .mobile-home-item {
      display: none; /* Hidden on desktop */
    }

    .logout-item {
      margin-top: 320px;
      padding-top: 20px;
    }

    .main-content {
      flex: 1;
      padding: 40px;
      padding-left: 200px;
    }

    .profile-header {
      display: flex;
      align-items: center;
      gap: 30px;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }

    .profile-image {
      width: 170px;
      height: 170px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid rgba(255, 255, 255, 0.2);
    }

    .profile-info {
      flex: 1;
      padding-left: 60px;
    }

    .profile-info h1 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 8px;
      color: white;
    }

    .profile-info p {
      font-size: 16px;
      opacity: 0.8;
      margin-bottom: 20px;
    }

    .button-group {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }

    .update-btn, .delete-photo-btn {
      background: white;
      color: #421720;
      padding: 10px 20px;
      border: none;
      border-radius: 25px;
      font-weight: 600;
      cursor: pointer;
      font-size: 14px;
      transition: background 0.3s ease;
    }

    .update-btn:hover, .delete-photo-btn:hover {
      background: #f0f0f0;
    }

    .profile-fields {
      margin-top: 40px;
      margin-left: -50px;
    }

    .field-group {
      margin-bottom: 30px;
    }

    .field-label {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 15px;
      color: white;
    }

    .field-value {
      font-size: 18px;
      color: white;
      padding-bottom: 20px;
      border-bottom: 3px solid white;
      font-weight: 400;
      max-width: 650px;
    }

    /* Overlay background */
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      z-index: 99;
    }

    /* Popup container */
    .popup-form {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 30px 25px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      width: 90%;
      max-width: 400px;
      z-index: 100;
      display: none;
      font-family: 'Segoe UI', sans-serif;
    }

    .popup-form h3 {
      margin-top: 0;
      margin-bottom: 20px;
      font-size: 22px;
      color: #421720;
      text-align: center;
    }

    .popup-form input[type="text"],
    .popup-form input[type="email"],
    .popup-form input[type="password"],
    .popup-form input[type="file"] {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      box-sizing: border-box;
    }

    .popup-form img#previewImage {
      display: block;
      margin: 10px auto 0;
      border-radius: 10px;
      object-fit: cover;
    }

    .popup-form button[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #421720;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .popup-form button[type="submit"]:hover {
      background-color: #5a2b2d;
    }

    /* RESPONSIVE MEDIA QUERIES */
    
    /* Tablet Portrait */
    @media screen and (max-width: 1024px) {
      .header {
        padding: 12px 50px;
      }
      
      .container {
        margin: 15px;
        max-width: none;
      }
      
      .main-content {
        padding: 30px;
        padding-left: 150px;
      }
      
      .profile-info {
        padding-left: 40px;
      }
      
      .profile-fields {
        margin-left: -30px;
      }
    }

    /* Mobile Landscape */
    @media screen and (max-width: 768px) {
      .header {
        padding: 12px 20px;
      }
      
      .logo {
        font-size: 28px;
        letter-spacing: 4px;
      }
      
      .home-btn {
        display: none;
      }
      
      .menu-toggle {
        display: block;
        margin-left: 190px;

      }
      
      .container {
        margin: 10px;
        flex-direction: column;
        height: auto;
        min-height: auto;
      }
      
      .sidebar {
        width: 100%;
        min-height: auto;
        position: fixed;
        top: 0;
        left: -100%;
        height: 100vh;
        z-index: 1001;
        transition: left 0.3s ease;
        overflow-y: auto;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      }
      
      .sidebar.active {
        left: 0;
      }
      
      .sidebar .logout-item {
        margin-top: 50px;
      }
      
      .sidebar .mobile-home-item {
        display: block; /* Show on mobile */
        order: -1; /* Put at the top */
      }
      
      .main-content {
        width: 100%;
        padding: 20px;
        padding-left: 20px;
      }
      
      .profile-header {
        flex-direction: column;
        text-align: center;
        gap: 20px;
        background: rgba(255, 255, 255, 0.08);
        padding: 25px 20px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      }
      
      .profile-image {
        width: 120px;
        height: 120px;
        border: 3px solid rgba(255, 255, 255, 0.3);
      }
      
      .profile-info {
        padding-left: 0;
        text-align: center;
      }
      
      .profile-info h1 {
        font-size: 28px;
        margin-bottom: 12px;
      }
      
      .profile-info p {
        font-size: 15px;
        margin-bottom: 25px;
        opacity: 0.9;
      }
      
      .button-group {
        justify-content: center;
        gap: 12px;
      }
      
      .update-btn, .delete-photo-btn {
        padding: 12px 24px;
        font-size: 14px;
        min-width: 120px;
      }
      
      .profile-fields {
        background: rgba(255, 255, 255, 0.08);
        padding: 25px 20px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        margin-left: 0;
        margin-top: 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      }
      
      .field-group {
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
      }

      .field-group:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
      }

      .field-label {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
      }

      .field-value {
        font-size: 16px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        max-width: 100%;
        padding-bottom: 12px;
      }
      
      .popup-form {
        width: 95%;
        max-width: 350px;
        padding: 25px 20px;
      }
    }

    /* Mobile Portrait */
    @media screen and (max-width: 480px) {
      .header {
        padding: 10px 15px;
      }
      
      .logo {
        font-size: 24px;
        letter-spacing: 2px;
      }
      
      .container {
        margin: 8px;
        border-radius: 12px;
      }
      
      .main-content {
        padding: 15px;
      }
      
      .profile-header {
        padding: 20px 15px;
        gap: 15px;
        margin-bottom: 20px;
      }
      
      .profile-image {
        width: 100px;
        height: 100px;
        border-width: 2px;
      }
      
      .profile-info h1 {
        font-size: 24px;
        margin-bottom: 8px;
      }
      
      .profile-info p {
        font-size: 14px;
        margin-bottom: 20px;
      }
      
      .button-group {
        gap: 10px;
        flex-direction: column;
        width: 100%;
      }
      
      .update-btn, .delete-photo-btn {
        width: 100%;
        padding: 12px 20px;
        font-size: 13px;
        min-width: auto;
      }
      
      .profile-fields {
        padding: 20px 15px;
      }
      
      .field-group {
        margin-bottom: 20px;
        padding-bottom: 15px;
      }
      
      .field-label {
        font-size: 12px;
        margin-bottom: 8px;
      }
      
      .field-value {
        font-size: 15px;
        padding-bottom: 10px;
      }
      
      .sidebar {
        width: 100%;
        padding: 20px 25px;
      }
      
      .sidebar h2 {
        font-size: 22px;
        margin-bottom: 20px;
      }
      
      .sidebar-item a {
        padding: 12px 15px;
        font-size: 15px;
      }
      
      .popup-form {
        width: 95%;
        max-width: 320px;
        padding: 20px 15px;
      }
      
      .popup-form h3 {
        font-size: 20px;
        margin-bottom: 18px;
      }
      
      .popup-form input {
        padding: 12px;
        font-size: 14px;
      }
    }

    /* Extra Small Mobile */
    @media screen and (max-width: 360px) {
      .logo {
        font-size: 20px;
        letter-spacing: 1px;
      }
      
      .profile-image {
        width: 80px;
        height: 80px;
      }
      
      .profile-info h1 {
        font-size: 20px;
      }
      
      .profile-info p {
        font-size: 13px;
      }
      
      .update-btn, .delete-photo-btn {
        font-size: 12px;
        padding: 10px 16px;
      }
      
      .field-value {
        font-size: 14px;
      }
      
      .popup-form {
        padding: 18px 12px;
      }
    }

    /* Overlay untuk mobile sidebar */
    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      display: none;
    }

    .sidebar-overlay.active {
      display: block;
    }

    /* Smooth transitions */
    .profile-header, .profile-fields {
      transition: all 0.3s ease;
    }

    .update-btn, .delete-photo-btn {
      transition: all 0.2s ease;
    }

    /* Touch-friendly button sizes for mobile */
    @media (hover: none) and (pointer: coarse) {
      .update-btn, .delete-photo-btn {
        min-height: 44px;
        min-width: 44px;
      }
      
      .sidebar-item a {
        min-height: 44px;
      }
    }
</style>
<body>
  <!-- Header -->
  <div class="header">
    <div class="logo">SKE<span class="m">MA</span></div>
    <button class="menu-toggle" onclick="toggleSidebar()">☰ Menu</button>
    <a href="../home/home.php"><button class="home-btn">Home</button></a>
  </div>

  <!-- Sidebar Overlay untuk Mobile -->
  <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

  <!-- Content -->
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <h2>User Profile</h2>

      <!-- Home Button - Only visible on mobile -->
      <div class="sidebar-item mobile-home-item">
        <a href="../home/home.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
            <path fill="#421720" d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
          </svg>
          <span>Home</span>
        </a>
      </div>

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

    <!-- Main Content -->
    <div class="main-content"> 
      <div class="profile-header">
        <img src="<?= htmlspecialchars($profile_image_path) ?>" alt="Profile Picture" class="profile-image">
        <div class="profile-info">
          <h1>ACCOUNT</h1>
          <p>Edit your name, password, email, image</p>
          <div class="button-group">
            <button class="update-btn" onclick="openPopup()">Edit Account</button>
            <form action="delete_photo.php" method="post" style="display:inline;">
              <button type="submit" class="delete-photo-btn" onclick="return confirm('Yakin hapus foto profil?')">Hapus Foto</button>
            </form>
          </div>
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
  </div>

  <!-- Popup Form -->
  <div class="overlay" id="overlay" onclick="closePopup()"></div>
  <div class="popup-form" id="popupForm">
    <form action="update_profile.php" method="post" enctype="multipart/form-data">
      <h3>Edit Profil</h3>
      <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($username) ?>" required>
      <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($email) ?>" required>
      <input type="password" name="password" placeholder="Password (biarkan kosong jika tidak ganti)">
      <input type="file" name="profile_image" accept="image/*" onchange="previewImage(event)">
      <img id="previewImage" src="#" style="display:none; width:100px; margin-top:10px;" />
      <button type="submit">Simpan</button>
    </form>
  </div>

  <script>
    function openPopup() {
      document.getElementById("popupForm").style.display = "block";
      document.getElementById("overlay").style.display = "block";
      document.body.style.overflow = "hidden";
    }

    function closePopup() {
      document.getElementById("popupForm").style.display = "none";
      document.getElementById("overlay").style.display = "none";
      document.body.style.overflow = "auto";
    }

    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function () {
        const output = document.getElementById("previewImage");
        output.src = reader.result;
        output.style.display = "block";
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const overlay = document.getElementById("sidebarOverlay");
      
      sidebar.classList.toggle("active");
      overlay.classList.toggle("active");
      
      if (sidebar.classList.contains("active")) {
        document.body.style.overflow = "hidden";
      } else {
        document.body.style.overflow = "auto";
      }
    }

    function closeSidebar() {
      const sidebar = document.getElementById("sidebar");
      const overlay = document.getElementById("sidebarOverlay");
      
      sidebar.classList.remove("active");
      overlay.classList.remove("active");
      document.body.style.overflow = "auto";
    }

    // Close sidebar when clicking on main content in mobile
    document.addEventListener('click', function(event) {
      const sidebar = document.getElementById("sidebar");
      const menuToggle = document.querySelector(".menu-toggle");
      
      if (window.innerWidth <= 768 && 
          sidebar.classList.contains("active") && 
          !sidebar.contains(event.target) && 
          !menuToggle.contains(event.target)) {
        closeSidebar();
      }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
      if (window.innerWidth > 768) {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");
        
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
        document.body.style.overflow = "auto";
      }
    });
  </script>
</body>
</html>