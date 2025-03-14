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
    // Ambil ID dari URL
    $id = (int)$_GET['id']; // Pastikan ID adalah integer

    // Cek apakah ada data yang bergantung di tabel lain (misalnya tabel project)
    $checkQuery = "SELECT * FROM project WHERE role_id = $id";
    $resultCheck = mysqli_query($koneksi, $checkQuery);

    if (mysqli_num_rows($resultCheck) > 0) {
        // Jika ada data yang bergantung, tampilkan pesan kesalahan
        echo '<!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Hapus Role</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container mt-4">
                <div class="alert alert-danger">Tidak bisa menghapus role ini karena masih ada data yang bergantung padanya di tabel project!</div>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </body>
        </html>';
        exit;
    }

    // Query untuk menghapus role
    $query = "DELETE FROM role WHERE role_id = $id";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php'); // Redirect ke halaman index setelah berhasil dihapus
        exit;
    } else {
        // Tampilkan pesan error jika gagal menghapus
        echo '<!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Hapus Role</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container mt-4">
                <div class="alert alert-danger">Gagal menghapus role!</div>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </body>
        </html>';
    }
} else {
    // Jika ID tidak ada, tampilkan pesan error
    echo '<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hapus Role</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-4">
            <div class="alert alert-danger">ID role tidak ditemukan!</div>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
    </body>
    </html>';
}
?>