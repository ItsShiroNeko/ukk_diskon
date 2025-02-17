<?php 

$koneksi = mysqli_connect('localhost', 'root', '', 'db_diskon');

if ($koneksi){
    echo " ";
} else {
    echo "tidak terhubung";
    die;
}   

?>