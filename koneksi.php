<?php

// Konfigurasi database
$host     = 'localhost';
$user     = 'root';
$password = '';
$database = 'time_management';

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>