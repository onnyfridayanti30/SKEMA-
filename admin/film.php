<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKEMA - Film Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #8B4A6B, #6B3A4A);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            display: flex;
            min-height: 600px;
        }

        .sidebar {
            background: #6B3A4A;
            width: 200px;
            padding: 20px;
            color: white;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            letter-spacing: 2px;
        }

        .logo span {
            color: #E74C3C;
        }

        .admin-profile {
            background: white;
            color: #333;
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 10px;
        }

        .menu a {
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .menu a:hover, .menu a.active {
            background: rgba(255,255,255,0.1);
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .logout {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            width: calc(200px - 40px);
        }

        .main-content {
            flex: 1;
            padding: 30px;
            background: #f8f9fa;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #333;
            font-weight: 600;
        }

        .btn-primary {
            background: #E74C3C;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #c0392b;
        }

        .btn-home {
            background: #E74C3C;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .films-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #dee2e6;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .poster-img {
            width: 50px;
            height: 70px;
            object-fit: cover;
            border-radius: 6px;
            background: #ddd;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-edit, .btn-delete {
            padding: 8px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-edit {
            background: #3498db;
            color: white;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #f0f0f0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #E74C3C;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state h3 {
            margin-bottom: 10px;
            color: #666;
        }

        .confirm-modal .modal-content {
            text-align: center;
            max-width: 400px;
        }

        .confirm-icon {
            width: 60px;
            height: 60px;
            background: #fee;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">SKE<span>MA</span></div>
            <div class="admin-profile">Admin Profile</div>
            
            <ul class="menu">
                <li>
                    <a href="#" class="menu-item">
                        <div class="menu-icon">📊</div>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item active">
                        <div class="menu-icon">🎬</div>
                        Film
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <div class="menu-icon">👤</div>
                        Account
                    </a>
                </li>
            </ul>
            
            <div class="logout">
                <a href="#" class="menu-item">
                    <div class="menu-icon">🚪</div>
                    Log Out
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>MANAJEMEN FILM</h1>
                <div>
                    <button class="btn-home">Home</button>
                    <button class="btn-primary" onclick="openAddModal()">
                        + Tambah Film
                    </button>
                </div>
            </div>

            <div class="films-table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Poster</th>
                            <th>Judul</th>
                            <th>Genre</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="filmsTableBody">
                        <!-- Films will be loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add/Edit Film Modal -->
    <div id="filmModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Tambah Film</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <form id="filmForm">
                <div class="form-group">
                    <label for="judul">Judul Film</label>
                    <input type="text" id="judul" name="judul" required>
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <select id="genre" name="genre" required>
                        <option value="">Pilih Genre</option>
                        <option value="Action">Action</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Drama">Drama</option>
                        <option value="Horror">Horror</option>
                        <option value="Romance">Romance</option>
                        <option value="Sci-Fi">Sci-Fi</option>
                        <option value="Thriller">Thriller</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" id="tahun" name="tahun" min="1900" max="2030" required>
                </div>
                <div class="form-group">
                    <label for="poster">URL Poster</label>
                    <input type="url" id="poster" name="poster" placeholder="https://example.com/poster.jpg">
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal confirm-modal">
        <div class="modal-content">
            <div class="confirm-icon">🗑️</div>
            <h3>Hapus Film?</h3>
            <p>Apakah Anda yakin ingin menghapus film "<span id="deleteFilmTitle"></span>"?</p>
            <div class="modal-actions" style="margin-top: 30px;">
                <button class="btn-secondary" onclick="closeDeleteModal()">Batal</button>
                <button class="btn-primary" onclick="confirmDelete()" style="background: #e74c3c;">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        // Sample data - in real app this would come from PHP/database
        let films = [
            {
                id: 1,
                judul: 'Suara Lukisan',
                genre: 'Horror',
                tahun: '2023',
                poster: 'https://via.placeholder.com/60x80/333/fff?text=Film'
            }
        ];

        let editingFilmId = null;
        let deletingFilmId = null;

        // Load films into table
        function loadFilms() {
            const tbody = document.getElementById('filmsTableBody');
            
            if (films.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="empty-state">
                            <h3>Belum ada film</h3>
                            <p>Tambahkan film pertama Anda</p>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = films.map((film, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td>
                        <img src="${film.poster}" alt="${film.judul}" class="poster-img" 
                             onerror="this.src='https://via.placeholder.com/60x80/ddd/999?text=No+Image'">
                    </td>
                    <td>${film.judul}</td>
                    <td>${film.genre}</td>
                    <td>${film.tahun}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-edit" onclick="editFilm(${film.id})" title="Edit">
                                ✏️
                            </button>
                            <button class="btn-delete" onclick="deleteFilm(${film.id})" title="Hapus">
                                🗑️
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        // Open add modal
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Film';
            document.getElementById('filmForm').reset();
            editingFilmId = null;
            document.getElementById('filmModal').style.display = 'block';
        }

        // Edit film
        function editFilm(id) {
            const film = films.find(f => f.id === id);
            if (!film) return;

            document.getElementById('modalTitle').textContent = 'Edit Film';
            document.getElementById('judul').value = film.judul;
            document.getElementById('genre').value = film.genre;
            document.getElementById('tahun').value = film.tahun;
            document.getElementById('poster').value = film.poster;
            
            editingFilmId = id;
            document.getElementById('filmModal').style.display = 'block';
        }

        // Delete film
        function deleteFilm(id) {
            const film = films.find(f => f.id === id);
            if (!film) return;

            document.getElementById('deleteFilmTitle').textContent = film.judul;
            deletingFilmId = id;
            document.getElementById('deleteModal').style.display = 'block';
        }

        // Confirm delete
        function confirmDelete() {
            films = films.filter(f => f.id !== deletingFilmId);
            loadFilms();
            closeDeleteModal();
        }

        // Close modals
        function closeModal() {
            document.getElementById('filmModal').style.display = 'none';
            editingFilmId = null;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
            deletingFilmId = null;
        }

        // Handle form submission
        document.getElementById('filmForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const filmData = {
                judul: formData.get('judul'),
                genre: formData.get('genre'),
                tahun: formData.get('tahun'),
                poster: formData.get('poster') || 'https://via.placeholder.com/60x80/ddd/999?text=No+Image'
            };

            if (editingFilmId) {
                // Edit existing film
                const filmIndex = films.findIndex(f => f.id === editingFilmId);
                if (filmIndex !== -1) {
                    films[filmIndex] = { ...films[filmIndex], ...filmData };
                }
            } else {
                // Add new film
                const newFilm = {
                    id: Date.now(),
                    ...filmData
                };
                films.push(newFilm);
            }

            loadFilms();
            closeModal();
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            const filmModal = document.getElementById('filmModal');
            const deleteModal = document.getElementById('deleteModal');
            
            if (event.target === filmModal) {
                closeModal();
            }
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        }

        // Initialize
        loadFilms();
    </script>
</body>
</html>