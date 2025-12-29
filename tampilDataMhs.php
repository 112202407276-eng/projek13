<?php 
    include "koneksi.php"; 
    $data = mysqli_query($koneksi, "SELECT * FROM mhs ORDER BY id DESC"); 
     $nourut=0; 
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Data Mahasiswa</title> 
        <link rel="stylesheet" href="style.css">
    </head> 
    <body> 
        <div class="header">
        <h1>Daftar Data Mahasiswa</h1>
         <div class="identitas">
         <p><strong>Nama :</strong> Adinda Salsa Stevani</p>
        <p><strong>NIM :</strong>A12.2020407276</p>
    </div>
</div>
<a href="cetakDataMhsPdf.php" target="_blank">
    <button style="
        background:pink;
        border:none;
        padding:8px 16px;
        border-radius:6px;
        font-weight:bold;
        cursor:pointer;">
        Cetak PDF
    </button>
</a>
        <a href="tambahDataMhs.php">Tambah Data Baru</a> 
        <br><br> 
        <table border="1" cellpadding="8"> 
        <tr> 
            <th>No</th> 
            <th>NIM</th> 
            <th>Nama</th> 
            <th>Tempat Lahir</th> 
            <th>Tanggal Lahir</th> 
            <th>Jml Sdr</th> 
            <th>Alamat</th> 
            <th>Kota</th> 
            <th>JK</th> 
            <th>Status</th> 
            <th>Hobi</th> 
            <th>Email</th> 
            <th colspan="2">Aksi</th> 
        </tr> 
        
        <?php while ($row = mysqli_fetch_assoc($data)) : ?> 
        <tr> 
            <?php $nourut++; ?> 
            <td><?= $nourut ?></td> 
             
            <td><?= $row['nim'] ?></td> 
            <td><?= $row['nama'] ?></td> 
            <td><?= $row['tempatLahir'] ?></td> 
            <td><?= $row['tanggalLahir'] ?></td> 
            <td><?= $row['jmlSaudara'] ?></td> 
            <td><?= $row['alamat'] ?></td> 
            <td><?= $row['kota'] ?></td> 
            <td><?= $row['jenisKelamin'] ?></td> 
            <td><?= $row['statusKeluarga'] ?></td> 
            <td><?= $row['hobi'] ?></td> 
            <td><?= $row['email'] ?></td> 
 
            <td><a href="koreksiDataMhs.php?kode=<?= $row['id'] ?>" class="koreksi">
              Koreksi</a></td> 
            <td><a href="hapusDataMhs.php?kode=<?php echo $row["id"]?>"onclick="return confirm('Yakin dihapus?')">Hapus</a></td> 
 
        </tr> 
        <?php  
           endwhile;  
        ?> 
        </table> 
    </body> 
</html>