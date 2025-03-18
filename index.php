<?php
// Array yang berisi daftar jenis gedung dan harganya
$gedung = [
    ["VIP", 1000000, "vip.jpg"],
    ["Ballroom", 900000, "Ballroom.jpg"],
    ["Outdoor", 700000, "outdoor.jpg"]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"> <!-- Menentukan karakter encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsif pada perangkat mobile -->
    <title>Lima Rasa - Landing page</title> <!-- Judul halaman -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Import CSS Bootstrap -->
    <style>
        /* Styling untuk kartu produk */
        .product-card {
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
        .carousel-item img {
            height: 450px;
            object-fit: cover;
        }
        .pesan-btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Lima Rasa</a> <!-- Logo -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="img/heros.jpg" alt="Gambar Lima Rasa" class="img-fluid rounded shadow"> <!-- Gambar utama -->
            </div>
            <div class="col-md-6 text-black">
                <h1 class="fw-bold">Lima Rasa</h1>
                <p>Menciptakan Perpaduan Sempurna dalam Setiap Hidangan, Menghadirkan Kenikmatan yang Tak Terlupakan.</p>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a> <!-- Tombol pemesanan -->
            </div>
        </div>
    </div>
    <hr>

    <!-- Daftar Produk -->
    <div class="container mt-5">
        <section id="produk">
            <h2 class="text-center">Jenis Gedung Resto</h2>
            <div class="row">
                <?php foreach ($gedung as $g) { ?> <!-- Perulangan untuk menampilkan gedung -->
                <div class="col-md-4">
                    <div class="product-card">
                        <img src="img/<?= $g[2] ?>"> <!-- Gambar gedung -->
                        <h5 class="mt-2"> <?= $g[0] ?> </h5> <!-- Nama gedung -->
                        <h5 class="mt-2">Rp <?= $g[1]?></h5> <!-- Harga gedung -->
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
    </div>
    <!-- <div class="pesan-btn-container">
        <a href="pesan.php" class="btn btn-lg btn-success">Pesan Sekarang</a>
    </div> -->

    <br><h3 class="text-center">Reviewer Resto kami</h3><br>
<div class="video-container">
    <video controls>
        <source src="vid/videoresto.mp4" type="video/mp4">
        Browser Anda tidak mendukung tag video.
    </video>
</div>

<style>
    .video-container {
        width: 100%;
        max-width: 640px; /* Lebar lebih kecil */
        height: 360px; /* Sesuai rasio 16:9 */
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .video-container video {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Biar video tetap bagus */
    }
</style>


    <!-- Tentang Kami -->
    <div class="container mt-5">
        <section id="tentang">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <h2 class="card-title">Tentang Kami</h2>
                    <p class="card-text">Menyediakan Pembookingan Resto Mewah.</p>
                    <hr>
                    <h5>Hubungi Kami</h5>
                    <p><strong>📍 Alamat:</strong> Jalan Flamboyan III</p>
                    <p><strong>📞 Telepon:</strong> <a href="tel:+6258746312345">+6258746312345</a></p>
                    <p><strong>📧 Email:</strong> <a href="mailto:LimaRasa@gmail.com">LimaRasa@gmail.com</a></p>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Lima Rasa All Right Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
