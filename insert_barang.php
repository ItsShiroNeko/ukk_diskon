<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru | Sistem Diskon</title>
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
                            <i class="fas fa-plus-circle me-2"></i>Tambah Barang Baru
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="tambah_barang.php">
                            <div class="mb-4">
                                <label for="barang" class="form-label text-muted">
                                    <i class="fas fa-box me-1"></i>Nama Barang
                                </label>
                                <input type="text" 
                                       id="barang" 
                                       name="barang" 
                                       class="form-control form-control-lg shadow-sm" 
                                       required 
                                       placeholder="Masukkan nama barang">
                            </div>
                            <div class="mb-4">
                                <label for="harga_input" class="form-label text-muted">
                                    <i class="fas fa-tag me-1"></i>Harga Barang
                                </label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <span class="input-group-text bg-light">Rp</span>
                                    <input type="text" 
                                           id="harga_input" 
                                           class="form-control" 
                                           required 
                                           placeholder="Masukkan harga barang" 
                                           oninput="formatRupiah(this)">
                                </div>
                                <input type="hidden" id="harga" name="harga">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="fas fa-plus-circle me-2"></i>Tambah Barang
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
            document.getElementById("harga").value = angka;
        }
    </script>
</body>
</html>