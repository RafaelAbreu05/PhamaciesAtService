<?php

// Search Districts
function searchDistrictsXML(){
	$stringDistricts = "http://services.sapo.pt/GIS/GetDistrictsSortedByName";
	$xmlDistricts = simplexml_load_file($stringDistricts) or die("Connection to SAPO Service failed.");
	$districts = $xmlDistricts->GetDistrictsSortedByNameResult->District;
	
	return $districts;
}

// Search Municipalities
function searchMunicipalitiesXML($postDistrict){
	$stringMunicipalities = "http://services.sapo.pt/GIS/GetMunicipalitiesByDistrictIdSortedByName?districtId=".$postDistrict;
	$xmlmunicipalities = simplexml_load_file($stringMunicipalities) or die("Connection to SAPO Service failed.");
	$municipalities = $xmlmunicipalities->GetMunicipalitiesByDistrictIdSortedByNameResult->Municipality;
	
	return $municipalities;
}

// Search Parishes
function searchParishesXML($postMunicipality){
	$stringParishes = "http://services.sapo.pt/GIS/GetParishesByMunicipalityIdSortedByName?municipalityId=".$postMunicipality;
	$xmlParishes = simplexml_load_file($stringParishes) or die("Connection to SAPO Service failed.");
	$parishes = $xmlParishes->GetParishesByMunicipalityIdSortedByNameResult->Parish;
	
	return $parishes;
}

// Search Pharmacies Parish
function searchPharmaciesXML($postParish){	
	$stringPharmacies = "http://services.sapo.pt/GIS/GetPOIByParishIdAndCategoryId?parishId=".$postParish."&categoryId=73";
	$xmlPharmacies = simplexml_load_file($stringPharmacies) or die("Connection to SAPO Service failed.");
	$pharmacies = $xmlPharmacies->GetPOIByParishIdAndCategoryIdResult->POI;
	
	return $pharmacies;
}

function seachPharmaciesAtServiceXML($postMunicipality){
	$stringPharmaciesAtService = "http://services.sapo.pt/Pharmacy/GetPharmaciesAtServiceByMunicipalityId?municipalityId=".$postMunicipality;
	$xmlPharmaciesAtService = simplexml_load_file($stringPharmaciesAtService) or die("Connection to SAPO Service failed.");
	$pharmaciesAtService = $xmlPharmaciesAtService->GetPharmaciesAtServiceByMunicipalityIdResult->Pharmacies->Pharmacy;
	
	return $pharmaciesAtService;
}

// Search Pharmacies At Service
function seachPharmaciesRadiusXML($postPharmacy, $postParish){
	$pharmacies = searchPharmaciesXML($postParish);


	$latitude = '';
	$longitude = '';

	foreach($pharmacies as $pharmacy) {
		if($pharmacy->POISourceId == $postPharmacy){
			$latitude = $pharmacy->Latitude;
			$longitude = $pharmacy->Longitude;
		}
	}
	$stringPharmaciesRadius = "http://services.sapo.pt/GIS/GetPOIByCoordinatesAndCategoryId?latitude=".$latitude."&longitude=".$longitude."&radius=10000&categoryId=73";
	$xmlPharmaciesRadius = simplexml_load_file($stringPharmaciesRadius) or die("Connection to SAPO Service failed.");
	$pharmaciesRadius = $xmlPharmaciesRadius->GetPOIByCoordinatesAndCategoryIdResult->POI;
	
	return $pharmaciesRadius;
}
?>