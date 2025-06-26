<?php
include 'koneksi.php';

// Ambil id dari parameter URL
$id = $_GET['id'];

// Ambil data prodi berdasarkan id
$query = mysqli_query($koneksi, "SELECT * FROM tb_prodi WHERE prodi = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika form disubmit
if (isset($_POST['update'])) {
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $update = mysqli_query($koneksi, "UPDATE tb_prodi SET nama_prodi = '$nama_prodi', jenjang = '$jenjang' WHERE prodi = '$id'");
    if ($update) {
        header('location:index.php?hal=data_prodi');
        exit;
    } else {
        echo "Gagal mengupdate data";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Prodi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
    <?php include 'index.php'; ?>

    <div class="container mt-4">
        <h3>Edit Prodi</h3>
        <hr>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama_prodi">Nama Prodi</label>
                <input type="text" name="nama_prodi" class="form-control"
                    value="<?php echo htmlspecialchars($data['nama_prodi']); ?>" required>
            </div>
            <div class="form-group">
                <label for="jenjang">Jenjang</label>
                <input type="text" name="jenjang" class="form-control"
                    value="<?php echo htmlspecialchars($data['jenjang']); ?>" required>
            </div>
            <br>
            <button type="submit" name="update" class="btn btn-dark">Update</button>
            <a href="index.php?hal=data_prodi" class="btn btn-outline-dark">Batal</a>
        </form>
    </div>
</body>

</html>