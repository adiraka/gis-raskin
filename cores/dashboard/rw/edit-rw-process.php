<?php  
	
	session_start();

	include '../../function.php';

	if ($_POST['nama'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama RW tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-rw'); 
		die();
	} elseif ($_POST['ketua'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama Ketua RW tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-rw'); 
		die();
	}

	$conn = koneksi();
	$rw_id = sanitizeThis($_POST['rw_id']);
	$nama = sanitizeThis($_POST['nama']);
	$ketua = sanitizeThis($_POST['ketua']);

	$query = "UPDATE rw SET nama_rw = '$nama', ketua_rw = '$ketua' WHERE id = '$rw_id'";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data RW berhasil diubah.';
		header('Location:../../../dashboard.php?page=kelola-rw'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-rw'); 
		die();
	}

?>