<?php

namespace Trip\BookingEngineBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This is a Entity to hold the data of City
 *
 *
 * SearchFilter
 */
class NewPackage
{

    /**
     * @var string
     */
    private $leavingFrom;
        /**
     * @var string
     */
    private $goingTo;
    /**
     * @var string
     */
    private $placesToVisit;
    /**
     * @var integer
     */
    private $numAdult;
    
    /**
     * @var string
     */
    private $date;
    /**
     * @var string
     */
    private $preferTime;
       /**
     * @var integer
     */
    private $vehicleId;
    /**
     * @var string
     */
    private $price;
    /**
     * @var string
     */
    private $description;
    
	
	/**
	 *
	 * @return the string
	 */
	public function getLeavingFrom() {
		return $this->leavingFrom;
	}
	
	/**
	 *
	 * @param
	 *        	$leavingFrom
	 */
	public function setLeavingFrom($leavingFrom) {
		$this->leavingFrom = $leavingFrom;
		return $this;
	}
    /**
	 *
	 * @return the string
	 */
	public function getGoingTo() {
		return $this->goingTo;
	}
	
	/**
	 *
	 * @param
	 *        	$goingTo
	 */
	public function setGoingTo($goingTo) {
		$this->goingTo = $goingTo;
		return $this;
	}
    /**
	 *
	 * @return the string
	 */
	public function getDate() {
		return $this->date;
	}
	
	/**
	 *
	 * @param
	 *        	$date
	 */
	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
    
    /**
     * Set preferTime
     * @param string $preferTime
     * @return Booking
     */

    public function setPreferTime($preferTime)
    {
    	$this->preferTime = $preferTime;
    	return $this;
    }
    /**
     * Get preferTime
     * @return string
     */
    public function getPreferTime()
    {
    	return $this->preferTime;
    }
    
    /**
	 *
	 * @return the integer
	 */
	public function getVehicleId() {
		return $this->vehicleId;
	}
	
	/**
	 *
	 * @param
	 *        	$vehicleId
	 */
	public function setVehicleId($vehicleId) {
		$this->vehicleId = $vehicleId;
		return $this;
	}
    /**
	 *
	 * @return the string
	 */
	public function getPrice() {
		return $this->price;
	}
	
	/**
	 *
	 * @param
	 *        	$price
	 */
	public function setPrice($price) {
		$this->price = $price;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getPlacesToVisit() {
		return $this->placesToVisit;
	}
	
	/**
	 *
	 * @param
	 *        	$placesToVisit
	 */
	public function setPlacesToVisit($placesToVisit) {
		$this->placesToVisit = $placesToVisit;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getNumAdult() {
		return $this->numAdult;
	}
	
	/**
	 *
	 * @param
	 *        	$numAdult
	 */
	public function setNumAdult($numAdult) {
		$this->numAdult = $numAdult;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 *
	 * @param
	 *        	$description
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	
	
	
    
}
