<?php  

	session_start();

	include '../../function.php';

	$conn = koneksi();
	$id = sanitizeThis($_POST['user_id']);
	$nip = sanitizeThis($_POST['nip']);
	$nama = sanitizeThis($_POST['nama']);

	$query = "UPDATE user_akun SET nip = '$nip', nama = '$nama' WHERE id = '$id'";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Profil berhasil dirubah.';
		header('Location:../../../dashboard.php?page=ubah-profil'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=ubah-profil'); 
		die();
	}

?>