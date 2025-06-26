<h2>Data mata kuliah</h2>
<hr>
<a href="index.php?hal=tambah_matkul" class="btn btn-dark">Tambah Data</a>
<?php
// Notifikasi jika data mata kuliah berhasil dihapus
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'deleted') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> Data mata kuliah berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } elseif ($_GET['msg'] == 'error') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Data mata kuliah gagal dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}
?>
<table id="example" class="table table-dark table-striped table-hover table-bordered mt-3 text-center text-white table-responsive table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Mata Kuliah</th>
            <th>Nama Prodi</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "koneksi.php"; // Pastikan koneksi.php sudah benar
        $no = 1;
        $sql = "SELECT tb_mk.kd_mk, tb_mk.nama_mk, tb_prodi.nama_prodi, tb_mk.sks
                FROM tb_mk
                JOIN tb_prodi ON tb_mk.prodi = tb_prodi.prodi";
        $query = mysqli_query($koneksi, $sql);
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $data['nama_mk'] . "</td>";
            echo "<td>" . $data['nama_prodi'] . "</td>";
            echo "<td>" . $data['sks'] . "</td>";
            echo "<td> 
                <a href='edit_matkul.php?id=" . $data['kd_mk'] . "' class='btn btn-warning'>Edit</a>
                <a href='hapus_matkul.php?id=" . $data['kd_mk'] . "' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </tbody>