<?php
session_start();
include '../../koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Cek apakah ID ada di URL
if (isset($_GET['id'])) {
    // Ambil ID dari URL dan pastikan itu adalah integer yang valid
    $id = (int)$_GET['id']; 

    // Query untuk menghapus proyek (tidak menggunakan prepared statement)
    $query = "DELETE FROM project WHERE project_id = $id";

    // Eksekusi query dan cek hasilnya
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, redirect ke halaman index
        header('Location: index.php');
        exit;
    } else {
        // Tampilkan pesan error jika gagal menghapus proyek
        $error_message = "Gagal menghapus proyek!";
    }
} else {
    // Jika ID tidak ada, tampilkan pesan error
    $error_message = "ID proyek tidak ditemukan!";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <?php if (isset($error_message)) { ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php } ?>
        <a href="index.php" class="btn btn-secondary">Kembali ke Daftar Project</a>
    </div>
</body>

</html>