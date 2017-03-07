<?php
class  Parish{
	
	// Parameters
	public $id;
	public $name;
	public $lat;
	public $long;

	// Construct
	public function __construct($id, $name, $lat, $long){
		$this->id = $id;
		$this->name = $name;
		$this->lat = $lat;
		$this->long = $long;
	}

	// GETS
	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
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

	public function setLat($lat){
		$this->lat = $lat;
	}

	public function setLong($long){
		$this->long = $long;
	}

	// To String
	public function toString(){
		return $this->name."(".$this->lat.",".$this->long.")";
	}
}
?>