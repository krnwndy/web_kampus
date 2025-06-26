<?php
include 'koneksi.php';
$success = false;
$error = false;
if (isset($_POST['simpan'])) {
    $nama_dosen = $_POST['nama_dosen'];
    $nidn = $_POST['nidn'];
    $prodi = $_POST['prodi'];
    $query = mysqli_query($koneksi, "INSERT INTO tb_dosen (nama_dosen, nidn, prodi) VALUES ('$nama_dosen', '$nidn', '$prodi')");
    if ($query) {
        $success = true;
    } else {
        $error = true;
    }
}
?>
<h3>Tambah Dosen</h3>
<hr>
<?php if ($success): ?>
    <div class="alert alert-success">Data dosen berhasil disimpan!</div>
    <script>
        setTimeout(function() {
            window.location.href = 'index.php?hal=data_dosen';
        }, 500);
    </script>
<?php elseif ($error): ?>
    <div class="alert alert-danger">Gagal menyimpan data.</div>
<?php endif; ?>
<form action="" method="post">
    <div class="form-group">
        <label for="nama_dosen">Nama Dosen</label>
        <input type="text" name="nama_dosen" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="nidn">NIDN</label>
        <input type="text" name="nidn" class="form-control" maxlength="10" required pattern="[0-9]{10}" title="NIDN harus 10 digit angka">
    </div>
    <div class="form-group">
        <label for="prodi">Program Studi</label>
        <select name="prodi" class="form-control" required>
            <?php
            $query_prodi = mysqli_query($koneksi, "SELECT * FROM tb_prodi");
            while ($prodi = mysqli_fetch_array($query_prodi)) {
                echo "<option value='" . $prodi['prodi'] . "'>" . $prodi['nama_prodi'] . "</option>";
            }
            ?>
        </select>
    </div>
    <br>
    <button type="submit" name="simpan" class="btn btn-dark">Simpan</button>
    <a href="index.php?hal=data_dosen" class="btn btn-outline-dark">Batal</a>
</form> 