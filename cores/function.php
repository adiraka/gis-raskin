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

	$listBulan = [
		1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember', 
	];

	function cekStatusPenerima($bulan, $tahun, $penerima_id) {
		$conn = koneksi();
		$query = "SELECT * FROM pemberian WHERE bulan = '$bulan' AND tahun = '$tahun' AND penerima_id = '$penerima_id'";
		$procs = mysqli_query($conn, $query);
		$row = mysqli_num_rows($procs);

		if ($row == '1') {
			return [
				'status' => 1,
				'text' => '&#x2714;'
			];
		} elseif ($row == '0') {
			return [
				'status' => 0,
				'text' => '&#x2718;'
			];
		} else {
			return [
				'status' => '',
				'text' => ''
			];
		}
	}

?>