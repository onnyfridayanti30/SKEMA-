<?php
// index.php

// Data film
$featured_movie = [
    'title' => 'Lawat',
    'description' => 'Pak Wayan yang merupakan seorang dalang wayang kulit yang ingin anaknya melestarikan wayang. Namun, Agus lebih memilih musik modern, menyebabkan konflik dan pertengkaran terjadi.'
];

$hot_movies = [
    ['title' => 'Lawat', 'genre' => 'Drama'],
    ['title' => 'Clarity', 'genre' => 'Romance'],
    ['title' => 'Suara Lukisan', 'genre' => 'Art'],
    ['title' => 'Harapan Harmoni', 'genre' => 'Music'],
    ['title' => 'Pulang Sekolah', 'genre' => 'Youth'],
    ['title' => 'Terehan', 'genre' => 'Action'],
    ['title' => 'Lensa Kanvas', 'genre' => 'Art'],
    ['title' => 'Bukumu Kala Itu', 'genre' => 'Romance']
];

// Warna gradient untuk poster
$gradients = [
    'linear-gradient(45deg, #8B4513, #D2691E)',
    'linear-gradient(45deg, #2c3e50, #3498db)',
    'linear-gradient(45deg, #8e44ad, #3498db)',
    'linear-gradient(45deg, #27ae60, #2ecc71)',
    'linear-gradient(45deg, #e74c3c, #c0392b)',
    'linear-gradient(45deg, #f39c12, #e67e22)',
    'linear-gradient(45deg, #1abc9c, #16a085)',
    'linear-gradient(45deg, #9b59b6, #8e44ad)'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKEMA - Platform Film Indonesia</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">SKE<span class="red">M</span>A</div>
        <nav class="nav">
            <a href="#home">Home</a>
            <a href="#about">About us</a>
            <a href="../profile/profile.php">Profile</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <div class="hero-poster">
                <div class="title"><?php echo $featured_movie['title']; ?></div>
            </div>
            <div class="hero-info">
                <h1><?php echo $featured_movie['title']; ?></h1>
                <p><?php echo $featured_movie['description']; ?></p>
                <button class="btn-detail" onclick="showDetail('<?php echo $featured_movie['title']; ?>')">
                    Lihat Detail
                </button>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section">
        <div class="search-container">
            <h2 class="section-title">Hot this month</h2>
            <div class="search-box">
                <input type="text" placeholder="Search movie" id="searchInput">
                <button class="search-btn" onclick="searchMovie()">🔍</button>
            </div>
        </div>
    </section>

    <!-- Movies Grid -->
    <section class="movies-section">
        <div class="movies-container">
            <div class="movies-grid" id="moviesGrid">
                <?php foreach ($hot_movies as $index => $movie): ?>
                    <div class="movie-card" onclick="showDetail('<?php echo $movie['title']; ?>')">
                        <div class="movie-poster" style="background: <?php echo $gradients[$index]; ?>">
                            <span style="z-index: 2;"><?php echo $movie['title']; ?></span>
                        </div>
                        <div class="movie-title"><?php echo $movie['title']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">SKE<span class="red">M</span>A</div>
            <div class="footer-info">
                <p>Dibuat oleh SKEMA Team</p>
                <p>©Rekomendasi Film Skensa</p>
                <p><strong>Contact Us:</strong></p>
                <p>skema183032@gmail.com</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>