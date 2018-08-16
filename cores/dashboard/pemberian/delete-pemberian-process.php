<?php  

	session_start();

	include '../../function.php';

	$conn = koneksi();
	$pemberian_id = sanitizeThis($_POST['pemberian_id']);

	$query = "DELETE FROM pemberian WHERE id = '$pemberian_id'";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data Pemberian Bantuan berhasil dihapus.';
		header('Location:../../../dashboard.php?page=kelola-pemberian'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-pemberian'); 
		die();
	}

?>