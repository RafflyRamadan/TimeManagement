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

// Query untuk mengambil detail berdasarkan ID
$query = "SELECT * FROM detail WHERE detail_id = $id";
$result = mysqli_query($koneksi, $query);
$detail = mysqli_fetch_assoc($result);

// Ambil daftar roles untuk dropdown
$roles_query = "SELECT * FROM role";
$roles_result = mysqli_query($koneksi, $roles_query);

// Ambil daftar projects untuk dropdown
$projects_query = "SELECT * FROM project";
$projects_result = mysqli_query($koneksi, $projects_query);

// Proses jika form disubmit
if (isset($_POST['submit'])) {
    // Ambil data dari form dan sanitasi
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $role_name = mysqli_real_escape_string($koneksi, $_POST['role_name']);
    $project_name = mysqli_real_escape_string($koneksi, $_POST['project_name']);
    $detail_pekerjaan = mysqli_real_escape_string($koneksi, $_POST['detail_pekerjaan']);
    $tanggal = $_POST['tanggal'];
    
    // Query untuk update
    $query = "UPDATE detail SET 
              nama = '$nama', 
              role_name = '$role_name', 
              project_name = '$project_name', 
              detail_pekerjaan = '$detail_pekerjaan', 
              tanggal = '$tanggal' 
              WHERE detail_id = $id";
    
    // Eksekusi query update
    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Gagal mengupdate detail!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Detail</title>
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
                        <h3 class="mb-0">Edit Detail</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
                        <form method="POST">
                            <!-- Nama Field -->
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control"
                                    value="<?php echo htmlspecialchars($detail['nama']); ?>" required>
                            </div>

                            <!-- Role Dropdown -->
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role_name" class="form-control" required>
                                    <option value="">Pilih Role</option>
                                    <?php while ($role = mysqli_fetch_assoc($roles_result)) { ?>
                                    <option value="<?php echo htmlspecialchars($role['role_name']); ?>"
                                        <?php echo ($role['role_name'] == $detail['role_name']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($role['role_name']); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Project Dropdown -->
                            <div class="form-group">
                                <label>Project</label>
                                <select name="project_name" class="form-control" required>
                                    <option value="">Pilih Project</option>
                                    <?php while ($project = mysqli_fetch_assoc($projects_result)) { ?>
                                    <option value="<?php echo htmlspecialchars($project['project_name']); ?>"
                                        <?php echo ($project['project_name'] == $detail['project_name']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($project['project_name']); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Detail Pekerjaan -->
                            <div class="form-group">
                                <label>Detail Pekerjaan</label>
                                <textarea name="detail_pekerjaan" class="form-control" rows="3"
                                    required><?php echo htmlspecialchars($detail['detail_pekerjaan']); ?></textarea>
                            </div>

                            <!-- Tanggal -->
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control"
                                    value="<?php echo htmlspecialchars($detail['tanggal']); ?>" required>
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