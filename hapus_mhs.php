<?php
include "koneksi.php";
$nim = $_GET['nim'];
$query = mysqli_query($koneksi, "DELETE FROM tb_mahasiswa WHERE nim = '$nim'");
if ($query) {
    header("Location: index.php?hal=data_mahasiswa&msg=deleted");
    exit();
} else {
    echo "<script>alert('Data mahasiswa gagal dihapus');</script>";
    echo "<script>window.location.href='index.php?hal=data_mahasiswa';</script>";
}
?>