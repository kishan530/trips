<?php

namespace Trip\BookingEngineBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Catalogue
 */
class Catalogue
{

    /**
     * @var array
     */
    private $locations;	
     /**
     * @var array
     */
    private $vehicles;
    /**
     * @var array
     */
    private $drivers;
	
	/**
	 *
	 * @return the string
	 */
	public function getLocations() {
		return $this->locations;
	}
	
	/**
	 *
	 * @param
	 *        	$locations
	 */
	public function setLocations($locations) {
		$this->locations = $locations;
		return $this;
	}
    /**
	 *
	 * @return the string
	 */
	public function getVehicles() {
		return $this->vehicles;
	}
	
	/**
	 *
	 * @param
	 *        	$vehicles
	 */
	public function setVehicles($vehicles) {
		$this->vehicles = $vehicles;
		return $this;
	}
	/**
	 *
	 * @return the string
	 */
	public function getDriver() {
		return $this->drivers;
	}
	
	/**
	 *
	 * @param
	 *        	$drivers
	 */
	public function setDriver($drivers) {
		$this->drivers = $drivers;
		return $this;
	}
}
