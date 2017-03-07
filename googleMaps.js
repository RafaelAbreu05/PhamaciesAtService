
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