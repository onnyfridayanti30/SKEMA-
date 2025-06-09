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
$stmt = $conn->prepare("SELECT username, email, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $profile_image);
$stmt->fetch();
$stmt->close();
$conn->close();

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
