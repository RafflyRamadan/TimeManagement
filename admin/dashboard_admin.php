<?php
session_start();
include '../koneksi.php';

// cek login
// Cek apakah session 'nama' ada, jika tidak arahkan ke halaman login
if (!isset($_SESSION['nama'])) {
    header("Location: ../login.php"); // Redirect ke login.php jika belum login
    exit();
}

// Fungsi untuk logout pengguna
function logout() {
    // Bersihkan semua data session
    $_SESSION = array();
    session_destroy();
    // Arahkan ke halaman login
    header("Location: ../index.php");
    exit();
}

// Ambil data user dari session (dengan keamanan XSS)
$nama = isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'Tamu';

// Proses logout jika tombol logout diklik
if (isset($_POST['logout'])) {
    logout();
}

// Contoh query (siap digunakan jika diperlukan)
// $query = "SELECT * FROM users WHERE status = 'active'";
// $result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Time Management</title>
    <link rel="icon" type="image/x-icon" href="../img/logo_kai.png">

    <!-- font poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- animasi aos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        /* Menggunakan font Poppins */
        background-color: whitesmoke;
        line-height: 1.6;
        color: black;
    }

    /* ===== NAVBAR ===== */
    .navbar {
        background-color: navy;
        padding: 1rem 2rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 10px lightgray;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .brand-name {
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: 0.5px;
    }

    .yellow-text {
        color: gold;
    }

    .welcome-text {
        font-weight: 400;
        font-size: 0.95rem;
    }

    .logout-form {
        display: inline;
    }

    .logout-btn {
        background: none;
        border: 1px solid red;
        color: red;
        cursor: pointer;
        padding: 6px 12px;
        border-radius: 4px;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background-color: red;
        color: white;
    }

    /* ===== KONTEN UTAMA ===== */
    .dashboard {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    /* ===== SECTION SELAMAT DATANG ===== */
    .welcome-section {
        background-color: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 6px lightgray;
        margin-bottom: 2rem;
        transition: transform 0.3s ease;
    }

    .welcome-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px silver;
    }

    .welcome-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .welcome-text-container {
        flex: 1;
    }

    .welcome-section h2 {
        font-size: 1.5rem;
        color: navy;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .welcome-section p {
        color: dimgray;
        font-size: 0.95rem;
    }

    .logo-kai {
        width: 120px;
        height: auto;
        transition: transform 0.5s ease;
    }

    .logo-kai:hover {
        transform: scale(1.05);
    }

    /* ===== GRID MENU ===== */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .menu-item {
        background-color: white;
        padding: 1.7rem;
        border-radius: 12px;
        box-shadow: 0 4px 6px lightgray;
        transition: all 0.3s ease;
        border-top: 4px solid royalblue;
    }

    .menu-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 15px silver;
    }

    /* Variasi warna border untuk menu yang berbeda */
    .menu-item:nth-child(1) {
        border-top-color: royalblue;
    }

    .menu-item:nth-child(2) {
        border-top-color: forestgreen;
    }

    .menu-item:nth-child(3) {
        border-top-color: gold;
    }

    .menu-item:nth-child(4) {
        border-top-color: purple;
    }

    .menu-item h3 {
        color: navy;
        margin-bottom: 0.8rem;
        font-size: 1.2rem;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .menu-icon {
        margin-right: 8px;
        color: royalblue;
    }

    .menu-item:nth-child(1) .menu-icon {
        color: royalblue;
    }

    .menu-item:nth-child(2) .menu-icon {
        color: forestgreen;
    }

    .menu-item:nth-child(3) .menu-icon {
        color: gold;
    }

    .menu-item:nth-child(4) .menu-icon {
        color: purple;
    }

    .menu-item p {
        color: dimgray;
        margin-bottom: 1.2rem;
        font-size: 0.9rem;
    }

    .menu-link {
        display: inline-block;
        padding: 8px 16px;
        background-color: royalblue;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .menu-item:nth-child(1) .menu-link {
        background-color: royalblue;
    }

    .menu-item:nth-child(2) .menu-link {
        background-color: forestgreen;
    }

    .menu-item:nth-child(3) .menu-link {
        background-color: gold;
        color: black;
    }

    .menu-item:nth-child(4) .menu-link {
        background-color: purple;
    }

    .menu-link:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    /* ===== RESPONSIF ===== */
    @media (max-width: 768px) {
        .welcome-header {
            flex-direction: column;
            text-align: center;
        }

        .menu-grid {
            grid-template-columns: 1fr;
        }

        .navbar {
            flex-direction: column;
            gap: 10px;
            padding: 1rem;
            text-align: center;
        }

        .user-info {
            flex-direction: column;
            gap: 5px;
        }
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar" data-aos="fade-down" data-aos-duration="800">
        <div class="user-info">
            <h2 class="brand-name">TIG<span class="yellow-text">KAI</span></h2>
            <span>|</span>
            <span class="welcome-text">Selamat datang, <?php echo $nama; ?></span>
        </div>
        <form method="POST" class="logout-form">
            <button type="submit" name="logout" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <!-- Dashboard -->
    <div class="dashboard">
        <!-- Welcome Section -->
        <div class="welcome-section" data-aos="fade-up" data-aos-duration="1000">
            <div class="welcome-header">
                <div class="welcome-text-container">
                    <h2><i class="fas fa-tachometer-alt" style="color: royalblue; margin-right: 8px;"></i>Dashboard</h2>
                    <p>Selamat datang di website Time Go KAI, <?php echo $nama; ?>. Pilih menu di bawah untuk memulai!</p>
                </div>
                <img src="../img/logo_kai.png" alt="Logo KAI" class="logo-kai" data-aos="zoom-in" data-aos-delay="300">
            </div>
        </div>

        <!-- Menu Grid -->
        <div class="menu-grid">
            <!-- User Management -->
            <div class="menu-item" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                <h3><i class="fas fa-users menu-icon"></i>Users</h3>
                <p>Kelola data pengguna sistem dan atur informasi akun</p>
                <a href="user/index.php" class="menu-link">
                    <i class="fas fa-arrow-right" style="margin-right: 5px;"></i>Akses Menu
                </a>
            </div>

            <!-- Role Management -->
            <div class="menu-item" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                <h3><i class="fas fa-user-tag menu-icon"></i>Roles</h3>
                <p>Atur peran dan hak akses untuk berbagai tingkat pengguna</p>
                <a href="role/index.php" class="menu-link">
                    <i class="fas fa-arrow-right" style="margin-right: 5px;"></i>Akses Menu
                </a>
            </div>

            <!-- Project Management -->
            <div class="menu-item" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
                <h3><i class="fas fa-tasks menu-icon"></i>Projects</h3>
                <p>Kelola proyek dan tugas yang sedang berjalan</p>
                <a href="project/index.php" class="menu-link">
                    <i class="fas fa-arrow-right" style="margin-right: 5px;"></i>Akses Menu
                </a>
            </div>

            <!-- Details Management -->
            <div class="menu-item" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
                <h3><i class="fas fa-chart-bar menu-icon"></i>Details</h3>
                <p>Lihat detail dan laporan proyek untuk analisis performa</p>
                <a href="detail/index.php" class="menu-link">
                    <i class="fas fa-arrow-right" style="margin-right: 5px;"></i>Akses Menu
                </a>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>

    // Mengaktifkan animasi scroll
    AOS.init({
        once: true, // animasi hanya dijalankan sekali saat scroll
        mirror: false, // tidak mengulangi animasi saat scroll naik
        offset: 100,
        duration: 800
    });

    // Menampilkan konfirmasi sebelum logout
    document.querySelector('.logout-form').addEventListener('submit', function(e) {
        if (!confirm('Apakah Anda yakin ingin keluar?')) {
            e.preventDefault(); // Batalkan submit form jika user memilih Cancel
        }
    });
    </script>
</body>

</html>