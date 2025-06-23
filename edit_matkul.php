<?php
include 'koneksi.php';
// ambil id dari parameter URL
$id = $_GET['id'];
// ambil data matkul berdasarkan id
$query = mysqli_query($koneksi, "SELECT * FROM tb_mk WHERE kd_mk = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika form disubmit
if (isset($_POST['update'])) {
    $nama_mk = $_POST['nama_mk'];
    $prodi = $_POST['prodi'];
    $sks = $_POST['sks'];
    
    $update = mysqli_query($koneksi, "UPDATE tb_mk SET 
        nama_mk = '$nama_mk',
        prodi = '$prodi',
        sks = '$sks'
        WHERE kd_mk = '$id'");
    
    if ($update) {
        header('location:index.php?hal=data_mata_kuliah');
        exit;
    } else {
        echo "Gagal mengupdate data";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mata Kuliah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'index.php'; ?>
    <div class="container mt-4">
        <h3>Edit Mata Kuliah</h3>
        <hr>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama_mk">Nama Mata Kuliah</label>
                <input type="text" name="nama_mk" class="form-control" value="<?php echo htmlspecialchars($data['nama_mk']); ?>" required>
            </div>
            <div class="form-group">
                <label for="prodi">Program Studi</label>
                <select name="prodi" class="form-control" required>
                    <?php
                    $query_prodi = mysqli_query($koneksi, "SELECT * FROM tb_prodi");
                    while ($prodi_row = mysqli_fetch_array($query_prodi)) {
                        $selected = ($prodi_row['prodi'] == $data['prodi']) ? 'selected' : '';
                        echo "<option value='" . $prodi_row['prodi'] . "' " . $selected . ">" . $prodi_row['nama_prodi'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sks">SKS</label>
                <input type="number" name="sks" class="form-control" value="<?php echo htmlspecialchars($data['sks']); ?>" required>
            </div>
            <br>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="index.php?hal=data_mata_kuliah" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>