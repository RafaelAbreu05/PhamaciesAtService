<?php
class  Pharmacy{
	// Parameters
	public $id;
	public $name;
	public $parish;
	public $address;
	public $locality;
	public $houseNumber;
	public $zipCode;
	public $phone;
	public $fax;
	public $lat;
	public $long;

	// Constructor
	public function __construct($id, $name, $parish, $address, $locality, $houseNumber, $zipCode, $phone, $fax, $lat, $long){
		$this->id = $id;
		$this->name = $name;
		$this->parish = $parish;
		$this->address = $address;
		$this->locality = $locality; 
		$this->houseNumber = $houseNumber;
		$this->zipCode = $zipCode;
		$this->phone = $phone;
		$this->fax = $fax;
		$this->lat = $lat;
		$this->long = $long;
	}

	// GETS
	public function getID(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function getParish(){
		return $this->parish;
	}

	public function getAdrress(){
		return $this->address;
	}

	public function getLocality(){
		return $this->locality;
	}

	public function getHouseNumber(){
		return $this->houseNumber;
	}

	public function getZipCode(){
		return $this->zipCode;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function getFax(){
		return $this->fax;
	}

	public function getLat(){
		return $this->lat;
	}

	public function getLong(){
		return $this->long;
	}

	// SETS
	public function setID($id){
		$this->id = $id;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setParish($parish){
		$this->parish = $parish;
	}

	public function setAdrress($address){
		$this->address = $address;
	}

	public function setLocality($locality){
		$this->locality = $locality;
	}

	public function setHouseNumber($houseNumber){
		$this->houseNumber = $houseNumber;
	}

	public function setZipCode($zipCode){
		$this->zipCode = $zipCode;
	}

	public function setPhone($phone){
		$this->phone = $phone;
	}

	public function setFax($fax){
		$this->fax = $fax;
	}

	public function setLat($lat){
		$this->lat = $lat;
	}

	public function setLong($long){
		$this->long = $long;
	}

	// To String
	public function toString(){
		return $this->name." on ".$this->address." [".$this->zipCode."], ".$this->parish." (".$this->lat.", ".$this->long.")";
	}
}
?>