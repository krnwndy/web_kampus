<?php
include 'koneksi.php';
$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM tb_prodi WHERE prodi = '$id'");
if($hapus) {
    header('location:index.php?hal=data_prodi&msg=deleted');
    exit();
} else {
    header('location:index.php?hal=data_prodi&msg=error');
    exit();
}
