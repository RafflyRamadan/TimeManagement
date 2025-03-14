<?php session_start(); include '../../koneksi.php'; 

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Query untuk mengambil semua data pengguna tanpa prepared statement
$query = "SELECT * FROM user";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna</title>
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

    /* Navbar */
    .navbar {
        background-color: darkslategray;
        padding: 1rem 2rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logout-form {
        display: inline;
    }

    .logout-btn {
        background: none;
        border: none;
        color: darkred;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .logout-btn:hover {
        background-color: darkred;
        color: white;
    }

    [data-aos] {
        transition-duration: 800ms;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" data-aos="fade-down" data-aos-duration="1000">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php">Users Management</a>
            <img src="../../img/logo_kai.png" alt="Logo KAI" width="70px">
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up" data-aos-delay="200">
            <h2>Daftar Pengguna</h2>
            <div>
                <a href="create.php" class="btn btn-primary" data-aos="zoom-in" data-aos-delay="400">Tambah User</a>
                <a href="../dashboard_admin.php" class="btn btn-secondary" data-aos="zoom-in"
                    data-aos-delay="500">Kembali ke Dashboard</a>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="1200">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 35%;">Nama</th>
                        <th style="width: 35%;">Email</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; while ($row = mysqli_fetch_assoc($result)) { $i++; ?>
                    <tr data-aos="fade-right" data-aos-delay="<?php echo 100 + ($i * 50); ?>">
                        <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="edit.php?id=<?php echo $row['user_id']; ?>"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete.php?id=<?php echo $row['user_id']; ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</a>
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

    // Initialize AOS
    AOS.init({
        once: true, 
        mirror: false, 
        easing: 'ease-out-cubic', 
    });
    </script>
</body>

</html>