<?php 
	include 'cores/function.php'; 
	$listMarker = getMapMarkerList();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/vendors/material-kit-pro/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/vendors/material-kit-pro/assets/img/favicon.png">
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
						<a href="login.php">
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

						<h6 class="category text-danger">
							<i class="material-icons">trending_up</i> Trending
						</h6>

						<h4 class="card-title">
							<a href="index.html#pablo">Peta Persebaran Keluarga Miskin Pada Kelurahan Koto Panjang</a>
						</h4>

						<br>

						<div id="map" style="width: 100%; height: 600px;"></div>

						<br>

						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>

					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer footer-white">
		<div class="container">
			<a class="footer-brand" href="http://www.creative-tim.com">Material Kit PRO</a>

			<ul class="pull-center">
				<li>
					<a href="index.html#pablo">
						Creative Tim
					</a>
				</li>
				<li>
					<a href="index.html#pablo">
						About Us
					</a>
				</li>
				<li>
					<a href="index.html#pablo">
						Blog
					</a>
				</li>
				<li>
					<a href="index.html#pablo">
						Licenses
					</a>
				</li>
			</ul>

			<ul class="social-buttons pull-right">
				<li>
					<a href="https://twitter.com/CreativeTim" target="_blank" class="btn btn-just-icon btn-simple btn-twitter">
						<i class="fa fa-twitter"></i>
					</a>
				</li>
				<li>
					<a href="https://www.facebook.com/CreativeTim" target="_blank" class="btn btn-just-icon btn-simple btn-dribbble">
						<i class="fa fa-dribbble"></i>
					</a>
				</li>
				<li>
					<a href="https://www.instagram.com/CreativeTimOfficial" target="_blank" class="btn btn-just-icon btn-simple btn-google">
						<i class="fa fa-google-plus"></i>
					</a>
				</li>
			</ul>

		</div>
	</footer>

	
    <script>
    	var map;
    	var markerList = <?php echo $listMarker; ?>;

    	function initMap() {
    		map = new google.maps.Map(document.getElementById('map'), {
    			center: {lat: -0.792288, lng: 100.656306},
    			zoom: 17,
    			styles: styles
    		});

    		var icon = {
			    url: "assets/img/marker.png",
			    scaledSize: new google.maps.Size(50, 50), // scaled size
			    origin: new google.maps.Point(0,0), // origin
			    anchor: new google.maps.Point(0, 0) // anchor
			};

    		$.each(markerList, function(key, data) {
    			var latLng = new google.maps.LatLng(data.lat, data.long);
    			var marker = new google.maps.Marker({
    				position: latLng,
    				title: data.nama,
    				icon: icon
    			});
    			marker.setMap(map);
    			var contentStr = '<div class="text-center">';
    				contentStr += '<strong>' + data.nama + '<br>' + data.no_kk + '<br>' + data.bantuan + '</strong><br><br>' + data.alamat;
    				contentStr += '<br>' + data.rt_rw;
    				contentStr += '</div>';
    			var infowindow = new google.maps.InfoWindow({
    				content: contentStr
    			});
    			marker.addListener('click', function() {
    				infowindow.open(map, marker);
    			});
    		});
    	}
   	
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDnqIloh4KN9gJepqJnsHlLofNif5Ic04&callback=initMap" async defer></script>

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

</body>
</html>
