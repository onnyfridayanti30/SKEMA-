<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKEMA - Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #8B4A6B 0%, #6B3549 100%);
            min-height: 100vh;
            color: white;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            right: 0;
            padding: 20px 40px;
            z-index: 100;
        }

        .home-btn {
            background: #E85A7A;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .home-btn:hover {
            background: #D64570;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(232, 90, 122, 0.3);
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px 0;
            border-radius: 0 20px 20px 0;
            margin: 20px 0 20px 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
            padding: 0 30px;
        }

        .logo h1 {
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .logo .highlight {
            color: #E85A7A;
        }

        .profile-section {
            background: rgba(255, 255, 255, 0.15);
            margin: 0 20px 30px 20px;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }

        .profile-section h3 {
            font-size: 1.1rem;
            color: #F5F5F5;
        }

        .menu {
            padding: 0 20px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            margin: 8px 0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #E0E0E0;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .menu-item.active {
            background: rgba(232, 90, 122, 0.3);
            color: white;
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            opacity: 0.8;
        }

        .logout {
            position: absolute;
            bottom: 30px;
            left: 20px;
            right: 20px;
        }

        .logout .menu-item {
            color: #FF6B6B;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 80px 40px 40px 40px;
        }

        .dashboard-header {
            margin-bottom: 40px;
        }

        .dashboard-title {
            font-size: 1.5rem;
            color: #E0E0E0;
            margin-bottom: 10px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .welcome-text {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            background: linear-gradient(45deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .admin-name {
            font-size: 2rem;
            color: #F5F5F5;
            font-weight: 600;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #E85A7A;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1rem;
            color: #C0C0C0;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Film Section */
        .film-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .film-latest {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #F5F5F5;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .film-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .film-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .film-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .film-poster {
            width: 60px;
            height: 80px;
            background: linear-gradient(45deg, #4A4A4A, #2A2A2A);
            border-radius: 8px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: #FFD700;
            font-weight: bold;
        }

        .film-info h4 {
            color: #F5F5F5;
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .film-info p {
            color: #B0B0B0;
            font-size: 0.9rem;
        }

        .film-count-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .big-number {
            font-size: 4rem;
            font-weight: bold;
            color: #E85A7A;
            margin-bottom: 15px;
        }

        .count-label {
            font-size: 1rem;
            color: #C0C0C0;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                border-radius: 0;
                margin: 0;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .film-section {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <button class="home-btn" onclick="goHome()">Home</button>
    </div>

    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <h1>SKE<span class="highlight">MA</span></h1>
            </div>
            
            <div class="profile-section">
                <h3>Admin Profile</h3>
            </div>
            
            <div class="menu">
                <div class="menu-item active">
                    <div class="menu-icon">📊</div>
                    <span>Dashboard</span>
                </div>
                <div class="menu-item">
                    <div class="menu-icon">🎬</div>
                    <span>Film</span>
                </div>
                <div class="menu-item">
                    <div class="menu-icon">👤</div>
                    <span>Account</span>
                </div>
            </div>
            
            <div class="logout">
                <div class="menu-item">
                    <div class="menu-icon">🚪</div>
                    <span>Log Out</span>
                </div>
            </div>
        </div>

        <div class="main-content">
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

    <script>
        // Menu interactions
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                menuItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Film item interactions
        const filmItems = document.querySelectorAll('.film-item');
        filmItems.forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Home button function
        function goHome() {
            alert('Navigating to Home...');
        }

        // Add loading animation effect
        window.addEventListener('load', function() {
            const cards = document.querySelectorAll('.stat-card, .welcome-card, .film-latest, .film-count-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Stat counter animation
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current).toLocaleString();
            }, 30);
        }

        // Initialize counter animations
        setTimeout(() => {
            animateCounter(document.querySelector('.stat-card:nth-child(1) .stat-number'), 80);
            animateCounter(document.querySelector('.stat-card:nth-child(2) .stat-number'), 1100);
            animateCounter(document.querySelector('.big-number'), 8);
        }, 500);
    </script>
</body>
</html>