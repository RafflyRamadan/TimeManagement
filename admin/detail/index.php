<?php
session_start();
include '../../koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit;
}

// Query untuk mengambil semua detail dan mengurutkannya berdasarkan tanggal
$query = "SELECT * FROM detail ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- AOS CSS -->
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

    [data-aos] {
        transition-duration: 800ms;
    }

    .table-container {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background-color: white;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" data-aos="fade-down" data-aos-duration="1000">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php">Details Management</a>
            <img src="../../img/logo_kai.png" alt="" width="70px">
        </div>
    </nav>

    <div class="container mt-4">
        <div class="page-header d-flex justify-content-between align-items-center mb-4" data-aos="fade-up"
            data-aos-delay="200">
            <h2>Daftar Detail</h2>
            <div>
                <a href="create.php" class="btn btn-primary" data-aos="zoom-in" data-aos-delay="400">Tambah Detail</a>
                <a href="../dashboard_admin.php" class="btn btn-secondary" data-aos="zoom-in"
                    data-aos-delay="500">Kembali ke Dashboard</a>
            </div>
        </div>

        <div class="table-container" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1200">
            <table class="table table-striped table-bordered mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 15%;">Nama</th>
                        <th style="width: 15%;">Role</th>
                        <th style="width: 20%;">Project</th>
                        <th style="width: 25%;">Detail Pekerjaan</th>
                        <th style="width: 10%;">Tanggal</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; while ($row = mysqli_fetch_assoc($result)) { $i++; ?>
                    <tr data-aos="fade-up" data-aos-delay="<?php echo 100 + ($i * 30); ?>">
                        <td><?php echo htmlspecialchars($row['detail_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['role_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['detail_pekerjaan']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="edit.php?id=<?php echo $row['detail_id']; ?>"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete.php?id=<?php echo $row['detail_id']; ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus detail ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>

    // inisialisasi AOS
    AOS.init({
        once: true,
        mirror: false,
        easing: 'ease-out-cubic', 
        offset: 100 
    });

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            AOS.refresh();
        }, 100);
    });
    </script>
</body>

</html>