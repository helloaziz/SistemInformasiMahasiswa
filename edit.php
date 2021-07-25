!DOCTYPE html>
<html>
<head>
	<title>CRUD PHP dan MySQLi - WWW.MALASNGODING.COM</title>
</head>
<body>
 
	<h2>CRUD DATA MAHASISWA - WWW.MALASNGODING.COM</h2>
	<br/>
	<a href="http://localhost/project/media.php?modul=user">KEMBALI</a>
	<br/>
	<br/>
	<h3>EDIT DATA MAHASISWA</h3>
 
	<?php
	include 'koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi,"select * from user where id='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
		<form method="post" action="update.php">
			<table>
				<tr>			
					<td>username</td>
					<td>
						<input type="hidden" name="id" value="<?php echo $d['id']; ?>">
						<input type="username" name="username" value="<?php echo $d['username']; ?>">
					</td>
				</tr>
				<tr>
					<td>password</td>
					<td><input type="password" name="password" value="<?php echo $d['password']; ?>"></td>
				</tr>
                <tr>
					<td>konfirmasi password</td>
					<td><input type="password2" name="password2" value="<?php echo $d['password2']; ?>"></td>
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
 
</body>
</html>