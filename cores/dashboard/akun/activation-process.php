<?php  

	session_start();

	include '../../function.php';

	$conn = koneksi();
	$stat = sanitizeThis($_GET['stat']);
	$user_id = sanitizeThis($_GET['id']);

	if ($stat == '1') {
		$aktivationQ = "UPDATE user_akun SET status = '0' WHERE id = '$user_id'";
	} elseif ($stat == '0') {
		$aktivationQ = "UPDATE user_akun SET status = '1' WHERE id = '$user_id'";
	}
	
	$aktivationP = mysqli_query($conn, $aktivationQ);

	if ($aktivationP) {
		$_SESSION['sukses'] = 'Status akun berhasil dirubah.';
		header('Location:../../../dashboard.php?page=kelola-akun'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-akun'); 
		die();
	}

?>