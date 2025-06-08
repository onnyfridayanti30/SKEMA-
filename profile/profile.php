<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKEMA - User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
    <link href='https://cdn.boxicons.com/fonts/brands/boxicons-brands.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="profile.css">
</head>


<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">
                SKE<span class="m">MA</span>
            </div>
        <button class="home-btn" onclick="goHome()">Home</button>
    </div>


        <!-- Main Content -->
        <div class="main-content">

         <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>User Profile</h2>
            
            <div class="sidebar-item active" onclick="showUserInfo()">
               <i class='bx  bx-user'></i> 
                User Info
            </div>
            
            <div class="sidebar-item" onclick="showFavorites()">
               
                Favorites
            </div>
            
            <div class="sidebar-item logout-item" onclick="logout()">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                </svg>
                Log Out
            </div>
        </div>
            <!-- User Info Section -->
            <div id="userInfo" class="content-section">
                <div class="profile-header">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=face" 
                         alt="Profile" class="profile-image">
                    <div class="profile-info">
                        <h1>ACCOUNT</h1>
                        <p>Edit your name, password, email, image</p>
                        <button class="update-btn" >Update Data</button>
                    </div>
                </div>

                <div id="alert" class="alert"></div>

                <div class="profile-fields">
                    <div class="field-group">
                        <div class="field-label">Email</div>
                        <div class="field-value" id="userEmail"></div>
                    </div>

                    <div class="field-group">
                        <div class="field-label">Username</div>
                        <div class="field-value" id="userUsername"></div>
                    </div>

                    <div class="field-group">
                        <div class="field-label">Password</div>
                        <div class="field-value" id="userPassword">••••••••••••</div>
                    </div>
                </div>
            </div>
</body>
</html>