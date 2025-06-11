<?php
include 'koneksidetail.php';

$id_film = $_GET['id'] ?? null;

if ($id_film) {
    $query = "SELECT * FROM detail WHERE id_film = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id_film);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Data dengan ID $id_film tidak ditemukan di database.";
        exit;
    }
} else {
    echo "ID tidak ditemukan di URL.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Film</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="detail.css">
    <style>
        /* ... Masukkan isi file style.css dari jawaban sebelumnya di sini ... */
    </style>
</head>
<body>

<div class="header">
    <a href="../home/home.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
    <img src="./uploads/poster/<?php echo htmlspecialchars($data['poster'] ?? 'default.jpg'); ?>" alt="Poster">
</div>

<!-- Desktop Layout -->
<div class="content">
    <div class="left-column">
        <img class="portrait" src="./uploads/gambar/<?php echo htmlspecialchars($data['gambar'] ?? 'default.jpg'); ?>" alt="Gambar Film">
        <div class="button-group">
            <a href="<?php echo htmlspecialchars($data['link'] ?? '#'); ?>" class="watch-button" target="_blank">▶ Watch Now</a>
            <button type="button" class="love-circle" id="desktopLoveBtn"><i class="fas fa-heart"></i></button>
        </div>
    </div>

    <div class="right-column">
        <p><?php echo htmlspecialchars($data['sinopsis'] ?? 'Sinopsis tidak tersedia'); ?></p>
        <strong>Actor:</strong>
        <p><?php echo htmlspecialchars($data['actor'] ?? 'Informasi actor tidak tersedia'); ?></p>
        <strong>Director:</strong>
        <p><?php echo htmlspecialchars($data['direktor'] ?? 'Informasi director tidak tersedia'); ?></p>
        <strong>Duration:</strong>
        <p><?php echo htmlspecialchars($data['duration'] ?? 'Informasi durasi tidak tersedia'); ?></p>
    </div>
</div>

<!-- Mobile Layout -->
<div class="mobile-content">
    <div class="mobile-header">
        <img class="mobile-portrait" src="./uploads/gambar/<?php echo htmlspecialchars($data['gambar'] ?? 'default.jpg'); ?>" alt="Gambar Film">
        <div class="mobile-button-group">
            <button onclick="openYouTube('<?php echo addslashes($data['link'] ?? '#'); ?>')" class="mobile-watch-button">
                <i class="fas fa-play"></i> Watch Now
            </button>
            <button type="button" class="mobile-love-circle" id="mobileLoveBtn"><i class="fas fa-heart"></i></button>
        </div>
    </div>

    <div class="mobile-text-content">
        <div class="info-section">
            <p><?php echo htmlspecialchars($data['sinopsis'] ?? 'Sinopsis tidak tersedia'); ?></p>
        </div>

        <div class="info-section">
            <strong>Actor:</strong>
            <p><?php echo htmlspecialchars($data['actor'] ?? 'Informasi actor tidak tersedia'); ?></p>
        </div>

        <div class="info-section">
            <strong>Director:</strong>
            <p><?php echo htmlspecialchars($data['direktor'] ?? 'Informasi director tidak tersedia'); ?></p>
        </div>

        <div class="info-section">
            <strong>Duration:</strong>
            <p><?php echo htmlspecialchars($data['duration'] ?? 'Informasi durasi tidak tersedia'); ?></p>
        </div>
    </div>
</div>

<script>
function openYouTube(link) {
    if (!link || link === '#') return;
    let finalLink = link;
    if (link.includes('youtu.be/')) {
        const videoId = link.split('youtu.be/')[1].split('?')[0];
        finalLink = `https://www.youtube.com/watch?v=${videoId}`;
    }
    if (/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        window.location.href = finalLink;
    } else {
        window.open(finalLink, '_blank');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const desktopLoveButton = document.querySelector('#desktopLoveBtn');
    const mobileLoveButton = document.querySelector('#mobileLoveBtn');

    function syncLoveStatus() {
        const isLoved = localStorage.getItem('movie_loved_id') === 'true';
        if (isLoved) {
            if (desktopLoveButton) desktopLoveButton.classList.add('loved');
            if (mobileLoveButton) mobileLoveButton.classList.add('loved');
        }
    }

    function saveLoveStatus(isLoved) {
        localStorage.setItem('movie_loved_id', isLoved);
    }

    syncLoveStatus();

    if (desktopLoveButton) {
        desktopLoveButton.addEventListener('click', function () {
            this.classList.toggle('loved');
            const isLoved = this.classList.contains('loved');
            saveLoveStatus(isLoved);
            if (mobileLoveButton) mobileLoveButton.classList.toggle('loved', isLoved);
        });
    }

    if (mobileLoveButton) {
        mobileLoveButton.addEventListener('click', function () {
            this.classList.toggle('loved');
            const isLoved = this.classList.contains('loved');
            saveLoveStatus(isLoved);
            if (desktopLoveButton) desktopLoveButton.classList.toggle('loved', isLoved);
        });
    }
});
</script>

</body>
</html>
