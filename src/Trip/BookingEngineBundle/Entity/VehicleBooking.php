<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * VehicleBooking
 *
 * @ORM\Table(name="booking_vehicle_services")
 * @ORM\Entity
 */
class VehicleBooking
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var integer
     * @ORM\Column(name="vehicle_id", type="integer")
     */
    private $vehicleId;
    /**
     * @var string
     * @ORM\Column(name="model", type="string", length=100)
     */
    private $model;
    /**
     * @var string
     * @ORM\Column(name="trip_type", type="string", length=100)
     */
    private $tripType;
    /**
     * @var string
     * @ORM\Column(name="leaving_from", type="string", length=100)
     */
    private $leavingFrom;
        /**
     * @var string
     * @ORM\Column(name="going_to", type="string", length=100)
     */
    private $goingTo;
    
    /**
     * @var string
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    /**
     * @var string
     * @ORM\Column(name="date_of_journey", type="date")
     */
    private $date;
    
    /**
     * @var string
     * @ORM\Column(name="return_date", type="date")
     */
    private $returnDate;
    /**
     * @var string
     * @ORM\Column(name="prefer_time", type="string", length=100)
     */
    private $preferTime;
    /**
     * @ORM\ManyToOne(targetEntity="Trip\BookingEngineBundle\Entity\Booking", inversedBy="vehicleBooking")
     * @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     */
    private $booking;
    
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
	public function getModel() {
		return $this->model;
	}
	
	/**
	 *
	 * @param
	 *        	$model
	 */
	public function setModel($model) {
		$this->model = $model;
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
	 *
	 * @return the string
	 */
	public function getReturnDate() {
		return $this->returnDate;
	}
	
	/**
	 *
	 * @param
	 *        	$returnDate
	 */
	public function setReturnDate($returnDate) {
		$this->returnDate = $returnDate;
		return $this;
	}
    
    /**
	 *
	 * @return the string
	 */
	public function getTripType() {
		return $this->tripType;
	}
	
	/**
	 *
	 * @param
	 *        	$tripType
	 */
	public function setTripType($tripType) {
		$this->tripType = $tripType;
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
	 * @return the integer
	 */
	public function getBooking() {
		return $this->booking;
	}
	
	/**
	 * @param
	 *        	$booking
	 */
	public function setBooking($booking) {
		$this->booking = $booking;
		return $this;
	}
    
    
}
