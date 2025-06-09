<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SKEMA - Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>


<div class="header">
    <div class="logo">SKE<span class="m">MA</span></div>
    <a href="../home/home.php"><button class="home-btn">Home</button></a>
</div>
   

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
            <div class="welcome-user">
                <div class="dashboard-header">
                    <h2 class="dashboard-title">DASHBOARD</h2>
                    <div class="welcome-card">
                        <div class="welcome-text">Welcome Back!!</div>
                        <div class="admin-name">Admin onny</div>
                    </div>
                 </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">80</div>
                        <div class="stat-label">Total Film</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">1,100</div>
                        <div class="stat-label">Users</div>
                    </div>
                </div>
            </div>



            <div class="film-section">
                <div class="film-latest">
                    <div class="section-title">Film Terbaru</div>
                    <div class="film-list">
                        <div class="film-item">
                            <div class="film-poster">SUARA LUKISAN</div>
                            <div class="film-info">
                                <h4>Suara Lukisan</h4>
                                <p>• Ditambahkan 2 hari yang lalu</p>
                            </div>
                        </div>
                        <div class="film-item">
                            <div class="film-poster">SUARA LUKISAN</div>
                            <div class="film-info">
                                <h4>Suara Lukisan</h4>
                                <p>• Ditambahkan 2 hari yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="film-count-card">
                    <div class="big-number">8</div>
                    <div class="count-label">Film Terbaru<br>Bulan Ini</div>
                </div>
            </div>
        </div>
</div>

</body>
</html>
