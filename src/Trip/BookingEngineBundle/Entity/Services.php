<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 * @ORM\Table(name="services")
 * @ORM\Entity
 */
class Services
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="leaving_from", type="integer")
     */
    private $leavingFrom;
     /**
     * @var string
     * @ORM\Column(name="going_to", type="integer")
     */
    private $goingTo;
    
    /**
     * @var string
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    /**
     * @var string
     * @ORM\Column(name="return_price", type="float")
     */
    private $returnPrice;
    /**
     * @var string
     * @ORM\Column(name="multi_price", type="float")
     */
    private $multiPrice;
    /**
     * @var string
     * @ORM\Column(name="vehicle_id", type="integer")
     */
    private $vehicleId;
	
	/**
	 *
	 * @return the integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @param
	 *        	$id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
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
	 * @param
	 *        	$returnPrice
	 */
	public function setReturnPrice($returnPrice) {
		$this->returnPrice = $returnPrice;
		return $this;
	}
    
         /**
	 *
	 * @return the string
	 */
	public function getReturnPrice() {
		return $this->returnPrice;
	}
    
    /**
	 *
	 * @param
	 *        	$multiPrice
	 */
	public function setMultiPrice($multiPrice) {
		$this->multiPrice = $multiPrice;
		return $this;
	}
    
         /**
	 *
	 * @return the string
	 */
	public function getMultiPrice() {
		return $this->multiPrice;
	}
    /**
	 *
	 * @return the string
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
	
    
}
