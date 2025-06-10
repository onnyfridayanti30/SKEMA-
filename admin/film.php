<?php
include 'koneksi.php';
session_start();

$films = mysqli_query($conn, "SELECT * FROM detail ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SKEMA - Film</title>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="film.css">
  
</head>
<body>


<div class="header">
    <div class="logo">SKE<span class="m">MA</span></div>
</div>

<div class="container">

    <div class="sidebar">

                <h2>Admin Profile</h2>

                <div class="sidebar-item dashboard-item ">
                  <a href="dashboard.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="none" stroke="#421720" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.557 2.75H4.682A1.93 1.93 0 0 0 2.75 4.682v3.875a1.94 1.94 0 0 0 1.932 1.942h3.875a1.94 1.94 0 0 0 1.942-1.942V4.682A1.94 1.94 0 0 0 8.557 2.75m10.761 0h-3.875a1.94 1.94 0 0 0-1.942 1.932v3.875a1.943 1.943 0 0 0 1.942 1.942h3.875a1.94 1.94 0 0 0 1.932-1.942V4.682a1.93 1.93 0 0 0-1.932-1.932m0 10.75h-3.875a1.94 1.94 0 0 0-1.942 1.933v3.875a1.94 1.94 0 0 0 1.942 1.942h3.875a1.94 1.94 0 0 0 1.932-1.942v-3.875a1.93 1.93 0 0 0-1.932-1.932M8.557 13.5H4.682a1.943 1.943 0 0 0-1.932 1.943v3.875a1.93 1.93 0 0 0 1.932 1.932h3.875a1.94 1.94 0 0 0 1.942-1.932v-3.875a1.94 1.94 0 0 0-1.942-1.942"/>
                    </svg>
                    <span>Dashboard</span>
                  </a>
                </div>

                <div class="sidebar-item film-item">
                  <a href="film.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="#421720" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"><rect width="18" height="18" x="3" y="3" rx="2"/>
                      <path d="M7 3v18M3 7.5h4M3 12h18M3 16.5h4M17 3v18m0-13.5h4m-4 9h4"/></g>
                    </svg>
                    <span>Film</span>
                  </a>
                </div>

                <div class="sidebar-item account-item">
                  <a href="account.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="0 0 24 24">
                      <path fill="#421720" d="M12 12.25a3.75 3.75 0 1 1 3.75-3.75A3.75 3.75 0 0 1 12 12.25m0-6a2.25 2.25 0 1 0 2.25 2.25A2.25 2.25 0 0 0 12 6.25m7 13a.76.76 0 0 1-.75-.75c0-1.95-1.06-3.25-6.25-3.25s-6.25 1.3-6.25 3.25a.75.75 0 0 1-1.5 0c0-4.75 5.43-4.75 7.75-4.75s7.75 0 7.75 4.75a.76.76 0 0 1-.75.75" />
                    </svg>
                    <span>Account</span>
                  </a>
                </div>

                <div class="sidebar-item logout-item">
                  <a href="../login&register/login.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                      <path fill="none" stroke="#421720" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.496 21H6.5c-1.105 0-2-1.151-2-2.571V5.57c0-1.419.895-2.57 2-2.57h7M16 15.5l3.5-3.5L16 8.5m-6.5 3.496h10"/>
                    </svg>
                    <span>Log Out</span>
                  </a>
                </div>
      </div>





  <div class="content">
  <div class="header-title">
    <h2 class="page-title">Management Film</h2>
    <button class="add-btn">+ Tambah Film</button>
  </div>

  <div class="main-content">
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Poster</th>
            <th>Judul</th>
            <th>Durasi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="filmTableBody">
          <?php $no = 1; foreach ($films as $film): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><img src="../home/uploads/poster/<?= $film['poster'] ?>" width="100" height="80" ></td>
            <td><?= htmlspecialchars($film['judul']) ?></td>
            <td><?= htmlspecialchars($film['duration']) ?> minutes</td>
            <td>
              <button class="btn-edit" 
                data-id="<?= $film['id_film'] ?>"
                data-judul="<?= htmlspecialchars($film['judul']) ?>"
                data-sinopsis="<?= htmlspecialchars($film['sinopsis']) ?>"
                data-duration="<?= $film['duration'] ?>"
                data-actor="<?= htmlspecialchars($film['actor']) ?>"
                data-direktor="<?= htmlspecialchars($film['direktor']) ?>"
              >✏️</button>
              <form action="hapus_film.php" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus film ini?')">
                <input type="hidden" name="id_film" value="<?= $film['id_film'] ?>">
                <button class="btn-delete">🗑️</button>
              </form>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tambah/Edit -->
<div class="modal-overlay" id="filmModal">
  <div class="modal-container">
    <h2 id="modalTitle">Tambah Film</h2>
    <form id="filmForm" action="tambah_film.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_film" id="id_film">

      <label>Judul film</label>
      <input type="text" name="judul" id="judul" required>

      <label>Deskripsi</label>
      <textarea name="sinopsis" id="sinopsis" required></textarea>

      <label>Durasi film</label>
      <input type="text" name="duration" id="duration" required>

      <div class="form-row">
        <div class="form-col">
          <label>Poster film</label>
          <input type="file" name="poster" id="poster">
        </div>
        <div class="form-col">
          <label>Aktor</label>
          <input type="text" name="actor" id="actor" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label>Banner film</label>
          <input type="file" name="gambar" id="gambar">
        </div>
        <div class="form-col">
          <label>Direktur</label>
          <input type="text" name="direktor" id="direktor" required>
        </div>
      </div>

      <div class="modal-actions">
        <button type="submit" class="btn-save">Simpan</button>
        <button type="button" class="btn-cancel" id="cancelBtn">Batal</button>
      </div>
    </form>
  </div>
</div>

<script>
  const modal = document.getElementById('filmModal');
  const addBtn = document.querySelector('.add-btn');
  const cancelBtn = document.getElementById('cancelBtn');
  const form = document.getElementById('filmForm');
  const modalTitle = document.getElementById('modalTitle');

  // Tambah Film
  addBtn.onclick = () => {
    modalTitle.textContent = "Tambah Film";
    form.action = "tambah_film.php";
    form.reset();
    document.getElementById('id_film').value = '';
    modal.style.display = "flex";
  };

  // Edit Film
  document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', () => {
      modalTitle.textContent = "Edit Film";
      form.action = "edit_film.php";
      document.getElementById('id_film').value = button.dataset.id;
      document.getElementById('judul').value = button.dataset.judul;
      document.getElementById('sinopsis').value = button.dataset.sinopsis;
      document.getElementById('duration').value = button.dataset.duration;
      document.getElementById('actor').value = button.dataset.actor;
      document.getElementById('direktor').value = button.dataset.direktor;
      modal.style.display = "flex";
    });
  });

  // Batal / Tutup Modal
  cancelBtn.onclick = () => modal.style.display = "none";
  window.onclick = event => { if (event.target == modal) modal.style.display = "none"; };
</script>

</body>
</html>
