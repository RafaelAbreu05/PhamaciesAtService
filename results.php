<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />

	<?php
	session_start();

	include '/classes/classes.php';
	include 'externalData.php';
	include 'functions.php';
	include 'exportDataFromXML.php';
	?>
	<meta http-equiv=refresh content='600; url=index.php'>
	<meta charset="UTF-8">
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6BmwJve_wN3QL5kISD413pIWOkUW5v1w&sensor=false"></script>
	
	<script src="markerwithlabel.js" type="text/javascript"></script>
	<script type="text/javascript">

		function initialize() {
			var mapOptions = {
			}

			var image = 'pharmacy1.png';
			var infowindow = new google.maps.InfoWindow();
			var bounds = new google.maps.LatLngBounds();
			var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

			var i = 0;

			<?php
			$pharmacy = $_SESSION['pharmacy'];
			$parish = $_SESSION['parish'];
			$municipality = $_SESSION['municipality'];


			$pharmaciesXML = searchPharmaciesXML($parish);
			$pharmaciesParish = exportPharmaciesFromXML($pharmaciesXML);

			foreach($pharmaciesParish as $p) {
				if($p->getId() == $pharmacy){
					$name = $p->getName();
					$lat = $p->getLat();
					$long = $p->getLong();
				}
			}?>

			var myLatLng = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $long ?>);
			var marker = new MarkerWithLabel({
				position: myLatLng,
				map: map,
				title: "<?php echo $name; ?>",
				labelContent: "<?php echo $name; ?>",
				labelAnchor: new google.maps.Point(50, 0),
				labelClass: "labels",
				raiseOnDrag: true,
				icon: image
			});

			bounds.extend(marker.position);

			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infowindow.setContent("<?php echo $name; ?>");
					infowindow.open(map, marker);
				}
			})(marker, i));
			i++;

			var image = 'pharmacy.png';

			<?php
			$pharmacies = searchPharmaciesAtServiceRadius($pharmacy, $parish, $municipality);
			foreach($pharmacies as $pharmacy){?>

				var myLatLng = new google.maps.LatLng(<?php echo $pharmacy->getLat(); ?>, <?php echo $pharmacy->getLong(); ?>);
				var marker = new MarkerWithLabel({
					position: myLatLng,
					map: map,
					title: "<?php echo $pharmacy->getName(); ?>",
					labelContent: i+". " + "<?php echo $pharmacy->getName(); ?>",
					labelAnchor: new google.maps.Point(50, 0),
					labelClass: "labels1",
					raiseOnDrag: true,
					icon: image
				});

				bounds.extend(marker.position);

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infowindow.setContent("<?php echo $pharmacy->getName(); ?>");
						infowindow.open(map, marker);
					}
				})(marker, i));
				i++;
				<?php
			}?>

			map.fitBounds(bounds);		
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</head>
<body>
	<?php
	$pharmacy = $_SESSION['pharmacy'];
	$parish = $_SESSION['parish'];
	$municipality = $_SESSION['municipality'];

	$pharmacies = searchPharmaciesXML($parish);
	
	foreach($pharmacies as $p) {
		if($p->POISourceId == $pharmacy){
			$name = $p->Name;
		}
	}
	?>
	<h1>Pharmacies At Service Around: <?php echo $name; ?></h1>
	<div style="float:left; width:50%;">
		<?php
		$pharmacies = searchPharmaciesAtServiceRadius($pharmacy, $parish, $municipality);
		$i=1;
		foreach($pharmacies as $pharmacy){?>
		<section style="margin: 10px;">
			<fieldset id="fieldset1" style="border-radius: 5px; padding: 5px; min-height:150px;">
				<legend><b> <?php echo $i.". ".$pharmacy->getName(); ?> </b> </legend>
				<h3><?php echo $pharmacy->getAdrress(); ?></h3>
				<h3><?php echo $pharmacy->getZipCode();?>, <?php echo $pharmacy->getParish(); ?>, <?php echo $pharmacy->getLocality(); ?></h3>
			</fieldset>
			<br>
		</section>
		<?php
	}?>
</div>
<div id="map-canvas" align="center" style="float:left; width:40%; height: 70%;"></div>


</body>	</html>