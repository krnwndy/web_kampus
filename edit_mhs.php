<?php
include "koneksi.php";
$nim = $_GET['nim'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
$data = mysqli_fetch_array($query);

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

$errors = [];

if (isset($_POST['simpan'])) {
    $nama_mahasiswa = trim($_POST['nama_mahasiswa']);
    $nim_baru = trim($_POST['nim']);
    $prodi = $_POST['prodi'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = trim($_POST['alamat']);
    $foto_lama = $data['foto'];
    $foto = $foto_lama;

    // Validasi field wajib
    if ($nama_mahasiswa == '') $errors[] = 'Nama mahasiswa wajib diisi.';
    if ($nim_baru == '') $errors[] = 'NIM wajib diisi.';
    if ($prodi == '') $errors[] = 'Prodi wajib dipilih.';
    if ($jenis_kelamin == '') $errors[] = 'Jenis kelamin wajib dipilih.';
    if ($alamat == '') $errors[] = 'Alamat wajib diisi.';

    // Validasi NIM unik jika diubah
    if ($nim_baru != $nim) {
        $cek_nim = mysqli_query($koneksi, "SELECT nim FROM tb_mahasiswa WHERE nim='$nim_baru'");
        if (mysqli_num_rows($cek_nim) > 0) {
            $errors[] = 'NIM sudah terdaftar, gunakan NIM lain.';
        }
    }

    // Validasi file foto jika upload baru
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        $folder = "images/photo/";
        $path = $folder . $foto;
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $max_size = 2 * 1024 * 1024; // 2MB
        $file_type = mime_content_type($tmp_name);
        $file_size = $_FILES['foto']['size'];
        if (!in_array($file_type, $allowed_types)) {
            $errors[] = 'File foto harus berupa JPG atau PNG.';
        }
        if ($file_size > $max_size) {
            $errors[] = 'Ukuran file foto maksimal 2MB.';
        }
    }

    // Jika tidak ada error, proses update
    if (empty($errors)) {
        if (!empty($_FILES['foto']['name'])) {
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }
            if (move_uploaded_file($tmp_name, $path)) {
                // Hapus foto lama jika ada dan berbeda
                if ($foto_lama && file_exists($folder . $foto_lama) && $foto_lama != $foto) {
                    unlink($folder . $foto_lama);
                }
            } else {
                $foto = $foto_lama; // Jika upload gagal, tetap pakai foto lama
                $errors[] = 'Upload foto gagal.';
            }
        }
        if (empty($errors)) {
            $query_update = mysqli_query($koneksi, "UPDATE tb_mahasiswa SET nama_mahasiswa='$nama_mahasiswa', nim='$nim_baru', prodi='$prodi', jenis_kelamin='$jenis_kelamin', alamat='$alamat', foto='$foto' WHERE nim='$nim'");
            if ($query_update) {
                echo '<div class="alert alert-success">Data mahasiswa berhasil diupdate.</div>';
                echo "<script>window.location.href='index.php?hal=data_mahasiswa';</script>";
            } else {
                $errors[] = 'Data mahasiswa gagal diupdate.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
</head>

<body>
    <?php include 'index.php'; ?>
    <div class="container mt-4">
        <h3>Edit Mahasiswa</h3>
        <hr>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul style="margin-bottom:0;">
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" class="form-control" value="<?php echo isset($_POST['nama_mahasiswa']) ? htmlspecialchars($_POST['nama_mahasiswa']) : htmlspecialchars($data['nama_mahasiswa']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" class="form-control" value="<?php echo isset($_POST['nim']) ? htmlspecialchars($_POST['nim']) : htmlspecialchars($data['nim']); ?>" required>
            </div>
            <div class="form-group">
                <label for="prodi">Prodi</label>
                <select name="prodi" class="form-control" required>
                    <?php
                    $selected_prodi = isset($_POST['prodi']) ? $_POST['prodi'] : $data['prodi'];
                    $query_prodi = mysqli_query($koneksi, "SELECT * FROM tb_prodi");
                    while ($prodi_row = mysqli_fetch_array($query_prodi)) {
                        $selected = ($selected_prodi == $prodi_row['prodi']) ? 'selected' : '';
                        echo "<option value='" . $prodi_row['prodi'] . "' $selected>" . $prodi_row['nama_prodi'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <?php $selected_jk = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : $data['jenis_kelamin']; ?>
                    <?php foreach ($enum_values as $jk): ?>
                        <option value="<?= $jk ?>" <?= ($selected_jk == $jk) ? 'selected' : '' ?>><?= $jk ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : htmlspecialchars($data['alamat']); ?>" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label><br>
                <?php if ($data['foto']): ?>
                    <img src="images/photo/<?php echo htmlspecialchars($data['foto']); ?>" width="100" style="object-fit:cover;border-radius:8px;">
                <?php endif; ?>
                <input type="file" name="foto" class="form-control mt-2">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan</button>
            <a href="index.php?hal=data_mahasiswa" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>