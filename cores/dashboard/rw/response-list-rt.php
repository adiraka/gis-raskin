<?php  

	session_start();

	include '../../function.php';

	$conn = koneksi();
	$rw_id = sanitizeThis($_POST['rw_id']);

	$query = "SELECT * FROM rt WHERE rw_id = '$rw_id'";
	$procs = mysqli_query($conn, $query);

	$list = [];

	while($row = mysqli_fetch_array($procs)) {
		$list[] = $row;
	}

	echo json_encode($list);

?>