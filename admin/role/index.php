<?php
session_start();
include '../../koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Query untuk mengambil semua data role
$query = "SELECT * FROM role";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Role</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <style>
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #f5f5f5;
        }
        .btn-group .btn {
            margin-right: 5px;
        }
        
        [data-aos] {
            transition-duration: 800ms;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" data-aos="fade-down">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php">Roles Management</a>
            <img src="../../img/logo_kai.png" alt="Logo KAI" width="70px">
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up" data-aos-delay="200">
            <h2>Daftar Peran</h2>
            <div>
                <a href="create.php" class="btn btn-primary" data-aos="zoom-in" data-aos-delay="400">Tambah Role</a>
                <a href="../dashboard_admin.php" class="btn btn-secondary" data-aos="zoom-in" data-aos-delay="500">Kembali ke Dashboard</a>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="300">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 30%;">Role Name</th>
                        <th style="width: 40%;">Keterangan</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; while ($row = mysqli_fetch_assoc($result)) { $i++; ?>
                        <tr data-aos="fade-right" data-aos-delay="<?php echo 100 + ($i * 50); ?>">
                            <td><?php echo htmlspecialchars($row['role_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['role_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="edit.php?id=<?php echo htmlspecialchars($row['role_id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="delete.php?id=<?php echo htmlspecialchars($row['role_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')">Hapus</a>
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

        // AOS
        AOS.init({
            once: true, 
            mirror: false, 
            easing: 'ease-out-cubic',
            offset: 100 
        });
    </script>
</body>
</html>