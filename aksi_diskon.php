<?php 
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $id_barang = $_POST['barang'];
    $diskon = $_POST['diskon'];

    $query = mysqli_query($koneksi, "SELECT harga FROM tb_barang WHERE id_barang = '$id_barang'");
    $data = mysqli_fetch_assoc($query);
    $harga = $data['harga'];

    if ($harga > 0 && $diskon >= 0 && $diskon <= 100) {
        $nilaiDiskon = $harga * ($diskon / 100);
        $totharga = $harga - $nilaiDiskon;

        mysqli_query($koneksi, "INSERT INTO trans_diskon (id_barang, diskon, totharga) VALUES ('$id_barang', '$diskon', '$totharga')");

        echo "<script>
            alert('Total harga setelah diskon: Rp " . number_format($totharga, 2, ',', '.') . "');
            location.href='index.php';
        </script>";
    } else {
        echo "<script>
            alert('Input tidak valid.');
            location.href='index.php';
        </script>";
    }
}
?>
