<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sistem Pengolahan Data Pesebaran Keluarga Miskin</title>
	<link href="../../../assets/vendors/material-dashboard-pro/assets/css/bootstrap.min.css" rel="stylesheet" />
	<style type="text/css" media="print">
		/*@page { 
			size: landscape;
		}*/
	</style>
</head>
<body>
	<?php  

		session_start();
		include '../../../cores/function.php';

		$conn = koneksi();
		$profil = getStaffProfil($_SESSION['id']);

		$lRW = [];
		$finalData = [];

		$listBulan = [
			1 => 'jan', 2 => 'feb', 3 => 'mar', 4 => 'apr', 5 => 'mei', 6 => 'jun', 7 => 'jul', 8 => 'agu', 9 => 'sep', 10 => 'okt', 11 => 'nov', 12 => 'des', 
		];

		$tahun = $_GET['tahun'];
		$bantuan_id = $_GET['bantuan_id'];

		$bantuanQ = mysqli_query($conn, "SELECT * FROM bantuan WHERE id = '$bantuan_id'");
		$bantuanDt = mysqli_fetch_assoc($bantuanQ);

		$rwQ = mysqli_query($conn, "SELECT * FROM rw");
		while($rRW = mysqli_fetch_array($rwQ)) {
			$lRW[] = $rRW;
		}

		foreach ($lRW as $index => $dataRW) {
			$lRT = [];
			$rtQ = mysqli_query($conn, "SELECT * FROM rt WHERE rw_id = '".$dataRW['id']."'");
			while($rRT = mysqli_fetch_array($rtQ)) {
				$lRT[] = $rRT;
			}
			foreach ($lRT as $index2 => $dataRT) {
				$addDATA = [];
				$addDATA['rt_rw'] = 'RT '.$dataRT['nama_rt'].' RW '.$dataRW['nama_rw'];
				for ($i = 1; $i <= 12 ; $i++) {
					$countQ = mysqli_query($conn, "
						SELECT COUNT(pemberian.id) AS TotalPenerima FROM pemberian, penerima 
						WHERE pemberian.penerima_id = penerima.id AND penerima.rt_id = '".$dataRT['id']."' 
						AND pemberian.bantuan_id = $bantuan_id AND pemberian.tahun = $tahun AND pemberian.bulan = $i  
					");
					$countDT = mysqli_fetch_assoc($countQ)['TotalPenerima'];
					$addDATA[$listBulan[$i]] = $countDT;
				}
				$finalData[] = $addDATA;
			}
			
		}

	?>

	<div class="container" style="margin-top: 20px; font-size: 10pt;">
		<div class="row">
			<div class="col-md-12">
				<p class="text-center" style="font-size: 12pt;">
					<strong>
						<span style="font-size: 13pt;">LAPORAN</span> <br> PENERIMAAN BANTUAN <?php echo strtoupper($bantuanDt['nama_bantuan'].' '.$bantuanDt['banyak_bantuan'].' '.$bantuanDt['satuan']. ' ( Rp '.number_format($bantuanDt['nominal']).' )') ?> <br>KEL. KOTO PANJANG - KEC. TANJUNG HARAPAN <br> SELAMA TAHUN <?php echo $tahun ?> 
					</strong>
				</p>
				<br><br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center" rowspan="2" style="vertical-align:middle;">NO</th>
							<th class="text-center" rowspan="2" style="vertical-align:middle;">RT/RW</th>
							<th class="text-center" colspan="12">BULAN</th>
						</tr>
						<tr>
							<th class="text-center">JAN</th>
							<th class="text-center">FEB</th>
							<th class="text-center">MAR</th>
							<th class="text-center">APR</th>
							<th class="text-center">MEI</th>
							<th class="text-center">JUN</th>
							<th class="text-center">JUL</th>
							<th class="text-center">AGU</th>
							<th class="text-center">SEP</th>
							<th class="text-center">OKT</th>
							<th class="text-center">NOV</th>
							<th class="text-center">DES</th>
						</tr>
					</thead>
					<tbody>
						<?php  
							$tot_jan = 0; $tot_feb = 0; $tot_mar = 0; $tot_apr = 0; $tot_mei = 0; $tot_jun = 0; 
							$tot_jul = 0; $tot_agu = 0; $tot_sep = 0; $tot_okt = 0; $tot_nov = 0; $tot_des = 0;
						?>
						<?php foreach ($finalData as $key => $value): ?>
							<tr>
								<td class="text-center"><?php echo $key+1 ?></td>
								<td class="text-center"><?php echo $value['rt_rw'] ?></td>
								<?php  
									for ($i = 1; $i <= 12 ; $i++) {
										echo '<td class="text-center">'.$value[$listBulan[$i]].'</td>';
										if ($i == 1) {
											$tot_jan = $tot_jan + $value[$listBulan[$i]];
										} elseif ($i == 2) {
											$tot_feb = $tot_feb + $value[$listBulan[$i]];
										} elseif ($i == 3) {
											$tot_mar = $tot_mar + $value[$listBulan[$i]];
										} elseif ($i == 4) {
											$tot_apr = $tot_apr + $value[$listBulan[$i]];
										} elseif ($i == 5) {
											$tot_mei = $tot_mei + $value[$listBulan[$i]];
										} elseif ($i == 6) {
											$tot_jun = $tot_jun + $value[$listBulan[$i]];
										} elseif ($i == 7) {
											$tot_jul = $tot_jul + $value[$listBulan[$i]];
										} elseif ($i == 8) {
											$tot_agu = $tot_agu + $value[$listBulan[$i]];
										} elseif ($i == 9) {
											$tot_sep = $tot_sep + $value[$listBulan[$i]];
										} elseif ($i == 10) {
											$tot_okt = $tot_okt + $value[$listBulan[$i]];
										} elseif ($i == 11) {
											$tot_nov = $tot_nov + $value[$listBulan[$i]];
										} elseif ($i == 12) {
											$tot_des = $tot_des + $value[$listBulan[$i]];
										}
									}
								?>
							</tr>
						<?php endforeach ?>
						<tr>
							<td colspan="2" class="text-center"><strong>TOTAL</strong></td>
							<td class="text-center"><strong><?php echo $tot_jan ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_feb ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_mar ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_apr ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_mei ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_jun ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_jul ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_agu ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_sep ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_okt ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_nov ?></strong></td>
							<td class="text-center"><strong><?php echo $tot_des ?></strong></td>
						</tr>
					</tbody>
				</table>
				<br>
				<p class="text-center">Solok, ...</p><br>
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
			</div>
		</div>
	</div>

	<script>
		window.print();
		setTimeout(window.close, 0);
	</script>

</body>
</html>