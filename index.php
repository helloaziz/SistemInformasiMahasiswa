<?php
include ('koneksi.php');
session_start();
// selama user belum logout maka ketika membuka browser baru maka akan tetap bisa menjalankan aplikasi
if (isset($_SESSION["login"])){
	header("location:media.php");
	exit;
}
	// mengecek penekanan tombol Login, data input dari form disimpan di variabel $ 
   if (isset($_POST["login"])){
	    $username=$_POST["username"];
	    $password=$_POST["password"];
	    $result=mysqli_query($koneksi,"SELECT * from user where username='$username'");
		//cek username
	if (mysqli_num_rows($result)===1){
		
		//cek password
		// data yg ditemukan disimpan di $row
		$row=mysqli_fetch_assoc($result);
		//password verify mengecek string apakah sama dengan password_hash
		if (password_verify($password,$row["password"])){
			//set session, jika user & password di temukan di database, menjalankan media.php
				$_SESSION["login"]=true;
					header("location:media.php?modul=home");
			exit;
		}
	}
	$error=true;
}
?>	

<!DOCTYPE HTML>
<html>
	<head>
		<title>Halaman Login</title>
	</head>
	<script>
		function myFunction(x) {
  		x.style.background = "green";
	}
		function mymessage() {
  		alert("Selamat datang");
	}
</script>
	<body onload="mymessage()">
	<h1>Halaman Login</h1>
	<?php
		// kalo ada error 
		if (isset($error)):
	?>
	<p style="color:red;font-style:italic;">Username/password salah</p>
	<?php endif; ?> 
		<form action="" method="POST">
			<ul>
				<li>
					<label for="username">username : </label>
					<input type="text" onfocus="myFunction(this)" name="username" id="username">
				</li>
				<li>
					<label for="password">password :</label>
					<input type="password" onfocus="myFunction(this)" name="password" id="password">
				</li>
				<li>
					<button type="Submit" name="login">Login</button>
				</li>
			</ul>
		</form>	
	</body>
</html>
