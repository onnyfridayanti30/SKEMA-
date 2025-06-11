<?php
// Menginclude file koneksi database
include 'koneksidetail.php';

// Mengambil parameter 'id' dari URL menggunakan GET, jika tidak ada akan null
$id_film = $_GET['id'] ?? null;

// Cek apakah ID film ada
if ($id_film) {
    // Query untuk mengambil data film berdasarkan ID dengan prepared statement (mencegah SQL injection)
    $query = "SELECT * FROM detail WHERE id_film = ?";
    $stmt = $koneksi->prepare($query);
    // Bind parameter ID sebagai integer
    $stmt->bind_param("i", $id_film);
    // Eksekusi query
    $stmt->execute();
    // Ambil hasil query
    $result = $stmt->get_result();
    // Konversi hasil ke array associative
    $data = $result->fetch_assoc();

    // Cek apakah data ditemukan
    if (!$data) {
        echo "Data dengan ID $id_film tidak ditemukan di database.";
        exit; // Hentikan eksekusi script
    }
} else {
    // Jika ID tidak ada di URL
    echo "ID tidak ditemukan di URL.";
    exit; // Hentikan eksekusi script
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Meta viewport untuk responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Film</title>
    <!-- Link ke Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Link ke Google Fonts untuk font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Link ke file CSS eksternal -->
    <link rel="stylesheet" href="detail.css">
    <style>
        /* Placeholder untuk CSS internal jika diperlukan */
    </style>
</head>
<body>

<!-- Header section dengan tombol back dan poster -->
<div class="header">
    <!-- Tombol back ke halaman home -->
    <a href="../home/home.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
    <!-- Menampilkan poster film, dengan fallback ke default.jpg jika tidak ada -->
    <img src="./uploads/poster/<?php echo htmlspecialchars($data['poster'] ?? 'default.jpg'); ?>" alt="Poster">
</div>

<!-- Layout untuk Desktop -->
<div class="content">
    <!-- Kolom kiri berisi gambar dan tombol -->
    <div class="left-column">
        <!-- Gambar portrait film -->
        <img class="portrait" src="./uploads/gambar/<?php echo htmlspecialchars($data['gambar'] ?? 'default.jpg'); ?>" alt="Gambar Film">
        <!-- Group tombol watch dan love -->
        <div class="button-group">
            <!-- Tombol watch now yang membuka link di tab baru -->
            <a href="<?php echo htmlspecialchars($data['link'] ?? '#'); ?>" class="watch-button" target="_blank">▶ Watch Now</a>
            <!-- Tombol love untuk desktop -->
            <button type="button" class="love-circle" id="desktopLoveBtn"><i class="fas fa-heart"></i></button>
        </div>
    </div>

    <!-- Kolom kanan berisi informasi detail film -->
    <div class="right-column">
        <!-- Sinopsis film -->
        <p><?php echo htmlspecialchars($data['sinopsis'] ?? 'Sinopsis tidak tersedia'); ?></p>
        <!-- Informasi actor -->
        <strong>Actor:</strong>
        <p><?php echo htmlspecialchars($data['actor'] ?? 'Informasi actor tidak tersedia'); ?></p>
        <!-- Informasi director -->
        <strong>Director:</strong>
        <p><?php echo htmlspecialchars($data['direktor'] ?? 'Informasi director tidak tersedia'); ?></p>
        <!-- Informasi durasi -->
        <strong>Duration:</strong>
        <p><?php echo htmlspecialchars($data['duration'] ?? 'Informasi durasi tidak tersedia'); ?></p>
    </div>
</div>

<!-- Layout untuk Mobile -->
<div class="mobile-content">
    <!-- Header mobile dengan gambar dan tombol -->
    <div class="mobile-header">
        <!-- Gambar portrait untuk mobile -->
        <img class="mobile-portrait" src="./uploads/gambar/<?php echo htmlspecialchars($data['gambar'] ?? 'default.jpg'); ?>" alt="Gambar Film">
        <!-- Group tombol untuk mobile -->
        <div class="mobile-button-group">
            <!-- Tombol watch yang memanggil fungsi JavaScript -->
            <button onclick="openYouTube('<?php echo addslashes($data['link'] ?? '#'); ?>')" class="mobile-watch-button">
                <i class="fas fa-play"></i> Watch Now
            </button>
            <!-- Tombol love untuk mobile -->
            <button type="button" class="mobile-love-circle" id="mobileLoveBtn"><i class="fas fa-heart"></i></button>
        </div>
    </div>

    <!-- Konten teks untuk mobile -->
    <div class="mobile-text-content">
        <!-- Section sinopsis -->
        <div class="info-section">
            <p><?php echo htmlspecialchars($data['sinopsis'] ?? 'Sinopsis tidak tersedia'); ?></p>
        </div>

        <!-- Section actor -->
        <div class="info-section">
            <strong>Actor:</strong>
            <p><?php echo htmlspecialchars($data['actor'] ?? 'Informasi actor tidak tersedia'); ?></p>
        </div>

        <!-- Section director -->
        <div class="info-section">
            <strong>Director:</strong>
            <p><?php echo htmlspecialchars($data['direktor'] ?? 'Informasi director tidak tersedia'); ?></p>
        </div>

        <!-- Section duration -->
        <div class="info-section">
            <strong>Duration:</strong>
            <p><?php echo htmlspecialchars($data['duration'] ?? 'Informasi durasi tidak tersedia'); ?></p>
        </div>
    </div>
</div>

<script>
// Fungsi untuk membuka YouTube dengan deteksi device
function openYouTube(link) {
    // Cek apakah link valid
    if (!link || link === '#') return;
    
    let finalLink = link;
    // Konversi youtu.be ke format youtube.com
    if (link.includes('youtu.be/')) {
        const videoId = link.split('youtu.be/')[1].split('?')[0];
        finalLink = `https://www.youtube.com/watch?v=${videoId}`;
    }
    
    // Deteksi apakah device mobile
    if (/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        // Untuk mobile: buka di tab yang sama
        window.location.href = finalLink;
    } else {
        // Untuk desktop: buka di tab baru
        window.open(finalLink, '_blank');
    }
}

// Event listener saat DOM sudah loaded
document.addEventListener('DOMContentLoaded', function () {
    // Ambil referensi tombol love desktop dan mobile
    const desktopLoveButton = document.querySelector('#desktopLoveBtn');
    const mobileLoveButton = document.querySelector('#mobileLoveBtn');

    // Fungsi untuk sinkronisasi status love dari localStorage
    function syncLoveStatus() {
        const isLoved = localStorage.getItem('movie_loved_id') === 'true';
        if (isLoved) {
            // Tambahkan class 'loved' jika film disukai
            if (desktopLoveButton) desktopLoveButton.classList.add('loved');
            if (mobileLoveButton) mobileLoveButton.classList.add('loved');
        }
    }

    // Fungsi untuk menyimpan status love ke localStorage
    function saveLoveStatus(isLoved) {
        localStorage.setItem('movie_loved_id', isLoved);
    }

    // Sinkronisasi status saat halaman dimuat
    syncLoveStatus();

    // Event listener untuk tombol love desktop
    if (desktopLoveButton) {
        desktopLoveButton.addEventListener('click', function () {
            // Toggle class 'loved'
            this.classList.toggle('loved');
            const isLoved = this.classList.contains('loved');
            // Simpan status ke localStorage
            saveLoveStatus(isLoved);
            // Sinkronisasi dengan tombol mobile
            if (mobileLoveButton) mobileLoveButton.classList.toggle('loved', isLoved);
        });
    }

    // Event listener untuk tombol love mobile
    if (mobileLoveButton) {
        mobileLoveButton.addEventListener('click', function () {
            // Toggle class 'loved'
            this.classList.toggle('loved');
            const isLoved = this.classList.contains('loved');
            // Simpan status ke localStorage
            saveLoveStatus(isLoved);
            // Sinkronisasi dengan tombol desktop
            if (desktopLoveButton) desktopLoveButton.classList.toggle('loved', isLoved);
        });
    }
});
</script>

</body>
</html>