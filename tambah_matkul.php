<?php
include 'koneksi.php';

$success = false;
$error = false;

if (isset($_POST['simpan'])) {
    $nama_mk = $_POST['nama_mk'];
    $prodi = $_POST['prodi'];
    $sks = $_POST['sks'];
    $query = mysqli_query($koneksi, "INSERT INTO tb_mk (nama_mk, prodi, sks) VALUES ('$nama_mk', '$prodi', '$sks')");
    if ($query) {
        $success = true;
    } else {
        $error = true;
    }
}
?>
<h3>Tambah Mata Kuliah</h3>
<hr>
<?php if ($success): ?>
    <div class="alert alert-success">Data mata kuliah berhasil disimpan!</div>
    <script>
        setTimeout(function() {
            window.location.href = 'index.php?hal=data_mata_kuliah';
        }, 500);
    </script>
<?php elseif ($error): ?>
    <div class="alert alert-danger">Gagal menyimpan data.</div>
<?php endif; ?>
<form action="" method="post">
    <div class="form-group">
        <label for="nama_mk">Nama Mata Kuliah</label>
        <input type="text" name="nama_mk" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="prodi">Program Studi</label>
        <select name="prodi" class="form-control" required>
            <option value="">Pilih Program Studi</option>
            <?php
            $query_prodi = mysqli_query($koneksi, "SELECT * FROM tb_prodi");
            while ($prodi = mysqli_fetch_array($query_prodi)) {
                echo "<option value='" . $prodi['prodi'] . "'>" . $prodi['nama_prodi'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="sks">SKS</label>
        <input type="number" name="sks" class="form-control" required>
    </div>
    <br>
    <button type="submit" name="simpan" class="btn btn-dark">Simpan</button>
    <a href="index.php?hal=data_mata_kuliah" class="btn btn-outline-dark">Batal</a>
</form>
