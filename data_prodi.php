<?php
include 'koneksi.php';
?>

<h2>Data Prodi</h2>

<a href="index.php?hal=tambah_prodi" class="btn btn-success">Tambah Data</a>
<?php
// Notifikasi jika data mata kuliah berhasil dihapus
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'deleted') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> Data Prodi berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } elseif ($_GET['msg'] == 'error') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Data Prodi gagal dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}
?>
<hr>
<table id="example" class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Prodi</th>
            <th>Jenjang</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $sql = "SELECT * FROM tb_prodi";
        $query = mysqli_query($koneksi, $sql);
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $data['nama_prodi'] . "</td>";
            echo "<td>" . $data['jenjang'] . "</td>";
            echo "<td> 
                <a href='edit_prodi.php?id=" . $data['prodi'] . "' class='btn btn-warning'>Edit</a>
                <a href='hapus_prodi.php?id=" . $data['prodi'] . "' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

