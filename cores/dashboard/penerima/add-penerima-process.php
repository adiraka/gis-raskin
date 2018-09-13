<?php  
	
	session_start();

	include '../../function.php';

	if ($_POST['no_kk'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nomor Kartu Keluarga tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-penerima'); 
		die();
	} elseif ($_POST['kepala_keluarga'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama Kepala Keluarga tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-penerima'); 
		die();
	} elseif ($_POST['alamat'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Alamat tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-penerima'); 
		die();
	} elseif ($_POST['rt_id'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama RT tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-penerima'); 
		die();
	} elseif ($_POST['telepon'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Telepon tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-penerima'); 
		die();
	} elseif ($_POST['latitude'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Latitude tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-penerima'); 
		die();
	} elseif ($_POST['longitude'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Longitude tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-penerima'); 
		die();
	} elseif ($_POST['bantuan_id'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Jenis Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-penerima'); 
		die();
	} elseif ($_FILES['foto']['name'] == NULL) {
		$_SESSION['gagal'] = 'Foto Rumah Penerima Bantuan tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-penerima'); 
		die();
	}

	$conn = koneksi();
	$no_kk = sanitizeThis($_POST['no_kk']);
	$kepala_keluarga = sanitizeThis($_POST['kepala_keluarga']);
	$alamat = sanitizeThis($_POST['alamat']);
	$telepon = sanitizeThis($_POST['telepon']);
	$latitude = sanitizeThis($_POST['latitude']);
	$longitude = sanitizeThis($_POST['longitude']);
	$rt_id = sanitizeThis($_POST['rt_id']);
	$bantuan_id = sanitizeThis($_POST['bantuan_id']);

	$file_type = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
	$file_name = sanitizeThis($_FILES['foto']['name']);
	$file_size = $_FILES['foto']['size'];
	$target_dir = '../../../assets/img/foto_rumah/';
	$check = getimagesize($_FILES['foto']['tmp_name']);

	if ($check == false) {
		$_SESSION['gagal'] = 'File yang diinputkan bukan merupakan file gambar!';
		header('Location:../../../dashboard.php?page=tambah-penerima');
		die();
	}

	if ($file_size > 2000000) {	
		$_SESSION['gagal'] = 'Ukuran file gambar maksimal 2MB!';
		header('Location:../../../dashboard.php?page=tambah-penerima');
		die();
	}

	$new_file_name = substr(sha1(time()), 0, 20).'.'.$file_type;
	$new_target_file = $target_dir.$new_file_name;
	$upload_file = move_uploaded_file($_FILES['foto']['tmp_name'], $new_target_file);

	if (!$upload_file) {	
		$_SESSION['gagal'] = 'Telah terjadi kesalahan dalam mengupload file gambar!';
		header('Location:../../../dashboard.php?page=tambah-penerima');
		die();
	}

	$query = "INSERT INTO penerima (no_kk, kepala_keluarga, alamat, telepon, rt_id, bantuan_id, latitude, longitude, foto_rumah) VALUES ('$no_kk', '$kepala_keluarga', '$alamat', '$telepon', '$rt_id', '$bantuan_id', '$latitude', '$longitude', '$new_file_name')";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Data Penerima berhasil ditambahkan.';
		header('Location:../../../dashboard.php?page=kelola-penerima'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-penerima'); 
		die();
	}

?>