<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKEMA - Movie Platform</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
    <script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
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
                <a href="../about/about.php" class="nav-link">About us</a>
                <a href="../profile/profile.php" class="nav-link">Profile</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-image">
                <img src="./uploads/gambar/lawat.png" alt="Lawat Movie">
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
                <h3>All Film</h3>
             
            </div>
        </div>
    </section>

    <hr class="section-line">

   
  <div class="movies-grid"> <!-- Container utama untuk grid film -->
    <?php
    include 'koneksi.php'; // Menyertakan file koneksi ke database (pastikan $conn sudah aktif)

    $query = mysqli_query($conn, "SELECT * FROM detail"); // Menjalankan query untuk mengambil semua data dari tabel 'detail'

    while ($movie = mysqli_fetch_assoc($query)) : // Melakukan loop untuk setiap baris hasil query
    ?>
        <div class="movie-card"> <!-- Satu kotak kartu untuk setiap film -->
            <a href="detail.php?id=<?php echo $movie['id_film']; ?>"> <!-- Link ke halaman detail.php dengan id film sebagai parameter -->
                <img src="./uploads/poster/<?php echo htmlspecialchars($movie['poster']); ?>" 
                     alt="<?php echo htmlspecialchars($movie['judul']); ?>"> <!-- Menampilkan poster film, aman dari XSS -->
                <h4><?php echo htmlspecialchars($movie['judul']); ?></h4> <!-- Menampilkan judul film -->
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
