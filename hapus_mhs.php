<?php
include "koneksi.php";
$nim = $_GET['nim'];
$query = mysqli_query($koneksi, "DELETE FROM tb_mahasiswa WHERE nim = '$nim'");
if ($query) {
    echo "<script>alert('Data mahasiswa berhasil dihapus');</script>";
    echo "<script>window.location.href='index.php?hal=data_mahasiswa';</script>";
} else {
    echo "<script>alert('Data mahasiswa gagal dihapus');</script>";
    echo "<script>window.location.href='index.php?hal=data_mahasiswa';</script>";
}
?>