<?php
// SKEMA Team PHP Version
// Team members data
$teamMembers = array(
    array(
        'name' => 'I Putu Mertayasa',
        'class' => 'XI RPL 3 / 18',
        'username' => '__wrld.taa',
        'instagram_url' => 'https://www.instagram.com/__wrld.taa?igsh=ZzVwajFzaHd2bDR3',
        'quote' => 'Lelah Ya Istirahat',
        'image' => 'merta.jpg'
    ),
    array(
        'name' => 'Ni Komang Onny Fridayanti',
        'class' => 'XI RPL 3 / 30',
        'username' => 'onnyfridayanti',
        'instagram_url' => 'https://www.instagram.com/onnyfridayanti?igsh=MTlvbDF4a2doMmlkeQ==',
        'quote' => 'Kerja Cordas',
        'image' => 'oni.jpg'
    ),
    array(
        'name' => 'Ni Nyoman Ayu Bunga Lestari',
        'class' => 'XI RPL 3 / 32',
        'username' => 'ayumg',
        'instagram_url' => 'https://www.instagram.com/ayumg._?igsh=NTc1N2c2M2d3NDc4',
        'quote' => 'Life Goes On',
        'image' => 'bunga.jpg'
    )
);

// Page configuration
$pageTitle = "SKEMA Team";
$heroTitle = "what is a SKEMA?";
$heroDescription = "SKEMA atau Skensa Cinema, Web ini kami rancang sebagai wadah untuk menampung hasil karya film dari siswa siswi SKENSA serta membantu pengguna mempermudah mengakses film hasil karya dari siswa siswi SKENSA";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #5d2a47, #401920); 
            color: white; 
            min-height: 100vh; 
        }
        .container { width: 100%; margin: 0; padding: 20px 40px; }
        
        /* Header */
        .nav { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 20px 0px;
            margin: 0 0 50px; 
            border-bottom: 2px solid rgba(255, 255, 255, 0.95);
        }
        .logo { 
            font-size: 40px; 
            font-weight: bold; 
            font-family: "Rammetto One", sans-serif;
            letter-spacing: 8px;
        }
        .logo .red { color: #ff4757; }
        .nav-links { 
            font-size: 20px;
            display: flex; 
            padding: 0 200px;
            gap: 8rem; 
            list-style: none; 
        }
        .nav-links a { 
            color: white; 
            text-decoration: none; 
            font-size: 20px;
            font-weight: bold;
            transition: color 0.3s;
        }
        .nav-links a:hover { color: #ff4757; }
        
        /* Hero */
        
        .hero h1 { 
            font-size: 42px; 
            font-weight: bold;
            margin-bottom: 25px; 
            line-height: 1.2;
        }
        .hero p { 
            font-size: 30px; 
            opacity: 0.9; 
            line-height: 1.6; 
            max-width: 600px;
        }
        
        /* Team Section */
        .team-title { 
            text-align: center; 
            font-size: 50px; 
            font-weight: bold;
            margin: 40px 0 50px; 
            padding: 30px 20px 20px;
            border-top: 2px solid rgba(255, 245, 245, 0.98);
        }
        
        .member { 
            display: flex; 
            align-items: center; 
            margin-bottom: 30px;
            gap: 30px;
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            padding-left: 40px;
            padding-right: 40px;
        }
        
        .member:nth-child(even) { flex-direction: row-reverse; }
        
        .member img { 
            width: 339px; 
            height: 445px; 
            border-radius: 15px; 
            object-fit: cover;
            flex-shrink: 0;
        }
        
        .member-card {
            background: rgba(255,255,255,0.08); 
            border-radius: 20px; 
            padding: 30px; 
            height: 445px; 
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.1);
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .member-info { 
            text-align: center;
            width: 100%;
        }
        
        .member h3 { 
            font-size: 50px; 
            font-weight: bold;
            margin-bottom: 15px; 
        }
        
        .member .class { 
            font-size: 25px; 
            opacity: 0.8; 
            margin: 8px 0; 
        }
        
        .member .username a {
            color: white;
            text-decoration: none;
            font-size: 25px; 
            transition: opacity 0.3s;
        }

        .member .username a:hover {
            opacity: 1;
            text-decoration: underline;
            color:rgb(52, 6, 189);
        }
        
        .member .quote { 
            
            font-size: 25px; 
            opacity: 0.7; 
            margin-top: 15px;
            color:rgb(255, 255, 255);
        }
        
        /* Footer */
.footer {
    
    padding: 3rem 0;
    border-top: 3px solid #ffffff;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer-logo h2 {
    color: #ffffff;
    font-size: 40px;
    font-weight: bold;
    font-family: "Rammetto One", sans-serif;
    letter-spacing: 8px;
}

.footer-logo span {
    color: #e74c3c;
}

.footer-info {
    display: flex;
    gap:19rem;
    align-items: center;
}

.footer-text p,
.contact-info p {
    color: #bbb;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.contact-info p:first-child {
    color: #ffffff;
    font-weight: 600;
}
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .container { padding: 20px; }
            
            .nav { 
                flex-direction: column; 
                gap: 20px; 
                text-align: center;
            }
            .nav-links { gap: 25px; }
            
            .hero h1 { font-size: 32px; }
            .hero p { font-size: 15px; }
            
            .member, .member:nth-child(even) { 
                flex-direction: column; 
                text-align: center;
                gap: 20px;
                width: 100vw;
                margin-left: calc(-50vw + 50%);
                padding-left: 20px;
                padding-right: 20px;
            }
            .member img { 
                width: 150px; 
                height: 150px; 
            }
            .member-card {
                padding: 20px;
                height: auto;
                min-height: 200px;
            }
            .member h3 { font-size: 24px; }
            
            .footer-info {
             display: flex; /* Tambahkan ini */
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
    text-align: center;
}

            .footer-info { text-align: center; }
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="nav">
            <div class="logo">SKE<span class="red">MA</span></div>
            <ul class="nav-links">
                <li><a href="../home/home.php">Home</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="../profile/profile.php">Profile</a></li>
            </ul>
        </nav>
        
        <div class="hero">
            <h1><?php echo htmlspecialchars($heroTitle); ?></h1>
            <p><?php echo htmlspecialchars($heroDescription); ?></p>
        </div>
        
        <h2 class="team-title">Our Team</h2>
        
        <?php foreach ($teamMembers as $index => $member) { ?>
        <div class="member">
            <img src="<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
            <div class="member-card">
                <div class="member-info">
                    <h3><?php echo htmlspecialchars($member['name']); ?></h3>
                    <p class="class"><?php echo htmlspecialchars($member['class']); ?></p>
                    <p class="username">
                        <a href="<?php echo htmlspecialchars($member['instagram_url']); ?>" target="_blank" rel="noopener noreferrer">
                            @<?php echo htmlspecialchars($member['username']); ?>
                        </a>
                    </p>
                    <p class="quote">"<?php echo htmlspecialchars($member['quote']); ?>"</p>
                </div>
            </div>
        </div>
        <?php } ?>
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