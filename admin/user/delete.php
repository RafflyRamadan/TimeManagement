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
    $id = $_GET['id'];

    // Query untuk menghapus pengguna
    $query = "DELETE FROM user WHERE user_id = $id";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php'); // Redirect ke halaman index setelah berhasil dihapus
        exit;
    } else {
        // Tampilkan pesan error jika gagal menghapus
        echo "<div class='alert alert-danger'>Gagal menghapus user!</div>";
        echo "<br><a href='index.php' class='btn btn-secondary'>Kembali</a>";
    }
} else {
    // Jika ID tidak ada, tampilkan pesan error
    echo "<div class='alert alert-danger'>ID pengguna tidak ditemukan!</div>";
    echo "<br><a href='index.php' class='btn btn-secondary'>Kembali</a>";
}

// Menutup koneksi
mysqli_close($koneksi);
?>