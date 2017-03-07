/*
	$i = 0;
	$my_array = array();
	foreach($pharmaciesAtService as $pharmacyAtService) {
		foreach($pharmacies as $pharmacy){
			if(($pharmacy->getId() - $pharmacyAtService->Code)==0){
				$my_array[$i] = $pharmacy;
				echo $pharmacy->toString();
				$i++;
			}
		}
	}
	$_SESSION['pharmaciesAtService'] = $my_array;
	*/