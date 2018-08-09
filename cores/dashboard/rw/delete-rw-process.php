<?php  
	
	session_start();

	include '../../function.php';

	$conn = koneksi();
	$rw_id = sanitizeThis($_POST['rw_id']);

	$query = "DELETE FROM rw WHERE id = '$rw_id'";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data RW berhasil dihapus.';
		header('Location:../../../dashboard.php?page=kelola-rw'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-rw'); 
		die();
	}

?>