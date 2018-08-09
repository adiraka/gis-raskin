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
	$rw_id = sanitizeThis($_POST['rw_id']);
	$nama = sanitizeThis($_POST['nama']);
	$ketua = sanitizeThis($_POST['ketua']);

	$query = "UPDATE rt SET rw_id = '$rw_id', nama_rt = '$nama', ketua_rt = '$ketua' WHERE id = '$rt_id'";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data RT berhasil diubah.';
		header('Location:../../../dashboard.php?page=kelola-rt'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-rt'); 
		die();
	}

?>