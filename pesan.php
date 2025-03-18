<?php
    // Daftar jenis gedung beserta harga sewanya per hari dan gambar representatif
    $gedung = [
        ["VIP", 1000000, "vip.jpg"],
        ["Ballroom", 900000, "Ballroom.jpg"],
        ["Outdoor", 700000, "outdoor.jpg"]
    ];

    // Inisialisasi variabel default untuk form
    $pilih_gedung = $gedung[0][0]; // Default jenis gedung pertama
    $pilih_harga = $gedung[0][1]; // Default harga gedung pertama
    $catering = false; // Default catering tidak dipilih
    $durasi = ""; // Durasi string
    $total_bayar = 0; // Total pembayaran awal adalah 0
    $errors = []; // Array untuk menampung pesan error

    // Mengecek apakah form telah dikirim dengan metode POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Mengambil jenis gedung yang dipilih dari form atau default
        $pilih_gedung = $_POST['restaurant'] ?? $gedung[0][0];  

        // Mendapatkan harga berdasarkan pilihan gedung
        $pilih_harga = array_column($gedung, 1, 0)[$pilih_gedung];  

        // Mengecek apakah checkbox catering dipilih
        $catering = isset($_POST['catering']);  

        // Mengambil durasi sewa dari input form
        $durasi = $_POST['durasi'] ?? '';  

        // Mengambil nomor identitas dari input form
        $identitas = $_POST['identitas'] ?? '';  

        // Validasi: Durasi harus berupa angka dan lebih dari 0
        if (!is_numeric($durasi)) {  
            $errors[] = "Durasi harus berupa angka lebih dari 0";  
        }

        // Validasi: Nomor identitas harus berupa angka
        if (!is_numeric($_POST['identitas'])) {  
            $errors[] = "Identitas harus berupa angka";  
        }

        // Validasi: Nomor identitas harus 16 digit angka
        if (strlen($_POST['identitas']) !== 16) {
            $errors[] = "Nomor Identitas harus 16 digit angka.";
        }

        // Jika tidak ada error, hitung total pembayaran
        if (empty($errors)) {
            // Menghitung total harga sewa berdasarkan durasi
            $total_harga_gedung = $pilih_harga * $durasi;

            // Memberikan diskon 10% jika sewa 3 hari atau lebih
            $diskon = ($durasi >= 3) ? 0.1 * $total_harga_gedung : 0;

            // Menghitung biaya tambahan catering (Rp 100.000 per hari jika dipilih)
            $biaya_catering = $catering ? 100000 * $durasi : 0;

            // Menghitung total pembayaran akhir
            $total_bayar = $total_harga_gedung - $diskon + $biaya_catering;
        }

        // Menyimpan data pemesanan jika tombol "Simpan" ditekan
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $identitas = $_POST['identitas'];
            $gender = $_POST['gender'];
            $restaurant = $_POST['restaurant'];
            $check = $catering ? 'Ya' : 'Tidak'; // Konversi catering ke teks
        
            // Array menyimpan detail pesanan
            $pesanan = [
                "Nama" => $nama,
                "Nomor Identitas" => $identitas,
                "Jenis Kelamin" => $gender,
                "Jenis Gedung" => $restaurant,
                "Catering" => $check,
                "Durasi" => $durasi,
                "Diskon" => $diskon,
                "Total Bayar" => number_format($total_bayar, 0, ',', '.')
            ];
                
            // Membuat string detail pesanan untuk alert
            $detail_pesanan = "Pesanan Berhasil!\n\n";
            foreach ($pesanan as $key => $value) {
                $detail_pesanan .= "$key: $value\n";
            }
        
            // Menampilkan alert dan mengarahkan kembali ke halaman utama
            echo "<script>
                alert(`$detail_pesanan`);
                window.location.href = 'index.php';
            </script>";
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lima Rasa - Form Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white text-center">
                <h3>Form Pemesanan</h3>
            </div>
            <div class="card-body">
                <!-- Menampilkan error jika ada -->
                <?php if ($errors) { ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error) { echo "<li>$error</li>"; } ?>
                        </ul>
                    </div>
                <?php } ?>

                <!-- Form input pemesanan -->
                <form method="POST">
                    <input type="text" class="form-control mb-3" name="nama" placeholder="Nama Pemesan" value="<?= $_POST['nama'] ?? '' ?>" required>
                    
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <input class="form-check-input" type="radio" name="gender" value="Laki-laki" <?= ($_POST['gender'] ?? '') === 'Laki-laki' ? 'checked' : '' ?>> Laki-laki
                        <input class="form-check-input ms-3" type="radio" name="gender" value="Perempuan" <?= ($_POST['gender'] ?? '') === 'Perempuan' ? 'checked' : '' ?>> Perempuan
                    </div>
                    
                    <input type="text" class="form-control mb-3" name="identitas" placeholder="Nomor Identitas (16 digit)" value="<?= $_POST['identitas'] ?? '' ?>" required>
                    
                    <select class="form-select mb-3" name="restaurant" onchange="this.form.submit()">
                        <?php foreach ($gedung as $nilai) { ?>
                            <option value="<?= $nilai[0] ?>" <?= ($nilai[0] === $pilih_gedung) ? 'selected' : '' ?>>
                                <?= $nilai[0] ?>
                            </option>
                        <?php } ?>
                    </select>
                    
                    <input type="text" class="form-control mb-3" name="harga" value="<?= number_format($pilih_harga, 0, ',', '.') ?>" readonly>
                    
                    <input type="date" class="form-control mb-3" name="tanggal" value="<?= $_POST['tanggal'] ?? '' ?>" required>
                    
                    <input type="number" class="form-control mb-3" name="durasi" placeholder="Durasi Sewa (hari)" value="<?= $durasi ?>" required>
                    
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" name="catering" <?= $catering ? 'checked' : '' ?>> Termasuk catering (Rp 100.000/hari)
                    </div>

                    <button type="submit" class="btn btn-primary">Hitung Total</button>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <style>
        body{
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</body>
</html>
