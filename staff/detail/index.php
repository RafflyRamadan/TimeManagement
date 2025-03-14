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

if (!$result) {
    die("Error dalam query: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Detail</title>
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
            <a class="navbar-brand" href="../dashboard.php" data-aos="fade-down">Details Management</a>
            <img src="../img/logo_kai.png" alt="" width="70px" data-aos="fade-down">
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 data-aos="fade-right">Daftar Detail</h2>
            <div>
                <a href="create.php" class="btn btn-primary" data-aos="fade-left">Tambah Detail</a>
                <a href="../dashboard_staff.php" class="btn btn-secondary" data-aos="fade-left">Kembali ke Dashboard</a>
            </div>
        </div>

        <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-striped table-bordered">
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
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr data-aos="fade-up" data-aos-duration="700">
                    <td><?php echo htmlspecialchars($row['detail_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td><?php echo htmlspecialchars($row['role_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['detail_pekerjaan']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="edit.php?id=<?php echo $row['detail_id']; ?>" class="btn btn-sm btn-warning"
                                data-aos="zoom-in">Edit</a>
                            <a href="delete.php?id=<?php echo $row['detail_id']; ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus detail ini?')"
                                data-aos="zoom-in">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
        <div style="text-align: center; padding: 2rem;" data-aos="fade-up">
            <p>Belum ada detail yang tersedia.</p>
        </div>
        <?php } ?>
    </div>

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
    // Inisialisasi AOS
    AOS.init({
        duration: 1000, 
        once: true, // Animasi hanya terjadi sekali
    });
    </script>
</body>

</html>