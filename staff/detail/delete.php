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
    // Ambil ID dari URL dan pastikan ID adalah integer
    $id = (int)$_GET['id'];

    // Query untuk menghapus detail tanpa prepared statement
    $query = "DELETE FROM detail WHERE detail_id = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika berhasil menghapus, redirect ke halaman index
        header('Location: index.php');
        exit;
    } else {
        // Jika gagal menghapus, tampilkan pesan error
        $_SESSION['error'] = "Gagal menghapus detail!";
        header('Location: error_page.php'); // Redirect ke halaman error
        exit;
    }
} else {
    // Jika ID tidak ditemukan di URL, tampilkan pesan error
    $_SESSION['error'] = "ID detail tidak ditemukan!";
    header('Location: error_page.php'); // Redirect ke halaman error
    exit;
}
?>