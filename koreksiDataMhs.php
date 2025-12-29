<!DOCTYPE html> 
<html> 
<head> 
    <title>Sistem Informasi Akademik::Edit Data Mahasiswa</title> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" type="text/css" href="bootstrap-5.3.8/css/bootstrap.css"> 
    <link rel="stylesheet" type="text/css" href="css/styleku.css"> 
    <script src="bootstrap-5.3.8/js/bootstrap.js"></script> 
    <style> 
        body{ 
            margin-left: 100px; 
            margin-top: 50px; 
        } 
    h1{ 
         
        padding-bottom: 50px; 
    }    
 
    </style> 
</head> 
 
<body> 
  <?php
require "koneksi.php";

if (!isset($_GET['kode'])) {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location='tampilDataMhs.php';
          </script>";
    exit;
}

$id = $_GET['kode'];
$sql = "SELECT * FROM mhs WHERE id='$id'";
$qry = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($qry) == 0) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location='tampilDataMhs.php';
          </script>";
    exit;
}

$row1 = mysqli_fetch_assoc($qry);
?>
    <! -- Form yang dapat menampilkan data pada masing2 isian, 
     dan sekaligus digunakan untuk memperbaiki apabila ada yang diper baiki --> 
<h1>Formulir Pendataan Mahasiswa    </h1>    
<form action="simpanKoreksiDataMhs.php" method="POST"> 
 
  NIM: 
  <input type="text" name="nim" id="nim"  value="<?php echo $row1['nim']?>"> 
  <br> 
 
Nama : 
 <input type="text"  name="nama" id="nama"  value="<?php echo $row1['nama']?>"> 
 
Tempat Lahir : 
 <input type="text"  name="tempatLahir" id="tempatLahir"  value="<?php echo $row1['tempatLahir']?>"> 
<br> 
 
Tanggal Lahir: 
<input type="date" name="tanggalLahir" id="tanggalLahir" value="<?php echo $row1['tanggalLahir']?>"> 
 
<br> 
 
Jumlah Saudara: 
<input type="text"  name="jumlahSaudara" id="jumlahSaudara"  value="<?php echo $row1['jmlSaudara']?>"> 
 
Alamat: 
 <input type="text"  name="alamat" id="alamat"  value="<?php echo $row1['alamat']?>"> 
 <br>    
 
    <select name="kota"> 
        <option value="Semarang" <?= ($row1['kota']=='Semarang') ? 'selected' : ''; ?>>Semarang</option> 
        <option value="Solo" <?= ($row1['kota']=='Solo') ? 'selected' : ''; ?>>Solo</option> 
        <option value="Brebes" <?= ($row1['kota']=='Brebes') ? 'selected' : ''; ?>>Brebes</option> 
        <option value="Kudus" <?= ($row1['kota']=='Kudus') ? 'selected' : ''; ?>>Kudus</option> 
    </select> 
     
    <br> 
    Jenis Kelamin 
    <input type="radio" name="jenisKelamin" value="Pria" <?= ($row1['jenisKelamin']=='Pria') ? 'checked' : ''; ?>>Pria 
    <input type="radio" name="jenisKelamin" value="Wanita" <?= ($row1['jenisKelamin']=='Wanita') ? 'checked' : ''; ?>>Wanita 
 
    <br> 
    Status Keluarga 
    <input type="radio" name="statusKeluarga" value="Belum Menikah" <?= ($row1['statusKeluarga']=='Belum Menikah') ? 'checked' : 
''; ?>>Belum Menikah 
    <input type="radio" name="statusKeluarga" value="Menikah" <?= ($row1['statusKeluarga']=='Menikah') ? 'checked' : ''; 
?>>Menikah 
    <br> 
 
    <?php 
        $hobi_dr_db = $row1['hobi']; 
        $hobi_array = explode(',', $hobi_dr_db); 
        $semua_hobi = ["Membaca", "Olahraga", "Musik", "Traveling"]; 
 
        foreach ($semua_hobi as $hobi) { 
            $is_checked = in_array($hobi, $hobi_array) ? 'checked' : ''; 
            echo "<input type='checkbox' name='hobi[]' value='$hobi' $is_checked>"; 
            echo "<label>$hobi</label><br>"; 
        } 
    ?> 
 
    <br> 
    Email: 
    <input type="email"  name="email" id="email"  value="<?php echo $row1['email']?>"> 
    <br> 
     
<input type="Submit" id="Submit" value="Submit"> 
<input type="hidden" name="id" value ="<?php echo $id ?>"> 
</form> 
</body> 
</html>