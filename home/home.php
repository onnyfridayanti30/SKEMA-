<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKEMA - Movie Platform</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo">
                SKE<span class="m">MA</span>
            </div>
            <nav class="nav">
                <a href="#" class="nav-link">Home</a>
                <a href="#" class="nav-link">About us</a>
                <a href="../profile/profile.php" class="nav-link">Profile</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-image">
                <img src="image/lawat.png" alt="Lawat Movie">
            </div>
            <div class="hero-text">
                <h2>Lawat</h2>
                <p>Pak Wayan yang merupakan seorang dalang wayang kulit yang ingin anaknya, melestarikan wayang. Namun, Agus lebih memilih musik modern, menyebabkan konflik dan pertengkaran terjadi</p>
                <button class="btn-detail">Lihat Detail</button>
            </div>
        </div>
    </section>

    <!-- Hot This Month Section -->
    <section class="hot-section">
        <div class="container-hot-section">
            <div class="section-header">
                <h3>Hot this month</h3>
             
            </div>
        </div>
    </section>

    <hr class="section-line">

    <!-- Movies Grid -->
    <div class="movies-grid">
        <?php
        include 'koneksi.php'; // pastikan file koneksi.php berisi koneksi ke MySQL

        $query = mysqli_query($conn, "SELECT * FROM detail");

        while ($movie = mysqli_fetch_assoc($query)) :
        ?>
            <div class="movie-card">
                <a href="detail.php?id=<?php echo $movie['id_film']; ?>">
                    <img src="./image/<?php echo htmlspecialchars($movie['poster']); ?>" alt="<?php echo htmlspecialchars($movie['judul']); ?>">
                    <h4><?php echo htmlspecialchars($movie['judul']); ?></h4>
                </a>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h2>SKE<span>MA</span></h2>
                </div>
                <div class="footer-info">
                    <div class="footer-text">
                        <p>Dibuat oleh SKEMA Team</p>
                        <p>©Rekomendasi Film Skensa</p>
                    </div>
                    <div class="contact-info">
                        <p>Contact Us:</p>
                        <p>skema18302@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
