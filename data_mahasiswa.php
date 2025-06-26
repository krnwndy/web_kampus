<h2>Data Mahasiswa</h2>
<hr>
<a href="index.php?hal=tambah_mhs" class="btn btn-dark">Tambah Data</a>
<?php
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'deleted') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> Data mahasiswa berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } elseif ($_GET['msg'] == 'error') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Data mahasiswa gagal dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}
?>
<table id="example"
    class="table table-dark table-striped table-hover table-bordered mt-3 text-center text-white table-responsive table-sm ">
    <thead>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Prodi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "koneksi.php";
        $no = 1;
        $sql = "SELECT tb_mahasiswa.nim, tb_mahasiswa.nama_mahasiswa, tb_mahasiswa.jenis_kelamin, tb_mahasiswa.alamat, tb_mahasiswa.foto, tb_prodi.nama_prodi
                FROM tb_mahasiswa
                JOIN tb_prodi ON tb_mahasiswa.prodi = tb_prodi.prodi";
        $query = mysqli_query($koneksi, $sql);
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td><img src='images/photo/" . $data['foto'] . "' width='60' height='60' style='object-fit:cover;border-radius:50%;'></td>";
            echo "<td>" . $data['nim'] . "</td>";
            echo "<td>" . $data['nama_mahasiswa'] . "</td>";
            echo "<td>" . $data['jenis_kelamin'] . "</td>";
            echo "<td>" . $data['alamat'] . "</td>";
            echo "<td>" . $data['nama_prodi'] . "</td>";
            echo "<td>
                <a href='edit_mhs.php?nim=" . $data['nim'] . "' class='btn btn-warning btn-sm'>Edit</a>
                <a href='hapus_mhs.php?nim=" . $data['nim'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>