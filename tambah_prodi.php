<h3>Tambah Prodi</h3>
<hr>
<form action="" method="post">
    <div class="form-group">
        <label for="nama_prodi">Nama Prodi</label>
        <input type="text" name="nama_prodi" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="jenjang">Jenjang</label>
        <input type="text" name="jenjang" class="form-control" required>
    </div>
    <br>
    <button type="submit" name="simpan" class="btn btn-dark">Simpan</button>
</form>

<?php

if(isset($_POST['simpan'])) {
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $query = mysqli_query($koneksi, "INSERT INTO tb_prodi VALUES (NULL, '$nama_prodi', '$jenjang')");
    if($query) {
        header('location:index.php?hal=data_prodi');
        exit; // Supaya tidak terjadi error
    } else {
        echo "gagal";
    }
}
?>