<?php
session_start(); // Memulai session

// Simulasi data pemesanan lapangan (untuk tujuan demonstrasi)
$lapanganA = [["09:00", "10:00"], ["10:30", "12:00"], ["13:00", "14:30"]];
$lapanganB = [["08:00", "09:30"], ["12:00", "13:30"], ["15:00", "16:30"]];

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $lapangan = $_POST['lapangan'];

    // Cek apakah lapangan yang dipilih sudah dibooking
    $booking_conflict = false;
    if ($lapangan == "A") {
        foreach ($lapanganA as $booking) {
            if (($jam_mulai >= $booking[0] && $jam_mulai < $booking[1]) || ($jam_selesai > $booking[0] && $jam_selesai <= $booking[1])) {
                $booking_conflict = true;
                break;
            }
        }
    } else {
        foreach ($lapanganB as $booking) {
            if (($jam_mulai >= $booking[0] && $jam_mulai < $booking[1]) || ($jam_selesai > $booking[0] && $jam_selesai <= $booking[1])) {
                $booking_conflict = true;
                break;
            }
        }
    }

    if ($booking_conflict) {
        $_SESSION['error_message'] = "Lapangan $lapangan pada jam mulai $jam_mulai dan jam selesai $jam_selesai sudah dibooking.";
    } else {
        // Menambahkan pemesanan baru ke daftar lapangan
        if ($lapangan == "A") {
            $lapanganA[] = [$jam_mulai, $jam_selesai];
        } else {
            $lapanganB[] = [$jam_mulai, $jam_selesai];
        }

        // Menyimpan data pemesanan dalam session
        $_SESSION['pesanan'] = [
            'nama' => $nama,
            'tanggal' => $tanggal,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'lapangan' => $lapangan
        ];

        $_SESSION['success_message'] = "Pemesanan berhasil!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penyewaan - Lampung Futsal</title>
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
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="beranda.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="penyewaan.php">Penyewaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="layanan.php">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="bukti.php">Bukti Pembayaran</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <h2>Penyewaan Lapangan</h2>
        <p>Kami menyediakan lapangan futsal berkualitas tinggi dengan fasilitas terbaik di Lampung.</p>
        <ul>
            <li>Harga per jam: Rp 170.000</li>
            <li>Harga paket 5 jam: Rp 700.000</li>
            <li>Diskon 20% khusus untuk mahasiswa menggunakan KTM.</li>
        </ul>

        <!-- Tampilkan pesan jika ada error atau sukses -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>

        <!-- Form Pemesanan -->
        <form class="mt-3" action="" method="POST">
            <label for="nama">Nama Pemesan:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
            <label for="tanggal">Tanggal Sewa:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            <label for="jam_mulai">Jam Mulai:</label>
            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
            <label for="jam_selesai">Jam Selesai:</label>
            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
            <label for="lapangan">Pilih Lapangan:</label>
            <select class="form-control" id="lapangan" name="lapangan" required>
                <option value="A">Lapangan A</option>
                <option value="B">Lapangan B</option>
            </select>
            <button type="submit" class="btn btn-primary mt-3">Pesan Sekarang</button>
        </form>

        <!-- Tampilkan data pemesanan jika ada -->
        <?php if (isset($_SESSION['pesanan'])): ?>
            <div class="mt-4">
                <h4>Data Pemesan:</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Sewa</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Lapangan</th>
                    </tr>
                    <tr>
                        <td><?php echo $_SESSION['pesanan']['nama']; ?></td>
                        <td><?php echo $_SESSION['pesanan']['tanggal']; ?></td>
                        <td><?php echo $_SESSION['pesanan']['jam_mulai']; ?></td>
                        <td><?php echo $_SESSION['pesanan']['jam_selesai']; ?></td>
                        <td><?php echo $_SESSION['pesanan']['lapangan']; ?></td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <a href="index.php">Home</a> | All rights reserved.</p>
</body>
</html>
