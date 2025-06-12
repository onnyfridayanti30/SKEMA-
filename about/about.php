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
                      // Nama file foto profil
    ),
    // Array kedua - data anggota tim kedua
    array(
        'name' => 'Ni Komang Onny Fridayanti',          // Nama lengkap anggota kedua
        'class' => 'XI RPL 3 / 30',                     // Kelas dan nomor absen
        'username' => 'onnyfridayanti',                  // Username Instagram
        'instagram_url' => 'https://www.instagram.com/onnyfridayanti?igsh=MTlvbDF4a2doMmlkeQ==',  // URL Instagram
        'quote' => 'Kerja Cordas',                      // Quote personal (mungkin typo dari "Keras")
                              // Nama file foto profil
    ),
    // Array ketiga - data anggota tim ketiga
    array(
        'name' => 'Ni Nyoman Ayu Bunga Lestari',        // Nama lengkap anggota ketiga
        'class' => 'XI RPL 3 / 32',                     // Kelas dan nomor absen
        'username' => 'ayumg',                           // Username Instagram
        'instagram_url' => 'https://www.instagram.com/ayumg._?igsh=NTc1N2c2M2d3NDc4',  // URL Instagram
        'quote' => 'Life Goes On',                      // Quote personal dalam bahasa Inggris
                             // Nama file foto profil
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

</head>

<style>/* Reset CSS universal - menghilangkan default styling browser */
* {
    margin: 0;               /* Hapus margin default semua elemen */
    padding: 0;              /* Hapus padding default semua elemen */
    box-sizing: border-box;  /* Border dan padding dihitung dalam total width/height */
}

/* Styling untuk body/elemen utama halaman */
body {
    font-family: 'Poppins', sans-serif;    /* Font utama Poppins dari Google Fonts */
    background: linear-gradient(135deg, #5d2a47, #401920);  /* Gradient background diagonal dari ungu ke coklat gelap */
    color: white;            /* Warna teks default putih */
    min-height: 100vh;       /* Minimum tinggi 100% viewport height */
}

/* Container utama untuk seluruh konten */
.container {
    width: 100%;             /* Lebar penuh dari parent */
    margin: 0;               /* Tidak ada margin */
    padding: 20px 40px;      /* Padding 20px vertikal, 40px horizontal */
}

/* Navigation bar styling */
.nav {
    display: flex;                    /* Flexbox layout */
    justify-content: space-between;   /* Distribusi space antara logo dan menu */
    align-items: center;              /* Align vertikal ke tengah */
    padding: 20px 0;                  /* Padding vertikal 20px */
    margin-bottom: 50px;              /* Margin bawah 50px */
    border-bottom: 2px solid rgba(255, 255, 255, 0.95);  /* Border bawah putih transparan */
}

/* Logo styling */
.logo {
    font-size: 40px;                    /* Ukuran font besar untuk logo */
    font-weight: bold;                  /* Font tebal */
    font-family: "Rammetto One", sans-serif;  /* Font khusus Rammetto One */
    letter-spacing: 8px;                /* Jarak antar huruf 8px untuk efek spasi */
}

/* Styling untuk bagian "MA" dalam logo SKEMA */
.logo .red {
    color: #ff4757;                     /* Warna merah untuk aksen logo */
}

/* Container untuk menu navigasi */
.nav-links {
    font-size: 20px;                    /* Ukuran font menu */
    display: flex;                      /* Flexbox horizontal */
    padding: 0 200px;                   /* Padding horizontal besar untuk centering */
    gap: 8rem;                          /* Jarak antar menu item 8rem (128px) */
    list-style: none;                   /* Hilangkan bullet point list */
}

/* Styling link dalam navigasi */
.nav-links a {
    color: white;                       /* Warna link putih */
    text-decoration: none;              /* Hilangkan underline */
    font-weight: bold;                  /* Font tebal */
    transition: color 0.3s;             /* Animasi perubahan warna 0.3 detik */
}

/* Efek hover pada link navigasi */
.nav-links a:hover {
    color: #ff4757;                     /* Warna berubah merah saat hover */
}

/* Styling heading utama di hero section */
.hero h1 {
    font-size: 42px;                    /* Font size besar */
    font-weight: bold;                  /* Font tebal */
    margin-bottom: 25px;                /* Margin bawah */
    line-height: 1.2;                   /* Line height untuk readability */
}

/* Styling paragraf di hero section */
.hero p {
    font-size: 30px;                    /* Font size sedang-besar */
    opacity: 0.9;                       /* Sedikit transparan (90% opacity) */
    line-height: 1.6;                   /* Line height untuk readability */
    max-width: 600px;                   /* Maksimal lebar 600px untuk readability */
}

/* Styling judul "Our Team" */
.team-title {
    text-align: center;                 /* Teks di tengah */
    font-size: 50px;                    /* Font size sangat besar */
    font-weight: bold;                  /* Font tebal */
    margin: 40px 0 50px;                /* Margin: 40px atas, 0 samping, 50px bawah */
    padding: 30px 20px 20px;            /* Padding: 30px atas, 20px samping, 20px bawah */
    border-top: 2px solid rgba(255, 245, 245, 0.98);  /* Border atas putih transparan */
}

/* Container untuk setiap anggota tim */
.member {
    display: flex;                      /* Flexbox layout */
    align-items: center;                /* Align vertikal ke tengah */
    margin-bottom: 30px;                /* Margin bawah antar member */
    gap: 30px;                          /* Jarak antara foto dan card info */
    width: 100vw;                       /* Lebar full viewport width */
    margin-left: calc(-50vw + 50%);     /* Trick untuk membuat full width dari dalam container */
    padding: 0 40px;                    /* Padding horizontal untuk spacing */
}

/* Alternate layout untuk member genap (foto di kanan) */
.member:nth-child(even) {
    flex-direction: row-reverse;        /* Balik urutan flex items */
}

/* Styling foto anggota tim */
.member img {
    width: 339px;                       /* Lebar tetap foto */
    height: 445px;                      /* Tinggi tetap foto */
    border-radius: 15px;                /* Sudut membulat */
    object-fit: cover;                  /* Crop foto mempertahankan aspek rasio */
    flex-shrink: 0;                     /* Tidak boleh mengecil di flexbox */
}

/* Card/kotak informasi anggota */
.member-card {
    background: rgba(255, 255, 255, 0.08);  /* Background putih transparan */
    border-radius: 20px;                     /* Sudut membulat */
    padding: 30px;                           /* Padding dalam card */
    height: 445px;                           /* Tinggi sama dengan foto */
    backdrop-filter: blur(5px);              /* Efek blur background */
    border: 1px solid rgba(255, 255, 255, 0.1);  /* Border tipis transparan */
    flex: 1;                                 /* Mengambil sisa ruang flexbox */
    display: flex;                           /* Flexbox untuk centering konten */
    align-items: center;                     /* Center vertikal */
    justify-content: center;                 /* Center horizontal */
}

/* Container informasi dalam card */
.member-info {
    text-align: center;                      /* Teks di tengah */
    width: 100%;                            /* Lebar penuh */
}

/* Nama anggota tim */
.member h3 {
    font-size: 50px;                        /* Font size besar untuk nama */
    font-weight: bold;                      /* Font tebal */
    margin-bottom: 15px;                    /* Margin bawah */
}

/* Kelas anggota tim */
.member .class {
    font-size: 25px;                        /* Font size sedang */
    opacity: 0.8;                           /* Sedikit transparan */
    margin: 8px 0;                          /* Margin vertikal */
}

/* Link username Instagram */
.member .username a {
    color: white;                           /* Warna putih */
    text-decoration: none;                  /* Hilangkan underline */
    font-size: 25px;                        /* Font size sedang */
    transition: opacity 0.3s;               /* Animasi perubahan opacity */
}

/* Efek hover pada username link */
.member .username a:hover {
    opacity: 1;                             /* Full opacity saat hover */
    text-decoration: underline;             /* Tambah underline */
    color: rgb(52, 6, 189);                /* Warna biru saat hover */
}

/* Quote anggota tim */
.member .quote {
    font-size: 25px;                        /* Font size sedang */
    opacity: 0.7;                           /* Lebih transparan */
    margin-top: 15px;                       /* Margin atas */
    color: white;                           /* Warna putih eksplisit */
}

/* Footer section */
.footer {
    padding: 3rem 0;                        /* Padding vertikal 3rem */
    border-top: 3px solid #ffffff;          /* Border atas putih tebal */
}

/* Container konten footer */
.footer-content {
    display: flex;                          /* Flexbox layout */
    justify-content: space-between;         /* Distribusi space between */
    align-items: center;                    /* Align vertikal center */
}

/* Logo di footer */
.footer-logo h2 {
    color: #ffffff;                         /* Warna putih */
    font-size: 40px;                        /* Font size besar */
    font-weight: bold;                      /* Font tebal */
    font-family: "Rammetto One", sans-serif; /* Font khusus */
    letter-spacing: 8px;                    /* Letter spacing untuk efek */
}

/* Bagian "MA" di logo footer */
.footer-logo span {
    color: #e74c3c;                         /* Warna merah untuk aksen */
}

/* Container informasi footer */
.footer-info {
    display: flex;                          /* Flexbox layout */
    gap: 19rem;                             /* Gap besar antar section */
    align-items: center;                    /* Align vertikal center */
}

/* Styling teks footer umum */
.footer-text p,
.contact-info p {
    color: #bbb;                            /* Warna abu-abu terang */
    font-size: 0.9rem;                      /* Font size kecil */
    margin-bottom: 0.5rem;                  /* Margin bawah kecil */
}

/* Label "Contact Us" di footer */
.contact-info p:first-child {
    color: #ffffff;                         /* Warna putih untuk label */
    font-weight: 600;                       /* Font semi-bold */
}

/* ======================== RESPONSIVE DESIGN ======================== */
/* Media query untuk tablet dan mobile (max-width: 768px) */
@media (max-width: 768px) {
    /* Padding container lebih kecil di mobile */
    .container {
        padding: 20px;                      /* Padding uniform 20px */
    }

    /* Navigation menjadi vertikal di mobile */
    .nav {
        flex-direction: column;             /* Flexbox vertikal */
        gap: 20px;                          /* Gap antar elemen nav */
        text-align: center;                 /* Teks di tengah */
    }

    /* Menu navigasi dengan gap lebih kecil */
    .nav-links {
        gap: 25px;                          /* Gap lebih kecil antar menu */
    }

    /* Hero title lebih kecil di mobile */
    .hero h1 {
        font-size: 32px;                    /* Font size dikurangi */
    }

    /* Hero description lebih kecil di mobile */
    .hero p {
        font-size: 15px;                    /* Font size jauh lebih kecil */
    }

    /* Member layout menjadi vertikal di mobile */
    .member,
    .member:nth-child(even) {               /* Reset row-reverse untuk mobile */
        flex-direction: column;             /* Layout vertikal */
        text-align: center;                 /* Teks di tengah */
        gap: 20px;                          /* Gap lebih kecil */
        width: 100vw;                       /* Tetap full width */
        margin-left: calc(-50vw + 50%);     /* Tetap gunakan full width trick */
        padding: 0 20px;                    /* Padding lebih kecil */
    }

    /* Foto anggota lebih kecil di mobile */
    .member img {
        width: 150px;                       /* Lebar dikurangi drastis */
        height: 150px;                      /* Tinggi dikurangi, jadi persegi */
    }

    /* Member card disesuaikan untuk mobile */
    .member-card {
        padding: 20px;                      /* Padding lebih kecil */
        height: auto;                       /* Tinggi otomatis */
        min-height: 200px;                  /* Minimum tinggi */
    }

    /* Nama anggota lebih kecil di mobile */
    .member h3 {
        font-size: 24px;                    /* Font size dikurangi */
    }

    /* Footer info menjadi vertikal di mobile */
    .footer-info {
        flex-direction: column;             /* Layout vertikal */
        align-items: center;                /* Center horizontal */
        justify-content: center;            /* Center vertikal */
        gap: 20px;                          /* Gap lebih kecil */
        text-align: center;                 /* Teks di tengah */
    }
}
</style>
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
                <li><a href="#">Home</a></li>
                <!-- Link ke halaman home (relatif path naik satu folder) -->
                <li><a href="#">About us</a></li>
                <!-- Link About us (href="#" berarti link kosong/current page) -->
                <li><a href="../profile/profile.php/">Profile</a></li>
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