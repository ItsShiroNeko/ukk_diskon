<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM trans_diskon WHERE id_transaksi = '$id'");
    echo "<script>alert('Diskon berhasil dihapus!'); location.href='index.php';</script>";
}
?>
