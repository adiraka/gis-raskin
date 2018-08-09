<?php  

	session_start();

	include '../../function.php';

	if ($_POST['nama'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-bantuan'); 
		die();
	} elseif ($_POST['banyak'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Banyak Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-bantuan'); 
		die();
	} elseif ($_POST['satuan'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Satuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-bantuan'); 
		die();
	} elseif ($_POST['nominal'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nominal tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-bantuan'); 
		die();
	}

	$conn = koneksi();
	$id = sanitizeThis($_POST['id']);
	$nama = sanitizeThis($_POST['nama']);
	$banyak = sanitizeThis($_POST['banyak']);
	$satuan = sanitizeThis($_POST['satuan']);
	$nominal = sanitizeThis($_POST['nominal']);

	$query = "UPDATE bantuan SET nama_bantuan = '$nama', banyak_bantuan = '$banyak', satuan = '$satuan', nominal = '$nominal' WHERE id = '$id'";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data Bantuan berhasil diubah.';
		header('Location:../../../dashboard.php?page=kelola-bantuan'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-bantuan'); 
		die();
	}

?>