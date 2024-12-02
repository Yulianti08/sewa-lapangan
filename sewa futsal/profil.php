<?php
session_start();
include 'connect.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "Pengguna"; // Placeholder jika tidak ada data login
}

// Ambil data pengguna dari database
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Proses upload foto profil
if (isset($_POST['upload'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["profile_picture"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
        // Update path foto profil di database
        $updateQuery = "UPDATE users SET profile_picture = '$targetFilePath' WHERE username = '$username'";
        mysqli_query($conn, $updateQuery);
        header("Location: profil.php");
        exit();
    } else {
        echo "<script>alert('foto berhasil diganti.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Lampung Futsal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 20px auto;
            border: 2px solid #3498db;
            cursor: pointer;
        }
        .profile-container {
            position: relative;
            display: inline-block;
        }
        .change-pic-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 40px;
            height: 40px;
            background-color: #3498db;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: white;
            font-size: 24px;
            border: none;
        }
        .change-pic-btn:hover {
            background-color: #2980b9;
        }
        .change-pic-text {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #3498db;
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
                    <li class="nav-item"><a class="nav-link" href="beranda.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="penyewaan.php">Penyewaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="layanan.php">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="bukti.php">Bukti Pembayaran</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
                    <li class="nav-item"><a class="nav-link active" href="profil.php">Profil</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Profil -->
    <div class="container mt-5 text-center">
        <div class="profile-section">
            <div class="profile-container">
               <img src="<?php echo $user['profile_picture'] ?: 'default.jpg'; ?>" alt="Foto Profil" class="profile-pic">
                <form method="POST" enctype="multipart/form-data" class="mt-3">
                    <label for="profile_picture" class="change-pic-btn" title="Ganti Foto Profil">+</label>
                    <input type="file" id="profile_picture" name="profile_picture" class="d-none" accept="image/*" onchange="this.form.submit()">
                </form>
            </div>
            <h2 class="mt-3"><?php echo $user['username']; ?></h2>
        </div>

        <!-- Modal untuk melihat foto profil lebih besar -->
        <div class="modal fade" id="profilePicModal" tabindex="-1" aria-labelledby="profilePicModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="<?php echo $user['profile_picture'] ?: 'default.jpg'; ?>" alt="Foto Profil Besar" class="w-100">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol untuk ganti password -->
        <div class="text-center mt-4">
            <button class="btn btn-warning" onclick="window.location.href='ganti_password.php'">Ganti Password</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
