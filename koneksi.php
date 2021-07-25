<?php
//koneksi ke database mysql, silahkan di rubah dengan koneksi kalian sendiri

$koneksi = mysqli_connect("localhost","root","","db_universitas");
 
//cek jika koneksi ke mysql gagal, maka akan tampil pesan berikut
if (mysqli_connect_errno()){
	echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
}
?>