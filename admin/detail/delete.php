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

    // Query untuk menghapus data tanpa prepared statement
    $query = "DELETE FROM detail WHERE detail_id = $id";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php'); // Redirect ke halaman index setelah berhasil dihapus
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        $_SESSION['error_message'] = 'Gagal menghapus detail!';
        header('Location: index.php'); // Redirect kembali ke index.php dengan pesan error
        exit;
    }
} else {
    // Jika ID tidak ada di URL, tampilkan pesan error
    $_SESSION['error_message'] = 'ID detail tidak ditemukan!';
    header('Location: index.php'); // Redirect kembali ke index.php dengan pesan error
    exit;
}
?>