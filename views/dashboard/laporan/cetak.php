<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sistem Pengolahan Data Pesebaran Keluarga Miskin</title>
	<link href="../../../assets/vendors/material-dashboard-pro/assets/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
	<?php  

		session_start();
		include '../../../cores/function.php';

		$conn = koneksi();
		$profil = getStaffProfil($_SESSION['id']);

		$listData = [];
		$listPenerima = [];

		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		$bantuan_id = $_GET['bantuan_id'];

		$tes = cekStatusPenerima($bulan, $tahun, '1');

		$bantuanQ = mysqli_query($conn, "SELECT * FROM bantuan WHERE id = '$bantuan_id'");
		$bantuanDt = mysqli_fetch_assoc($bantuanQ);

		$penerimaQ = mysqli_query($conn, "
			SELECT penerima.id, penerima.no_kk, penerima.kepala_keluarga, penerima.alamat, penerima.telepon, rw.nama_rw, rt.nama_rt 
			FROM penerima, rw, rt 
			WHERE penerima.rt_id = rt.id AND rt.rw_id = rw.id AND penerima.bantuan_id = '$bantuan_id'
		");

		while($rPenerima = mysqli_fetch_array($penerimaQ)) {
			$listPenerima[] = $rPenerima;
		}

		foreach ($listPenerima as $key => $value) {
			$listData[$key]['kk'] = $value['no_kk'];
			$listData[$key]['nama'] = $value['kepala_keluarga'];
			$listData[$key]['alamat'] = $value['alamat'];
			$listData[$key]['rw'] = $value['nama_rw'];
			$listData[$key]['rt'] = $value['nama_rt'];
			$listData[$key]['telepon'] = $value['telepon'];
			$listData[$key]['status'] = cekStatusPenerima($bulan, $tahun, $value['id']);
		}

	?>

	<div class="container" style="margin-top: 20px; font-size: 10pt;">
		<div class="row">
			<div class="col-md-12">
				<p class="text-center" style="font-size: 12pt;">
					<strong>
						<span style="font-size: 13pt;">LAPORAN</span> <br> DAFTAR PENERIMA BANTUAN <?php echo strtoupper($bantuanDt['nama_bantuan'].' '.$bantuanDt['banyak_bantuan'].' '.$bantuanDt['satuan']. ' ( Rp '.number_format($bantuanDt['nominal']).' )') ?> <br>KEL. KOTO PANJANG - KEC. TANJUNG HARAPAN <br> PADA BULAN <?php echo strtoupper($listBulan[$bulan]).' '.$tahun ?> 
					</strong>
				</p>
				<br><br>
				<table class="table table-bordered">
					<?php  
						$totalDiterima = 0;
						$totalBelum = 0;
					?>
					<thead>
						<tr>
							<th class="text-center">NO</th>
							<th class="text-center">NO. KK</th>
							<th class="text-center">NAMA</th>
							<th class="text-center">ALAMAT</th>
							<th class="text-center">RW/RT</th>
							<th class="text-center">STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($listData as $key => $value): ?>
							<tr>
								<td class="text-center"><?php echo $key+1 ?></td>
								<td class="text-center"><?php echo $value['kk'] ?></td>
								<td><?php echo $value['nama'] ?></td>
								<td><?php echo $value['alamat'] ?></td>
								<td class="text-center"><?php echo 'RW '.$value['rw'].' RT '.$value['rt'] ?></td>
								<td class="text-center"><?php echo $value['status']['text'] ?></td>
								<?php  
									if ($value['status']['status'] == 1) {
										$totalDiterima = $totalDiterima + 1;
									} elseif ($value['status']['status'] == 0) {
										$totalBelum = $totalBelum + 1;
									}
								?>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<br>
				<p class="text-center">Solok, ... <?php echo $listBulan[$bulan].' '.$tahun ?></p><br>
				<table style="width: 100%">
					<tr>
						<td class="text-center">
							<p>DIKETAHUI OLEH :</p>
							<p>LURAH KOTO PANJANG</p>
							<br><br>
							<p><u>ADE CHANDRA YUDA, SH., MH</u></p>
							<p>NIP. 197704192005011005</p>
						</td>
						<td class="text-center">
							<p>Petugas Pengelola Bantuan</p>
							<p>Kelurahan Koto Panjang</p>
							<br><br>
							<p><u><?php echo strtoupper($profil['nama']) ?></u></p>
							<p>NIP. <?php echo $profil['nip'] ?></p>
						</td>
					</tr>
				</table>
				<br><br>
				<p>Keterangan :</p>
				<p>Total Penerima Bantuan : <?php echo $totalBelum + $totalDiterima ?></p>
				<p>Bantuan Yang Sudah Diterima : <?php echo $totalDiterima ?></p>
				<p>Bantuan Yang Belum Diterima : <?php echo $totalBelum ?></p>
			</div>
		</div>
	</div>

	<script>
		window.print();
	</script>

</body>
</html>