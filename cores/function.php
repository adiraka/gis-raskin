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

	function getMapMarkerList() {
		$conn = koneksi();
		$listMarker = [];

		$index = 0;

		$query = "
			SELECT penerima.id, penerima.no_kk, penerima.kepala_keluarga, penerima.alamat, penerima.telepon, penerima.latitude, penerima.longitude, rw.nama_rw, rt.nama_rt, bantuan.nama_bantuan, bantuan.banyak_bantuan, bantuan.satuan, bantuan.nominal 
			FROM penerima, rw, rt, bantuan 
			WHERE rw.id = rt.rw_id AND rt.id = penerima.rt_id AND bantuan.id = penerima.bantuan_id
		";
		$procs = mysqli_query($conn, $query);
		while ($data = mysqli_fetch_array($procs)) {
			$listMarker[$index]['no_kk'] = $data['no_kk'];
			$listMarker[$index]['nama'] = $data['kepala_keluarga']; 
			$listMarker[$index]['alamat'] = $data['alamat'];
			$listMarker[$index]['rt_rw'] = 'RT '.$data['nama_rt'].' RW '.$data['nama_rw'];
			$listMarker[$index]['bantuan'] = $data['nama_bantuan'].' '.$data['banyak_bantuan'].$data['satuan'];
			$listMarker[$index]['lat'] = $data['latitude'];
			$listMarker[$index]['long'] = $data['longitude'];
			$index++;
		}

		return json_encode($listMarker);
	}

?>