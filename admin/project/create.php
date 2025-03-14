<?php
session_start();
include '../../koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Ambil daftar roles untuk dropdown
$roles_query = "SELECT * FROM role";
$roles_result = mysqli_query($koneksi, $roles_query);

// Proses jika form disubmit
if (isset($_POST['submit'])) {
    $project_name = mysqli_real_escape_string($koneksi, $_POST['project_name']);
    $role_id = (int)$_POST['role_id'];

    // Validasi jika role_id tidak kosong
    if ($role_id === 0) {
        $error = "Role harus dipilih!";
    } elseif (empty($project_name)) {
        $error = "Nama proyek tidak boleh kosong!";
    } else {
        // Query untuk menambah proyek (tidak menggunakan prepared statement)
        $query = "INSERT INTO project (project_name, role_id) VALUES ('$project_name', $role_id)";

        if (mysqli_query($koneksi, $query)) {
            header('Location: index.php');
            exit;
        } else {
            $error = "Gagal menambah project!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Project</title>
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
                        <h3 class="mb-0">Tambah Project</h3>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan error jika ada -->
                        <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                        <?php } ?>
                        <form method="POST">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" name="project_name" class="form-control"
                                    value="<?php echo isset($project_name) ? htmlspecialchars($project_name) : ''; ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role_id" class="form-control" required>
                                    <option value="">Pilih Role</option>
                                    <?php while ($role = mysqli_fetch_assoc($roles_result)) { ?>
                                    <option value="<?php echo $role['role_id']; ?>"
                                        <?php echo (isset($role_id) && $role_id == $role['role_id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($role['role_name']); ?>
                                    </option>
                                    <?php } ?>
                                </select>
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