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
    		var distanceMatrixService = new google.maps.DistanceMatrixService;

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

    		var kelKotoPanjang = new google.maps.Polygon({
    			paths: kelKotoPanjangCoords,
    			strokeColor: 'blue',
    			strokeOpacity: 0.8,
    			strokeWeight: 2,
    			fillColor: 'blue',
    			fillOpacity: 0.1
    		});

    		kelKotoPanjang.setMap(map);
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
    			var distance = '';
    			var duration = '';
    			var latLng = new google.maps.LatLng(data.lat, data.long);

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

    			var x = google.maps.geometry.spherical.computeDistanceBetween(pointA, pointB);
    			var distance = x.toFixed(2);
    			
    			marker.setMap(map);
    			var contentStr = '<div class="text-center">';
    				contentStr += '<strong>' + data.nama + '<br>' + data.no_kk + '<br>' + data.bantuan + '</strong><br><br>' + data.alamat;
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
    				contentStr += '<strong>' + data.nama + '<br>' + data.no_kk + '<br>' + data.bantuan + '</strong><br><br>' + data.alamat;
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
    				contentStr += '<strong>' + data.nama + '<br>' + data.no_kk + '<br>' + data.bantuan + '</strong><br><br>' + data.alamat;
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
    				contentStr += '<strong>' + data.nama + '<br>' + data.no_kk + '<br>' + data.bantuan + '</strong><br><br>' + data.alamat;
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

    	var kelKotoPanjangCoords = [
	    	{lat: -0.7907914340491139, lng: 100.65458298277724},
	    	{lat: -0.7907643051498534, lng: 100.65456426729247},
	    	{lat: -0.7907405028118938, lng: 100.65461020012185},
	    	{lat: -0.7907217291367821, lng: 100.6546457393913},
	    	{lat: -0.7907116718107938, lng: 100.65466652651116},
	    	{lat: -0.7907028520183149, lng: 100.65468161477474},
	    	{lat: -0.7906884365176695, lng: 100.6547084368649},
	    	{lat: -0.7906753619937742, lng: 100.65473458840279},
	    	{lat: -0.7906626227140441, lng: 100.65475705190329},
	    	{lat: -0.7906495481900725, lng: 100.65478018595604},
	    	{lat: -0.7906321154913672, lng: 100.65481036080746},
	    	{lat: -0.7906153532810181, lng: 100.65483919455437},
	    	{lat: -0.7905992615590121, lng: 100.65486869885353},
	    	{lat: -0.7905858517906335, lng: 100.65489015652565},
	    	{lat: -0.790574951167428, lng: 100.6549103028799},
	    	{lat: -0.7905552767925118, lng: 100.65494399741124},
	    	{lat: -0.7905358326281409, lng: 100.65497752502392},
	    	{lat: -0.7905294629880595, lng: 100.65499127134512},
	    	{lat: -0.7904909099032029, lng: 100.65505692779584},
	    	{lat: -0.7904754886691457, lng: 100.65508542598161},
	    	{lat: -0.7904567149928381, lng: 100.65511593610915},
	    	{lat: -0.7904485076547749, lng: 100.65522767426683},
	    	{lat: -0.7904431437472276, lng: 100.65524510862542},
	    	{lat: -0.7903718935043903, lng: 100.65539449118387},
	    	{lat: -0.7903764783507932, lng: 100.65539940407837},
	    	{lat: -0.7903811717699718, lng: 100.65540543904865},
	    	{lat: -0.7903868709218245, lng: 100.65542153230274},
	    	{lat: -0.7903912290967615, lng: 100.65543527862394},
	    	{lat: -0.7903922348294354, lng: 100.65545204243028},
	    	{lat: -0.790389217631401, lng: 100.65547249427402},
	    	{lat: -0.790384859456464, lng: 100.65548758169973},
	    	{lat: -0.7903771488392509, lng: 100.6554996516403},
	    	{lat: -0.7903691029777963, lng: 100.65551071575248},
	    	{lat: -0.7903617276047866, lng: 100.65551608017051},
	    	{lat: -0.7903189740468937, lng: 100.65566697748807},
	    	{lat: -0.7901501398938957, lng: 100.65629225874545},
	    	{lat: -0.7900413647095093, lng: 100.65669692394613},
	    	{lat: -0.790026782069316, lng: 100.65691218867687},
	    	{lat: -0.7902056031243458, lng: 100.65695997514672},
	    	{lat: -0.7902828914205589, lng: 100.65704386818311},
	    	{lat: -0.7903866866394939, lng: 100.65707340931635},
	    	{lat: -0.7904221874675962, lng: 100.65708393421949},
	    	{lat: -0.7904593995762117, lng: 100.65709600416005},
	    	{lat: -0.790483308825807, lng: 100.657103465771},
	    	{lat: -0.7905111340958361, lng: 100.65710815963678},
	    	{lat: -0.7905349364351187, lng: 100.65711318877868},
	    	{lat: -0.790579452422849, lng: 100.65712167997162},
	    	{lat: -0.7905988965870291, lng: 100.6571263738374},
	    	{lat: -0.7906210108825114, lng: 100.65713038828335},
	    	{lat: -0.7906515181052518, lng: 100.65713642325363},
	    	{lat: -0.7906840367929965, lng: 100.65714312877617},
	    	{lat: -0.7906991012082573, lng: 100.65714547570906},
	    	{lat: -0.7907192158602718, lng: 100.65714949902258},
	    	{lat: -0.7907403362447694, lng: 100.65715419288836},
	    	{lat: -0.7907631629731393, lng: 100.6571585671561},
	    	{lat: -0.7907846984216766, lng: 100.6571627359333},
	    	{lat: -0.7908007901429702, lng: 100.65716575341844},
	    	{lat: -0.7908386727365703, lng: 100.6571727942171},
	    	{lat: -0.7909293649798436, lng: 100.657184333852},
	    	{lat: -0.7909962784196717, lng: 100.6571924621469},
	    	{lat: -0.7910503338463938, lng: 100.6571993064689},
	    	{lat: -0.7911063194917923, lng: 100.65720534139552},
	    	{lat: -0.7911197292585044, lng: 100.65720768832841},
	    	{lat: -0.7911431963501232, lng: 100.65721405857482},
	    	{lat: -0.7911844313822206, lng: 100.65722277575412},
	    	{lat: -0.7912396808314207, lng: 100.65723705275173},
	    	{lat: -0.7912550995979908, lng: 100.65724511806013},
	    	{lat: -0.7913217129238852, lng: 100.657282404645},
	    	{lat: -0.7913840683354422, lng: 100.65734811876587},
	    	{lat: -0.7914536100933212, lng: 100.65743074292732},
	    	{lat: -0.7915115895625612, lng: 100.65750198575597},
	    	{lat: -0.7915665696003962, lng: 100.65756870570522},
	    	{lat: -0.7915749507036625, lng: 100.65757440539937},
	    	{lat: -0.7916426700173981, lng: 100.65760022166114},
	    	{lat: -0.7916631802497306, lng: 100.65761012430607},
	    	{lat: -0.7917101144266961, lng: 100.65762185897051},
	    	{lat: -0.7917946794205838, lng: 100.65764331664263},
	    	{lat: -0.7918792030915092, lng: 100.65766506972466},
	    	{lat: -0.7919560986070937, lng: 100.65768489610537},
	    	{lat: -0.792004709000102, lng: 100.6576969660457},
	    	{lat: -0.7920680952898109, lng: 100.6577143289951},
	    	{lat: -0.7921193747043493, lng: 100.65772695039118},
	    	{lat: -0.7921748799553339, lng: 100.65774089407387},
	    	{lat: -0.7922678546741466, lng: 100.65776532745713},
	    	{lat: -0.7923709144113884, lng: 100.65779197263441},
	    	{lat: -0.7924646634287069, lng: 100.65781544396043},
	    	{lat: -0.7925550190997172, lng: 100.65783812298662},
	    	{lat: -0.7926264255613242, lng: 100.65785555750142},
	    	{lat: -0.7927441975882696, lng: 100.65788439124833},
	    	{lat: -0.7927615483933531, lng: 100.65788947818044},
	    	{lat: -0.7928725571060056, lng: 100.65792185379814},
	    	{lat: -0.7929697957512056, lng: 100.65795037296016},
	    	{lat: -0.7930244405256648, lng: 100.6579671367665},
	    	{lat: -0.7931229185653547, lng: 100.65799560223468},
	    	{lat: -0.7931678412590596, lng: 100.65800867800317},
	    	{lat: -0.7931859444350905, lng: 100.65801471297345},
	    	{lat: -0.7932430527630746, lng: 100.6580295584821},
	    	{lat: -0.7932909926541141, lng: 100.65804296952717},
	    	{lat: -0.7933660010071197, lng: 100.65806432871886},
	    	{lat: -0.7934075712610804, lng: 100.65807639865943},
	    	{lat: -0.7934493069765411, lng: 100.6580880609165},
	    	{lat: -0.7935049574766007, lng: 100.65810415417059},
	    	{lat: -0.7935586072702128, lng: 100.65812142358095},
	    	{lat: -0.7936095639582824, lng: 100.65813651090787},
	    	{lat: -0.7936662201880769, lng: 100.65815360999034},
	    	{lat: -0.7937523778851271, lng: 100.65817976152823},
	    	{lat: -0.7937966387883008, lng: 100.65819383426526},
	    	{lat: -0.7938385442818848, lng: 100.65820623948196},
	    	{lat: -0.7938973241807623, lng: 100.65822343210834},
	    	{lat: -0.7939412411257634, lng: 100.65823650786888},
	    	{lat: -0.7940223225339456, lng: 100.65807346100996},
	    	{lat: -0.7940223225339456, lng: 100.65803725118826},
	    	{lat: -0.7939204083773492, lng: 100.6579004585285},
	    	{lat: -0.7938399498308921, lng: 100.65778244133185},
	    	{lat: -0.7938292220245757, lng: 100.65772611494253},
	    	{lat: -0.7938372678793131, lng: 100.65763223762701},
	    	{lat: -0.7938748152012169, lng: 100.65755445356558},
	    	{lat: -0.7939096805712363, lng: 100.65747130508612},
	    	{lat: -0.7939499098439942, lng: 100.65739888544272},
	    	{lat: -0.7939981849707641, lng: 100.6573237835903},
	    	{lat: -0.7940679157084494, lng: 100.6572164952297},
	    	{lat: -0.7941403283963399, lng: 100.65708774919699},
	    	{lat: -0.794185921569546, lng: 100.65699387188147},
	    	{lat: -0.7942207869369574, lng: 100.65694022770117},
	    	{lat: -0.7942556523040761, lng: 100.6568543970127},
	    	{lat: -0.7942717440118714, lng: 100.65677661295126},
	    	{lat: -0.7942717440118714, lng: 100.65667200679968},
	    	{lat: -0.7942610162066746, lng: 100.65655667181204},
	    	{lat: -0.7942449244988411, lng: 100.65642792577933},
	    	{lat: -0.7942121591176192, lng: 100.65631737318836},
	    	{lat: -0.7941531561878661, lng: 100.65615912285648},
	    	{lat: -0.7941048810628899, lng: 100.65606256333194},
	    	{lat: -0.794056605937354, lng: 100.65598746147953},
	    	{lat: -0.7939895571509552, lng: 100.65588821974598},
	    	{lat: -0.7939198264119596, lng: 100.65579434243045},
	    	{lat: -0.793839367865477, lng: 100.65571924057804},
	    	{lat: -0.7937535454141824, lng: 100.65562804547153},
	    	{lat: -0.7936516312509578, lng: 100.65553685036502},
	    	{lat: -0.7935765366027736, lng: 100.6554429730495},
	    	{lat: -0.7934692585315564, lng: 100.65532227364383},
	    	{lat: -0.7933826945643183, lng: 100.65520054723333},
	    	{lat: -0.7933424652860646, lng: 100.65512544538092},
	    	{lat: -0.7932539608725042, lng: 100.65501815702032},
	    	{lat: -0.793133273032781, lng: 100.65492696191382},
	    	{lat: -0.7930099032374331, lng: 100.65483576680731},
	    	{lat: -0.792883601688164, lng: 100.65474188949179},
	    	{lat: -0.7927173206487598, lng: 100.65467483426642},
	    	{lat: -0.7925349478881891, lng: 100.65462923671316},
	    	{lat: -0.792336483404315, lng: 100.65459436799597},
	    	{lat: -0.7920763339989062, lng: 100.65456218148779},
	    	{lat: -0.7917598635661902, lng: 100.65453535939764},
	    	{lat: -0.7915626239219643, lng: 100.65450623243555},
	    	{lat: -0.7912944286083341, lng: 100.65450891464457},
	    	{lat: -0.7910047776501256, lng: 100.65452232568964},
	    	{lat: -0.7908438604423933, lng: 100.65453037231669}
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDnqIloh4KN9gJepqJnsHlLofNif5Ic04&callback=initMap&libraries=geometry"" async defer></script>

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
