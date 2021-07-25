<?php
include ('koneksi.php');
?>
<?php
error_reporting(0);

switch($_GET[proses])
{
	default:
?>

	<body>

		<a href="media.php?modul=user&proses=tambah">Tambah User</a>
		<table class="table table-striped table-hover table-sm table-bordered">
			<thead class="thead-dark">
					<tr>
						<th>NO.</th>
						<th>Username</th>
						<th>Aksi</th>
						
					</tr>
			</thead>
				<?php
					$tampil= mysqli_query($koneksi,"select * from user");		
									
					
					//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
					if(mysqli_num_rows($tampil) > 0)
					{
						//membuat variabel $no untuk menyimpan nomor urut
						$no = 1;
						//melakukan perulangan while dengan dari dari query $sql
						// $no = $posisi+1;
						while ($data=mysqli_fetch_array($tampil)){
											
							//menampilkan data perulangan
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$data['username'].'</td>
								
								<td>
									<a href="media.php?modul=user&proses=editusr&id='.$data['id'].'" class="badge badge-warning">Edit</a>
									<a href="media.php?modul=user&proses=hapususr&id='.$data['id'].'" class="badge badge-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Hapus</a>
									</td>	
									</td>
							</tr>
							';
							$no++;
						}
					//jika query menghasilkan nilai 0
					}
						else
					{
						echo '
						<tr>
							<td colspan="6">Tidak ada data.</td>
						</tr>
						';
					}
				?>
			
			
		</table>
		
	
		
	<?php
		break;
		case 'tambah'
	?>	
	<?php
		if (isset($_POST["register"])){
				// jika tombol registrasi sdh ditekan jalankan fungsi registrasi
					// isi username membuat huruf kecil dan membersihkan / menghilangkan back slas
					$username=$_POST['username'];
					//fungsi mysqli_real_escape_string utk memungkinkan user memasukkan password ada tanda ""
					$password=$_POST['password'];
					$password2=$_POST['password2'];
						
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
					
					
					//Fungsi mysql_num_rows pada php adalah untuk mengetahui berapa jumlah baris di dalam tabel database yang dipanggil oleh perintah mysql_query()
						if(mysqli_num_rows($result) == 0){
								$result = mysqli_query($koneksi, "INSERT INTO user(username,password) VALUES('$username','$password')") or die(mysqli_error($koneksi));
								
								if($result){
									echo '<script>alert("Berhasil menambahkan data."); document.location="media.php?modul=user";</script>';
								}else{
									echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
								}
							}else{
								echo '<div class="alert alert-warning">Gagal, User sudah terdaftar.</div>';
							}
					}	
		?>
	
				<!-- membaca action di halaman yg sama dengan method POST -->
						<form action="" method="POST">
							<ul>
								<li>
									<label for="username">username : </label>
									<input type="text" name="username" id="username">
								</li>
								<li>
									<label for="password">password :</label>
									<input type="password" name="password" id="password">
								</li>
								<li>
									<label for="password">password :</label>
									<input type="password" name="password2" id="password2">
								</li>
								<li>
									<button type="Submit" name="register">Simpan</button>
								</li>
							</ul>
						</form>	

<?php
break;
case 'editusr':
?>	
<?php
	include 'koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi,"select * from user where id='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
		<form method="post" action="update.php">
			<table>
				<tr>			
					<td>Nama</td>
					<td>
						<input type="hidden" name="id" value="<?php echo $d['id']; ?>">
						<input type="text" name="username" value="<?php echo $d['username']; ?>">
					</td>
				</tr>
				<tr>
					<td>password</td>
					<td><input type="password" name="password" ></td>
				</tr>
				<tr>
					<td>password</td>
					<td><input type="password" name="password2"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="SIMPAN"></td>
				</tr>		
			</table>
		</form>
		<?php 
	}
	?>
 

	
						<?php
break;
case 'hapususr':
?>	
<?php
	include ('koneksi.php');

	//jika benar mendapatkan GET id dari URL
	if(isset($_GET['id'])){
		//membuat variabel $id yang menyimpan nilai dari $_GET['id']
		$id = $_GET['id'];
		
		//melakukan query ke database, dengan cara SELECT data yang mtaemiliki id yang sama dengan variabel $id
		$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'") or die(mysqli_error($koneksi));
		
		//jika query menghasilkan nilai > 0 maka eksekusi script di bawah
		if(mysqli_num_rows($cek) > 0){
			//query ke database DELETE untuk menghapus data dengan kondisi id=$id
			$del = mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'") or die(mysqli_error($koneksi));
			if($del){
				echo '<script>alert("Berhasil menghapus data."); document.location="media.php?modul=user";</script>';
			}else{
				echo '<script>alert("Gagal menghapus data."); document.location="modul=user";</script>';
			}
		}else{
			echo '<script>alert("ID tidak ditemukan di database."); document.location="modul=user";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="modul=user";</script>';
	}
?>

<?php
	break;
}

?>	
</body>	
	