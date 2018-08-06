<?php  
	
	session_start();
	include '../function.php';
	$conn = koneksi();

	// validasi
	if ($_POST['username'] == NULL) {
		$_SESSION['gagal'] = 'Kolom username tidak boleh kosong.';
		header('Location:../../login.php'); 
		die();
	} elseif ($_POST['password'] == NULL) {
		$_SESSION['gagal'] = 'Kolom password tidak boleh kosong.';
		header('Location:../../login.php'); 
		die();
	}

	$username = sanitizeThis($_POST['username']);
	$password = md5(sanitizeThis($_POST['password']));

	$query = "SELECT * FROM user_akun WHERE username = '$username' AND password = '$password'";
	$procs = mysqli_query($conn, $query);

	$data = mysqli_fetch_assoc($procs);
	$count = mysqli_num_rows($procs);

	if ($count == 1) {
		$hakakses = $data['hak_akses'];
		$status = $data['status'];
		if ($status != 1) {
			$_SESSION['gagal'] = 'Akun anda tidak dapat diakses untuk sementara waktu.';
			header('Location:../../login.php'); 
			die();
		}
		if ($hakakses == 'staff') {
			$_SESSION['id'] = $data['id'];		
			$_SESSION['username'] = $data['username'];
			$_SESSION['akses'] = $hakakses;
			$_SESSION['sukses'] = 'Selamat Datang.';
			header('Location:../../dashboard.php?page=beranda');
			die();
		}
	} else {
		$_SESSION['gagal'] = 'Akun yang anda inputkan salah.';
		header('Location:../../login.php'); 
		die();
	}

?>