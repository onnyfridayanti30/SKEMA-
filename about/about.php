<?php
// Membuka tag PHP untuk menulis kode server-side

// SKEMA Team - PHP array berisi data anggota tim
// Membuat array multidimensional untuk menyimpan data setiap anggota tim
$teamMembers = array(
    // Array (tempat untuk menyimpan data) pertama - data anggota tim pertama
    array(
        'name' => 'I Putu Mertayasa',                    // Nama lengkap anggota
        'class' => 'XI RPL 3 / 18',                     // Kelas dan nomor absen
        'username' => '__wrld.taa',                      // Username Instagram
        'instagram_url' => 'https://www.instagram.com/__wrld.taa?igsh=ZzVwajFzaHd2bDR3',  // URL lengkap Instagram
        'quote' => 'Lelah Ya Istirahat',                // Quote/motto personal
        'image' => 'merta.jpg'                           // Nama file foto profil
    ),
    // Array kedua - data anggota tim kedua
    array(
        'name' => 'Ni Komang Onny Fridayanti',          // Nama lengkap anggota kedua
        'class' => 'XI RPL 3 / 30',                     // Kelas dan nomor absen
        'username' => 'onnyfridayanti',                  // Username Instagram
        'instagram_url' => 'https://www.instagram.com/onnyfridayanti?igsh=MTlvbDF4a2doMmlkeQ==',  // URL Instagram
        'quote' => 'Kerja Cordas',                      // Quote personal (mungkin typo dari "Keras")
        'image' => 'oni.jpg'                             // Nama file foto profil
    ),
    // Array ketiga - data anggota tim ketiga
    array(
        'name' => 'Ni Nyoman Ayu Bunga Lestari',        // Nama lengkap anggota ketiga
        'class' => 'XI RPL 3 / 32',                     // Kelas dan nomor absen
        'username' => 'ayumg',                           // Username Instagram
        'instagram_url' => 'https://www.instagram.com/ayumg._?igsh=NTc1N2c2M2d3NDc4',  // URL Instagram
        'quote' => 'Life Goes On',                      // Quote personal dalam bahasa Inggris
        'image' => 'bunga.jpg'                           // Nama file foto profil
    )
);

// Variabel dinamis untuk judul dan deskripsi halaman
// Menyimpan teks yang akan ditampilkan di berbagai bagian halaman
$pageTitle = "SKEMA Team";                               // Judul halaman yang akan muncul di tab browser
$heroTitle = "what is a SKEMA?";                         // Judul utama di bagian hero
$heroDescription = "SKEMA atau Skensa Cinema, Web ini kami rancang sebagai wadah untuk menampung hasil karya film dari siswa siswi SKENSA serta membantu pengguna mempermudah mengakses film hasil karya dari siswa siswi SKENSA";  // Deskripsi panjang tentang SKEMA
?>
<!-- Menutup tag PHP dan mulai HTML -->
<!DOCTYPE html>
<!-- Deklarasi dokumen HTML5 -->
<html lang="id">
<!-- Tag HTML dengan atribut bahasa Indonesia -->
<head>
    <!-- Bagian head berisi metadata dan resource yang diperlukan -->
    <meta charset="UTF-8">
    <!-- Set encoding karakter ke UTF-8 untuk mendukung karakter Indonesia -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta viewport untuk responsive design di mobile -->
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <!-- Judul halaman menggunakan PHP variable dengan htmlspecialchars untuk keamanan -->
    
    <!-- Preconnect untuk optimasi loading Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- Membuat koneksi awal ke server Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Preconnect untuk subdomain gstatic dengan CORS -->
    
    <!-- Import font Poppins dengan berbagai weight -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font utama Poppins dari ringan (300) hingga bold (700) -->
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
    <!-- Font Rammetto One untuk aksen/logo -->
    
    <link rel="stylesheet" href="about.css">
    <!-- Link ke file CSS eksternal untuk styling -->
</head>
<body>
    <!-- Mulai body HTML -->
    <div class="container">
        <!-- Container utama untuk seluruh konten -->
        <nav class="nav">
            <!-- Navigation bar -->
            <div class="logo">SKE<span class="red">MA</span></div>
            <!-- Logo dengan "SKE" normal dan "MA" dengan class red (warna merah) -->
            <ul class="nav-links">
                <!-- Unordered list untuk menu navigasi -->
                <li><a href="../home/home.php">Home</a></li>
                <!-- Link ke halaman home (relatif path naik satu folder) -->
                <li><a href="#">About us</a></li>
                <!-- Link About us (href="#" berarti link kosong/current page) -->
                <li><a href="../profile/profile.php">Profile</a></li>
                <!-- Link ke halaman profile -->
            </ul>
        </nav>

        <div class="hero">
            <!-- Section hero/banner utama -->
            <h1><?php echo htmlspecialchars($heroTitle); ?></h1>
            <!-- Heading 1 menggunakan variable PHP heroTitle dengan sanitasi -->
            <p><?php echo htmlspecialchars($heroDescription); ?></p>
            <!-- Paragraf deskripsi menggunakan variable heroDescription dengan sanitasi -->
        </div>

        <h2 class="team-title">Our Team</h2>
        <!-- Heading 2 untuk judul section tim -->

        <?php foreach ($teamMembers as $index => $member) { ?>
        <!-- Loop PHP untuk mengulangi setiap anggota tim -->
        <!-- $index = urutan anggota (0,1,2...), $member = data anggota saat ini -->
        <div class="member">
            <!-- Container untuk setiap anggota tim -->
            <img src="<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
            <!-- Gambar profil anggota, src dari array image, alt dari array name -->
            <div class="member-card">
                <!-- Card/kotak informasi anggota -->
                <div class="member-info">
                    <!-- Container informasi detail anggota -->
                    <h3><?php echo htmlspecialchars($member['name']); ?></h3>
                    <!-- Heading 3 nama anggota dari array -->
                    <p class="class"><?php echo htmlspecialchars($member['class']); ?></p>
                    <!-- Paragraf kelas anggota dengan class CSS "class" -->
                    <p class="username">
                        <!-- Paragraf untuk username Instagram -->
                        <a href="<?php echo htmlspecialchars($member['instagram_url']); ?>" target="_blank" rel="noopener noreferrer">
                        <!-- Link Instagram: target="_blank" buka tab baru, rel untuk keamanan -->
                            @<?php echo htmlspecialchars($member['username']); ?>
                            <!-- Teks link dengan @ + username -->
                        </a>
                    </p>
                    <p class="quote">"<?php echo htmlspecialchars($member['quote']); ?>"</p>
                    <!-- Quote anggota dalam tanda kutip -->
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- Menutup loop foreach -->
    </div>
    <!-- Menutup container utama -->

    <footer class="footer">
        <!-- Footer/bagian bawah halaman -->
        <div class="container">
            <!-- Container untuk konten footer -->
            <div class="footer-content">
                <!-- Wrapper konten footer -->
                <div class="footer-logo">
                    <!-- Section logo di footer -->
                    <h2>SKE<span>MA</span></h2>
                    <!-- Logo footer dengan span untuk styling berbeda -->
                </div>
                <div class="footer-info">
                    <!-- Section informasi footer -->
                    <div class="footer-text">
                        <!-- Text footer kiri -->
                        <p>Dibuat oleh SKEMA Team</p>
                        <!-- Credit pembuat -->
                        <p>©Rekomendasi Film Skensa</p>
                        <!-- Copyright notice -->
                    </div>
                    <div class="contact-info">
                        <!-- Informasi kontak -->
                        <p>Contact Us:</p>
                        <!-- Label kontak -->
                        <p>skema18302@gmail.com</p>
                        <!-- Email kontak -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<!-- Menutup tag body -->
</html>
<!-- Menutup tag HTML -->