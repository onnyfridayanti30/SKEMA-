<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

// Query berdasarkan ID atau ambil data pertama
$id = isset($_GET['id']) ? (int)$_GET['id'] : 3;
$query = mysqli_query($conn, "SELECT * FROM detail WHERE id_film = $id LIMIT 1");
if (!$query) {
    die("Query error: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($query);
if (!$data) {
    die("Data tidak ditemukan di tabel film.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Film - <?php echo htmlspecialchars($data['judul_film'] ?? 'Film'); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: #1c1c1c;
            color: #fff;
        }
        .header {
            position: relative;
            width: 100%;
        }
        .header img {
            width: 100%;
            height: 600px;
            display: block;
            object-fit: cover;
        }
        .back-button {
            position: absolute;
            top: 17px;
            left: 17px;
            color: #fff;
            font-size: 20px;
            
           
            cursor: pointer;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: rgba(0,0,0,0.7);
        }
        .content {
            display: flex;
            gap: 20px;
            padding: 20px;
            flex-wrap: wrap;
        }
        .left-column {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .portrait {
            width: 450px;
            height: 655px;
            border-radius: 20px;
            object-fit: cover;
            margin-bottom: 15px;
        }
        .button-group {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .watch-button {
            padding: 10px 100px;
            background-color: #E53935;
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            font-size: 25px;
            transition: background-color 0.3s;
        }
        .watch-button:hover {
            background-color: #c62828;
        }
        .love-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #E53935;
            color: #837E7E;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .love-circle:hover {
            background-color: #c62828;
        }

        .love-circle.loved {
            color: #fff !important;
        }

        .love-circle.loved:hover {
    color: #fff !important;
}
        .text-content {
            flex: 1;
            min-width: 250px;
        }
        .text-content p {
            font-size: 36px;
            line-height: 1.6;
            margin: 10px 0;
        }
        .text-content strong {
            font-size: 36px;
            margin-top: 20px;
            display: block;
            color:rgb(255, 255, 255);
        }
        
        
       /* Responsive design */
@media (max-width: 1024px) {
    .header img {
        height: 350px;
    }
}

@media (max-width: 768px) {
    .header img {
        height: 250px;
    }
    .content {
        flex-direction: column;
        align-items: center;
    }
    .portrait {
        width: 300px;
        height: 400px;
    }
    .watch-button {
        padding: 10px 50px;
        font-size: 18px;
    }
    .text-content p {
        font-size: 16px;
    }
    .text-content strong {
        font-size: 20px;
    }
}

@media (max-width: 480px) {
    .header img {
        height: 200px;
    }
    .portrait {
        width: 250px;
        height: 350px;
    }
    .watch-button {
        padding: 8px 30px;
        font-size: 16px;
    }
    .text-content p {
        font-size: 14px;
    }
    .text-content strong {
        font-size: 18px;
    }
}
    </style>
</head>
<body>

<div class="header">
    <a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
    <img src="Foto Film/<?php echo htmlspecialchars($data['poster'] ?? 'default.jpg'); ?>" alt="<?php echo htmlspecialchars($data['judul_film'] ?? 'Film'); ?>">
</div>

<div class="content">
    <div class="left-column">
        <img class="portrait" src="Foto Film/<?php echo htmlspecialchars($data['gambar'] ?? 'default.jpg'); ?>" alt="<?php echo htmlspecialchars($data['judul_film'] ?? 'Film'); ?>">
        <div class="button-group">
            <a href="<?php echo htmlspecialchars($data['link'] ?? '#'); ?>" class="watch-button" target="_blank">▶ Watch Now</a>
            <span class="love-circle"><i class="fas fa-heart"></i></span>
        </div>
    </div>

    <div class="text-content">
        
         
        <p><?php echo htmlspecialchars($data['sinopsis'] ?? 'Sinopsis tidak tersedia'); ?></p>
        
        <strong>Actor:</strong>
        <p><?php echo htmlspecialchars($data['actor'] ?? 'Informasi actor tidak tersedia'); ?></p>
        
        <strong>Director:</strong>
        <p><?php echo htmlspecialchars($data['direktor'] ?? 'Informasi director tidak tersedia'); ?></p>
        
        <strong>Duration:</strong>
        <p><?php echo htmlspecialchars($data['duration'] ?? 'Informasi durasi tidak tersedia'); ?></p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loveButton = document.querySelector('.love-circle');
    
    loveButton.addEventListener('click', function() {
        // Toggle class 'loved'
        this.classList.toggle('loved');
    });
});
</script>

</body>
</html>