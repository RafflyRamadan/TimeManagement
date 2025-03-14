<?php
session_start();
include '../../koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Ambil ID dari URL
$id = $_GET['id'];

// Query untuk mengambil data pengguna berdasarkan ID
$query = "SELECT * FROM user WHERE user_id = $id";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

// Proses update jika form disubmit
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    
    // Mulai query update
    $query = "UPDATE user SET nama = '$nama', email = '$email'";
    
    // Cek apakah password diisi
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query .= ", password = '$password'"; // Menambahkan password ke query
    }
    
    $query .= " WHERE user_id = $id";
    
    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Gagal mengupdate user!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
                        <h3 class="mb-0">Edit User</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
                        <form method="POST">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control"
                                    value="<?php echo htmlspecialchars($user['nama']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Password (Kosongkan jika tidak ingin mengubah password)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>