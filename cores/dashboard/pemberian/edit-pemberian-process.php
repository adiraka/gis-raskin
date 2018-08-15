<?php  

	session_start();

	include '../../function.php';

	if ($_POST['bulan'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Bulan Periode Pemberian Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-pemberian&id='.$_POST['pemberian_id']); 
		die();
	} elseif ($_POST['tahun'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Tahun Periode Pemberian Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-pemberian&id='.$_POST['pemberian_id']); 
		die();
	} elseif ($_POST['penerima_id'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Penerima Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-pemberian&id='.$_POST['pemberian_id']); 
		die();
	} elseif ($_POST['bantuan_id'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Bantuan Yang Diberikan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-pemberian&id='.$_POST['pemberian_id']); 
		die();
	} elseif ($_POST['tanggal'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Tanggal Pemberian Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-pemberian&id='.$_POST['pemberian_id']); 
		die();
	}

	$conn = koneksi();
	$pemberian_id = sanitizeThis($_POST['pemberian_id']);
	$bulan = sanitizeThis($_POST['bulan']);
	$tahun = sanitizeThis($_POST['tahun']);
	$penerima_id = sanitizeThis($_POST['penerima_id']);
	$bantuan_id = sanitizeThis($_POST['bantuan_id']);
	$tanggal = sanitizeThis($_POST['tanggal']);
	$user_id = $_SESSION['id'];

	$query = "
		UPDATE pemberian SET bulan = '$bulan', tahun = '$tahun', penerima_id = '$penerima_id', bantuan_id = '$bantuan_id', tanggal = '$tanggal' 
		WHERE id = '$pemberian_id'
	";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data Pemberian Bantuan berhasil diubah.';
		header('Location:../../../dashboard.php?page=kelola-pemberian'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-pemberian'); 
		die();
	}

?>