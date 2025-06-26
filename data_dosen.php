<h2>Data Dosen</h2>
<hr>
<a href="index.php?hal=tambah_dosen" class="btn btn-dark">Tambah Data</a>
<?php
// Notifikasi jika data mata kuliah berhasil dihapus
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'deleted') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> Data Dosen berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } elseif ($_GET['msg'] == 'error') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Data Dosen gagal dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}
?>
<br><br>
<table id="example" class="table table-dark table-striped table-hover table-bordered mt-3 text-center text-white table-responsive table-sm ">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Dosen</th>
            <th>NIDN</th>
            <th>Prodi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "koneksi.php";
        $no = 1;
        $sql = "SELECT tb_dosen.kd_dosen, tb_dosen.nama_dosen, tb_dosen.nidn, tb_prodi.nama_prodi FROM tb_dosen JOIN tb_prodi ON tb_dosen.prodi = tb_prodi.prodi";
        $query = mysqli_query($koneksi, $sql);
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $data['nama_dosen'] . "</td>";
            echo "<td>" . $data['nidn'] . "</td>";
            echo "<td>" . $data['nama_prodi'] . "</td>";
            echo "<td> 
                <a href='edit_dosen.php?id=" . $data['kd_dosen'] . "' class='btn btn-warning'>Edit</a>
                <a href='hapus_dosen.php?id=" . $data['kd_dosen'] . "' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>