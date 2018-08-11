<?php  

	session_start();

	include '../../function.php';

	if ($_POST['bulan'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Bulan Periode Pemberian Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-pemberian'); 
		die();
	} elseif ($_POST['tahun'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Tahun Periode Pemberian Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-pemberian'); 
		die();
	} elseif ($_POST['penerima_id'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Penerima Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-pemberian'); 
		die();
	} elseif ($_POST['bantuan_id'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Bantuan Yang Diberikan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-pemberian'); 
		die();
	} elseif ($_POST['tanggal'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Tanggal Pemberian Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-pemberian'); 
		die();
	}

	$conn = koneksi();
	$bulan = sanitizeThis($_POST['bulan']);
	$tahun = sanitizeThis($_POST['tahun']);
	$penerima_id = sanitizeThis($_POST['penerima_id']);
	$bantuan_id = sanitizeThis($_POST['bantuan_id']);
	$tanggal = sanitizeThis($_POST['tanggal']);
	$user_id = $_SESSION['id'];

	$qCheck = "SELECT * FROM pemberian WHERE bulan = '$bulan' AND tahun = '$tahun' AND penerima_id = '$penerima_id'";
	$pCheck = mysqli_query($conn, $qCheck);
	$cCheck = mysqli_num_rows($pCheck);
	
	if ($cCheck == '1') {
		$_SESSION['gagal'] = 'Penerima bersangkutan telah menerima bantuan pada periode ini.';
		header('Location:../../../dashboard.php?page=tambah-pemberian'); 
		die();
	}

	$query = "INSERT INTO pemberian (bulan, tahun, penerima_id, bantuan_id, tanggal, user_akun_id) VALUES('$bulan', '$tahun', '$penerima_id', '$bantuan_id', '$tanggal', '$user_id')";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data Pemberian Bantuan berhasil ditambahkan.';
		header('Location:../../../dashboard.php?page=kelola-pemberian'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-pemberian'); 
		die();
	}

?>