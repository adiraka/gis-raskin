<?php 
	include 'cores/function.php'; 
	$conn = koneksi();
	$listMarker = getMapMarkerList();
	$listMarkerRw01 = getMapMarkerListRw01();
	$listMarkerRw02 = getMapMarkerListRw02();
	$listMarkerRw03 = getMapMarkerListRw03();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Sistem Informasi Pemetaan Keluarga Miskin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<link href="assets/vendors/material-kit-pro/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/vendors/material-kit-pro/assets/css/material-icons.css" rel="stylesheet"/>
	<link href="assets/vendors/material-kit-pro/assets/css/material-kit.css" rel="stylesheet"/>

</head>

<body class="index-page">

	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-primary">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="">Sistem Informasi Pemetaan Keluarga Miskin</a>
			</div>

			<div class="collapse navbar-collapse" id="example-navbar-primary">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="home.php">
							<i class="material-icons">home</i>
							HOME
						</a>
					</li>
					<li>
						<a href="login.php" target="_blank">
							<i class="material-icons">input</i>
							LOGIN
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-12">	
				<div class="card card-blog">
					<div class="card-content">

						<!-- <h6 class="category text-danger">
							<i class="material-icons">trending_up</i> Trending
						</h6> -->

						<h4 class="card-title">
							<a href="#">Peta Persebaran Keluarga Miskin Pada Kel. Koto Panjang, Kec. Tanjung Harapan, Kota Solok</a>
							<select name="select_data" id="select_data" class="pull-right">
								<option value="" disabled selected>Pilih Data</option>
								<option value="0">Keseluruhan</option>
								<option value="1">RW 01</option>
								<option value="2">RW 02</option>
								<option value="3">RW 03</option>
							</select>
						</h4>

						<br>

						<div id="map" style="width: 100%; height: 850px;"></div><br> 

						<p>
							<strong>KETERANGAN :</strong>
							<img src="assets/img/marker1.png" style="height: 35px; width: 30px;"> RW 01, 
							<img src="assets/img/marker2.png" style="height: 35px; width: 30px;"> RW 02, 
							<img src="assets/img/marker3.png" style="height: 35px; width: 30px;"> RW 03, 
							<img src="assets/img/marker4.png" style="height: 35px; width: 30px;"> Kantor Lurah,
						</p>
						
						<br><br>

						<h4 class="card-title">
							<a href="#">Tabel Jumlah Penerima Bantuan Pada Kel. Koto Panjang, Kec. Tanjung Harapan, Kota Solok</a>
						</h4>

						<br>
							
						<div class="table-responsive">
								
							<table class="table table-bordered table-hover table-stripped">
								<thead>
									<tr>
										<th rowspan="2" class="text-center">NO</th>
										<th rowspan="2" class="text-center">BANTUAN YANG DITERIMA</th>
										<?php  

											$rwDT = [];
											$rwQ = "SELECT * FROM rw ORDER BY nama_rw";
											$rwPRC = mysqli_query($conn, $rwQ);
											while($rwRO = mysqli_fetch_array($rwPRC)) {
												$rwDT[] = $rwRO;
											}

											foreach ($rwDT as $value) {
												$rtCNT = mysqli_query($conn, "SELECT COUNT(id) AS jumlah FROM rt WHERE rw_id = '".$value['id']."'");
												$count = mysqli_fetch_assoc($rtCNT)['jumlah'];
												echo '<th colspan="'.$count.'" class="text-center">RW '.$value['nama_rw'].'</th>';
											}

										?>
										<th rowspan="2" class="text-center">TOTAL</th>
									</tr>
									<tr>
										<?php  

											foreach ($rwDT as $value) {
												$rtDT = getListRtByRw($value['id']);
												foreach ($rtDT as $value) {
													echo '<th class="text-center">RT '.$value['nama_rt'].'</th>';
												}
											}

										?>
									</tr>
								</thead>
								<tbody>
									<?php  

										$bantuanDT = [];
										$bantuanQ = "SELECT * FROM bantuan";
										$bantuanPRC = mysqli_query($conn, $bantuanQ);
										while($bantuanRO = mysqli_fetch_array($bantuanPRC)) {
											$bantuanDT[] = $bantuanRO;
										}

									?>

									<?php foreach ($bantuanDT as $key => $value): ?>
										
										<tr>
											<td class="text-center"><?php echo $key+1 ?></td>
											<td><?php echo strtoupper($value['nama_bantuan'].' '.$value['banyak_bantuan'].$value['satuan'].' ( IDR '.number_format($value['nominal']).' )') ?></td>

											<?php  

												$totalPenerima = 0;

												foreach ($rwDT as $value2) {
													$rtDT = getListRtByRw($value2['id']);
													foreach ($rtDT as $value3) {
														$countQ = mysqli_query($conn, "SELECT COUNT(id) AS jumlah FROM penerima WHERE rt_id = '".$value3['id']."' AND bantuan_id = '".$value['id']."'");
														$jumlah = mysqli_fetch_assoc($countQ)['jumlah'];
														$totalPenerima = $totalPenerima + $jumlah;
														echo '<td class="text-center">'.$jumlah.' KK</td>';
													}
												}

											?>

											<td class="text-center"><?php echo $totalPenerima ?> KK</td>

										</tr>

									<?php endforeach ?>
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer footer-white">
		<div class="container text-center">
			
			<?php echo date('Y') ?> @ STMIK INDONESIA PADANG

		</div>
	</footer>

	
    <script>
    	var map;
    	var markers = [];

    	function initMap() {
    		var directionsDisplay = new google.maps.DirectionsRenderer();
    		var directionsService = new google.maps.DirectionsService();

    		map = new google.maps.Map(document.getElementById('map'), {
    			center: {lat: -0.7921522, lng: 100.6560294},
    			zoom: 18,
    			styles: styles
    		});

			var iconLurah = {
				url: "assets/img/marker4.png",
			};

			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(-0.791992, 100.655094),
				title: 'Kantor Lurah Koto Panjang',
				icon: iconLurah
			});

			marker.setMap(map);

			var contentStr = '<div class="text-center">';
			contentStr += '<strong>KANTOR LURAH KOTO PANJANG</strong><br>';
			contentStr += '<br>Koto Panjang, Tj. Harapan, Kota Solok, Sumatera Barat 27317';
			contentStr += '</div>';
			var infowindow = new google.maps.InfoWindow({
				content: contentStr
			});
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			});

    		setAllPenerimaMarker();

    		var rw1Polygon = new google.maps.Polygon({
    			paths: RW01Coords,
    			strokeColor: 'red',
    			strokeOpacity: 0.8,
    			strokeWeight: 2,
    			fillColor: 'red',
    			fillOpacity: 0.1
    		});

            var rw2Polygon = new google.maps.Polygon({
                paths: RW02Coords,
                strokeColor: 'blue',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: 'blue',
                fillOpacity: 0.1
            });

            var rw3Polygon = new google.maps.Polygon({
                paths: RW03Coords,
                strokeColor: 'yellow',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: 'yellow',
                fillOpacity: 0.1
            });

    		rw1Polygon.setMap(map);
            rw2Polygon.setMap(map);
            rw3Polygon.setMap(map);
    	}

    	function setAllPenerimaMarker() {
    		deleteMarkers();
    		var markerList = <?php echo $listMarker; ?>;

    		var icon1 = {
			    url: "assets/img/marker1.png",
			};

			var icon2 = {
			    url: "assets/img/marker2.png",
			};

			var icon3 = {
			    url: "assets/img/marker3.png",
			};

    		$.each(markerList, function(key, data) {
    			var latLng = new google.maps.LatLng(data.lat, data.long);
    			var distanceMatrixService = new google.maps.DistanceMatrixService;

    			if (data.rw == '01') {
    				var marker = new google.maps.Marker({
    					position: latLng,
    					title: data.nama,
    					icon: icon1
    				});
    			} else if(data.rw == '02') {
    				var marker = new google.maps.Marker({
    					position: latLng,
    					title: data.nama,
    					icon: icon2
    				});
    			} else if(data.rw == '03') {
    				var marker = new google.maps.Marker({
    					position: latLng,
    					title: data.nama,
    					icon: icon3
    				});
    			}

    			markers.push(marker);

    			var pointA = new google.maps.LatLng(-0.791992, 100.655094);
    			var pointB = new google.maps.LatLng(data.lat, data.long);

    			var distance;
    			var duration;

    			var a = [];
    			marker.setMap(map);

    			// var x = google.maps.geometry.spherical.computeDistanceBetween(pointA, pointB);
    			// var distance = x.toFixed(2);

    			distanceMatrixService.getDistanceMatrix({
    				origins: [pointA],
    				destinations: [pointB],
    				travelMode: 'DRIVING',
    				unitSystem: google.maps.UnitSystem.METRIC,
    				avoidHighways: false,
    				avoidTolls: false
    			}, function(response, status){
    				if (status !== 'OK') {
    					alert('Telah terjadi kesalahan.');
    				} else {
    					var distance = response.rows[0].elements[0].distance.text;
    					var duration = response.rows[0].elements[0].duration.text;

    					var contentStr = '<div class="text-center">';
    					contentStr += '<strong>' + data.nama + '<br>' + data.no_kk + '<br>' + data.bantuan + '</strong><br>';
    					contentStr += '<br><img src="assets/img/foto_rumah/' + data.foto + '" style="height:200px; width: auto;"><br>';
    					contentStr += '<br>' + data.alamat;
    					contentStr += '<br>' + data.rt_rw + '<br>';
    					contentStr += 'Jarak Kantor Lurah : ' + distance + '<br>';
    					contentStr += 'Durasi : ' + duration;
    					contentStr += '</div>';
    					var infowindow = new google.maps.InfoWindow({
    						content: contentStr
    					});
    					marker.addListener('click', function() {
    						setDirectionMap(pointA, pointB, map);
    						infowindow.open(map, marker);
    					});

    				}
    			});

    			
    			
    		});
    	}

    	function setDirectionMap(pointA, pointB, map) {
    		var directionsDisplay = new google.maps.DirectionsRenderer();
    		var directionsService = new google.maps.DirectionsService();

    		directionsService.route({
    			origin: pointB,
    			destination: pointA,
    			travelMode: google.maps.TravelMode['DRIVING'],
    		}, function(response, status) {
    			if (status == 'OK') {
    				directionsDisplay.setDirections(response);
    			} else {
    				window.alert('Directions request failed due to ' + status);
    			}
    		});
    		directionsDisplay.setMap(map);
    	}

    	function setMarkerRw01() {
    		deleteMarkers();
    		var markerList = <?php echo $listMarkerRw01; ?>;

    		var icon = {
			    url: "assets/img/marker1.png",
			};

			$.each(markerList, function(key, data) {
    			var distance = '';
    			var duration = '';
    			var latLng = new google.maps.LatLng(data.lat, data.long);

    			var marker = new google.maps.Marker({
    				position: latLng,
    				title: data.nama,
    				icon: icon
    			});

    			markers.push(marker);

    			var pointA = new google.maps.LatLng(-0.791992, 100.655094);
    			var pointB = new google.maps.LatLng(data.lat, data.long);

    			var x = google.maps.geometry.spherical.computeDistanceBetween(pointA, pointB);
    			var distance = x.toFixed(2);
    			
    			marker.setMap(map);
    			var contentStr = '<div class="text-center">';
    				contentStr += '<strong>' + data.nama + '<br>' + data.no_kk + '<br>' + data.bantuan + '</strong><br>';
    				contentStr += '<br><img src="assets/img/foto_rumah/' + data.foto + '" style="height:200px; width: auto;"><br>';
    				contentStr += '<br>' + data.alamat;
    				contentStr += '<br>' + data.rt_rw + '<br>';
    				contentStr += 'Dari Kantor Lurah : ' + distance + ' m';
    				contentStr += '</div>';
    			var infowindow = new google.maps.InfoWindow({
    				content: contentStr
    			});
    			marker.addListener('click', function() {
    				infowindow.open(map, marker);
    			});
    		});

    	}

    	function setMarkerRw02() {
    		deleteMarkers();
    		var markerList = <?php echo $listMarkerRw02; ?>;

    		var icon = {
			    url: "assets/img/marker2.png",
			};

			$.each(markerList, function(key, data) {
    			var distance = '';
    			var duration = '';
    			var latLng = new google.maps.LatLng(data.lat, data.long);

    			var marker = new google.maps.Marker({
    				position: latLng,
    				title: data.nama,
    				icon: icon
    			});

    			markers.push(marker);

    			var pointA = new google.maps.LatLng(-0.791992, 100.655094);
    			var pointB = new google.maps.LatLng(data.lat, data.long);

    			var x = google.maps.geometry.spherical.computeDistanceBetween(pointA, pointB);
    			var distance = x.toFixed(2);
    			
    			marker.setMap(map);
    			var contentStr = '<div class="text-center">';
    				contentStr += '<strong>' + data.nama + '<br>' + data.no_kk + '<br>' + data.bantuan + '</strong><br>';
    				contentStr += '<br><img src="assets/img/foto_rumah/' + data.foto + '" style="height:200px; width: auto;"><br>';
    				contentStr += '<br>' + data.alamat;
    				contentStr += '<br>' + data.rt_rw + '<br>';
    				contentStr += 'Dari Kantor Lurah : ' + distance + ' m';
    				contentStr += '</div>';
    			var infowindow = new google.maps.InfoWindow({
    				content: contentStr
    			});
    			marker.addListener('click', function() {
    				infowindow.open(map, marker);
    			});
    		});
    	}

    	function setMarkerRw03() {
    		deleteMarkers();
    		var markerList = <?php echo $listMarkerRw03; ?>;

    		var icon = {
			    url: "assets/img/marker3.png",
			};

			$.each(markerList, function(key, data) {
    			var distance = '';
    			var duration = '';
    			var latLng = new google.maps.LatLng(data.lat, data.long);

    			var marker = new google.maps.Marker({
    				position: latLng,
    				title: data.nama,
    				icon: icon
    			});

    			markers.push(marker);

    			var pointA = new google.maps.LatLng(-0.791992, 100.655094);
    			var pointB = new google.maps.LatLng(data.lat, data.long);

    			var x = google.maps.geometry.spherical.computeDistanceBetween(pointA, pointB);
    			var distance = x.toFixed(2);
    			
    			marker.setMap(map);
    			var contentStr = '<div class="text-center">';
    				contentStr += '<strong>' + data.nama + '<br>' + data.no_kk + '<br>' + data.bantuan + '</strong><br>';
    				contentStr += '<br><img src="assets/img/foto_rumah/' + data.foto + '" style="height:200px; width: auto;"><br>';
    				contentStr += '<br>' + data.alamat;
    				contentStr += '<br>' + data.rt_rw + '<br>';
    				contentStr += 'Dari Kantor Lurah : ' + distance + ' m';
    				contentStr += '</div>';
    			var infowindow = new google.maps.InfoWindow({
    				content: contentStr
    			});
    			marker.addListener('click', function() {
    				infowindow.open(map, marker);
    			});
    		});
    	}

    	function setMapOnAll(map) {
    		for (var i = 0; i < markers.length; i++) {
    			markers[i].setMap(map);
    		}
    	}

    	function clearMarkers() {
    		setMapOnAll(null);
    	}

    	function deleteMarkers() {
    		clearMarkers();
    		markers = [];
    	}

    	var RW03Coords = [
            {lat: -0.793881782372437, lng:100.657472400801},
            {lat: -0.7938442350505968, lng: 100.65753945602637},
            {lat: -0.7937986418736248, lng: 100.65760382904273},
            {lat: -0.7937610945510339, lng: 100.65769770635825},
            {lat: -0.7937771862607502, lng: 100.65779158367377},
            {lat: -0.7938281433411348, lng: 100.65787741436225},
            {lat: -0.7938871462755316, lng: 100.65798202051383},
            {lat: -0.7938710545662351, lng: 100.65805712236624},
            {lat: -0.793833507244293, lng: 100.6581751395629},
            {lat: -0.793726229179755, lng: 100.65812685980063},
            {lat: -0.7935089910905249, lng: 100.65809199108344},
            {lat: -0.7933293003167358, lng: 100.65803298248511},
            {lat: -0.7931947593354693, lng: 100.65798447567295},
            {lat: -0.7930556207870572, lng: 100.65793615378175},
            {lat: -0.7928705660891818, lng: 100.65788787401948},
            {lat: -0.7927284226199689, lng: 100.65784495867524},
            {lat: -0.7926345542885816, lng: 100.65781813658509},
            {lat: -0.7925540957171253, lng: 100.65778595007691},
            {lat: -0.7925460498598945, lng: 100.65768402613435}, 
            {lat: -0.7925540957171253, lng: 100.65760892428193}, 
            {lat: -0.7925701874315362, lng: 100.65748554266725}, 
            {lat: -0.7926050528125603, lng: 100.65739166535172}, 
            {lat: -0.7926506460026871, lng: 100.65727096594605}, 
            {lat: -0.7927042850492432, lng: 100.65711003340516}, 
            {lat: -0.7927257406676773, lng: 100.65701079167161}, 
            {lat: -0.7927445143337182, lng: 100.65690618552003}, 
            {lat: -0.7927686519042022, lng: 100.65681230820451}, 
            {lat: -0.7927847436177861, lng: 100.65676671065125}, 
            {lat: -0.7928685818819637, lng: 100.65678762574203}, 
            {lat: -0.7929222209257082, lng: 100.65672325272567}, 
            {lat: -0.7929678141123363, lng: 100.65661864657409}, 
            {lat: -0.7929973155857749, lng: 100.65650599379546}, 
            {lat: -0.7930321809631987, lng: 100.65646844286925}, 
            {lat: -0.7930268170589972, lng: 100.65639602322585}, 
            {lat: -0.7930026794900146, lng: 100.65633969683654}, 
            {lat: -0.7930268170589972, lng: 100.65623509068496}, 
            {lat: -0.7930080433942415, lng: 100.65616267104156}, 
            {lat: -0.7930563185320161, lng: 100.65610902686126}, 
            {lat: -0.7930724102444804, lng: 100.65602051396377}, 
            {lat: -0.7930858200048186, lng: 100.65592663664825}, 
            {lat: -0.7931260492855787, lng: 100.65582203049667}, 
            {lat: -0.793168960517956, lng: 100.65565573353774}, 
            {lat: -0.7932118717498882, lng: 100.6555591740132},
            {lat: -0.7932521010294269, lng: 100.65542238135345}, 
            {lat: -0.7933191498277846, lng: 100.65530168194778}, 
            {lat: -0.7933257276770768, lng: 100.65517280712311},
            {lat: -0.7934229162292148, lng: 100.65534585001024},
            {lat: -0.7935436040604904, lng: 100.65548403344508},
            {lat: -0.7936160167575534, lng: 100.6555430420434},
            {lat: -0.7937018392116979, lng: 100.65562619052287},
            {lat: -0.7937983894704921, lng: 100.65572006783839},
            {lat: -0.7938788480177507, lng: 100.65581930957194},
            {lat: -0.793956624611967, lng: 100.65590514026042},
            {lat: -0.7940344012047077, lng: 100.65601779303904},
            {lat: -0.794149725115383, lng: 100.65616531453486},
            {lat: -0.7941926363371372, lng: 100.65625382743235},
            {lat: -0.794238229509771, lng: 100.6563879378831},
            {lat: -0.7942596851202409, lng: 100.65656228146906},
            {lat: -0.794238229509771, lng: 100.6567661293542},
            {lat: -0.7941541530302662, lng: 100.65699144191285},
            {lat: -0.7939887660257504, lng: 100.65724088735124},
            {lat: -0.7938975796744782, lng: 100.65740986651917}
    	];

        var RW02Coords = [
           {lat: -0.7925540957171253, lng: 100.65778595007691},
           {lat: -0.792385805622127, lng: 100.65774208931055},
           {lat: -0.7922517079941023, lng: 100.65769917396631},
           {lat: -0.7920988366928741, lng: 100.65765089420404},
           {lat: -0.7920012502839677, lng: 100.65760777078981},
           {lat: -0.7918644706906494, lng: 100.65760240637178},
           {lat: -0.7918188774918715, lng: 100.65756753765459},
           {lat: -0.7918483789734906, lng: 100.65753535114641},
           {lat: -0.7918778804548933, lng: 100.65742001615877},
           {lat: -0.7918939721719376, lng: 100.65734491430635},
           {lat: -0.7919127458417442, lng: 100.65720543943758},
           {lat: -0.7919583390394915, lng: 100.65707669340486},
           {lat: -0.7919583390394915, lng: 100.65693453632707},
           {lat: -0.7919395653698885, lng: 100.65685943447465},
           {lat: -0.7919637029450797, lng: 100.65675214611406},
           {lat: -0.7919766625052562, lng: 100.65666694926756},
           {lat: -0.7920488291790103, lng: 100.65657969134861},
           {lat: -0.7920246916043153, lng: 100.6564884962421},
           {lat: -0.7919630066905923, lng: 100.65643216985279},
           {lat: -0.7919951901239558, lng: 100.65634097474629},
           {lat: -0.7920461472262735, lng: 100.6562524618488},
           {lat: -0.7920729667535527, lng: 100.65614249127918},
           {lat: -0.7920702848008286, lng: 100.6560566605907},
           {lat: -0.7920944223752437, lng: 100.65600301641041},
           {lat: -0.7921561072870202, lng: 100.6559842409473},
           {lat: -0.7922070643873533, lng: 100.6560003342014},
           {lat: -0.7922338839135893, lng: 100.65600569861942},
           {lat: -0.7922767951552157, lng: 100.65592523234898},
           {lat: -0.7923062966335779, lng: 100.65583671945149},
           {lat: -0.7923599356845994, lng: 100.65573747771793},
           {lat: -0.7924243025449145, lng: 100.65563823598438},
           {lat: -0.7924967152615571, lng: 100.65554972308689},
           {lat: -0.7925423084528797, lng: 100.65549339669758},
           {lat: -0.7925643816674144, lng: 100.65546785011475},
           {lat: -0.7925506435030627, lng: 100.6552613200206},
           {lat: -0.7925506435030627, lng: 100.65520499363129},
           {lat: -0.7925291878837126, lng: 100.65513257398788},
           {lat: -0.7925533254554561, lng: 100.65507088318054},
           {lat: -0.7925533254554561, lng: 100.65499578132813},
           {lat: -0.792545279598238, lng: 100.65489385738556},
           {lat: -0.7925560074078748, lng: 100.65483484878723},
           {lat: -0.7925801449794656, lng: 100.65473560705368},
           {lat: -0.7926686494074275, lng: 100.65474097147171},
           {lat: -0.7927786094516481, lng: 100.65478388681595},
           {lat: -0.7928805236363861, lng: 100.65481607332413},
           {lat: -0.7929609822014939, lng: 100.65486167087738},
           {lat: -0.7930307129566723, lng: 100.65490995063965},
           {lat: -0.793111171518854, lng: 100.65497700586502},
           {lat: -0.79317553836749, lng: 100.65505210771744},
           {lat: -0.7932372232631602, lng: 100.65510575189774},
           {lat: -0.7933257276770768, lng: 100.65517280712311},
           {lat: -0.7933191498277846, lng: 100.65530168194778},
           {lat: -0.7932521010294269, lng: 100.65542238135345},
           {lat: -0.7932118717498882, lng: 100.6555591740132},
           {lat: -0.793168960517956, lng: 100.65565573353774},
           {lat: -0.7931260492855787, lng: 100.65582203049667},
           {lat: -0.7930858200048186, lng: 100.65592663664825},
           {lat: -0.7930724102444804, lng: 100.65602051396377},
           {lat: -0.7930563185320161, lng: 100.65610902686126},
           {lat: -0.7930080433942415, lng: 100.65616267104156},
           {lat: -0.7930268170589972, lng: 100.65623509068496},
           {lat: -0.7930026794900146, lng: 100.65633969683654},
           {lat: -0.7930268170589972, lng: 100.65639602322585},
           {lat: -0.7930321809631987, lng: 100.65646844286925},
           {lat: -0.7929973155857749, lng: 100.65650599379546},
           {lat: -0.7929678141123363, lng: 100.65661864657409},
           {lat: -0.7929222209257082, lng: 100.65672325272567},
           {lat: -0.7928685818819637, lng: 100.65678762574203},
           {lat: -0.7927847436177861, lng: 100.65676671065125},
           {lat: -0.7927686519042022, lng: 100.65681230820451},
           {lat: -0.7927445143337182, lng: 100.65690618552003},
           {lat: -0.7927257406676773, lng: 100.65701079167161},
           {lat: -0.7927042850492432, lng: 100.65711003340516},
           {lat: -0.7926506460026871, lng: 100.65727096594605},
           {lat: -0.7926050528125603, lng: 100.65739166535172},
           {lat: -0.7925701874315362, lng: 100.65748554266725},
           {lat: -0.7925540957171253, lng: 100.65760892428193},
           {lat: -0.7925460498598945, lng: 100.65768402613435}
        ];

        var RW01Coords = [
            {lat: -0.7925801449794656, lng: 100.65473560705368},
            {lat: -0.7924669513517734, lng: 100.65470909904593},
            {lat: -0.7923060342007695, lng: 100.65469032358283},
            {lat: -0.7921773004754832, lng: 100.65467959474677},
            {lat: -0.7920405208879661, lng: 100.65464472602957},
            {lat: -0.7919037412959454, lng: 100.65461790393942},
            {lat: -0.7918125548987587, lng: 100.65456962417716},
            {lat: -0.7916677294402834, lng: 100.65456694196814},
            {lat: -0.7915389956951632, lng: 100.65456157755011},
            {lat: -0.7913914882739642, lng: 100.65456425975913},
            {lat: -0.791268776644651, lng: 100.65457089471374},
            {lat: -0.7911346789805079, lng: 100.65456553029571},
            {lat: -0.7909978993586154, lng: 100.65457357692276},
            {lat: -0.7908584377787065, lng: 100.6545628480867},
            {lat: -0.7907508617997153, lng: 100.65456143495726},
            {lat: -0.7907615896139959, lng: 100.65461239692854},
            {lat: -0.7907213603102976, lng: 100.65466872331785},
            {lat: -0.7906569934235459, lng: 100.65480015155958},
            {lat: -0.7906194460724953, lng: 100.65486720678496},
            {lat: -0.7905255776933615, lng: 100.65502545711684},
            {lat: -0.7904880303411025, lng: 100.65508714792418},
            {lat: -0.7904585288498146, lng: 100.65520784732985},
            {lat: -0.7904156175893847, lng: 100.65531245348143},
            {lat: -0.7903834341437697, lng: 100.6553982841699},
            {lat: -0.7903673424208731, lng: 100.65550825473952},
            {lat: -0.7903566146055748, lng: 100.65562358972716},
            {lat: -0.7903002935747689, lng: 100.65575233575987},
            {lat: -0.7902911375231334, lng: 100.65584169006183},
            {lat: -0.7902589540765516, lng: 100.65599994039371},
            {lat: -0.7902079969522879, lng: 100.65611795759037},
            {lat: -0.7901784954590154, lng: 100.65618501281574},
            {lat: -0.7901409481036267, lng: 100.65633521652057},
            {lat: -0.7901168105178379, lng: 100.65639154290989},
            {lat: -0.7900846270699073, lng: 100.65648005580738},
            {lat: -0.790036351897541, lng: 100.65668658590153},
            {lat: -0.7900883639079918, lng: 100.65675900554493},
            {lat: -0.7901044556319825, lng: 100.6568260607703},
            {lat: -0.7901339571257766, lng: 100.65688238715961},
            {lat: -0.7901929601127671, lng: 100.65693603133991},
            {lat: -0.7902841465455379, lng: 100.65698967552021},
            {lat: -0.7903592412533893, lng: 100.65699772214725},
            {lat: -0.7904692013588419, lng: 100.65704063749149},
            {lat: -0.7906236207554062, lng: 100.6570913755603},
            {lat: -0.7907652140606414, lng: 100.6571701169014},
            {lat: -0.7908702068144172, lng: 100.65716264567254},
            {lat: -0.7910277434076142, lng: 100.65719345726689},
            {lat: -0.791153795215277, lng: 100.65719345726689},
            {lat: -0.7912101162344929, lng: 100.65724173702915},
            {lat: -0.7912932567852627, lng: 100.65731415667256},
            {lat: -0.7913763973343658, lng: 100.6573758474799},
            {lat: -0.7914541354216958, lng: 100.65745940673662},
            {lat: -0.7915268428753918, lng: 100.65751054555687},
            {lat: -0.7917065337273717, lng: 100.6575883296183},
            {lat: -0.7918188774918715, lng: 100.65756753765459},
            {lat: -0.7918483789734906, lng: 100.65753535114641},
            {lat: -0.7918778804548933, lng: 100.65742001615877},
            {lat: -0.7918939721719376, lng: 100.65734491430635},
            {lat: -0.7919127458417442, lng: 100.65720543943758},
            {lat: -0.7919583390394915, lng: 100.65707669340486},
            {lat: -0.7919583390394915, lng: 100.65693453632707},
            {lat: -0.7919395653698885, lng: 100.65685943447465},
            {lat: -0.7919637029450797, lng: 100.65675214611406},
            {lat: -0.7919766625052562, lng: 100.65666694926756},
            {lat: -0.7920488291790103, lng: 100.65657969134861},
            {lat: -0.7920246916043153, lng: 100.6564884962421},
            {lat: -0.7919630066905923, lng: 100.65643216985279},
            {lat: -0.7919951901239558, lng: 100.65634097474629},
            {lat: -0.7920461472262735, lng: 100.6562524618488},
            {lat: -0.7920729667535527, lng: 100.65614249127918},
            {lat: -0.7920702848008286, lng: 100.6560566605907},
            {lat: -0.7920944223752437, lng: 100.65600301641041},
            {lat: -0.7921561072870202, lng: 100.6559842409473},
            {lat: -0.7922070643873533, lng: 100.6560003342014},
            {lat: -0.7922338839135893, lng: 100.65600569861942},
            {lat: -0.7922767951552157, lng: 100.65592523234898},
            {lat: -0.7923062966335779, lng: 100.65583671945149},
            {lat: -0.7923599356845994, lng: 100.65573747771793},
            {lat: -0.7924243025449145, lng: 100.65563823598438},
            {lat: -0.7924967152615571, lng: 100.65554972308689},
            {lat: -0.7925423084528797, lng: 100.65549339669758},
            {lat: -0.7925643816674144, lng: 100.65546785011475},
            {lat: -0.7925506435030627, lng: 100.6552613200206},
            {lat: -0.7925506435030627, lng: 100.65520499363129},
            {lat: -0.7925291878837126, lng: 100.65513257398788},
            {lat: -0.7925533254554561, lng: 100.65507088318054},
            {lat: -0.7925533254554561, lng: 100.65499578132813},
            {lat: -0.792545279598238, lng: 100.65489385738556},
            {lat: -0.7925560074078748, lng: 100.65483484878723}
        ];
   	
		var styles = [
		    {
		        "featureType": "all",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "all",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "visibility": "on"
		            },
		            {
		                "hue": "#ff0000"
		            }
		        ]
		    },
		    {
		        "featureType": "all",
		        "elementType": "geometry.fill",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "administrative",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "administrative",
		        "elementType": "labels.text.fill",
		        "stylers": [
		            {
		                "color": "#444444"
		            }
		        ]
		    },
		    {
		        "featureType": "landscape",
		        "elementType": "all",
		        "stylers": [
		            {
		                "color": "#f2f2f2"
		            }
		        ]
		    },
		    {
		        "featureType": "poi",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.government",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.medical",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.place_of_worship",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.school",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "road",
		        "elementType": "all",
		        "stylers": [
		            {
		                "saturation": -100
		            },
		            {
		                "lightness": 45
		            },
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "road.highway",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "simplified"
		            }
		        ]
		    },
		    {
		        "featureType": "road.arterial",
		        "elementType": "labels.icon",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "road.local",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "transit",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "water",
		        "elementType": "all",
		        "stylers": [
		            {
		                "color": "#46bcec"
		            },
		            {
		                "visibility": "on"
		            }
		        ]
		    }
		]
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDnqIloh4KN9gJepqJnsHlLofNif5Ic04&callback=initMap&libraries=geometry" async defer></script>

	<script src="assets/vendors/material-kit-pro/assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="assets/vendors/material-kit-pro/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/vendors/material-kit-pro/assets/js/material.min.js"></script>
	<script src="assets/vendors/material-kit-pro/assets/js/moment.min.js"></script>
	<script src="assets/vendors/material-kit-pro/assets/js/nouislider.min.js" type="text/javascript"></script>
	<script src="assets/vendors/material-kit-pro/assets/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
	<script src="assets/vendors/material-kit-pro/assets/js/bootstrap-selectpicker.js" type="text/javascript"></script>
	<script src="assets/vendors/material-kit-pro/assets/js/bootstrap-tagsinput.js"></script>
	<script src="assets/vendors/material-kit-pro/assets/js/jasny-bootstrap.min.js"></script>
	<script src="assets/vendors/material-kit-pro/assets/js/material-kit.js" type="text/javascript"></script>

	<script>
		$(function(){
			$('#select_data').on('change', function(){
				var dataVal = $(this).val();
				if (dataVal == '0') {
					setAllPenerimaMarker();
				} else if (dataVal == '1') {
					setMarkerRw01();
				} else if (dataVal == '2') {
					setMarkerRw02();
				} else if (dataVal == '3') {
					setMarkerRw03();
				}
			});
		});
	</script>

</body>
</html>
