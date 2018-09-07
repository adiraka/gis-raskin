<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sistem Pengolahan Data Pesebaran Keluarga Miskin</title>
	<link href="../../../assets/vendors/material-dashboard-pro/assets/css/bootstrap.min.css" rel="stylesheet" />
	<style type="text/css" media="print">
		@page { 
			size: A4 landscape;
		}
	</style>
	<style>
		@media all {
			.page-break { display: none; }
		}

		@page { 
			size: A4 landscape;
		}

		@media print {
			.page-break { display: block; page-break-before: always; }
			.main-konten {
				margin-left: -25mm;
			}
		}

		.chart-container {
			width: 850px;
			height: 300px
		}
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

		$dataArrayPenerima1 = [];
		$dataArrayPenerima2 = [];

	?>

	<div class="container" style="margin-top: 20px; font-size: 8pt;">
		<div class="row">
			<div class="col-md-12">
				<p class="text-center" style="font-size: 12pt;">
					<strong>
						<span style="font-size: 13pt;">LAPORAN</span> <br> PENERIMAAN BANTUAN <?php echo strtoupper($bantuanDt['nama_bantuan'].' '.$bantuanDt['banyak_bantuan'].' '.$bantuanDt['satuan']. ' ( Rp '.number_format($bantuanDt['nominal']).' )') ?> <br>KEL. KOTO PANJANG - KEC. TANJUNG HARAPAN <br> SELAMA TAHUN <?php echo $tahun ?> 
					</strong>
				</p>
				<br><br>
				<div class="main-konten">
					<p><strong>A. TABEL LAPORAN KWARTAL I</strong></p>
					<table class="table table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-center" rowspan="3" style="vertical-align:middle;">#</th>
								<th class="text-center" rowspan="3" style="vertical-align:middle; width: 100px;">NAMA RW</th>
								<th class="text-center" rowspan="3" style="vertical-align:middle; width: 100px;">NAMA RT</th>
								<th class="text-center" colspan="6">JANUARI</th>
								<th class="text-center" colspan="6">FEBRUARI</th>
								<th class="text-center" colspan="6">MARET</th>
							</tr>
							<tr>
								<?php  
									for ($i=0; $i < 3; $i++) { 
										echo '
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">PENERIMA (KK)</th>
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">BANYAK (KG)</th>
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">NOMINAL (RP)</th>
										';
									}
								?>
							</tr>
							<tr>
								<?php  
									for ($i=0; $i < 9; $i++) { 
										echo '
											<th class="text-center">&#x2714;</th>
											<th class="text-center">&#x2718;</th>
										';
									}
								?>
							</tr>
						</thead>
						<tbody>
							<?php  

								$penerima1_bt1 = 0;
								$penerima2_bt1 = 0;
								$banyak1_bt1 = 0;
								$banyak2_bt1 = 0;
								$nominal1_bt1 = 0;
								$nominal2_bt1 = 0;

								$penerima1_bt2 = 0;
								$penerima2_bt2 = 0;
								$banyak1_bt2 = 0;
								$banyak2_bt2 = 0;
								$nominal1_bt2 = 0;
								$nominal2_bt2 = 0;

								$penerima1_bt3 = 0;
								$penerima2_bt3 = 0;
								$banyak1_bt3 = 0;
								$banyak2_bt3 = 0;
								$nominal1_bt3 = 0;
								$nominal2_bt3 = 0;

								foreach ($lRW as $index => $dataRW) {
									$lRT = [];
									$rtQ = mysqli_query($conn, "SELECT * FROM rt WHERE rw_id = '".$dataRW['id']."'");
									$rtNumRow = mysqli_num_rows($rtQ);
									while($rRT = mysqli_fetch_array($rtQ)) {
										$lRT[] = $rRT;
									}

									echo '
										<tr>
											<td class="text-center" rowspan="'.($rtNumRow+2).'" style="vertical-align:middle;"><strong>'.($index+1).'</strong></td>
											<td class="text-center" rowspan="'.($rtNumRow+1).'" style="vertical-align:middle;">RW '.$dataRW['nama_rw'].'</td>
										</tr>
									';

									$penerima1_b1 = 0;
									$penerima2_b1 = 0;
									$banyak1_b1 = 0;
									$banyak2_b1 = 0;
									$nominal1_b1 = 0;
									$nominal2_b1 = 0;

									$penerima1_b2 = 0;
									$penerima2_b2 = 0;
									$banyak1_b2 = 0;
									$banyak2_b2 = 0;
									$nominal1_b2 = 0;
									$nominal2_b2 = 0;

									$penerima1_b3 = 0;
									$penerima2_b3 = 0;
									$banyak1_b3 = 0;
									$banyak2_b3 = 0;
									$nominal1_b3 = 0;
									$nominal2_b3 = 0;

									foreach ($lRT as $index2 => $dataRT) {
										$addDATA = [];

										$mainCountQ = mysqli_query($conn, "
											SELECT COUNT(id) AS TotalPenerima FROM penerima 
											WHERE rt_id = '".$dataRT['id']."' AND bantuan_id = $bantuan_id 
										");
										$mainCountDT = mysqli_fetch_assoc($mainCountQ)['TotalPenerima'];
										
										echo '
											<tr>
												<td class="text-center">RT '.$dataRT['nama_rt'].'</td>
										';

										for ($i = 1; $i <= 3 ; $i++) {
											$countQ = mysqli_query($conn, "
												SELECT COUNT(pemberian.id) AS TotalPenerima  FROM pemberian, penerima 
												WHERE pemberian.penerima_id = penerima.id AND penerima.rt_id = '".$dataRT['id']."' 
												AND pemberian.bantuan_id = $bantuan_id AND pemberian.tahun = $tahun AND pemberian.bulan = $i  
												");
											$countDT = mysqli_fetch_assoc($countQ)['TotalPenerima'];
											echo '
												<td class="text-center">'.$countDT.'</td>
												<td class="text-center">'.($mainCountDT-$countDT).'</td>
												<td class="text-center">'.($bantuanDt['banyak_bantuan']*$countDT).'</td>
												<td class="text-center">'.($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT)).'</td>
												<td class="text-right">'.number_format($bantuanDt['nominal']*$countDT).'</td>
												<td class="text-right">'.number_format($bantuanDt['nominal']*($mainCountDT-$countDT)).'</td>
											';

											if ($i == 1) {
												$penerima1_bt1 = $penerima1_bt1 + $countDT;
												$penerima2_bt1 = $penerima2_bt1 + ($mainCountDT-$countDT);
												$banyak1_bt1 = $banyak1_bt1 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt1 = $banyak2_bt1 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt1 = $nominal1_bt1 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt1 = $nominal2_bt1 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b1 = $penerima1_b1 + $countDT;
												$penerima2_b1 = $penerima2_b1 + ($mainCountDT-$countDT);
												$banyak1_b1 = $banyak1_b1 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b1 = $banyak2_b1 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b1 = $nominal1_b1 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b1 = $nominal2_b1 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											} elseif ($i == 2) {
												$penerima1_bt2 = $penerima1_bt2 + $countDT;
												$penerima2_bt2 = $penerima2_bt2 + ($mainCountDT-$countDT);
												$banyak1_bt2 = $banyak1_bt2 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt2 = $banyak2_bt2 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt2 = $nominal1_bt2 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt2 = $nominal2_bt2 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b2 = $penerima1_b2 + $countDT;
												$penerima2_b2 = $penerima2_b2 + ($mainCountDT-$countDT);
												$banyak1_b2 = $banyak1_b2 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b2 = $banyak2_b2 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b2 = $nominal1_b2 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b2 = $nominal2_b2 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											} elseif ($i == 3) {
												$penerima1_bt3 = $penerima1_bt3 + $countDT;
												$penerima2_bt3 = $penerima2_bt3 + ($mainCountDT-$countDT);
												$banyak1_bt3 = $banyak1_bt3 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt3 = $banyak2_bt3 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt3 = $nominal1_bt3 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt3 = $nominal2_bt3 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b3 = $penerima1_b3 + $countDT;
												$penerima2_b3 = $penerima2_b3 + ($mainCountDT-$countDT);
												$banyak1_b3 = $banyak1_b3 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b3 = $banyak2_b3 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b3 = $nominal1_b3 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b3 = $nominal2_b3 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											}

										}
										$finalData[] = $addDATA;

										echo '</tr>';
									}

									echo '
										<tr>
											<td colspan="2" class="text-center"><strong>TOTAL</strong></td>
											<td class="text-center"><strong>'.$penerima1_b1.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b1.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b1.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b1.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b1).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b1).'</strong></td>
											<td class="text-center"><strong>'.$penerima1_b2.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b2.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b2.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b2.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b2).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b2).'</strong></td>
											<td class="text-center"><strong>'.$penerima1_b3.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b3.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b3.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b3.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b3).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b3).'</strong></td>
										</tr>
									';

								}

								$dataArrayPenerima1[] = $penerima1_bt1;
								$dataArrayPenerima2[] = $penerima2_bt1;
								$dataArrayPenerima1[] = $penerima1_bt2;
								$dataArrayPenerima2[] = $penerima2_bt2;
								$dataArrayPenerima1[] = $penerima1_bt3;
								$dataArrayPenerima2[] = $penerima2_bt3;

							?>

							<tr>
								<td></td>
								<td colspan="2"></td>
								<td colspan="6"></td>
								<td colspan="6"></td>
								<td colspan="6"></td>
							</tr>
							<tr>
								<td colspan="3" class="text-center"><strong>GRAND TOTAL</strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt1 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt1) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt1) ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt2 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt2) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt2) ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt3 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt3) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt3) ?></strong></td>
							</tr>
						</tbody>
					</table>
					<div class="page-break"></div><br><br>
					<p><strong>B. TABEL LAPORAN KWARTAL II</strong></p>
					<table class="table table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-center" rowspan="3" style="vertical-align:middle;">#</th>
								<th class="text-center" rowspan="3" style="vertical-align:middle; width: 100px;">NAMA RW</th>
								<th class="text-center" rowspan="3" style="vertical-align:middle; width: 100px;">NAMA RT</th>
								<th class="text-center" colspan="6">APRIL</th>
								<th class="text-center" colspan="6">MEI</th>
								<th class="text-center" colspan="6">JUNI</th>
							</tr>
							<tr>
								<?php  
									for ($i=0; $i < 3; $i++) { 
										echo '
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">PENERIMA (KK)</th>
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">BANYAK (KG)</th>
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">NOMINAL (RP)</th>
										';
									}
								?>
							</tr>
							<tr>
								<?php  
									for ($i=0; $i < 9; $i++) { 
										echo '
											<th class="text-center">&#x2714;</th>
											<th class="text-center">&#x2718;</th>
										';
									}
								?>
							</tr>
						</thead>
						<tbody>
							<?php  

								$penerima1_bt1 = 0;
								$penerima2_bt1 = 0;
								$banyak1_bt1 = 0;
								$banyak2_bt1 = 0;
								$nominal1_bt1 = 0;
								$nominal2_bt1 = 0;

								$penerima1_bt2 = 0;
								$penerima2_bt2 = 0;
								$banyak1_bt2 = 0;
								$banyak2_bt2 = 0;
								$nominal1_bt2 = 0;
								$nominal2_bt2 = 0;

								$penerima1_bt3 = 0;
								$penerima2_bt3 = 0;
								$banyak1_bt3 = 0;
								$banyak2_bt3 = 0;
								$nominal1_bt3 = 0;
								$nominal2_bt3 = 0;

								foreach ($lRW as $index => $dataRW) {
									$lRT = [];
									$rtQ = mysqli_query($conn, "SELECT * FROM rt WHERE rw_id = '".$dataRW['id']."'");
									$rtNumRow = mysqli_num_rows($rtQ);
									while($rRT = mysqli_fetch_array($rtQ)) {
										$lRT[] = $rRT;
									}

									echo '
										<tr>
											<td class="text-center" rowspan="'.($rtNumRow+2).'" style="vertical-align:middle;"><strong>'.($index+1).'</strong></td>
											<td class="text-center" rowspan="'.($rtNumRow+1).'" style="vertical-align:middle;">RW '.$dataRW['nama_rw'].'</td>
										</tr>
									';

									$penerima1_b1 = 0;
									$penerima2_b1 = 0;
									$banyak1_b1 = 0;
									$banyak2_b1 = 0;
									$nominal1_b1 = 0;
									$nominal2_b1 = 0;

									$penerima1_b2 = 0;
									$penerima2_b2 = 0;
									$banyak1_b2 = 0;
									$banyak2_b2 = 0;
									$nominal1_b2 = 0;
									$nominal2_b2 = 0;

									$penerima1_b3 = 0;
									$penerima2_b3 = 0;
									$banyak1_b3 = 0;
									$banyak2_b3 = 0;
									$nominal1_b3 = 0;
									$nominal2_b3 = 0;

									foreach ($lRT as $index2 => $dataRT) {
										$addDATA = [];

										$mainCountQ = mysqli_query($conn, "
											SELECT COUNT(id) AS TotalPenerima FROM penerima 
											WHERE rt_id = '".$dataRT['id']."' AND bantuan_id = $bantuan_id
										");
										$mainCountDT = mysqli_fetch_assoc($mainCountQ)['TotalPenerima'];
										
										echo '
											<tr>
												<td class="text-center">RT '.$dataRT['nama_rt'].'</td>
										';

										for ($i = 4; $i <= 6 ; $i++) {
											$countQ = mysqli_query($conn, "
												SELECT COUNT(pemberian.id) AS TotalPenerima  FROM pemberian, penerima 
												WHERE pemberian.penerima_id = penerima.id AND penerima.rt_id = '".$dataRT['id']."' 
												AND pemberian.bantuan_id = $bantuan_id AND pemberian.tahun = $tahun AND pemberian.bulan = $i  
												");
											$countDT = mysqli_fetch_assoc($countQ)['TotalPenerima'];
											echo '
												<td class="text-center">'.$countDT.'</td>
												<td class="text-center">'.($mainCountDT-$countDT).'</td>
												<td class="text-center">'.($bantuanDt['banyak_bantuan']*$countDT).'</td>
												<td class="text-center">'.($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT)).'</td>
												<td class="text-right">'.number_format($bantuanDt['nominal']*$countDT).'</td>
												<td class="text-right">'.number_format($bantuanDt['nominal']*($mainCountDT-$countDT)).'</td>
											';

											if ($i == 4) {
												$penerima1_bt1 = $penerima1_bt1 + $countDT;
												$penerima2_bt1 = $penerima2_bt1 + ($mainCountDT-$countDT);
												$banyak1_bt1 = $banyak1_bt1 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt1 = $banyak2_bt1 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt1 = $nominal1_bt1 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt1 = $nominal2_bt1 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b1 = $penerima1_b1 + $countDT;
												$penerima2_b1 = $penerima2_b1 + ($mainCountDT-$countDT);
												$banyak1_b1 = $banyak1_b1 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b1 = $banyak2_b1 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b1 = $nominal1_b1 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b1 = $nominal2_b1 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											} elseif ($i == 5) {
												$penerima1_bt2 = $penerima1_bt2 + $countDT;
												$penerima2_bt2 = $penerima2_bt2 + ($mainCountDT-$countDT);
												$banyak1_bt2 = $banyak1_bt2 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt2 = $banyak2_bt2 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt2 = $nominal1_bt2 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt2 = $nominal2_bt2 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b2 = $penerima1_b2 + $countDT;
												$penerima2_b2 = $penerima2_b2 + ($mainCountDT-$countDT);
												$banyak1_b2 = $banyak1_b2 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b2 = $banyak2_b2 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b2 = $nominal1_b2 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b2 = $nominal2_b2 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											} elseif ($i == 6) {
												$penerima1_bt3 = $penerima1_bt3 + $countDT;
												$penerima2_bt3 = $penerima2_bt3 + ($mainCountDT-$countDT);
												$banyak1_bt3 = $banyak1_bt3 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt3 = $banyak2_bt3 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt3 = $nominal1_bt3 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt3 = $nominal2_bt3 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b3 = $penerima1_b3 + $countDT;
												$penerima2_b3 = $penerima2_b3 + ($mainCountDT-$countDT);
												$banyak1_b3 = $banyak1_b3 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b3 = $banyak2_b3 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b3 = $nominal1_b3 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b3 = $nominal2_b3 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											}

										}
										$finalData[] = $addDATA;

										echo '</tr>';
									}

									echo '
										<tr>
											<td colspan="2" class="text-center"><strong>TOTAL</strong></td>
											<td class="text-center"><strong>'.$penerima1_b1.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b1.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b1.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b1.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b1).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b1).'</strong></td>
											<td class="text-center"><strong>'.$penerima1_b2.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b2.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b2.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b2.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b2).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b2).'</strong></td>
											<td class="text-center"><strong>'.$penerima1_b3.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b3.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b3.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b3.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b3).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b3).'</strong></td>
										</tr>
									';

								}

								$dataArrayPenerima1[] = $penerima1_bt1;
								$dataArrayPenerima2[] = $penerima2_bt1;
								$dataArrayPenerima1[] = $penerima1_bt2;
								$dataArrayPenerima2[] = $penerima2_bt2;
								$dataArrayPenerima1[] = $penerima1_bt3;
								$dataArrayPenerima2[] = $penerima2_bt3;

							?>

							<tr>
								<td></td>
								<td colspan="2"></td>
								<td colspan="6"></td>
								<td colspan="6"></td>
								<td colspan="6"></td>
							</tr>
							<tr>
								<td colspan="3" class="text-center"><strong>GRAND TOTAL</strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt1 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt1) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt1) ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt2 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt2) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt2) ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt3 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt3) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt3) ?></strong></td>
							</tr>
						</tbody>
					</table>
					<div class="page-break"></div><br><br>
					<p><strong>C. TABEL LAPORAN KWARTAL III</strong></p>
					<table class="table table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-center" rowspan="3" style="vertical-align:middle;">#</th>
								<th class="text-center" rowspan="3" style="vertical-align:middle; width: 100px;">NAMA RW</th>
								<th class="text-center" rowspan="3" style="vertical-align:middle; width: 100px;">NAMA RT</th>
								<th class="text-center" colspan="6">JULI</th>
								<th class="text-center" colspan="6">AGUSTUS</th>
								<th class="text-center" colspan="6">SEPTEMBER</th>
							</tr>
							<tr>
								<?php  
									for ($i=0; $i < 3; $i++) { 
										echo '
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">PENERIMA (KK)</th>
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">BANYAK (KG)</th>
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">NOMINAL (RP)</th>
										';
									}
								?>
							</tr>
							<tr>
								<?php  
									for ($i=0; $i < 9; $i++) { 
										echo '
											<th class="text-center">&#x2714;</th>
											<th class="text-center">&#x2718;</th>
										';
									}
								?>
							</tr>
						</thead>
						<tbody>
							<?php  

								$penerima1_bt1 = 0;
								$penerima2_bt1 = 0;
								$banyak1_bt1 = 0;
								$banyak2_bt1 = 0;
								$nominal1_bt1 = 0;
								$nominal2_bt1 = 0;

								$penerima1_bt2 = 0;
								$penerima2_bt2 = 0;
								$banyak1_bt2 = 0;
								$banyak2_bt2 = 0;
								$nominal1_bt2 = 0;
								$nominal2_bt2 = 0;

								$penerima1_bt3 = 0;
								$penerima2_bt3 = 0;
								$banyak1_bt3 = 0;
								$banyak2_bt3 = 0;
								$nominal1_bt3 = 0;
								$nominal2_bt3 = 0;

								foreach ($lRW as $index => $dataRW) {
									$lRT = [];
									$rtQ = mysqli_query($conn, "SELECT * FROM rt WHERE rw_id = '".$dataRW['id']."'");
									$rtNumRow = mysqli_num_rows($rtQ);
									while($rRT = mysqli_fetch_array($rtQ)) {
										$lRT[] = $rRT;
									}

									echo '
										<tr>
											<td class="text-center" rowspan="'.($rtNumRow+2).'" style="vertical-align:middle;"><strong>'.($index+1).'</strong></td>
											<td class="text-center" rowspan="'.($rtNumRow+1).'" style="vertical-align:middle;">RW '.$dataRW['nama_rw'].'</td>
										</tr>
									';

									$penerima1_b1 = 0;
									$penerima2_b1 = 0;
									$banyak1_b1 = 0;
									$banyak2_b1 = 0;
									$nominal1_b1 = 0;
									$nominal2_b1 = 0;

									$penerima1_b2 = 0;
									$penerima2_b2 = 0;
									$banyak1_b2 = 0;
									$banyak2_b2 = 0;
									$nominal1_b2 = 0;
									$nominal2_b2 = 0;

									$penerima1_b3 = 0;
									$penerima2_b3 = 0;
									$banyak1_b3 = 0;
									$banyak2_b3 = 0;
									$nominal1_b3 = 0;
									$nominal2_b3 = 0;

									foreach ($lRT as $index2 => $dataRT) {
										$addDATA = [];

										$mainCountQ = mysqli_query($conn, "
											SELECT COUNT(id) AS TotalPenerima FROM penerima 
											WHERE rt_id = '".$dataRT['id']."' AND bantuan_id = $bantuan_id
										");
										$mainCountDT = mysqli_fetch_assoc($mainCountQ)['TotalPenerima'];
										
										echo '
											<tr>
												<td class="text-center">RT '.$dataRT['nama_rt'].'</td>
										';

										for ($i = 7; $i <= 9 ; $i++) {
											$countQ = mysqli_query($conn, "
												SELECT COUNT(pemberian.id) AS TotalPenerima  FROM pemberian, penerima 
												WHERE pemberian.penerima_id = penerima.id AND penerima.rt_id = '".$dataRT['id']."' 
												AND pemberian.bantuan_id = $bantuan_id AND pemberian.tahun = $tahun AND pemberian.bulan = $i  
												");
											$countDT = mysqli_fetch_assoc($countQ)['TotalPenerima'];
											echo '
												<td class="text-center">'.$countDT.'</td>
												<td class="text-center">'.($mainCountDT-$countDT).'</td>
												<td class="text-center">'.($bantuanDt['banyak_bantuan']*$countDT).'</td>
												<td class="text-center">'.($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT)).'</td>
												<td class="text-right">'.number_format($bantuanDt['nominal']*$countDT).'</td>
												<td class="text-right">'.number_format($bantuanDt['nominal']*($mainCountDT-$countDT)).'</td>
											';

											if ($i == 7) {
												$penerima1_bt1 = $penerima1_bt1 + $countDT;
												$penerima2_bt1 = $penerima2_bt1 + ($mainCountDT-$countDT);
												$banyak1_bt1 = $banyak1_bt1 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt1 = $banyak2_bt1 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt1 = $nominal1_bt1 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt1 = $nominal2_bt1 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b1 = $penerima1_b1 + $countDT;
												$penerima2_b1 = $penerima2_b1 + ($mainCountDT-$countDT);
												$banyak1_b1 = $banyak1_b1 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b1 = $banyak2_b1 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b1 = $nominal1_b1 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b1 = $nominal2_b1 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											} elseif ($i == 8) {
												$penerima1_bt2 = $penerima1_bt2 + $countDT;
												$penerima2_bt2 = $penerima2_bt2 + ($mainCountDT-$countDT);
												$banyak1_bt2 = $banyak1_bt2 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt2 = $banyak2_bt2 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt2 = $nominal1_bt2 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt2 = $nominal2_bt2 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b2 = $penerima1_b2 + $countDT;
												$penerima2_b2 = $penerima2_b2 + ($mainCountDT-$countDT);
												$banyak1_b2 = $banyak1_b2 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b2 = $banyak2_b2 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b2 = $nominal1_b2 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b2 = $nominal2_b2 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											} elseif ($i == 9) {
												$penerima1_bt3 = $penerima1_bt3 + $countDT;
												$penerima2_bt3 = $penerima2_bt3 + ($mainCountDT-$countDT);
												$banyak1_bt3 = $banyak1_bt3 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt3 = $banyak2_bt3 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt3 = $nominal1_bt3 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt3 = $nominal2_bt3 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b3 = $penerima1_b3 + $countDT;
												$penerima2_b3 = $penerima2_b3 + ($mainCountDT-$countDT);
												$banyak1_b3 = $banyak1_b3 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b3 = $banyak2_b3 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b3 = $nominal1_b3 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b3 = $nominal2_b3 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											}

										}
										$finalData[] = $addDATA;

										echo '</tr>';
									}

									echo '
										<tr>
											<td colspan="2" class="text-center"><strong>TOTAL</strong></td>
											<td class="text-center"><strong>'.$penerima1_b1.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b1.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b1.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b1.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b1).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b1).'</strong></td>
											<td class="text-center"><strong>'.$penerima1_b2.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b2.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b2.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b2.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b2).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b2).'</strong></td>
											<td class="text-center"><strong>'.$penerima1_b3.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b3.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b3.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b3.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b3).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b3).'</strong></td>
										</tr>
									';

								}

								$dataArrayPenerima1[] = $penerima1_bt1;
								$dataArrayPenerima2[] = $penerima2_bt1;
								$dataArrayPenerima1[] = $penerima1_bt2;
								$dataArrayPenerima2[] = $penerima2_bt2;
								$dataArrayPenerima1[] = $penerima1_bt3;
								$dataArrayPenerima2[] = $penerima2_bt3;

							?>

							<tr>
								<td></td>
								<td colspan="2"></td>
								<td colspan="6"></td>
								<td colspan="6"></td>
								<td colspan="6"></td>
							</tr>
							<tr>
								<td colspan="3" class="text-center"><strong>GRAND TOTAL</strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt1 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt1) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt1) ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt2 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt2) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt2) ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt3 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt3) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt3) ?></strong></td>
							</tr>
						</tbody>
					</table>
					<div class="page-break"></div><br><br>
					<p><strong>D. TABEL LAPORAN KWARTAL IV</strong></p>
					<table class="table table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-center" rowspan="3" style="vertical-align:middle;">#</th>
								<th class="text-center" rowspan="3" style="vertical-align:middle; width: 100px;">NAMA RW</th>
								<th class="text-center" rowspan="3" style="vertical-align:middle; width: 100px;">NAMA RT</th>
								<th class="text-center" colspan="6">OKTOBER</th>
								<th class="text-center" colspan="6">NOVEMBER</th>
								<th class="text-center" colspan="6">DESEMBER</th>
							</tr>
							<tr>
								<?php  
									for ($i=0; $i < 3; $i++) { 
										echo '
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">PENERIMA (KK)</th>
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">BANYAK (KG)</th>
											<th class="text-center" style="vertical-align:middle; width: 100px;" colspan="2">NOMINAL (RP)</th>
										';
									}
								?>
							</tr>
							<tr>
								<?php  
									for ($i=0; $i < 9; $i++) { 
										echo '
											<th class="text-center">&#x2714;</th>
											<th class="text-center">&#x2718;</th>
										';
									}
								?>
							</tr>
						</thead>
						<tbody>
							<?php  

								$penerima1_bt1 = 0;
								$penerima2_bt1 = 0;
								$banyak1_bt1 = 0;
								$banyak2_bt1 = 0;
								$nominal1_bt1 = 0;
								$nominal2_bt1 = 0;

								$penerima1_bt2 = 0;
								$penerima2_bt2 = 0;
								$banyak1_bt2 = 0;
								$banyak2_bt2 = 0;
								$nominal1_bt2 = 0;
								$nominal2_bt2 = 0;

								$penerima1_bt3 = 0;
								$penerima2_bt3 = 0;
								$banyak1_bt3 = 0;
								$banyak2_bt3 = 0;
								$nominal1_bt3 = 0;
								$nominal2_bt3 = 0;

								foreach ($lRW as $index => $dataRW) {
									$lRT = [];
									$rtQ = mysqli_query($conn, "SELECT * FROM rt WHERE rw_id = '".$dataRW['id']."'");
									$rtNumRow = mysqli_num_rows($rtQ);
									while($rRT = mysqli_fetch_array($rtQ)) {
										$lRT[] = $rRT;
									}

									echo '
										<tr>
											<td class="text-center" rowspan="'.($rtNumRow+2).'" style="vertical-align:middle;"><strong>'.($index+1).'</strong></td>
											<td class="text-center" rowspan="'.($rtNumRow+1).'" style="vertical-align:middle;">RW '.$dataRW['nama_rw'].'</td>
										</tr>
									';

									$penerima1_b1 = 0;
									$penerima2_b1 = 0;
									$banyak1_b1 = 0;
									$banyak2_b1 = 0;
									$nominal1_b1 = 0;
									$nominal2_b1 = 0;

									$penerima1_b2 = 0;
									$penerima2_b2 = 0;
									$banyak1_b2 = 0;
									$banyak2_b2 = 0;
									$nominal1_b2 = 0;
									$nominal2_b2 = 0;

									$penerima1_b3 = 0;
									$penerima2_b3 = 0;
									$banyak1_b3 = 0;
									$banyak2_b3 = 0;
									$nominal1_b3 = 0;
									$nominal2_b3 = 0;

									foreach ($lRT as $index2 => $dataRT) {
										$addDATA = [];

										$mainCountQ = mysqli_query($conn, "
											SELECT COUNT(id) AS TotalPenerima FROM penerima 
											WHERE rt_id = '".$dataRT['id']."' AND bantuan_id = $bantuan_id
										");
										$mainCountDT = mysqli_fetch_assoc($mainCountQ)['TotalPenerima'];
										
										echo '
											<tr>
												<td class="text-center">RT '.$dataRT['nama_rt'].'</td>
										';

										for ($i = 10; $i <= 12 ; $i++) {
											$countQ = mysqli_query($conn, "
												SELECT COUNT(pemberian.id) AS TotalPenerima  FROM pemberian, penerima 
												WHERE pemberian.penerima_id = penerima.id AND penerima.rt_id = '".$dataRT['id']."' 
												AND pemberian.bantuan_id = $bantuan_id AND pemberian.tahun = $tahun AND pemberian.bulan = $i  
												");
											$countDT = mysqli_fetch_assoc($countQ)['TotalPenerima'];
											echo '
												<td class="text-center">'.$countDT.'</td>
												<td class="text-center">'.($mainCountDT-$countDT).'</td>
												<td class="text-center">'.($bantuanDt['banyak_bantuan']*$countDT).'</td>
												<td class="text-center">'.($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT)).'</td>
												<td class="text-right">'.number_format($bantuanDt['nominal']*$countDT).'</td>
												<td class="text-right">'.number_format($bantuanDt['nominal']*($mainCountDT-$countDT)).'</td>
											';

											if ($i == 10) {
												$penerima1_bt1 = $penerima1_bt1 + $countDT;
												$penerima2_bt1 = $penerima2_bt1 + ($mainCountDT-$countDT);
												$banyak1_bt1 = $banyak1_bt1 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt1 = $banyak2_bt1 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt1 = $nominal1_bt1 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt1 = $nominal2_bt1 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b1 = $penerima1_b1 + $countDT;
												$penerima2_b1 = $penerima2_b1 + ($mainCountDT-$countDT);
												$banyak1_b1 = $banyak1_b1 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b1 = $banyak2_b1 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b1 = $nominal1_b1 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b1 = $nominal2_b1 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											} elseif ($i == 11) {
												$penerima1_bt2 = $penerima1_bt2 + $countDT;
												$penerima2_bt2 = $penerima2_bt2 + ($mainCountDT-$countDT);
												$banyak1_bt2 = $banyak1_bt2 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt2 = $banyak2_bt2 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt2 = $nominal1_bt2 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt2 = $nominal2_bt2 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b2 = $penerima1_b2 + $countDT;
												$penerima2_b2 = $penerima2_b2 + ($mainCountDT-$countDT);
												$banyak1_b2 = $banyak1_b2 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b2 = $banyak2_b2 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b2 = $nominal1_b2 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b2 = $nominal2_b2 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											} elseif ($i == 12) {
												$penerima1_bt3 = $penerima1_bt3 + $countDT;
												$penerima2_bt3 = $penerima2_bt3 + ($mainCountDT-$countDT);
												$banyak1_bt3 = $banyak1_bt3 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_bt3 = $banyak2_bt3 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_bt3 = $nominal1_bt3 + ($bantuanDt['nominal']*$countDT);
												$nominal2_bt3 = $nominal2_bt3 + ($bantuanDt['nominal']*($mainCountDT-$countDT));

												$penerima1_b3 = $penerima1_b3 + $countDT;
												$penerima2_b3 = $penerima2_b3 + ($mainCountDT-$countDT);
												$banyak1_b3 = $banyak1_b3 + ($bantuanDt['banyak_bantuan']*$countDT);
												$banyak2_b3 = $banyak2_b3 + ($bantuanDt['banyak_bantuan']*($mainCountDT-$countDT));
												$nominal1_b3 = $nominal1_b3 + ($bantuanDt['nominal']*$countDT);
												$nominal2_b3 = $nominal2_b3 + ($bantuanDt['nominal']*($mainCountDT-$countDT));
											}

										}
										$finalData[] = $addDATA;

										echo '</tr>';
									}

									echo '
										<tr>
											<td colspan="2" class="text-center"><strong>TOTAL</strong></td>
											<td class="text-center"><strong>'.$penerima1_b1.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b1.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b1.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b1.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b1).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b1).'</strong></td>
											<td class="text-center"><strong>'.$penerima1_b2.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b2.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b2.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b2.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b2).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b2).'</strong></td>
											<td class="text-center"><strong>'.$penerima1_b3.'</strong></td>
											<td class="text-center"><strong>'.$penerima2_b3.'</strong></td>
											<td class="text-center"><strong>'.$banyak1_b3.'</strong></td>
											<td class="text-center"><strong>'.$banyak2_b3.'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal1_b3).'</strong></td>
											<td class="text-right"><strong>'.number_format($nominal2_b3).'</strong></td>
										</tr>
									';

								}

								$dataArrayPenerima1[] = $penerima1_bt1;
								$dataArrayPenerima2[] = $penerima2_bt1;
								$dataArrayPenerima1[] = $penerima1_bt2;
								$dataArrayPenerima2[] = $penerima2_bt2;
								$dataArrayPenerima1[] = $penerima1_bt3;
								$dataArrayPenerima2[] = $penerima2_bt3;

							?>

							<tr>
								<td></td>
								<td colspan="2"></td>
								<td colspan="6"></td>
								<td colspan="6"></td>
								<td colspan="6"></td>
							</tr>
							<tr>
								<td colspan="3" class="text-center"><strong>GRAND TOTAL</strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt1 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt1 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt1) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt1) ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt2 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt2 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt2) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt2) ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima1_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerima2_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak1_bt3 ?></strong></td>
								<td class="text-center"><strong><?php echo $banyak2_bt3 ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal1_bt3) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($nominal2_bt3) ?></strong></td>
							</tr>
						</tbody>
					</table>
					<div class="page-break"></div><br><br>
					<p><strong>E. TABEL LAPORAN DATA AKUMULASI TAHUNAN</strong></p>
					<table class="table table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-center" rowspan="2" style="vertical-align:middle;">#</th>
								<th class="text-center" rowspan="2" style="vertical-align:middle;">NAMA RW</th>
								<th class="text-center" rowspan="2" style="vertical-align:middle;">NAMA RT</th>
								<th class="text-center" colspan="2">PENERIMA (KK)</th>
								<th class="text-center" colspan="2">BANYAK (KG)</th>
								<th class="text-center" colspan="2">NOMINAL (RP)</th>
							</tr>
							<tr>
								<th class="text-center">&#x2714;</th>
								<th class="text-center">&#x2718;</th>
								<th class="text-center">&#x2714;</th>
								<th class="text-center">&#x2718;</th>
								<th class="text-center">&#x2714;</th>
								<th class="text-center">&#x2718;</th>
							</tr>
						</thead>
						<tbody>
							<?php  

								$penerimaTotal1 = 0;
								$penerimaTotal2 = 0;

								foreach ($lRW as $index => $dataRW) {
									$lRT = [];
									$rtQ = mysqli_query($conn, "SELECT * FROM rt WHERE rw_id = '".$dataRW['id']."'");
									$rtNumRow = mysqli_num_rows($rtQ);
									while($rRT = mysqli_fetch_array($rtQ)) {
										$lRT[] = $rRT;
									}

									echo '
										<tr>
											<td class="text-center" rowspan="'.($rtNumRow+1).'" style="vertical-align:middle;"><strong>'.($index+1).'</strong></td>
											<td class="text-center" rowspan="'.($rtNumRow+1).'" style="vertical-align:middle;">RW '.$dataRW['nama_rw'].'</td>
										</tr>
									';

									foreach ($lRT as $index2 => $dataRT) {
										$mainCountQ = mysqli_query($conn, "
											SELECT COUNT(id) AS TotalPenerima FROM penerima 
											WHERE rt_id = '".$dataRT['id']."' AND bantuan_id = $bantuan_id 
										");
										$mainCountDT = mysqli_fetch_assoc($mainCountQ)['TotalPenerima'];

										$countPenerima1 = 0;
										$countPenerima2 = 0;

										for ($i=1; $i <= 12; $i++) { 
											$countQ = mysqli_query($conn, "
												SELECT COUNT(pemberian.id) AS TotalPenerima  FROM pemberian, penerima 
												WHERE pemberian.penerima_id = penerima.id AND penerima.rt_id = '".$dataRT['id']."' 
												AND pemberian.bantuan_id = $bantuan_id AND pemberian.tahun = $tahun AND pemberian.bulan = $i  
												");
											$countDT = mysqli_fetch_assoc($countQ)['TotalPenerima'];
											$countPenerima1 = $countPenerima1 + $countDT;
											$countPenerima2 = $countPenerima2 + ($mainCountDT-$countDT);
										}
										
										echo '
											<tr>
												<td class="text-center">RT '.$dataRT['nama_rt'].'</td>
												<td class="text-center">'.$countPenerima1.'</td>
												<td class="text-center">'.$countPenerima2.'</td>
												<td class="text-center">'.($bantuanDt['banyak_bantuan']*$countPenerima1).'</td>
												<td class="text-center">'.($bantuanDt['banyak_bantuan']*$countPenerima2).'</td>
												<td class="text-right">'.number_format($bantuanDt['nominal']*$countPenerima1).'</td>
												<td class="text-right">'.number_format($bantuanDt['nominal']*$countPenerima2).'</td>
											</tr>
										';

										$penerimaTotal1 = $penerimaTotal1 + $countPenerima1;
										$penerimaTotal2 = $penerimaTotal2 + $countPenerima2;
										
									}
								}

							?>
							<tr>
								<td></td>
								<td colspan="2" class="text-center"><strong>TOTAL</strong></td>
								<td class="text-center"><strong><?php echo $penerimaTotal1 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerimaTotal2 ?></strong></td>
								<td class="text-center"><strong><?php echo $penerimaTotal1*$bantuanDt['banyak_bantuan'] ?></strong></td>
								<td class="text-center"><strong><?php echo $penerimaTotal2*$bantuanDt['banyak_bantuan'] ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($penerimaTotal1*$bantuanDt['nominal']) ?></strong></td>
								<td class="text-right"><strong><?php echo number_format($penerimaTotal2*$bantuanDt['nominal']) ?></strong></td>
							</tr>
						</tbody>
					</table>
					<div class="page-break"></div><br><br>
					<p><strong>F. GRAFIK DATA TAHUNAN</strong></p>
					<div class="chart-container">
						<canvas id="chart-laporan"></canvas>
					</div>
					<br>
					<p class="text-center">Solok, <?php echo date('d M Y') ?></p><br>
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
	</div>

	<?php 

		$dataArrayPenerima1 = json_encode($dataArrayPenerima1);
		$dataArrayPenerima2 = json_encode($dataArrayPenerima2);

	?>

	<script src="../../../assets/vendors/material-kit-pro/assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="../../../assets/vendors/chart/dist/Chart.bundle.min.js" type="text/javascript"></script>

	<script>
		$(function(){
			var ctx = document.getElementById("chart-laporan").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
					datasets: [{
						label: 'Diterima',
						data: <?php echo $dataArrayPenerima1 ?>,
						backgroundColor: [
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						],
						borderColor: [
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(54, 162, 235, 1)',
						],
						borderWidth: 1
					},{
						label: 'Tidak Diterima',
						data: <?php echo $dataArrayPenerima2 ?>,
						backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						],
						borderColor: [
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						'rgba(255,99,132,1)',
						],
						borderWidth: 1
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					animation: {
						duration: 0
					}
				}
			});
		})

		// window.print();
		// setTimeout(window.close, 0);
		setTimeout(function () { window.print(); }, 500);
        window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
	</script>

</body>
</html>