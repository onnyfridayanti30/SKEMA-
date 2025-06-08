<?php
session_start();

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

// Ambil data user
$stmt = $conn->prepare("SELECT username, email, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $profileImage);
$stmt->fetch();
$stmt->close();
$conn->close();

// Gambar default jika tidak ada
if (empty($profileImage)) {
    $profileImage = "./img/default.jpg";
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
  <style>
    .profile-image {
      width: 170px;
      height: 170px;
      border-radius: 50%;
      object-fit: cover;
    }
    .popup-form {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
      z-index: 999;
    }
    .popup-form input {
      display: block;
      width: 100%;
      margin-bottom: 10px;
      padding: 8px;
    }
    .popup-form button {
      padding: 10px;
    }
    .overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.4);
      display: none;
      z-index: 998;
    }
    .delete-photo-btn {
      margin-top: 10px;
      background: #e53935;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <div class="header">
    <div class="logo">SKE<span class="m">MA</span></div>
    <a href="../home/home.php"><button class="home-btn">Home</button></a>
  </div>

  <!-- Content -->
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <h2>User Profile</h2>
      <div class="sidebar-item active"><i class='bx bx-user'></i> User Info</div>
      <div class="sidebar-item"><i class='bx bx-heart'></i><a href="favorites.php">Favorites</a ></div>
      <div class="sidebar-item logout-item"><i class='bx bx-log-out'></i> <a href="../login&register/login.php">Log Out</a></div>
    </div>

    <!-- Main Content -->
    <div class="main-content"> 
      <div class="profile-header">
        <img id="profilePreview" src="<?= htmlspecialchars($profileImage) ?>" alt="Profile" class="profile-image" />
        <div class="profile-info">
          <h1>ACCOUNT</h1>
          <p>Edit your name, password, email, image</p>
          <button class="update-btn" onclick="openPopup()">Edit Account</button>
          <form action="delete_photo.php" method="post" style="display:inline;">
            <button type="submit" class="delete-photo-btn" onclick="return confirm('Yakin hapus foto profil?')">Hapus Foto</button>
          </form>
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
    }

    function closePopup() {
      document.getElementById("popupForm").style.display = "none";
      document.getElementById("overlay").style.display = "none";
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
  </script>
</body>
</html>
