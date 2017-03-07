<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="style.css"/
	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
	<meta name="author" content="Hege Refsnes">
	<meta charset="UTF-8">
</head>
<body>
	<p>
		<?php
		$xml = simplexml_load_file("http://services.sapo.pt/GIS/GetPOIByParishIdAndCategoryId?categoryId=73");
		$pharmacies = $xml->GetPOIByParishIdAndCategoryIdResult->POI;
		foreach ($pharmacies as $pharmacy) {
			//print_r($pharmacy);
			print_r("Name = " . $pharmacy->Name);
			echo '<br/>';
			print_r("District = " . $pharmacy->District);
			echo '<br/>';
		}
		?>
	</p>   
</body>
</html>