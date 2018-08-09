<?php

	session_start();

	require 'cores/function.php'; 

    $conn = koneksi();
	$profil = getStaffProfil($_SESSION['id']);

	if (!isset($_SESSION['username']) || $_SESSION['akses'] != 'staff') {
		session_unset();
		$_SESSION['gagal'] = 'Maaf anda tidak memiliki izin untuk mengakses halaman ini';
		header('Location:login.php');
		die();
	}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/vendors/material-dashboard-pro/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/vendors/material-dashboard-pro/assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Staff Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="assets/vendors/material-dashboard-pro/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendors/material-dashboard-pro/assets/css/material-dashboard.css" rel="stylesheet" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

    <div class="wrapper">

        <?php include 'views/partials/sidebar.php'; ?>

        <div class="main-panel">

           <?php include 'views/partials/navbar.php'; ?>

            <div class="content">

                <div class="container-fluid">

                    <?php include 'views/partials/notification.php'; ?>
					
                	<?php
	                	if (ISSET($_GET['page'])) {
	                		$page = $_GET['page'];
	                		if ($page == 'beranda') {
	                			include 'views/dashboard/beranda.php';
	                		} elseif ($page == 'keluar') {
	                			include 'views/dashboard/keluar.php';
	                		} elseif ($page == 'kelola-rw') {
	                			include 'views/dashboard/rw/main.php';
	                		} elseif ($page == 'tambah-rw') {
	                			include 'views/dashboard/rw/add.php';
	                		} elseif ($page == 'ubah-rw') {
                                include 'views/dashboard/rw/edit.php';
                            } elseif ($page == 'hapus-rw') {
                                include 'views/dashboard/rw/delete.php';
                            } elseif ($page == 'kelola-rt') {
	                			include 'views/dashboard/rt/main.php';
	                		} elseif ($page == 'tambah-rt') {
                                include 'views/dashboard/rt/add.php';
                            } elseif ($page == 'ubah-rt') {
                                include 'views/dashboard/rt/edit.php';
                            } elseif ($page == 'hapus-rt') {
                                include 'views/dashboard/rt/delete.php';
                            } elseif ($page == 'kelola-bantuan') {
                                include 'views/dashboard/bantuan/main.php';
                            } elseif ($page == 'tambah-bantuan') {
                                include 'views/dashboard/bantuan/add.php';
                            } elseif ($page == 'ubah-bantuan') {
                                include 'views/dashboard/bantuan/edit.php';
                            } elseif ($page == 'hapus-bantuan') {
                                include 'views/dashboard/bantuan/delete.php';
                            } elseif ($page == 'kelola-penerima') {
                                include 'views/dashboard/penerima/main.php';
                            } elseif ($page == 'tambah-penerima') {
                                include 'views/dashboard/penerima/add.php';
                            } else {
	                			echo 'Halaman yang anda cari tidak ditemukan.';
	                		}
	                	} else {
	                		echo 'Halaman yang anda cari tidak ditemukan.';
	                	}
                	?>
                    
                </div>

            </div>

            <?php include 'views/partials/footer.php'; ?>

        </div>

    </div>

    <script src="assets/vendors/material-dashboard-pro/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/material.min.js" type="text/javascript"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/arrive.min.js" type="text/javascript"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/jquery.validate.min.js"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/jquery.tagsinput.js"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/material-dashboard.js"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/jquery.datatables.js"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/jquery.select-bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>