<?php
session_start();
require_once '../koneksi.php';

// PENGECEKAN LOGIN
// Cek apakah session 'nama' ada, jika tidak arahkan ke halaman login
if (!isset($_SESSION['nama'])) {
    header("Location: ../login.php"); // Redirect ke login.php jika belum login
    exit();
}

// FUNGSI UTAMA
// Fungsi logout 
function logout() {
    // Menghapus semua data sesi
    session_destroy();
    // Mengarahkan pengguna ke halaman index
    header("Location: ../index.php");
    exit();
}

// PROSES UTAMA
// Proses logout jika tombol logout diklik
if (isset($_POST['logout'])) {
    logout();
}

// Ambil nama user dari session, jika tidak ada gunakan 'Tamu'
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Tamu';

// Query untuk mengambil data proyek yang sudah selesai
$query = "SELECT * FROM project WHERE status = 'completed' ORDER BY project_id DESC";
$result = mysqli_query($koneksi, $query);

// menampilkan jumlah proyek selesai:
$jumlahProyekSelesai = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Time Management</title>

    <!-- CSS Library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <style>
    /* STYLE DASAR */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: whitesmoke;
        color: black;
    }

    /* NAVBAR */
    .navbar {
        background-color: navy;
        padding: 1rem 2rem;
        color: white;
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
    }

    .navbar-brand span {
        color: gold;
    }

    /* DASHBOARD UTAMA */
    .dashboard {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    /* =============== SECTION WELCOME =============== */
    .welcome-section {
        background-color: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 6px lightgray;
        margin-bottom: 2rem;
    }

    .welcome-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo-kai {
        width: 120px;
        height: auto;
    }

    /* GRID MENU */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    /* ITEM MENU */
    .menu-item {
        background-color: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 6px lightgray;
        border-top: 4px solid royalblue;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .menu-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px silver;
    }

    .menu-item h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .menu-item p {
        color: dimgray;
        margin-bottom: 1.2rem;
    }

    /* LINK MENU */
    .menu-link {
        display: inline-block;
        padding: 10px 20px;
        background-color: royalblue;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
        font-weight: 500;
    }

    .menu-link:hover {
        background-color: mediumblue;
        color: white;
    }

    /* Item menu dengan warna berbeda */
    .menu-item:nth-child(1) {
        border-top-color: royalblue;
    }

    .menu-item:nth-child(2) {
        border-top-color: forestgreen;
    }

    .menu-item:nth-child(3) {
        border-top-color: orange;
    }

    /* Icon warna berbeda */
    .icon-project {
        color: royalblue;
    }

    .icon-details {
        color: forestgreen;
    }

    .icon-history {
        color: orange;
    }

    /* Warna link sesuai menu */
    .link-project {
        background-color: royalblue;
    }

    .link-project:hover {
        background-color: mediumblue;
    }

    .link-details {
        background-color: forestgreen;
    }

    .link-details:hover {
        background-color: green;
    }

    .link-history {
        background-color: orange;
    }

    .link-history:hover {
        background-color: darkorange;
    }

    /* RESPONSIF UNTUK MOBILE */
    @media (max-width: 768px) {
        .welcome-header {
            flex-direction: column;
            text-align: center;
        }

        .menu-grid {
            grid-template-columns: 1fr;
        }

        .logo-kai {
            margin-top: 1rem;
        }
    }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Brand/Logo -->
            <a class="navbar-brand" href="#">TIG<span>KAI</span></a>

            <!-- Tombol hamburger untuk tampilan mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu navigasi utama -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="project/index.php">
                            <i class="fas fa-tasks me-1"></i> Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="detail/index.php">
                            <i class="fas fa-chart-bar me-1"></i> Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="history/index.php">
                            <i class="fas fa-history me-1"></i> History
                        </a>
                    </li>
                </ul>

                <!-- Informasi user dan tombol logout -->
                <div class="d-flex align-items-center">
                    <div class="text-light me-3">
                        <i class="fas fa-user me-1"></i> <?php echo $nama; ?>
                    </div>
                    <form method="POST" class="logout-form d-inline">
                        <button type="submit" name="logout" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- KONTEN DASHBOARD -->
    <div class="dashboard">
        <!-- Section Welcome -->
        <div class="welcome-section" data-aos="fade-down" data-aos-duration="800">
            <div class="welcome-header">
                <div class="welcome-text">
                    <h2><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h2>
                    <p>Selamat datang di website Time Go KAI, <?php echo $nama; ?>. Pilih menu di bawah untuk memulai!
                    </p>

                    <!-- Menampilkan data dari database (Optional) -->
                    <?php if(isset($jumlahProyekSelesai)): ?>
                    <div class="mt-2 badge bg-success">
                        <i class="fas fa-check-circle me-1"></i> Jumlah Proyek Selesai:
                        <?php echo $jumlahProyekSelesai; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <img src="../img/logo_kai.png" alt="Logo KAI" class="logo-kai">
            </div>
        </div>

        <!-- Menu Grid -->
        <div class="menu-grid">
            <!-- Projects Management -->
            <div class="menu-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <h3><i class="fas fa-tasks me-2 icon-project"></i>Projects</h3>
                <p>Lihat dan kelola semua proyek yang sedang berjalan dan yang akan datang.</p>
                <a href="project/index.php" class="menu-link link-project">
                    <i class="fas fa-arrow-right me-1"></i> Akses Menu
                </a>
            </div>

            <!-- Details Management -->
            <div class="menu-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <h3><i class="fas fa-chart-bar me-2 icon-details"></i>Details</h3>
                <p>Lihat detail dan laporan proyek untuk analisis lebih mendalam.</p>
                <a href="detail/index.php" class="menu-link link-details">
                    <i class="fas fa-arrow-right me-1"></i> Akses Menu
                </a>
            </div>

            <!-- Project History -->
            <div class="menu-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                <h3><i class="fas fa-history me-2 icon-history"></i>History</h3>
                <p>Lihat riwayat proyek yang telah selesai untuk referensi ke depan.</p>
                <a href="history/index.php" class="menu-link link-history">
                    <i class="fas fa-arrow-right me-1"></i> Akses Menu
                </a>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LLIBRARY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <!-- JAVASCRIPT -->
    <script>
    // Inisialisasi AOS (Animate On Scroll)
    AOS.init({
        once: true // Animasi hanya dijalankan sekali saat scroll
    });

    // Konfirmasi sebelum logout
    document.querySelector('.logout-form').addEventListener('submit', function(e) {
        if (!confirm('Apakah Anda yakin ingin keluar?')) {
            e.preventDefault();
        }
    });
    </script>
</body>

</html>