<?php
// Export Districts From XML
function exportDistrictsFromXML($districts){
	$allDistricts = array();
	$i = 0; 
	foreach ($districts as $district) {
		$d = new District($district->DistrictId, $district->DistrictName, $district->Latitude, $district->Longitude);
		$allDistricts[$i]=$d;
		$i++;
	}
	return $allDistricts;
}

// Export Municipalities From XML
function exportMunicipalitiesFromXML($municipalities){
	$allMunicipalities = array();
	$i = 0; 	
	foreach ($municipalities as $muni) {
		$m = new Municipality($muni->MunicipalityId, $muni->MunicipalityName, $muni->Latitude, $muni->Longitude);
		$allMunicipalities[$i] = $m;
		$i++;
	}
	return $allMunicipalities;
}

// Export Parishes From XML
function exportParishesFromXML($parishes){
	$allParishes = array();
	$i = 0; 
	foreach ($parishes as $parish) {
		$p = new Parish($parish->ParishId, $parish->ParishName, $parish->Latitude, $parish->Longitude);
		$allParishes[$i] = $p;
		$i++;
	}
	return $allParishes;
}

// Export Pharmacies From XML
function exportPharmaciesFromXML($pharmacies){
	$allPharmacies = array();
	$i = 0;
	foreach($pharmacies as $pharmacy) {		
		$ph = new Pharmacy($pharmacy->POISourceId, $pharmacy->Name, $pharmacy->Parish, $pharmacy->Address, $pharmacy->Locality, $pharmacy->HouseNumber, $pharmacy->ZipCode, $pharmacy->Phone, $pharmacy->Fax, $pharmacy->Latitude, $pharmacy->Longitude);
		$allPharmacies[$i] = $ph;
		$i++;
	}
	return $allPharmacies;
}

// Export Pharmacies From XML
function exportPharmaciesServiceFromXML($pharmacies){
	$allPharmaciesAtService = array();
	$i = 0;
	foreach($pharmacies as $pharmacy) {
		$ph = new Pharmacy($pharmacy->Code, $pharmacy->Name, $pharmacy->Address->Parish, $pharmacy->Address->Street, $pharmacy->Address->Locality,
			'', $pharmacy->Address->ZipCode, $pharmacy->Phone, $pharmacy->Fax, $pharmacy->Address->Coordinates->Latitude,
			 $pharmacy->Address->Coordinates->Longitude);
		$allPharmaciesAtService[$i] = $ph;
		$i++;
	}
	return $allPharmaciesAtService;
}

?>