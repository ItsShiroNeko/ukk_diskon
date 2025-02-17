<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM tb_barang");

// Query untuk menampilkan transaksi diskon
$transaksi_query = mysqli_query($koneksi, "SELECT td.id_transaksi, b.nama_barang, td.diskon, td.totharga 
    FROM trans_diskon td 
    JOIN tb_barang b ON td.id_barang = b.id_barang
    ORDER BY td.id_transaksi DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Diskon Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-calculator me-2"></i>Sistem Diskon</a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0 text-center"><i class="fas fa-percent me-2"></i>Hitung Diskon</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="aksi_diskon.php">
                            <div class="mb-4">
                                <label for="barang" class="form-label text-muted">Nama Barang</label>
                                <select name="barang" id="barang" class="form-select shadow-sm" onchange="tampilkanHarga()" required>
                                    <option value="" data-harga="">-- Pilih Barang --</option>
                                    <?php while ($data = mysqli_fetch_array($query)): ?>
                                        <option value="<?= $data['id_barang'] ?>" data-harga="<?= $data['harga'] ?>">
                                            <?= $data['nama_barang'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted">Harga Barang</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">Rp</span>
                                    <input type="text" id="harga" name="harga" class="form-control shadow-sm" readonly placeholder="0">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="diskon" class="form-label text-muted">Persentase Diskon</label>
                                <div class="input-group">
                                    <input type="number" id="diskon" name="diskon" class="form-control shadow-sm" min="0" max="100" step="any" required placeholder="0">
                                    <span class="input-group-text bg-light">%</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3 shadow-sm">
                                <i class="fas fa-calculator me-2"></i>Hitung Diskon
                            </button>
                        </form>
                        <div class="d-grid gap-2">
                            <a href="insert_barang.php" class="btn btn-success shadow-sm">
                                <i class="fas fa-plus me-2"></i>Tambah Barang
                            </a>
                            <a href="hapus_barang.php" class="btn btn-danger shadow-sm">
                                <i class="fas fa-trash me-2"></i>Hapus Barang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0 text-center"><i class="fas fa-history me-2"></i>Riwayat Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 417px; overflow-y: auto;">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Awal</th>
                                        <th>Diskon</th>
                                        <th>Nomial Diskon</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $transaksi_query = mysqli_query(
                                        $koneksi,
                                        "SELECT td.id_transaksi, td.diskon, td.totharga, b.nama_barang, b.harga
                FROM trans_diskon td 
                JOIN tb_barang b ON td.id_barang = b.id_barang 
                ORDER BY td.id_transaksi DESC");
                                    $no = 1;
                                    while ($transaksi = mysqli_fetch_array($transaksi_query)): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $transaksi['nama_barang']; ?></td>
                                            <td>Rp <?= number_format($transaksi['harga'], 2, ',', '.'); ?></td>
                                            <td><span class="badge bg-info"><?= $transaksi['diskon']; ?>%</span></td>
                                            <td><span class="badge bg-secondary"><?php echo $transaksi['harga'] * ($transaksi['diskon'] / 100)?></span></td>
                                            <td><span class="badge bg-success">Rp <?= number_format($transaksi['totharga'], 2, ',', '.'); ?></span></td>
                                            <td>
                                                <a href="edit_barang.php?id=<?= $transaksi['id_transaksi']; ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="hapus_diskon.php?id=<?= $transaksi['id_transaksi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <?php if (mysqli_num_rows($transaksi_query) == 0): ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Belum ada transaksi</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tampilkanHarga() {
            var select = document.getElementById("barang");
            var harga = select.options[select.selectedIndex].getAttribute("data-harga");
            document.getElementById("harga").value = harga ? parseInt(harga).toLocaleString("id-ID") : "0";
        }
    </script>
</body>
</html>