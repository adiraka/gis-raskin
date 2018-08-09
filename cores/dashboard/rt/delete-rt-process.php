<?php  
	
	session_start();

	include '../../function.php';

	if ($_POST['nama'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama RT tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-rt'); 
		die();
	} elseif ($_POST['ketua'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama Ketua RT tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-rt'); 
		die();
	} elseif ($_POST['rw_id'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama RW tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-rt'); 
		die();
	}

	$conn = koneksi();
	$rt_id = sanitizeThis($_POST['rt_id']);

	$query = "DELETE FROM rt WHERE id = '$rt_id'";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data RT berhasil dihapus.';
		header('Location:../../../dashboard.php?page=kelola-rt'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-rt'); 
		die();
	}

?>