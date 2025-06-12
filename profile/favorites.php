<?php
session_start(); 

require 'koneksi.php'; // 📂 Menghubungkan file koneksi ke database MySQL

if (!isset($_SESSION["user_id"])) { // 🔐 Cek apakah user sudah login
    header("Location: ../login&register/login.php"); // 🔄 Kalau belum login, arahkan ke halaman login
    exit(); // 🛑 Hentikan eksekusi script
}

// 🆔 Ambil data user dari session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? '';      // 👤 Username user (dari session)
$email = $_SESSION['email'] ?? '';            // 📧 Email user (dari session)
$profile_image = $_SESSION['profile_image'] ?? ''; // 🖼️ Nama file foto profil user (dari session)

// 🔁 Ambil ulang nama file foto profil langsung dari database
$sql = "SELECT profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($sql); // Siapkan perintah SQL
$stmt->bind_param("i", $user_id); // Isi parameter ID user
$stmt->execute(); // Jalankan query
$stmt->bind_result($profile_image_db); // Simpan hasil ke variabel
$stmt->fetch(); // Ambil hasilnya
$stmt->close(); // Tutup statement

// 🧠 Tentukan foto profil yang digunakan: kalau ada di DB, pakai; kalau nggak, pakai yang di session
$final_profile_image = !empty($profile_image_db) ? $profile_image_db : $profile_image;

// 📍 Tentukan path lengkap ke file foto profil
$profile_image_path = (!empty($final_profile_image) && file_exists("../uploads/profile_pictures/" . $final_profile_image))
    ? "../uploads/profile_pictures/" . $final_profile_image // Jika file ada, pakai ini
    : "./img/default.jpg"; // Jika tidak ada file-nya, pakai gambar default

// 🎬 Ambil daftar film favorit user
$sql = "SELECT d.id_film, d.judul, d.gambar
        FROM favorites f
        JOIN detail d ON f.detail_id = d.id_film
        WHERE f.user_id = ?";

$stmt = $conn->prepare($sql); // Siapkan query join antara tabel favorites dan detail
$stmt->bind_param("i", $user_id); // Isi parameter ID user
$stmt->execute(); // Jalankan query
$result = $stmt->get_result(); // Ambil hasil query

$favorites = []; // Siapkan array kosong untuk menyimpan data film favorit
while ($row = $result->fetch_assoc()) {
    $favorites[] = $row; // Tambahkan data film ke array
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SKEMA - Favorites</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="favorites.css">
</head>

<style>* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #523336;
    min-height: 100vh;
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
    height: 650px;
    margin-left: auto;
    margin-right: auto;
    background: #421720;
    border-radius: 15px;
    overflow: hidden;
}

.sidebar {
    background: white;
    width: 250px;
    min-height: 100%;
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
    transition: all 0.3s ease;
    padding: 10px 15px;
    border-radius: 10px;
}

.sidebar-item a:hover {
    background-color: #f9f1f1;
}

.sidebar-item.favorites-item a {
    background-color: #ffecf1;
}

.sidebar-item svg {
    flex-shrink: 0;
}

.logout-item {
    margin-top: 320px;
    padding-top: 20px;
}

.main-content {
    flex: 1;
    padding: 40px;
    padding-left: 50px;
}

.profile-section {
    display: flex;
    align-items: center;
    margin-top: 30px;
    color: white;
}

.profile-pic {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 20px;
    border: 4px solid rgba(255, 255, 255, 0.2);
}

.user-info h2 {
    margin: 0;
    font-size: 30px;
}

.fav-title {
    margin-top: 30px;
    font-size: 18px;
    font-weight: bold;
    color: white;
}

.favorites-carousel {
    display: flex;
    gap: 30px;
    margin-top: 20px;
    flex-wrap: wrap;
}

a {
    color: inherit;
    text-decoration: none;
}

.favorite-item {
    border-radius: 10px;
    overflow: hidden;
    width: 240px;
    color: white;
    text-align: center;
    transition: transform 0.3s ease;
}

.favorite-item:hover {
    transform: translateY(-5px);
}

.favorite-item img {
    width: 100%;
    height: 140px;
    object-fit: cover;
}

.favorite-item p {
    margin: 10px 0;
    font-weight: 600;
}

.no-favorites {
    color: white;
    text-align: center;
    padding: 40px;
    font-size: 16px;
}

/* Overlay for mobile menu */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

.overlay.active {
    display: block;
}

/* Close button for mobile sidebar */
.close-sidebar {
    position: absolute;
    top: 15px;
    right: 20px;
    background: none;
    border: none;
    font-size: 24px;
    color: #421720;
    cursor: pointer;
    display: none;
}

/* RESPONSIVE STYLES */
@media screen and (max-width: 768px) {

    
    .logo {
        font-size: 24px;
        letter-spacing: 4px;
    }
    
    .home-btn {
        display: none;
    }
    
    .menu-toggle {
        display: block;
    }
    
    .close-sidebar {
        display: block;
    }
    
    .container {
        margin: 10px;
        flex-direction: column;
        height: auto;
        min-height: auto;
    }
    
    .sidebar {
        width: 100%;
        position: fixed;
        top: 0;
        left: -100%;
        height: 100vh;
        z-index: 1000;
        transition: left 0.3s ease;
        background: white;
        overflow-y: auto;
    }
    
    .sidebar.active {
        left: 0;
    }
    
    .sidebar h2 {
        font-size: 20px;
        margin-top: 50px;
        margin-bottom: 30px;
    }
    
    .sidebar-item a {
        padding: 15px;
        font-size: 16px;
    }
    
    .logout-item {
        margin-top: 50px;
    }
    
    .main-content {
        padding: 20px;
        width: 100%;
    }
    
    .profile-section {
        flex-direction: column;
        text-align: center;
        margin-top: 20px;
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 15px;
    }
    
    .profile-pic {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .user-info h2 {
        font-size: 18px;
        margin-bottom: 5px;
    }
    
    .fav-title {
        font-size: 20px;
        text-align: center;
        margin-top: 25px;
    }
    
    .favorites-carousel {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    
    .favorite-item {
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 10px;
    }
    
    .favorite-item img {
        height: 180px;
        border-radius: 8px;
    }
    
    .favorite-item p {
        font-size: 13px;
        margin: 10px 0;
    }
}

/* Very small screens */
@media screen and (max-width: 480px) {
    .header {
        padding: 12px 15px;
      
    }
   .menu-toggle {
        float: right;
        margin-left: 210px; /* atau sesuaikan dengan posisi yang diinginkan */
    }

    .logo {
        font-size: 20px;
        letter-spacing: 2px;
    }
    
    .container {
        margin: 5px;
    }
    
    .main-content {
        padding: 15px;
    }
    
    .profile-section {
        padding: 15px;
    }
    
    .profile-pic {
        width: 80px;
        height: 80px;
    }
    
    .user-info h2 {
        font-size: 16px;
    }
    
    .fav-title {
        font-size: 18px;
    }
    
    .favorites-carousel {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    
    .favorite-item img {
        height: 160px;
    }
    
    .favorite-item p {
        font-size: 12px;
        margin: 8px 0;
    }
}

@media screen and (max-width: 360px) {
    .favorites-carousel {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .favorite-item img {
        height: 200px;
    }
}</style>

<body>

<div class="header">
    <div class="logo">SKE<span class="m">MA</span></div>
    <button class="menu-toggle" onclick="toggleSidebar()">☰ Menu</button>
    <a href="../home/home.php"><button class="home-btn">Home</button></a>
</div>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<div class="container">
    <div class="sidebar" id="sidebar">
        <button class="close-sidebar" onclick="closeSidebar()">✕</button>
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
            <img src="<?= htmlspecialchars($profile_image_path) ?>" alt="Profile" class="profile-pic" />
            <div class="user-info">
                <h2><?= htmlspecialchars($username) ?></h2>
                <p><?= htmlspecialchars($email) ?></p>
            </div>
        </div>

        <h3 class="fav-title">Favorites</h3>
        <hr>
        <div class="favorites-carousel">
            <?php if (!empty($favorites)) : ?>
                <?php foreach ($favorites as $film) : ?>
                    <div class="favorite-item">
                        <a href="../home/detail.php?id=<?= $film['id_film'] ?>">
                            <img src="../home/uploads/gambar/<?= htmlspecialchars($film['gambar']) ?>" alt="<?= htmlspecialchars($film['judul']) ?>">
                            <p><?= htmlspecialchars($film['judul']) ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="no-favorites">
                    <p>Belum ada film favorit yang ditambahkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function toggleSidebar(){
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
}

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
}

// Close sidebar when clicking on sidebar links
document.querySelectorAll('.sidebar-item a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            closeSidebar();
        }
    });
});

// Handle window resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        closeSidebar();
    }
});

// Prevent body scroll when sidebar is open
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                if (sidebar.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            }
        });
    });
    
    observer.observe(sidebar, { attributes: true });
});

</script>

</body>
</html>