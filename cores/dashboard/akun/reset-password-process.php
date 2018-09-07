<?php  

	session_start();

	include '../../function.php';

	$conn = koneksi();
	$user_id = sanitizeThis($_GET['id']);

	$userQ = "SELECT * FROM user_akun WHERE id = '$user_id'";
	$userP = mysqli_query($conn, $userQ);
	$userDt = mysqli_fetch_assoc($userP);

	$newPAss = md5($userDt['nip']);

	$resetQ = "UPDATE user_akun SET password = '$newPAss' WHERE id = '$user_id'";
	$resetP = mysqli_query($conn, $resetQ);

	if ($resetP) {
		$_SESSION['sukses'] = 'Password Akun berhasil direset.';
		header('Location:../../../dashboard.php?page=kelola-akun'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-akun'); 
		die();
	}

?>