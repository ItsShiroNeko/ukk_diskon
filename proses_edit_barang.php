<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_transaksi = $_POST['id_transaksi'];
    $id_barang = $_POST['id_barang'];
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $harga = (float) $_POST['harga'];
    $diskon = (float) $_POST['diskon'];

    if (!empty($nama_barang) && $harga > 0 && $diskon >= 0 && $diskon <= 100) {
        $update_barang = "UPDATE tb_barang SET nama_barang = '$nama_barang', harga = '$harga' WHERE id_barang = '$id_barang'";
        mysqli_query($koneksi, $update_barang);

        $nilaiDiskon = $harga * ($diskon / 100);
        $totharga = $harga - $nilaiDiskon;

        $update_diskon = "UPDATE trans_diskon SET diskon = '$diskon', totharga = '$totharga' WHERE id_transaksi = '$id_transaksi'";
        if (mysqli_query($koneksi, $update_diskon)) {
            echo "<script>alert('Barang & Diskon berhasil diperbarui!'); location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data.'); location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Input tidak valid.'); location.href='index.php';</script>";
    }
}
?>