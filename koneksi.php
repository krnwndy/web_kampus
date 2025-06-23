<!-- koneksi ke database mysql yang ada di XAMPP -->
<?php
$koneksi = mysqli_connect("localhost:3307", "pma", "indika123", "db_kampus");
if (!$koneksi) {
    die("Koneksi gagal totol: " . mysqli_connect_error());
}  else {
    // echo "Koneksi berhasil";
}
?>