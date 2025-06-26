<?php
include "koneksi.php";

// Ambil value enum dari kolom jenis_kelamin
$enum_values = [];
$result = mysqli_query($koneksi, "SHOW COLUMNS FROM tb_mahasiswa LIKE 'jenis_kelamin'");
$row = mysqli_fetch_assoc($result);
if (preg_match("/^enum\\((.*)\\)$/", $row['Type'], $matches)) {
    $enum = explode(",", $matches[1]);
    foreach ($enum as $value) {
        $v = trim($value, "'");
        $enum_values[] = $v;
    }
}

if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    // Proses upload foto
    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $folder = "images/photo/";
    $path = $folder . $foto;

    // Pastikan folder tujuan ada
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // Cek dan upload file
    if (move_uploaded_file($tmp_name, $path)) {
        // Insert data ke database
        $query = mysqli_query($koneksi, "INSERT INTO tb_mahasiswa (nim, nama_mahasiswa, prodi, jenis_kelamin, foto, alamat) VALUES ('$nim', '$nama', '$prodi', '$jenis_kelamin', '$foto', '$alamat')");
        if ($query) {
            echo '<div class="alert alert-success">Data mahasiswa berhasil disimpan.</div>';
            echo "<script>window.location.href='index.php?hal=data_mahasiswa';</script>";
        } else {
            echo '<div class="alert alert-danger">Data mahasiswa gagal disimpan.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Foto gagal diupload.</div>';
    }
}
?>

<h3>Tambah Mahasiswa</h3>
<hr>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nim">NIM</label>
        <input type="text" name="nim" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="nama">Nama Mahasiswa</label>
        <input type="text" name="nama" class="form-control" required>
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
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="">Pilih Jenis Kelamin</option>
            <?php foreach ($enum_values as $jk): ?>
                <option value="<?= $jk ?>"><?= $jk ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="foto">Foto</label>
        <input type="file" name="foto" class="form-control" required>
    </div>
    <br>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="index.php?hal=data_mahasiswa" class="btn btn-secondary">Batal</a>
</form>