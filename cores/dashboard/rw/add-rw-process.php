<?php  

	include '../../function.php';

	$conn = koneksi();

	if ($_POST['nama'] == NULL) {
		$_SESSION['gagal'] = 'Kolom nama rw tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-rw'); 
		die();
	}

?>