<?php
include 'koneksi.php';

// Ambil id dari parameter URL
$id = $_GET['id'];

// Hapus data dosen berdasarkan id
$hapus = mysqli_query($koneksi, "DELETE FROM tb_dosen WHERE kd_dosen = '$id'");

if ($hapus) {
    header("Location: index.php?hal=data_dosen&msg=deleted");
    exit;
} else {
    header("Location: index.php?hal=data_dosen&msg=error");
    exit;
}
?>