<?php
session_start();
include '../../koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Ambil ID dari URL
$id = (int)$_GET['id']; // Pastikan ID adalah integer

// Query untuk mengambil data role berdasarkan ID
$query = "SELECT * FROM role WHERE role_id = $id";
$result = mysqli_query($koneksi, $query);
$role = mysqli_fetch_assoc($result);

// Proses jika form disubmit
if (isset($_POST['submit'])) {
    $role_name = mysqli_real_escape_string($koneksi, $_POST['role_name']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    
    // Query untuk update
    $query = "UPDATE role SET role_name = '$role_name', keterangan = '$keterangan' WHERE role_id = $id";
    
    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php');
        exit;
    } else {
        $error = " Gagal mengupdate role!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php">Time Management</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Edit Role</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
                        <form method="POST">
                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" name="role_name" class="form-control"
                                    value="<?php echo htmlspecialchars($role['role_name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3"
                                    required><?php echo htmlspecialchars($role['keterangan']); ?></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>