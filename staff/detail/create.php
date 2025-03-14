<?php
session_start();
include '../../koneksi.php'; // Sesuaikan path ke koneksi.php

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php'); // Sesuaikan path ke login.php
    exit;
}

// Ambil daftar roles untuk dropdown
$roles_query = "SELECT * FROM role";
$roles_result = mysqli_query($koneksi, $roles_query);

// Ambil daftar projects untuk dropdown
$projects_query = "SELECT * FROM project";
$projects_result = mysqli_query($koneksi, $projects_query);

// Proses jika form disubmit
if (isset($_POST['submit'])) {
    // Validasi input
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $role_name = mysqli_real_escape_string($koneksi, $_POST['role_name']);
    $project_name = mysqli_real_escape_string($koneksi, $_POST['project_name']);
    $detail_pekerjaan = mysqli_real_escape_string($koneksi, $_POST['detail_pekerjaan']);
    $tanggal = $_POST['tanggal'];

    // Query tanpa prepared statement
    $query = "INSERT INTO detail (nama, role_name, project_name, detail_pekerjaan, tanggal) 
              VALUES ('$nama', '$role_name', '$project_name', '$detail_pekerjaan', '$tanggal')";
    
    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Gagal menambah detail!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="../dashboard_admin.php">Time Management</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Tambah Detail</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
                        <form method="POST">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role_name" class="form-control" required>
                                    <option value="">Pilih Role</option>
                                    <?php while ($role = mysqli_fetch_assoc($roles_result)) { ?>
                                    <option value="<?php echo htmlspecialchars($role['role_name']); ?>">
                                        <?php echo htmlspecialchars($role['role_name']); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Project</label>
                                <select name="project_name" class="form-control" required>
                                    <option value="">Pilih Project</option>
                                    <?php while ($project = mysqli_fetch_assoc($projects_result)) { ?>
                                    <option value="<?php echo htmlspecialchars($project['project_name']); ?>">
                                        <?php echo htmlspecialchars($project['project_name']); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Detail Pekerjaan</label>
                                <textarea name="detail_pekerjaan" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>