<?php 
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

$password=password_hash($password,PASSWORD_DEFAULT);
// update data ke database
mysqli_query($koneksi,"update user set username='$username', password='$password' where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location:media.php?modul=user");

?>