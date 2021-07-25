<?php
include ('koneksi.php');

function upload_foto()
{
	$namaFile=$_FILES['foto']['name'];
	$ukuranFile=$_FILES['foto']['size'];
	$error=$_FILES['foto']['error'];
	$tmpName=$_FILES['foto']['tmp_name'];
	
	//cek apakah tidak ada gambar yang diupload
	if($error === 4){
		echo"<script>
			alert('pilih gambar terlebih dahulu');
			</script>";
			return false;
	}
	
	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid=['jpg','jpeg','png','gif'];
	$ekstensiGambar=explode('.', $namaFile);
	$ekstensiGambar=strtolower(end($ekstensiGambar));
	
	if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
		echo"<script>
				alert('yang anda upload bukan gambar');
			</script>";
		return false;
	}
	
	//cek jika ukurannya terlalu besar
		if($ukuranFile>1000000){
			echo"<script>
				alert('ukuran gambar terlalu besar');
				</script>";
			return false;
		}
		
	//lolos pengecekan, gambar siap diupload
	move_uploaded_file($tmpName,'modul/mahasiswa/image/'.$namaFile);
	return $namaFile;
	}

	
	
?>

