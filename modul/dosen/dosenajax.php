<?php
include('../../koneksi.php');

$keyword = $_GET["katakunci"];

$sql = "SELECT * FROM dosen WHERE nama LIKE '%$keyword%'";
?>
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
						$batas   = 5;
						$halaman = @$_GET['halaman'];
						if(empty($halaman)){
						$posisi  = 0;
						$halaman = 1;
						}
						
						else{ 
						$posisi  = ($halaman-1) * $batas; 
						}

						$tampil = mysqli_query($koneksi, $sql);

						//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
						if(mysqli_num_rows($tampil) > 0){
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