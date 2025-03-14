<?php
include 'koneksi.php';

$pesan = "";
$alert_class = "alert-info";

// Proses form saat tombol register ditekan
if (isset($_POST['register'])) {
    // Mengambil dan membersihkan input dari form
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

    // Validasi input
    if (empty($nama) || empty($email) || empty($password) || empty($confirm_password)) {
        $pesan = "Semua kolom harus diisi!";
        $alert_class = "alert-danger";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesan = "Format email tidak valid!";
        $alert_class = "alert-danger";
    } elseif ($password !== $confirm_password) {
        $pesan = "Password dan konfirmasi password tidak cocok!";
        $alert_class = "alert-danger";
    } else {
        // Cek apakah email sudah terdaftar
        $cek_email = mysqli_query($koneksi, "SELECT email FROM user WHERE email = '$email'");

        if (mysqli_num_rows($cek_email) > 0) {
            $pesan = "Email sudah terdaftar!";
            $alert_class = "alert-warning";
        } else {
            // Hash password sebelum disimpan
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data pengguna ke database
            $query = "INSERT INTO user (nama, email, password) VALUES ('$nama', '$email', '$hashed_password')";
            
            if (mysqli_query($koneksi, $query)) {
                $pesan = "Registrasi berhasil! Silakan login.";
                $alert_class = "alert-success";
                
                // Reset form setelah registrasi berhasil
                $nama = $email = $password = $confirm_password = "";
            } else {
                $pesan = "Terjadi kesalahan saat registrasi: " . mysqli_error($koneksi);
                $alert_class = "alert-danger";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="css/register.css"> -->

    <style>
        body {
    background-image: url('img/log_kai2.jpg');
    background-size: cover;
    background-position: center bottom;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Overlay untuk membuat konten lebih mudah dibaca */
body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    /* Overlay hitam dengan opacity 50% */
    z-index: 0;
}

.card {
    width: 100%;
    max-width: 500px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background: rgba(255, 255, 255, 0.9);
    /* Latar belakang card semi-transparan */
    z-index: 1;
    /* Pastikan card berada di atas overlay */
}

.card-header {
    background-color: blue;
    color: white;
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
}

.btn-primary {
    background-color: blue;
    border-color: blue;
}

.btn-primary:hover {
    background-color: darkblue;
    border-color: darkblue;
}

.toggle-password {
    cursor: pointer;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: gray;
}
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            Registrasi
        </div>
        <div class="card-body">
            <?php if (isset($pesan) && !empty($pesan)): ?>
            <div class="alert <?php echo $alert_class; ?>">
                <?php echo $pesan; ?>
            </div>
            <?php endif; ?>

            <form action="" method="POST" id="registrationForm">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control"
                        value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('password')">👁️</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                    <div class="position-relative">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                            required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('confirm_password')">👁️</span>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" name="register" class="btn btn-primary">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-3 text-center">
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
    // Fungsi untuk menampilkan/menyembunyikan password
    function togglePasswordVisibility(fieldId) {
        const passwordField = document.getElementById(fieldId);

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    }

    // Validasi form di sisi client sebelum dikirim ke server
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            event.preventDefault();
            alert('Password dan konfirmasi password tidak cocok!');
        }
    });
    </script>
</body>

</html>