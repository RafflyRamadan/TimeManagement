<?php
session_start();
include '../../koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Proses ketika tombol Selesai diklik
if (isset($_GET['complete']) && isset($_GET['id'])) {
    $project_id = (int)$_GET['id'];
    $update_query = "UPDATE project SET status = 'completed' WHERE project_id = $project_id";

    if (mysqli_query($koneksi, $update_query)) {
        $_SESSION['success_message'] = 'Proyek berhasil ditandai sebagai selesai.';
    } else {
        $_SESSION['error_message'] = 'Gagal menandai proyek sebagai selesai.';
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Mengambil data proyek dan nama role yang terkait
$query = "SELECT project.*, role.role_name 
          FROM project 
          LEFT JOIN role ON project.role_id = role.role_id 
          WHERE project.status IS NULL OR project.status != 'completed'";
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
    <title>Manajemen Proyek</title>
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php">Projects Management</a>
            <img src="../img/logo_kai.png" alt="" width="70px">
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 data-aos="fade-down">Daftar Proyek</h2>
            <div>
                <a href="../dashboard_staff.php" class="btn btn-secondary" data-aos="fade-left">Kembali ke Dashboard</a>
            </div>
        </div>

        <!-- Display Success/Error Messages -->
        <?php if (isset($_SESSION['success_message'])) { ?>
        <div class="alert alert-success" data-aos="fade-up">
            <?php echo $_SESSION['success_message']; ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
        <?php } ?>
        <?php if (isset($_SESSION['error_message'])) { ?>
        <div class="alert alert-danger" data-aos="fade-up">
            <?php echo $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
        <?php } ?>

        <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 40%;">Project</th>
                    <th style="width: 30%;">Role</th>
                    <th style="width: 20%;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr data-aos="fade-up" data-aos-duration="700">
                    <td><?php echo htmlspecialchars($row['project_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['role_name']); ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="?complete=1&id=<?php echo htmlspecialchars($row['project_id']); ?>"
                                class="btn btn-sm btn-warning"
                                onclick="return confirm('Apakah Anda yakin ingin menandai proyek ini sebagai selesai?');"
                                data-aos="zoom-in">
                                Selesai
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
        <div class="alert alert-info" data-aos="fade-up">
            Tidak ada proyek yang tersedia saat ini.
        </div>
        <?php } ?>
    </div>

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
    // Inisialisasi AOS
    AOS.init({
        duration: 1000, // Durasi animasi dalam milidetik
        once: true, // Animasi hanya terjadi sekali
    });
    </script>
</body>

</html>