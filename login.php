<?php
session_start();
include('koneksi.php');

$pesan = "";
$alert_class = "alert-danger";

// Cek apakah form login disubmit
if (isset($_POST['login'])) {
    // Mengambil input
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Query untuk mengambil data user berdasarkan email
    $query = "SELECT * FROM User WHERE email = '$email'";
    $hasil = mysqli_query($koneksi, $query);
    
    // Cek apakah email ditemukan
    if ($hasil && mysqli_num_rows($hasil) > 0) {
        $user = mysqli_fetch_assoc($hasil);
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Login berhasil - Menyimpan data user ke session 
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['nama'] = $user['nama'];

            // Redirect berdasarkan level pengguna
            if ($user['level'] == 'admin') {
                header("Location: admin/dashboard_admin.php");
            } else {
                header("Location: staff/dashboard_staff.php");
            }
            exit;
        } else {
            // Password salah
            $pesan = "Email atau password salah!";
        }
    } else {
        // Email tidak ditemukan
        $pesan = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- External CSS -->
    <!-- <link rel="stylesheet" href="css/login.css"> -->

    <style>
        body {
    background-image: url("img/log_kai2.jpg");
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
    content: "";
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
    max-width: 400px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background: rgba(255, 255, 255, 0.9);
    z-index: 1;
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
    color: #6c757d;
}
    </style>
</head>

<body>
    <!-- Card Login -->
    <div class="card">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan error jika ada -->
            <?php if (!empty($pesan)): ?>
            <div class="alert <?php echo $alert_class; ?>">
                <?php echo $pesan; ?>
            </div>
            <?php endif; ?>

            <!-- Form Login -->
            <form action="" method="POST">
                <!-- Field Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                </div>

                <!-- Field Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <span class="toggle-password" onclick="togglePassword()">👁️</span>
                    </div>
                </div>

                <!-- Checkbox "Ingat saya" -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Ingat saya</label>
                </div>

                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-primary">Masuk</button>
                </div>
            </form>

            <div class="mt-3 text-center">
                <a href="forgot_password.php">Lupa password?</a><br>
                <a href="register.php">Daftar Akun Baru</a><br>
                <a href="index.php">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS -->
    <script>
    // Fungsi untuk menampilkan/menyembunyikan password
    function togglePassword() {
        const passwordInput = document.getElementById('password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    }

    // Otomatis sembunyikan pesan alert setelah 5 detik
    setTimeout(function() {
        const alerts = document.getElementsByClassName('alert');
        if (alerts.length > 0) {
            alerts[0].style.display = 'none';
        }
    }, 5000);
    </script>
</body>

</html>