<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>Utm Mataram | Dashboard</title>
</head>

<body>
    <div class="container-fluid">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="images/Logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                <b class="ml-3">UTM MATARAM</b>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2">Home</a></li>
                <li><a href="index.php?hal=data_mahasiswa" class="nav-link px-2">Data Mahasiswa</a></li>
                <li><a href="index.php?hal=data_mata_kuliah" class="nav-link px-2">Data Mata Kuliah</a></li>
                <li><a href="index.php?hal=data_prodi" class="nav-link px-2">Data Prodi</a></li>
                <li><a href="index.php?hal=data_dosen" class="nav-link px-2">Data Dosen</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-outline-primary me-2">Login</button>
                <button type="button" class="btn btn-primary">Sign-up</button>
            </div>
        </header>
    </div>
    <h3>Selamat Datang di UTM Mataram</h3>
    <div class="container">
        <?php
        include "koneksi.php"; // Pastikan koneksi.php sudah benar
        
        if (isset($_GET['hal'])) {
            if ($_GET['hal'] == "home") {
                include "dashboard.php";
            } elseif ($_GET['hal'] == "data_mahasiswa") {
                include "data_mahasiswa.php";
            } elseif ($_GET['hal'] == "data_mata_kuliah") {
                include "data_mata_kuliah.php";
            } elseif ($_GET['hal'] == "data_dosen") {
                include "data_dosen.php";
            } elseif ($_GET['hal'] == "data_prodi") {
                include "data_prodi.php";
            } elseif ($_GET['hal'] == "tambah_prodi") {
                include "tambah_prodi.php";
            } elseif ($_GET['hal'] == "edit_prodi") {
                include "edit_prodi.php";
            } elseif ($_GET['hal'] == "hapus_prodi") {
                include "hapus_prodi.php";
            } elseif ($_GET['hal'] == "tambah_dosen") {
                include "tambah_dosen.php";
            } elseif ($_GET['hal'] == "edit_dosen") {
                include "edit_dosen.php";
            } elseif ($_GET['hal'] == "hapus_dosen") {
                include "hapus_dosen.php";
            } elseif ($_GET['hal'] == "tambah_matkul") {
                include "tambah_matkul.php";
            } elseif ($_GET['hal'] == "edit_matkul") {
                include "edit_matkul.php";
            } elseif ($_GET['hal'] == "hapus_matkul") {
                include "hapus_matkul.php";
            } elseif ($_GET['hal'] == "tambah_mhs") {
                include "tambah_mhs.php";
            } elseif ($_GET['hal'] == "edit_mhs") {
                include "edit_mhs.php";
            } elseif ($_GET['hal'] == "hapus_mhs") {
                include "hapus_mhs.php";
            } else {
                include "dashboard.php";
            }
        }
        ?>
    </div>

    <!-- Content Close -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
</body>

<!-- 
        Tugas berikutnya adalah perbaiki tombol edit dan hapus pada halaman mahasiswa, mata kuliah, 
-->

</html>