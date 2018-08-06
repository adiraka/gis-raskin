<?php  

	function koneksi() {
		$conn = mysqli_connect('localhost', 'root', '', 'dbraskin');
		return $conn;
	}

	function sanitizeThis($string) {
		$conn = koneksi();
		$output1 = mysqli_real_escape_string($conn, $string);
		$output2 = strip_tags($output1);
		return htmlspecialchars($output2); 
	}

?>