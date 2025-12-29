<?php
require 'koneksi.php';

if (!isset($_POST['id'])) {
    die("ID tidak terkirim");
}

$id = $_POST['id'];
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$tempatLahir = $_POST['tempatLahir'];
$tanggalLahir = $_POST['tanggalLahir'];
$jmlSaudara = $_POST['jumlahSaudara'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];

$sql = "UPDATE mhs SET
        nim='$nim',
        nama='$nama',
        tempatLahir='$tempatLahir',
        tanggalLahir='$tanggalLahir',
        jmlSaudara='$jmlSaudara',
        alamat='$alamat',
        email='$email'
        WHERE id='$id'";

if (mysqli_query($koneksi, $sql)) {
    header("Location: tampilDataMhs.php");
    exit;
} else {
    echo "Gagal update: " . mysqli_error($koneksi);
}
?>
