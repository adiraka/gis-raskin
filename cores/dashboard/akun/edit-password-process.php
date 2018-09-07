<?php  

	session_start();

	include '../../function.php';

	if ($_POST['password'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Password tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-password'); 
		die();
	} elseif ($_POST['konf_password'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Konfirmasi Password tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-password'); 
		die();
	}

	$conn = koneksi();
	$id = sanitizeThis($_POST['user_id']);
	$password = sanitizeThis($_POST['password']);
	$konf_password = sanitizeThis($_POST['konf_password']);

	if ($password != $konf_password) {
		$_SESSION['gagal'] = 'Password Konfirmasi yang diinputkan tidak cocok.';
		header('Location:../../../dashboard.php?page=ubah-password'); 
		die();
	}

	$query = "UPDATE user_akun SET password = '".md5($password)."' WHERE id = '$id'";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Password berhasil dirubah.';
		header('Location:../../../dashboard.php?page=ubah-password'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=ubah-password'); 
		die();
	}

?>