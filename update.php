<?php 
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
						
//cek username suda ada atau belum
$result=mysqli_query($koneksi,"select username from user where username='$username'");
    if (mysqli_fetch_assoc($result)){
        echo "<script>
            alert (' username sudah ada')
            
        </script>";
    return false;
    }
    
//cek konfirmasi password
// jika paswword1 tidak sama dengan password2
    if ($password!==$password2) {
        echo '<script> alert("Password berbeda, ulangi");document.location="media.php?modul=user"";</script>';
        // berhentikan function agar masuk else	
        return false;
    }
    //return 1;


//enkripsi password
$password=password_hash($password,PASSWORD_DEFAULT);
//$password=md5($password);
//var_dump($password);die;

//$password=password_hash($password,PASSWORD_DEFAULT);
// update data ke database
mysqli_query($koneksi,"update user set username='$username', password='$password' where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location:media.php?modul=user");

?>