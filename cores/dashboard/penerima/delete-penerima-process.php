<?php  
	
	session_start();

	include '../../function.php';

	$conn = koneksi();
	$penerima_id = sanitizeThis($_POST['penerima_id']);
	
	$query = "DELETE FROM penerima WHERE id = '$penerima_id'";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data Penerima berhasil dihapus.';
		header('Location:../../../dashboard.php?page=kelola-penerima'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-penerima'); 
		die();
	}

?>