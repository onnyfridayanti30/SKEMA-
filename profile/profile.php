<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SKEMA - User Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="profile.css" />
</head>

<body>
  <!-- Header -->
  <div class="header">
    <div class="logo">SKE<span class="m">MA</span></div>
    <button class="home-btn" onclick="goHome()">Home</button>
  </div>

  <!-- Content -->
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <h2>User Profile</h2>
      <div class="sidebar-item active"><i class='bx bx-user'></i> User Info</div>
      <div class="sidebar-item"><i class='bx bx-heart'></i> Favorites</div>
      <div class="sidebar-item logout-item"><i class='bx bx-log-out'></i> Log Out</div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="profile-header">
        <img src="./img/100_1740.jpg" alt="Profile" class="profile-image" />
        <div class="profile-info">
          <h1>ACCOUNT</h1>
          <p>Edit your name, password, email, image</p>
          <button class="update-btn">Update Data</button>
        </div>
      </div>

      <div class="profile-fields">
        <div class="field-group">
          <div class="field-label">Email</div>
          <div class="field-value" id="userEmail">onnyfridayanti@gmail.com</div>
        </div>

        <div class="field-group">
          <div class="field-label">Username</div>
          <div class="field-value" id="userUsername">onnykacau</div>
        </div>

        <div class="field-group">
          <div class="field-label">Password</div>
          <div class="field-value" id="userPassword">•••••••••••</div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
