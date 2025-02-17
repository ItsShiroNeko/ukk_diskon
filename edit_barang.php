<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];
    $query = mysqli_query($koneksi, 
        "SELECT td.id_transaksi, td.diskon, td.totharga, b.id_barang, b.nama_barang, b.harga 
        FROM trans_diskon td 
        JOIN tb_barang b ON td.id_barang = b.id_barang 
        WHERE td.id_transaksi = '$id_transaksi'"
    );
    $transaksi = mysqli_fetch_assoc($query);


    if (!$transaksi) {
        echo "<script>alert('Transaksi tidak ditemukan!'); location.href='index.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID transaksi tidak valid!'); location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang & Diskon | Sistem Diskon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-calculator me-2"></i>Sistem Diskon
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0 text-center">
                            <i class="fas fa-edit me-2"></i>Edit Barang & Diskon
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="proses_edit_barang.php">
                            <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
                            <input type="hidden" name="id_barang" value="<?= $transaksi['id_barang']; ?>">

                            <div class="mb-4">
                                <label for="nama_barang" class="form-label text-muted">
                                    <i class="fas fa-box me-1"></i>Nama Barang
                                </label>
                                <input type="text" 
                                       id="nama_barang" 
                                       name="nama_barang" 
                                       class="form-control form-control-lg shadow-sm" 
                                       required
                                       value="<?php echo $transaksi['nama_barang']?>"
                                       placeholder="Masukkan nama barang">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Data sebelumnya: <?php echo $transaksi['nama_barang']?>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="harga" class="form-label text-muted">
                                    <i class="fas fa-tag me-1"></i>Harga Barang
                                </label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <span class="input-group-text bg-light">Rp</span>
                                    <input type="text" 
                                           id="harga" 
                                           class="form-control" 
                                           required
                                           value="<?php echo number_format($transaksi['harga'], 0, ',', '.')?>"
                                           oninput="formatRupiah(this)">
                                </div>
                                <input type="hidden" id="harga_format" name="harga">
                            </div>

                            <div class="mb-4">
                                <label for="diskon" class="form-label text-muted">
                                    <i class="fas fa-percent me-1"></i>Diskon
                                </label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <input type="number" 
                                           id="diskon" 
                                           name="diskon" 
                                           class="form-control" 
                                           min="0" 
                                           max="100" 
                                           required 
                                           value="<?= $transaksi['diskon']; ?>">
                                    <span class="input-group-text bg-light">%</span>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                                </button>
                                <a href="index.php" class="btn btn-outline-secondary btn-lg shadow-sm">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function formatRupiah(input) {
            let angka = input.value.replace(/\D/g, '');
            let formatted = new Intl.NumberFormat("id-ID").format(angka);
            input.value = formatted;
            document.getElementById("harga_format").value = angka;
        }
    </script>
</body>
</html>