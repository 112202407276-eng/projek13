<?php 
    //memanggil file pustaka fungsi 
    require "koneksi.php"; 
 
    //memindahkan data kiriman dari form ke var biasa 
    $id=$_GET["kode"]; 
 
    //membuat query hapus data 
    $sqlb="delete from mhs where id=$id"; 
    mysqli_query($koneksi,$sqlb); 
    header("location:tampilDataMhs.php"); 
?> 
