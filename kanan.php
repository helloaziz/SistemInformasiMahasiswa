
<?php
error_reporting(0);
	if ($_GET['modul']=='home')
	{
	?>		
		<div class="konten">
			<h1>Selamat Datang Administrator </h1></br>
							Sistem Informasi Akadamik Universitas Dian Nuswantoro</br>
							Jl. Imam Bonjol No.207, Pendrikan Kidul </br>
							Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50131 </br>
		</div>

	<?php
	}
	   else if($_GET['modul']=='user')
	{
	   include "modul/user/user.php";
	}
		else if($_GET['modul']=='mahasiswa')
	{
		include "modul/mahasiswa/mahasiswa.php";
	}
		else if($_GET['modul']=='dosen')
	{
		include "modul/dosen/dosen.php";
	}
		else if($_GET['modul']=='kelompok')
	{
		include "modul/kelompok/kelompok.php";
	}
		else if($_GET['modul']=='backup')
	{
		include "modul/backup/backup.php";
	}	
	
?>




					