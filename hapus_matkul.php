<?php
include 'koneksi.php';

// Ambil id dari parameter URL
$id = $_GET['id'];

// Hapus data matkul berdasarkan id
$hapus = mysqli_query($koneksi, "DELETE FROM tb_mk WHERE kd_mk = '$id'");

if ($hapus) {
    header("Location: index.php?hal=data_mata_kuliah&msg=deleted");
    exit;
} else {
    header("Location: index.php?hal=data_mata_kuliah&msg=error");
    exit;
}

?>