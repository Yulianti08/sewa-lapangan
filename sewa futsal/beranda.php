<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Lampung Futsal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #C9E6F0;
            margin: 0;
            padding: 0;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-link {
            font-size: 1rem;
            margin-right: 15px;
        }

        .nav-link.active {
            font-weight: bold;
            color: #0d6efd !important;
        }

        .nav-link.text-danger {
            font-weight: bold;
        }

        

        ul li {
            padding: 5px 0;
            font-size: 1.1rem;
            color: #495057;
        }

    

        /* Footer Styling */
        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: #0d6efd;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Lampung Futsal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="beranda.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="penyewaan.php">Penyewaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="layanan.php">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="bukti.php">Bukti Pembayaran</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="?logout=true">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <h2>Beranda</h2>
        <p>Selamat datang di Penyewaan Lapangan Lampung Futsal. Nikmati pengalaman futsal terbaik dengan fasilitas modern.</p>
        <ul>
            <li>Jam Buka: Senin - Minggu: 08:00 - 23:00</li>
        </ul>
    </div>
    <!-- Gambar ditambahkan di sini -->
    <div class="gambar">
                <img src="https://drive.google.com/thumbnail?id=1v5sEcN9rV2ndSDZz9BJUWQiD319B_-pl" alt="Lapangan Futsal Lampung" style="width: 100%; max-width: 800px; height: auto; display: block; margin: 20px auto;">
            </div>
        </section>
        

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Lampung Futsal. <a href="index.php">Kembali ke Halaman Utama</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
