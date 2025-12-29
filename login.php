<?php 
session_start(); 
 
if (isset($_SESSION['username'])) { 
    header("location:tampilDataMhs.php"); 
    exit; 
} 
?> 
 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Login Sistem</title> 
    <meta charset="utf-8"> 
</head> 
<body> 
 
<h2>LOGIN</h2> 
<form method="post"> 
    NIM : 
    <input type="text" name="nim" required autofocus><br><br> 
    Password : 
    <input type="password" name="passw" required><br><br> 
    <input type="submit" name="login" value="Login"> 
</form> 
 
<?php 
if (isset($_POST['login'])) { 
    require "koneksi.php"; 
    $username = mysqli_real_escape_string($koneksi, $_POST['nim']); 
    $password = $_POST['passw']; 
 
    // Ambil data user berdasarkan NIM 
    $sql = "SELECT * FROM mhs WHERE nim='$username' LIMIT 1"; 
    $query = mysqli_query($koneksi, $sql); 
 
    if (mysqli_num_rows($query) == 1) { 
        $data = mysqli_fetch_assoc($query); 
 
        // Cek password hash 
        if (password_verify($password, $data['pass'])) { 
            $_SESSION['username'] = $data['nim']; 
            header("location:tampilDataMhs.php"); 
            exit; 
        } else { 
            echo "<p style='color:red'>Password salah!</p>"; 
        } 
    } else { 
        echo "<p style='color:red'>NIM tidak ditemukan!</p>"; 
    } 
} 
?> 
 
</body> 
</html>