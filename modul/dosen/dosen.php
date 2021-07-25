<?php 
include('koneksi.php'); 



?>
<?php
error_reporting(0);

switch($_GET[prosesdsn])
{
	default:
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- memanggil file bootstrap.min.css di folder bootstrap -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	
	<!-- memanggil file jquery dan javascrip di folder aplikasi-->
	<script src="bootstrap/ajax/jquery/jquery.slim.min.js"></script>

	<!-- script src="bootstrap/js/popper.min.js"></script -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script> 
	<!---script jquery--->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						
						<li class="nav-item">
							<a class="nav-link" href="media.php?modul=dosen&prosesdsn=tambahdsn">Tambah</a>
						</li>
						<li>
							<form action="" method="POST">
								<input type="text" name="keyword" size="40" autofocus placeholder="masukkan kata kunci pencarian" autocomplete="off" id="katakunci">
								<button type="submit" id ="tombolcari" name="cari">Cari</button>
							</form>
						</li>
			
					</ul>
				</div>
			</div>
		</nav>
		
		<div id="containerid">
			<!-- membuat table dengan boostrap 4 dari w3schols-->
			<table class="table table-striped table-hover table-sm table-bordered">
				<thead class="thead-dark">
						<tr>
							<th>NO.</th>
							<th>NPP</th>
							<th>NAMA DOSEN</th>
							<th>JENIS KELAMIN</th>
							<th>PROGRAM STUDI</th>
							<th>FOTO</th>
							<th>AKSI</th>
						</tr>
				</thead>
				
				<?php
						$batas   = 3;
						$halaman = @$_GET['halaman'];
						if(empty($halaman)){
						$posisi  = 0;
						$halaman = 1;
						}
						
						else{ 
						$posisi  = ($halaman-1) * $batas; 
						}

						if(isset($_POST['tombolcari'])){
							$keyword = $_POST['katakunci'];
							$sql = "SELECT * FROM dosen WHERE nama like '%$keyword%' LIMIT ".$posisi.", ".$batas;		
						}else{
							$sql = "select * from dosen LIMIT ".$posisi.", ".$batas;		
						}
						
						// Langkah 2. Sesuaikan query dengan posisi dan batas
						$sql = "SELECT * FROM dosen ORDER BY id asc LIMIT $posisi,$batas";
						$tampil = mysqli_query($koneksi, $sql);

						//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
						if(mysqli_num_rows($tampil) > 0){
							$no = 1;
						$no = $posisi+1;
							while ($data=mysqli_fetch_array($tampil)){
								//menampilkan data perulangan
								echo '
								<tr>
									<td>'.$no.'</td>
									<td>'.$data['npp'].'</td>
									<td>'.$data['nama'].'</td>
									<td>'.$data['jenis_kelamin'].'</td>
									<td>'.$data['program_studi'].'</td>
									<td><img src="modul/mahasiswa/image/'.$data['foto'].'" alt="" width="70px" height="70px"></td>
									<td>
																		
										<a href="media.php?modul=dosen&prosesdsn=koreksidsn&id='.$data['id'].'" class="badge badge-warning">Koreksi</a>
										
										<a href="media.php?modul=dosen&prosesdsn=hapusdsn&id='.$data['id'].'" class="badge badge-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Hapus</a>
										
									</td>
								</tr>
								';
								$no++;
							}
						//jika query menghasilkan nilai 0
						}else{
							echo '
							<tr>
								<td colspan="6">Tidak ada data.</td>
							</tr>
							';
						}
					?>
			</table>
		</div>
		<?php
				// Langkah 3: Hitung total data dan halaman serta link 1,2,3 
				$query2     = mysqli_query($koneksi, "select * from dosen");
				$jmldata    = mysqli_num_rows($query2);
				//Fungsi Ceil adalah fungsi pembulatan bilangan pada PHP untuk hasil pembulatan keatas berupa bilangan bulat terdekat dari bilangan aslinya.
				$jmlhalaman = ceil($jmldata/$batas);
				?>
				
			<div class="text-center">
				<ul class="pagination">
					<?php
							echo "Halaman :   ";
							for($i=1;$i<=$jmlhalaman;$i++){
								if ($i != $halaman){
								echo "<li class='page-item'><a class='page-link' href='media.php?modul=dosen&halaman=$i'>$i</a></li>";
								}
						else{ 
						echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
						}
					}
					echo "<p>Total Dosen : <b>$jmldata</b> Dosen</p>";
					?>
				</ul>
			</div>

	<?php
		break;
		case 'tambahdsn':
	?>	
	<?php
		require ('functions.php'); 
			if(isset($_POST['submit'])){
				$npp			= $_POST['npp'];
				$nama			= $_POST['nama'];
				$jenis_kelamin	= $_POST['jenis_kelamin'];
				$program_studi	= $_POST['program_studi'];
				
				//upload gambar
				$foto=upload_foto();
				if ($foto === false) {
					return false;
				} 
				$cek = mysqli_query($koneksi, "SELECT * FROM dosen WHERE id='$id'") or die(mysqli_error($koneksi));
				
				//Fungsi mysql_num_rows pada php adalah untuk mengetahui berapa jumlah baris di dalam tabel database yang dipanggil oleh perintah mysql_query()
				if(mysqli_num_rows($cek) == 0){
					$sql = mysqli_query($koneksi, "INSERT INTO dosen(npp, nama, jenis_kelamin, program_studi, foto)VALUES('$npp', '$nama', '$jenis_kelamin', '$program_studi', '$foto')") or die(mysqli_error($koneksi));
					
					if($sql){
						echo '<script>alert("Berhasil menambahkan data."); document.location="media.php?modul=dosen";</script>';
					}else{
						echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
					}
				}else{
					echo '<div class="alert alert-warning">Gagal, NPP sudah terdaftar.</div>';
				}
			}
			
	?>
	
			<!-- dibawah ini form untuk memasukkan data mahasiswa dari style bootstrap-->
			</br> 
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">NPP</label>
					<div class="col-sm-10">
						<input type="text" name="npp" class="form-control" size="4" required>
					</div>
				</div>
				<!-- fasilitas dari bootstrap utk membuat form input data -->
				</br> 
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">NAMA DOSEN</label>
					<div class="col-sm-10">
						<input type="text" name="nama" class="form-control" required>
					</div>
				</div>
				</br> 
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">JENIS KELAMIN</label>
					<div class="col-sm-10">
						<div class="form-check">
							<input type="radio" class="form-check-input" name="jenis_kelamin" value="LAKI-LAKI" required>
							<label class="form-check-label">LAKI-LAKI</label>
						</div>
						<div class="form-check">
							<input type="radio" class="form-check-input" name="jenis_kelamin" value="PEREMPUAN" required>
							<label class="form-check-label">PEREMPUAN</label>
						</div>
					</div>
				</div>
				</br> 
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">PROGRAM STUDI</label>
					<div class="col-sm-10">
						<select name="program_studi" class="form-control" required>
							<option value="">PILIH PRODI</option>
							<option value="TEKNIK INFORMATIKA">TEKNIK INFORMATIKA</option>
							<option value="SISTEM INFORMASI">SISTEM INFORMASI</option>
							<option value="DESAIN KOMUNIKASI VISUAL">DESAIN KOMUNIKASI VISUAL</option>
						</select>
					</div>
				</div>
				
				</br> 
				<div class="form-group row">
					<label class="col-sm-2 col-form-label"> F O T O  </label>
					<div class="col-sm-5">
						<input type="file" name="foto" class="form-control" id="foto">
					</div>
						
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">&nbsp;</label>
					<div class="col-sm-10">
					</br> 
						<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
					</div>
				</div>
			</form>
			
	<?php
		break;
		case 'koreksidsn':
	?>	
	 
	
	<div class="container" style="margin-top:20px">
		<h2>Edit Dosen</h2>
		<hr>
		
		<?php
		include ('koneksi.php');
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit']))
		{
			$id				= $_POST['id'];
			$npp			=$_POST['npp'];	
			$nama			= $_POST['nama'];
			$jenis_kelamin	= $_POST['jenis_kelamin'];
			$program_studi	= $_POST['program_studi'];
			$foto 			= $_FILES['foto']['name'];	
		
			//cek dulu jika merubah gambar  jalankan coding ini
			if($foto!="") 
			{
				$ekstensifile_diperbolehkan = array('png','jpg','jpeg','gif'); //ekstensi file gambar yang bisa diupload 
				//explode : berfungsi pemisah string
				$pisah = explode('.', $foto); //memisahkan nama file dengan ekstensi yang diupload
				//fungsi end() itu adalah untuk mengambil nilai yang paling akhir di sebuah variabel.
				$ekstensi = strtolower(end($pisah));
				//tmp_name adalah nama file yang berada di dalam direktori temporer server;
				$file_tmp = $_FILES['foto']['tmp_name'];   
				//rand=acak, dari angka berpr s.d brp
				$kodeangka_acak = rand(1,999);
				$nama_gambar_baru = $kodeangka_acak.'-'.$foto; //menggabungkan angka acak dengan nama file sebenarnya
				if(in_array($ekstensi, $ekstensifile_diperbolehkan) == true)  
					{
						move_uploaded_file($file_tmp, 'modul/mahasiswa/image/'.$nama_gambar_baru); //memindah file gambar ke folder img
						$query=mysqli_query($koneksi,"UPDATE dosen SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', program_studi='$program_studi', foto='$nama_gambar_baru' where id='$id'");
					   
						if(!$query)
							{
								die ("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
							} 
						   else 
							{
								echo "<script>alert('Data berhasil diubah.');window.location='media.php?modul=dosen';</script>";
							}
					} 
						else 
					{     
					echo "<script>alert('Ekstensi gambar yang boleh hanya jpg,jpeg,gif atau png.');window.location='media.php?modul=dosen';</script>";
					}
			} 
			else 
			{
			$query = "UPDATE mdosen SET nama='".$nama."', jenis_kelamin='".$jenis_kelamin."', program_studi='".$program_studi."' WHERE id='".$id."'";
			$sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query
			if($sql)
				{
					//echo '<script>alert("Berhasil menyimpan data."); document.location="media.php?modul?mahasiswa?mahasiswa.php?id='.$id.'";</script>';
					echo '<script>alert("Berhasil menyimpan data."); document.location="media.php?modul=dosen";</script>';
				}
							else
						{
							echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
						}
				}
		}
		?>
		
		<?php
			//jika sudah mendapatkan parameter GET id dari URL
			if(isset($_GET['id']))
			{
				//membuat variabel $id untuk menyimpan id dari GET id di URL
				$id = $_GET['id'];
				
				//query ke database SELECT tabel mahasiswa berdasarkan id = $id
				$select = mysqli_query($koneksi, "SELECT * FROM dosen WHERE id='$id'") or die(mysqli_error($koneksi));
				
				//jika hasil query = 0 maka muncul pesan error
				if(mysqli_num_rows($select) == 0)
				{
					echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
					exit();
				//jika hasil query > 0
				} else
				{
					//membuat variabel $data dan menyimpan data row dari query
					$data = mysqli_fetch_assoc($select);
				}
			}
		?> 
		
		<form action=" "?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
			<input name="id" value="<?php echo $data['id']; ?>"  hidden />
			</br>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NPP</label>
				<div class="col-sm-10">
					<input type="text" name="npp" class="form-control" size="4" value="<?php echo $data['npp']; ?>" readonly required>
				</div>
			</div>
			</br>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NAMA DOSEN</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
				</div>
			</div>
			</br>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">JENIS KELAMIN</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jenis_kelamin" value="LAKI-LAKI" <?php if($data['jenis_kelamin'] == 'LAKI-LAKI'){ echo 'checked'; } ?> required>
						<label class="form-check-label">LAKI-LAKI</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jenis_kelamin" value="PEREMPUAN" <?php if($data['jenis_kelamin'] == 'PEREMPUAN'){ echo 'checked'; } ?> required>
						<label class="form-check-label">PEREMPUAN</label>
					</div>
				</div>
			</div>
			</br>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">PROGRAM STUDI</label>
				<div class="col-sm-10">
					<select name="program_studi" class="form-control" required>
						<option value="">PILIH PRODI</option>
						<option value="TEKNIK INFORMATIKA" <?php if($data['program_studi'] == 'TEKNIK INFORMATIKA'){ echo 'selected'; } ?>>TEKNIK INFORMATIKA</option>
						<option value="SISTEM INFORMASI" <?php if($data['program_studi'] == 'SISTEM INFORMASI'){ echo 'selected'; } ?>>SISTEM INFORMASI</option>
						<option value="DESAIN KOMUNIKASI VISUAL" <?php if($data['program_studi'] == 'DESAIN KOMUNIKASI VISUAL'){ echo 'selected'; } ?>>DESAIN KOMUNIKASI VISUAL</option>
					</select>
				</div>
			</div>
			</br>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label"> F O T O  </label>
				<div class="col-sm-5">
					
				<img src="modul/mahasiswa/image/<?php echo $data['foto']; ?>" style="width: 120px;float: left;margin-bottom: 5px;">
				<input type="file" name="foto" />
					
				</div>
			</div>
			</br> 
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
				    <!-- jika menekan tombol simpan, akan menjalankan file edit1.php -->
					<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
					<!-- jika menekan tombol KEMBALI, akan menjalankan file index.php -->
					<a href="media.php?modul=dosen" class="btn btn-warning">KEMBALI</a>
				</div>
			</div>
		</form>
	</div>

	<?php
		break;
		case 'hapusdsn':
	?>
	<?php
	include ('koneksi.php');

	//jika benar mendapatkan GET id dari URL
	if(isset($_GET['id'])){
		//membuat variabel $id yang menyimpan nilai dari $_GET['id']
		$id = $_GET['id'];
		
		//melakukan query ke database, dengan cara SELECT data yang mtaemiliki id yang sama dengan variabel $id
		$cek = mysqli_query($koneksi, "SELECT * FROM dosen WHERE id='$id'") or die(mysqli_error($koneksi));
		
		//jika query menghasilkan nilai > 0 maka eksekusi script di bawah
		if(mysqli_num_rows($cek) > 0){
			//query ke database DELETE untuk menghapus data dengan kondisi id=$id
			$del = mysqli_query($koneksi, "DELETE FROM dosen WHERE id='$id'") or die(mysqli_error($koneksi));
			if($del){
				echo '<script>alert("Berhasil menghapus data."); document.location="media.php?modul=dosen";</script>';
			}else{
				echo '<script>alert("Gagal menghapus data."); document.location="modul=dosen";</script>';
			}
		}else{
			echo '<script>alert("ID tidak ditemukan di database."); document.location="modul=dosen";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="modul=dosen";</script>';
	}
	 
	?>
<?php
}
?>


		


<script src="modul/dosen/skrip.js"></script>	
</body>

</html>