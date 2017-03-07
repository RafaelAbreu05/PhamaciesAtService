<?php
function processSelected($id, $post) {
	if($post == $id)
		$selected = 'selected=selected';
	else
		$selected = '';

	return $selected;
}


function showAllDistricts($post){
	// Search external Data
	$districtsXML = searchDistrictsXML();
	$districts = exportDistrictsFromXML($districtsXML);?>

	<h1>Pharmacies At Service </h1>
	<form name="myForm" id="myForm" action=' <?php echo $_SERVER["PHP_SELF"]; ?> ' method='POST'>
		<fieldset>
			<div>
				<div style="float:left; width:50%;">
					<div align="right">
						<label >Districts</label>
					</div>
				</div>
				<div id="map-canvas" style="float:left; width:50%;" >
					<select name='selectDistrict' onchange='this.form.submit()'  style="width: 200px;">
						<option value=''>-- Please select district --</option>
						<?php
						foreach ($districts as $district) {
							if(empty($post))
								echo "<option value='{$district->getId()}' > {$district->getName()} </option>";
							else{
								echo "<option value='{$district->getId()}' ".processSelected($district->getId(), $post)."> {$district->getName()} </option>";
							}
						}?>
					</select>
				</div>

				<?php
			}

// Search external Data
			function showMunicipalitiesFromDistrict($postDistrict, $postMunicipality){
				$municipalitiesXML = searchMunicipalitiesXML($postDistrict);
				$municipalities = exportMunicipalitiesFromXML($municipalitiesXML);
				?>
				<div>	
					<div style="float:left; width:50%;">
						<div align="right">
							<label>Municipality</label>
						</div>
					</div>
				</div>
				<div id="map-canvas" style="float:left; width:50%;">
					<select name='selectMunicipality' onchange='this.form.submit()' style="width: 200px;">
						<option value =''>-- Please select municipality --</option>
						<?php
						foreach ($municipalities as $municipality) {
							if(empty($postMunicipality))
								echo "<option value='{$municipality->getId()}'> {$municipality->getName()}	 </option>";
							else
								echo "<option value='{$municipality->getId()}' ".processSelected($municipality->getId(), $postMunicipality)."> {$municipality->getName()} </option>";
						}?>
					</select>
				</div>
				<?php
			}

			function showParishesFromMunicipality($postMunicipality, $postParish){
				$parishesXML = searchParishesXML($postMunicipality);
				$parishes = exportParishesFromXML($parishesXML);
				?>
				<div>	
					<div style="float:left; width:50%;">
						<div align="right">
							<label>Parish</label>	
						</div>
					</div>
				</div>
				<div id="map-canvas" style="float:left; width:50%;">
					<select name='selectParish' onchange='this.form.submit()' style="width: 200px;">
						<option>-- Please select parish --</option>
						<?php
						foreach ($parishes as $parish) {
							if(empty($postParish))
								echo "<option value='{$parish->getId()}'> {$parish->getName()} </option>";
							else
								echo "<option value='{$parish->getId()}' ".processSelected($parish->getId(), $postParish)."> {$parish->getName()} </option>";
						}?>
					</select>
				</div>
				<?php
			}

			function showPharmaciesFromParish($postParish, $postPharmacy){
				$pharmaciesXML = searchPharmaciesXML($postParish);
				$pharmacies = exportPharmaciesFromXML($pharmaciesXML);
				?>
				<div>	
					<div style="float:left; width:50%;">
						<div align="right">
							<label for="name">Pharmacy</label>	
						</div>
					</div>
				</div>
				<div id="map-canvas" style="float:left; width:50%;">
					<select name='selectPharmacy' onchange='this.form.submit()' style="width: 200px;">
						<option value = ''>-- Please select pharmacy --</option>
						<?php
						foreach ($pharmacies as $pharmacy) {
							if(empty($postPharmacy))
								echo "<option value='{$pharmacy->getId()}'> {$pharmacy->getName()} </option>";
							else
								echo "<option value='{$pharmacy->getId()}' ".processSelected($pharmacy->getId(), $postPharmacy)."> {$pharmacy->getName()} </option>";
						}?>
					</select>
				</div>
				<div align="center">
					<br>
				<br>
					<?php 
					if(!empty($postPharmacy))
						echo"<input id='bigbutton' name='submit' type='button' value='Search' onclick=\"parent.location='results.php'\">"?>
				</div>
			</div>
		</fieldset>
	</form>
	<?php

}

function showPharmacies($postParish){ 
	$pharmaciesXML = searchPharmaciesXML($postParish);
	$pharmacies = exportPharmaciesFromXML($pharmaciesXML);

	foreach($pharmacies as $pharmacy){	
		echo $pharmacy->toString();
		echo "<br>";
	}
}

function showPharmaciesRadius($postParish){ 
	$pharmaciesXML = searchPharmaciesXML($postParish);
	$pharmacies = exportPharmaciesFromXML($pharmaciesXML);

	foreach($pharmacies as $pharmacy){	
		echo $pharmacy->toString();
		echo "<br>";
	}
}

function searchPharmaciesAtServiceRadius($pharmacy, $parish, $municipality){
	$pharmaciesFromRadiusXML = seachPharmaciesRadiusXML($pharmacy, $parish);
	$pharmaciesFromRadius = exportPharmaciesFromXML($pharmaciesFromRadiusXML);

	$pharmaciesAtServiceXML = seachPharmaciesAtServiceXML($municipality);
	$pharmaciesAtService = exportPharmaciesServiceFromXML($pharmaciesAtServiceXML);

	$i=0;
	$pharmacies = array();
	foreach($pharmaciesFromRadius as $pharmacy){
		foreach($pharmaciesAtService as $pharmacyAtService){
			if(($pharmacy->getId() - $pharmacyAtService->getId()) == 0){
				$pharmacies[$i] = $pharmacyAtService;
				$i++;
			}
		}
	}
	return $pharmacies;
}

?>