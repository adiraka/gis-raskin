<?php

	session_start();

	require 'cores/function.php'; 

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
					
                	<?php
	                	if (ISSET($_GET['page'])) {
	                		$page = $_GET['page'];
	                		if ($page == 'beranda') {
	                			include 'views/dashboard/beranda.php';
	                		} elseif ($page == 'keluar') {
	                			include 'views/dashboard/keluar.php';
	                		} elseif ($page == 'kelola-rw') {
	                			
	                		} elseif ($page == 'kelola-rt') {
	                			
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

</body>

</html>