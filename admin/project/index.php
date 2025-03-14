<?php
session_start();
include '../../koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Mengambil data proyek dan nama role yang terkait
$query = "SELECT project.*, role.role_name 
          FROM project
          LEFT JOIN role ON project.role_id = role.role_id";
$result = mysqli_query($koneksi, $query);

// perubahan status proyek
if (isset($_GET['complete_id'])) {
    $project_id = (int)$_GET['complete_id']; // Pastikan ID adalah integer
    $query = "UPDATE project SET status = 'completed' WHERE project_id = $project_id";
    
    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php'); // Redirect kembali ke halaman ini
        exit;
    } else {
        $error = "Gagal menyelesaikan proyek!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Proyek</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
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

    .badge {
        font-size: 14px;
        padding: 5px 10px;
    }

    .navbar-brand {
        font-weight: bold;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" data-aos="fade-down" data-aos-duration="800">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php">Projects Management</a>
            <img src="../../img/logo_kai.png" alt="Logo KAI" width="70px">
        </div>
    </nav>

    <div class="container mt-4">
        <div class="page-header d-flex justify-content-between align-items-center mb-4" data-aos="fade-up"
            data-aos-duration="1000">
            <h2>Daftar Proyek</h2>
            <div>
                <a href="create.php" class="btn btn-primary" data-aos="zoom-in" data-aos-delay="200">Tambah Project</a>
                <a href="../dashboard_admin.php" class="btn btn-secondary" data-aos="zoom-in"
                    data-aos-delay="300">Kembali ke Dashboard</a>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 30%;">Nama Proyek</th>
                        <th style="width: 20%;">Role</th>
                        <th style="width: 20%;">Status</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $delay = 0;
                    while ($row = mysqli_fetch_assoc($result)) { 
                        $delay += 100; 
                    ?>
                    <tr data-aos="fade-right" data-aos-delay="<?php echo $delay; ?>">
                        <td><?php echo htmlspecialchars($row['project_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['role_name']); ?></td>
                        <td>
                            <?php if ($row['status'] == 'completed') { ?>
                            <span class="badge badge-success" data-aos="zoom-in"
                                data-aos-delay="<?php echo $delay + 100; ?>">Selesai</span>
                            <?php } else { ?>
                            <span class="badge badge-warning" data-aos="zoom-in"
                                data-aos-delay="<?php echo $delay + 100; ?>">Sedang Berjalan</span>
                            <?php } ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <?php if ($row['status'] == 'ongoing') { ?>
                                <a href="index.php?complete_id=<?php echo htmlspecialchars($row['project_id']); ?>"
                                    class="btn btn-sm btn-success"
                                    onclick="return confirm('Apakah Anda yakin ingin menyelesaikan project ini?')"
                                    data-aos="zoom-in" data-aos-delay="<?php echo $delay + 150; ?>">Selesai</a>
                                <?php } ?>
                                <a href="delete.php?id=<?php echo htmlspecialchars($row['project_id']); ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus project ini?')"
                                    data-aos="zoom-in" data-aos-delay="<?php echo $delay + 200; ?>">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            once: true,
            offset: 100,
            duration: 800,
            easing: 'ease-in-out',
        });
    });
    </script>
</body>

</html>