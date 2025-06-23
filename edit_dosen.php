<?php
include 'koneksi.php';

// Ambil id dari parameter URL
$id = $_GET['id'];

// Ambil data dosen berdasarkan id
$query = mysqli_query($koneksi, "SELECT tb_dosen.*, tb_prodi.nama_prodi 
                                FROM tb_dosen 
                                JOIN tb_prodi ON tb_dosen.prodi = tb_prodi.prodi 
                                WHERE tb_dosen.kd_dosen = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika form disubmit
if (isset($_POST['update'])) {
    $nama_dosen = $_POST['nama_dosen'];
    $nidn = $_POST['nidn'];
    $prodi = $_POST['prodi'];
    
    $update = mysqli_query($koneksi, "UPDATE tb_dosen SET 
        nama_dosen = '$nama_dosen',
        nidn = '$nidn',
        prodi = '$prodi'
        WHERE kd_dosen = '$id'");
        
    if ($update) {
        header('location:index.php?hal=data_dosen');
        exit;
    } else {
        echo "Gagal mengupdate data";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Dosen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'index.php'; ?>
    
    <div class="container mt-4">
        <h3>Edit Dosen</h3>
        <hr>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama_dosen">Nama Dosen</label>
                <input type="text" name="nama_dosen" class="form-control" value="<?php echo htmlspecialchars($data['nama_dosen']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" name="nidn" class="form-control" value="<?php echo htmlspecialchars($data['nidn']); ?>" required>
            </div>
            <div class="form-group">
                <label for="prodi">Program Studi</label>
                <select name="prodi" class="form-control" required>
                    <?php
                    $query_prodi = mysqli_query($koneksi, "SELECT * FROM tb_prodi");
                    while ($prodi = mysqli_fetch_array($query_prodi)) {
                        $selected = ($prodi['prodi'] == $data['prodi']) ? 'selected' : '';
                        echo "<option value='" . $prodi['prodi'] . "' " . $selected . ">" . $prodi['nama_prodi'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <br>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="index.php?hal=data_dosen" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html> 