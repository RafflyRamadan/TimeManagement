<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Management by KAI</title>
    <!-- CSS Eksternal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#hero">
                <i class="fas fa-train-subway"></i> TIG<span style="color: yellow;">KAI</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#organization">Struktur</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero-section">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <h1>Time Management by KAI</h1>
            <p>Lihat proyek, kerjakan tugas, dan kelola progres dengan lebih efektif.</p>
            <div>
                <a href="#features" class="cta-btn">Mulai Sekarang</a>
                <a href="login.php" class="cta-btn outline">Login</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features">
        <div class="container">
            <div class="section-header" data-aos="fade-up" data-aos-duration="800">
                <h2>Fitur Kami</h2>
                <p>Solusi manajemen waktu yang terintegrasi untuk meningkatkan kinerja.</p>
            </div>
            <div class="row">
                <!-- Fitur 1 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3>Lihat Progress</h3>
                        <p>Pantau perkembangan tugas Anda secara real-time dengan tampilan dashboard yang komprehensif
                            dan visual.</p>
                    </div>
                </div>

                <!-- Fitur 2 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h3>Cetak Laporan</h3>
                        <p>Hasilkan laporan yang rapi dan terstruktur sesuai kebutuhan Anda dengan format yang
                            profesional.</p>
                    </div>
                </div>

                <!-- Fitur 3 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3>Notifikasi</h3>
                        <p>Dapatkan pengingat waktu untuk tugas Anda melalui email atau aplikasi sehingga tidak ada
                            pekerjaan yang terlewat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Organization Section -->
    <section id="organization" class="organization-section">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">Struktur Organisasi</h2>
            <div class="row">
                <!-- Struktur 1 -->
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100" data-aos-duration="800">
                    <div class="organization-card">
                        <div class="org-icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <h3>Manajemen</h3>
                        <p>Tim yang bertanggung jawab atas strategi dan pengambilan keputusan untuk memastikan arah
                            perusahaan yang tepat.</p>
                    </div>
                </div>

                <!-- Struktur 2 -->
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="800">
                    <div class="organization-card">
                        <div class="org-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3>Operasional</h3>
                        <p>Tim yang menjalankan kegiatan harian perusahaan dan memastikan kelancaran semua proses
                            bisnis.</p>
                    </div>
                </div>

                <!-- Struktur 3 -->
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="800">
                    <div class="organization-card">
                        <div class="org-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3>IT & Teknologi</h3>
                        <p>Tim yang mengembangkan dan memelihara sistem teknologi untuk mendukung kebutuhan perusahaan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- Informasi Website -->
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="800">
                    <h4>Time Go KAI (TigKAI)</h4>
                    <hr>
                    <p>TigKAI adalah website manajemen waktu yang dirancang untuk membantu mengelola tugas sehari-hari
                        dengan lebih efisien.</p>
                    <p>Dengan fitur pengelolaan proyek, penanda, dan pencatatan laporan yang bisa membantu mencapai
                        produktivitas maksimal.</p>
                </div>

                <!-- Kontak -->
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="800">
                    <h4>Kontak Kami</h4>
                    <hr>
                    <p><i class="fas fa-map-marker-alt"></i> Jl. Ir. H. Juanda, Sekeloa, Kecamatan Coblong, <br>Kota
                        Bandung, Jawa Barat 40134</p>
                    <p><i class="fas fa-phone-alt"></i> +62 812-2365-2494</p>
                    <p><i class="fas fa-envelope"></i> rafflyputrar@gmail.com</p>
                </div>
            </div>

            <!-- Copyright -->
            <div class="footer-bottom">
                <p>&copy; 2025 Time Management by KAI. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <!-- Custom JavaScript -->
    <script>
    // Inisialisasi Animate On Scroll
    AOS.init({
        once: false, // Animasi hanya terjadi sekali saat scroll ke bawah
        mirror: false // Elemen tidak beranimasi saat scroll melewatinya
    });

    // Menu mobile otomatis tertutup saat diklik
    const navLinks = document.querySelectorAll('.nav-link');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
        toggle: false
    });

    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function() {
            // Hanya tutup pada tampilan mobile (lebar < 992px)
            if (window.innerWidth < 992) {
                bsCollapse.hide();
            }
        });
    });
    </script>
</body>

</html>