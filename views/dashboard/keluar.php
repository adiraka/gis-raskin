<?php  

	session_unset();

	$_SESSION['sukses'] = 'Anda telah berhasil keluar.';

?>

<script>
	window.location = 'login.php';
</script>