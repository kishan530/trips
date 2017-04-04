<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * HotelBooking
 *
 * @ORM\Table(name="booking_hotel_services")
 * @ORM\Entity
 */
class HotelBooking
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
     * @var string
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    /**
     * @ORM\ManyToOne(targetEntity="Trip\BookingEngineBundle\Entity\Booking", inversedBy="hotelBooking")
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
	public function getHotelId() {
		return $this->hotelId;
	}
	
	/**
	 *
	 * @param
	 *        	$hotelId
	 */
	public function setHotelId($hotelId) {
		$this->hotelId = $hotelId;
		return $this;
	}
   /**
	 *
	 * @return the string
	 */
	public function getHotelName() {
		return $this->hotelName;
	}
	
	/**
	 *
	 * @param
	 *        	$hotelName
	 */
	public function setHotelName($hotelName) {
		$this->hotelName = $hotelName;
		return $this;
	}
	/**
	 *
	 * @return the string
	 */
	public function getLocation() {
		return $this->location;
	}
	
	/**
	 *
	 * @param
	 *        	$location
	 */
	public function setLocation($location) {
		$this->location = $location;
		return $this;
	}
    /**
	 *
	 * @return the string
	 */
	public function getChekIn() {
		return $this->chekIn;
	}
	
	/**
	 *
	 * @param
	 *        	$chekIn
	 */
	public function setChekIn($chekIn) {
		$this->chekIn = $chekIn;
		return $this;
	}
    
     /**
	 *
	 * @return the string
	 */
	public function getChekOut() {
		return $this->chekOut;
	}
	
	/**
	 *
	 * @param
	 *        	$chekOut
	 */
	public function setChekOut($chekOut) {
		$this->chekOut = $chekOut;
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
