<?php  

	function koneksi() {
		$host = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'dbraskin';

		$conn = mysqli_connect($host, $user, $pass, $db);
		return $conn;
	}

	function sanitizeThis($string) {
		$conn = koneksi();
		$output1 = mysqli_real_escape_string($conn, $string);
		$output2 = strip_tags($output1);
		return htmlspecialchars($output2); 
	}

	function getStaffProfil($id) {
		$conn = koneksi();
		$query = "SELECT * FROM user_akun WHERE id = '$id'";
		$procs = mysqli_query($conn, $query);
		$datas = mysqli_fetch_assoc($procs);

		return $datas;
	}

?>