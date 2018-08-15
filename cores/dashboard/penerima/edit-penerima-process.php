<?php  
	
	session_start();

	include '../../function.php';

	if ($_POST['no_kk'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nomor Kartu Keluarga tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-penerima&id='.$_POST['penerima_id']); 
		die();
	} elseif ($_POST['kepala_keluarga'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama Kepala Keluarga tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-penerima&id='.$_POST['penerima_id']); 
		die();
	} elseif ($_POST['alamat'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Alamat tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-penerima&id='.$_POST['penerima_id']); 
		die();
	} elseif ($_POST['rt_id'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama RT tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-penerima&id='.$_POST['penerima_id']); 
		die();
	} elseif ($_POST['telepon'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Telepon tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-penerima&id='.$_POST['penerima_id']); 
		die();
	} elseif ($_POST['latitude'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Latitude tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-penerima&id='.$_POST['penerima_id']); 
		die();
	} elseif ($_POST['longitude'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Longitude tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-penerima&id='.$_POST['penerima_id']); 
		die();
	} elseif ($_POST['bantuan_id'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Jenis Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=ubah-penerima&id='.$_POST['penerima_id']); 
		die();
	}

	$conn = koneksi();
	$penerima_id = sanitizeThis($_POST['penerima_id']);
	$no_kk = sanitizeThis($_POST['no_kk']);
	$kepala_keluarga = sanitizeThis($_POST['kepala_keluarga']);
	$alamat = sanitizeThis($_POST['alamat']);
	$telepon = sanitizeThis($_POST['telepon']);
	$latitude = sanitizeThis($_POST['latitude']);
	$longitude = sanitizeThis($_POST['longitude']);
	$rt_id = sanitizeThis($_POST['rt_id']);
	$bantuan_id = sanitizeThis($_POST['bantuan_id']);
	
	$query = "
		UPDATE penerima SET no_kk = '$no_kk', kepala_keluarga = '$kepala_keluarga', alamat = '$alamat', telepon = '$telepon', rt_id = '$rt_id', bantuan_id = '$bantuan_id', latitude = '$latitude', longitude = '$longitude' WHERE id = '$penerima_id'
	";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data Penerima berhasil diubah.';
		header('Location:../../../dashboard.php?page=kelola-penerima'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-penerima'); 
		die();
	}

?>