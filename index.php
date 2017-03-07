<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>
<body>
	<?php
	session_start();
	include '/classes/classes.php';
	include 'externalData.php';
	include 'functions.php';
	include 'exportDataFromXML.php';

	$postDistrit = '';
	$postMunicipality = '';
	$postParish = '';
	$postPharmacy = '';

	if(isset($_POST['selectDistrict']) && $_POST['selectDistrict'] != ''){
		$postDistrit = $_POST['selectDistrict'];
	}else{
		$postDistrit = '';
		$postMunicipality = '';
		$postParish = '';
		$postPharmacy = '';
	}

	if(isset($_POST['selectMunicipality']) && $_POST['selectMunicipality'] != ''){
		$postMunicipality = $_POST['selectMunicipality'];
		$_SESSION['municipality'] = $postMunicipality;
	}else{
		$postMunicipality = '';
		$postParish = '';
		$postPharmacy = '';
	}

	if(isset($_POST['selectParish']) && $_POST['selectParish'] != ''){
		$postParish = $_POST['selectParish'];
		$_SESSION['parish'] = $postParish;
	}else{
		$postParish = '';
		$postPharmacy = '';
	}

	if(isset($_POST['selectPharmacy']) && $_POST['selectPharmacy'] != ''){
		$postPharmacy = $_POST['selectPharmacy'];
		$_SESSION['pharmacy'] = $postPharmacy;
	}else{
		$postPharmacy = '';
	}

	showAllDistricts($postDistrit);

	if($postDistrit != '')
		showMunicipalitiesFromDistrict($postDistrit, $postMunicipality);		

	if($postDistrit != '' && $postMunicipality != '')
		showParishesFromMunicipality($postMunicipality, $postParish);

	if($postDistrit != '' && $postMunicipality != '' && $postParish != '')
		showPharmaciesFromParish($postParish, $postPharmacy);

		//showPharmaciesAtService();

	?>
</body>	</html>