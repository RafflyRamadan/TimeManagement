<?php
session_start();
include '../../koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php'); // Redirect ke login jika belum login
    exit;
}

// Mengambil data proyek yang sudah selesai
$query = "SELECT project.*, role.role_name 
          FROM project 
          LEFT JOIN role ON project.role_id = role.role_id 
          WHERE project.status = 'completed'
          ORDER BY project.project_id ASC";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Error dalam query: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Project - Time Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: lightgray;
    }

    .btn-group .btn {
        margin-right: 5px;
    }

    .status-badge {
        padding: 5px 10px;
        background-color: green;
        color: white;
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php" data-aos="fade-down">History Management</a>
            <img src="../img/logo_kai.png" alt="" width="70px" data-aos="fade-down">
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 data-aos="fade-right">Daftar Riwayat</h2>
            <div>
                <a href="../dashboard_staff.php" class="btn btn-secondary" data-aos="fade-left">Kembali ke Dashboard</a>
            </div>
        </div>

        <!-- Menampilkan pesan sukses jika ada -->
        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success" data-aos="fade-up">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
        <?php endif; ?>

        <div class="table-container">
            <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 40%;">Project</th>
                        <th style="width: 30%;">Role</th>
                        <th style="width: 20%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr data-aos="fade-up" data-aos-duration="700">
                        <td><?php echo htmlspecialchars($row['project_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['role_name']); ?></td>
                        <td><span class="status-badge">Selesai</span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
            <div style="text-align: center; padding: 2rem;" data-aos="fade-up">
                <p>Belum ada proyek yang selesai.</p>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
    // Inisialisasi AOS
    AOS.init({
        duration: 1000,
        once: true,
    });
    </script>
</body>

</html>