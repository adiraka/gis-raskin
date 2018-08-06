<?php  

	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'dbraskin';

	$conn = mysqli_connect($host, $user, $pass, $db);

	if (!$conn) {
		die('Silahkan cek koneksi.php terlebih dahulu.');
	}

?>