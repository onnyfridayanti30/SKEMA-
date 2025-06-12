<?php
// Menginclude file koneksi database untuk mendapatkan variabel $koneksi
include 'koneksidetail.php';

// Mengambil parameter 'id' dari URL menggunakan superglobal $_GET
// Operator null coalescing (??) memberikan nilai null jika 'id' tidak ada
$id_film = $_GET['id'] ?? null;

// Cek apakah variabel $id_film memiliki nilai (tidak null atau empty)
if ($id_film) {
    // Membuat query SQL dengan prepared statement untuk keamanan
    // Tanda ? adalah placeholder untuk parameter yang akan di-bind
    $query = "SELECT * FROM detail WHERE id_film = ?";
    
    // Mempersiapkan statement SQL menggunakan koneksi database
    $stmt = $koneksi->prepare($query);
    
    // Bind parameter ke placeholder, "i" berarti integer
    // Parameter pertama adalah tipe data, parameter kedua adalah nilai
    $stmt->bind_param("i", $id_film);
    
    // Menjalankan/eksekusi query yang sudah disiapkan
    $stmt->execute();
    
    // Mengambil hasil dari query yang telah dieksekusi
    $result = $stmt->get_result();
    
    // Mengkonversi hasil query menjadi array associative
    // fetch_assoc() mengambil satu baris data sebagai array
    $data = $result->fetch_assoc();

    // Mengecek apakah data ditemukan dalam database
    if (!$data) {
        // Jika data tidak ditemukan, tampilkan pesan error
        echo "Data dengan ID $id_film tidak ditemukan di database.";
        // Menghentikan eksekusi script PHP
        exit;
    }
} else {
    // Jika parameter 'id' tidak ada dalam URL
    echo "ID tidak ditemukan di URL.";
    // Menghentikan eksekusi script PHP
    exit;
}
?>

<!DOCTYPE html>
<!-- Deklarasi dokumen HTML5 -->
<html lang="id">
<!-- Tag pembuka HTML dengan bahasa Indonesia -->
<head>
    <!-- Pengaturan karakter encoding UTF-8 untuk mendukung karakter khusus -->
    <meta charset="UTF-8">
    
    <!-- Meta tag untuk responsive design, mengatur viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Judul halaman yang muncul di tab browser -->
    <title>Detail Film</title>
    
    <!-- Link ke library Font Awesome untuk menggunakan ikon-ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Link ke Google Fonts untuk menggunakan font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Link ke file CSS eksternal untuk styling -->
    <link rel="stylesheet" href="detail.css">
    
    <!-- Tag style untuk CSS internal jika diperlukan -->
    <style>
        /* Placeholder untuk CSS internal jika diperlukan */
    </style>
</head>
<body>
<!-- Tag pembuka body, tempat konten utama halaman -->

<!-- Header section yang berisi tombol back dan poster film -->
<div class="header">
    <!-- Link tombol back yang mengarah ke halaman home -->
    <!-- Class "back-button" untuk styling CSS -->
    <a href="../home/home.php" class="back-button">
        <!-- Ikon panah kiri dari Font Awesome -->
        <i class="fas fa-arrow-left"></i>
    </a>
    
    <!-- Gambar poster film -->
    <img src="./uploads/poster/<?php echo htmlspecialchars($data['poster'] ?? 'default.jpg'); ?>" alt="Poster">
    <!-- htmlspecialchars() mencegah XSS attack dengan mengkonversi karakter khusus -->
    <!-- Operator ?? memberikan nilai default 'default.jpg' jika poster kosong -->
</div>

<!-- Layout utama untuk tampilan Desktop -->
<div class="content">
    <!-- Kolom kiri yang berisi gambar dan tombol-tombol -->
    <div class="left-column">
        <!-- Gambar portrait/potret film -->
        <img class="portrait" src="./uploads/gambar/<?php echo htmlspecialchars($data['gambar'] ?? 'default.jpg'); ?>" alt="Gambar Film">
        <!-- htmlspecialchars() untuk keamanan, ?? untuk fallback image -->
        
        <!-- Grup tombol yang berisi watch dan love button -->
        <div class="button-group">
            <!-- Tombol "Watch Now" yang membuka link film di tab baru -->
            <a href="<?php echo htmlspecialchars($data['link'] ?? '#'); ?>" class="watch-button" target="_blank">
                <!-- Simbol play dan teks tombol -->
                ▶ Watch Now
            </a>
            <!-- htmlspecialchars() untuk keamanan, target="_blank" membuka tab baru -->
            
            <!-- Tombol love berbentuk lingkaran untuk desktop -->
            <button type="button" class="love-circle" id="desktopLoveBtn">
                <!-- Ikon heart dari Font Awesome -->
                <i class="fas fa-heart"></i>
            </button>
            <!-- type="button" mencegah form submission, id untuk JavaScript -->
        </div>
    </div>

    <!-- Kolom kanan yang berisi informasi detail film -->
    <div class="right-column">
        <!-- Paragraf untuk menampilkan sinopsis film -->
        <p><?php echo htmlspecialchars($data['sinopsis'] ?? 'Sinopsis tidak tersedia'); ?></p>
        <!-- htmlspecialchars() untuk keamanan, ?? untuk teks default -->
        
        <!-- Label dan informasi actor -->
        <strong>Actor:</strong>
        <p><?php echo htmlspecialchars($data['actor'] ?? 'Informasi actor tidak tersedia'); ?></p>
        
        <!-- Label dan informasi director -->
        <strong>Director:</strong>
        <p><?php echo htmlspecialchars($data['direktor'] ?? 'Informasi director tidak tersedia'); ?></p>
        
        <!-- Label dan informasi durasi film -->
        <strong>Duration:</strong>
        <p><?php echo htmlspecialchars($data['duration'] ?? 'Informasi durasi tidak tersedia'); ?></p>
    </div>
</div>

<!-- Layout khusus untuk tampilan Mobile -->
<div class="mobile-content">
    <!-- Header mobile yang berisi gambar dan tombol -->
    <div class="mobile-header">
        <!-- Gambar portrait untuk tampilan mobile -->
        <img class="mobile-portrait" src="./uploads/gambar/<?php echo htmlspecialchars($data['gambar'] ?? 'default.jpg'); ?>" alt="Gambar Film">
        
        <!-- Grup tombol khusus untuk mobile -->
        <div class="mobile-button-group">
            <!-- Tombol watch yang memanggil fungsi JavaScript -->
            <button onclick="openYouTube('<?php echo addslashes($data['link'] ?? '#'); ?>')" class="mobile-watch-button">
                <!-- Ikon play dan teks tombol -->
                <i class="fas fa-play"></i> Watch Now
            </button>
            <!-- onclick memanggil fungsi JS, addslashes() menambah escape untuk quote -->
            
            <!-- Tombol love untuk mobile -->
            <button type="button" class="mobile-love-circle" id="mobileLoveBtn">
                <i class="fas fa-heart"></i>
            </button>
        </div>
    </div>

    <!-- Konten teks untuk tampilan mobile -->
    <div class="mobile-text-content">
        <!-- Section untuk sinopsis -->
        <div class="info-section">
            <p><?php echo htmlspecialchars($data['sinopsis'] ?? 'Sinopsis tidak tersedia'); ?></p>
        </div>

        <!-- Section untuk informasi actor -->
        <div class="info-section">
            <strong>Actor:</strong>
            <p><?php echo htmlspecialchars($data['actor'] ?? 'Informasi actor tidak tersedia'); ?></p>
        </div>

        <!-- Section untuk informasi director -->
        <div class="info-section">
            <strong>Director:</strong>
            <p><?php echo htmlspecialchars($data['direktor'] ?? 'Informasi director tidak tersedia'); ?></p>
        </div>

        <!-- Section untuk informasi durasi -->
        <div class="info-section">
            <strong>Duration:</strong>
            <p><?php echo htmlspecialchars($data['duration'] ?? 'Informasi durasi tidak tersedia'); ?></p>
        </div>
    </div>
</div>

<script>
// Fungsi JavaScript untuk membuka YouTube dengan deteksi device
function openYouTube(link) {
    // Cek apakah link valid atau bukan '#'
    if (!link || link === '#') return;
    
    // Variabel untuk menyimpan link final
    let finalLink = link;
    
    // Konversi link youtu.be ke format youtube.com yang standar
    if (link.includes('youtu.be/')) {
        // Ekstrak video ID dari URL youtu.be
        const videoId = link.split('youtu.be/')[1].split('?')[0];
        // Buat URL YouTube standar
        finalLink = `https://www.youtube.com/watch?v=${videoId}`;
    }
    
    // Deteksi apakah user menggunakan device mobile
    if (/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        // Untuk mobile: buka di tab yang sama (redirect)
        window.location.href = finalLink;
    } else {
        // Untuk desktop: buka di tab baru
        window.open(finalLink, '_blank');
    }
}

document.getElementById('desktopLoveBtn').addEventListener('click', function () {
    const filmId = <?= json_encode($id_film) ?>;

    fetch('../profile/add_favorite.php/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `film_id=${filmId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Film berhasil ditambahkan ke favorit!');
        } else if (data.status === 'exists') {
            alert('Film ini sudah ada di daftar favorit kamu.');
        } else {
            alert('Gagal menambahkan ke favorit: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan.');
    });
});
</script>

</body>
<!-- Tag penutup body -->
</html>
<!-- Tag penutup HTML -->