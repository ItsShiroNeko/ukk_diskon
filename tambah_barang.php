<?php 
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama_barang = $_POST['barang'];
    $harga = $_POST['harga'];

    $query = mysqli_query($koneksi, "INSERT INTO tb_barang (id_barang, nama_barang, harga) VALUES ('', '$nama_barang', '$harga')");

    if ($query){
        echo "<script>alert('barang berhasil disimpan'); location.href='index.php';</script>";
    } else {
        echo "<script>alert('gagal menyimban barang, coba lagi'); location.href='index.php';</script>";
    }
}



?>