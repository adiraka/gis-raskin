<?php  
	
	session_start();

	include '../../function.php';

	if ($_POST['nip'] == NULL) {
		$_SESSION['gagal'] = 'Kolom NIP tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-akun'); 
		die();
	} elseif ($_POST['nama'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Nama Lengkap tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-akun'); 
		die();
	} elseif ($_POST['username'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Username tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-akun'); 
		die();
	} elseif ($_POST['password'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Password tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-akun'); 
		die();
	} elseif ($_POST['konf_password'] == NULL) {
		$_SESSION['gagal'] = 'Kolom Konfirmasi Password tidak boleh kosong.';
		header('Location:../../../dashboard.php?page=tambah-akun'); 
		die();
	}

	$conn = koneksi();
	$nip = sanitizeThis($_POST['nip']);
	$nama = sanitizeThis($_POST['nama']);
	$username = sanitizeThis($_POST['username']);
	$password = sanitizeThis($_POST['password']);
	$konf_password = sanitizeThis($_POST['konf_password']);
	$status = 1;
	$hak_akses = 'staff';

	if ($password != $konf_password) {
		$_SESSION['gagal'] = 'Password Konfirmasi yang diinputkan tidak cocok.';
		header('Location:../../../dashboard.php?page=tambah-akun'); 
		die();
	}

	$query = "INSERT INTO user_akun (username, password, hak_akses, status, nama, nip) VALUES ('$username', '".md5($password)."', '$hak_akses', '$status', '$nama', '$nip')";
	$procs = mysqli_query($conn, $query);

	if ($procs) {
		$_SESSION['sukses'] = 'Akun baru berhasil ditambahkan.';
		header('Location:../../../dashboard.php?page=kelola-akun'); 
		die();
	} else {
		$_SESSION['gagal'] = 'Telah terjadi sebuah kesalahan.';
		header('Location:../../../dashboard.php?page=kelola-akun'); 
		die();
	}

?>