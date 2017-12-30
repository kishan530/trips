<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * HotelBooking
 *
 * @ORM\Table(name="booking_bike_services")
 * @ORM\Entity
 */
class BikeBooking
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
     * @ORM\ManyToOne(targetEntity="Trip\BookingEngineBundle\Entity\Booking", inversedBy="bikeBooking")
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
	public function getBikeId() {
		return $this->hotelId;
	}
	
	/**
	 *
	 * @param
	 *        	$bikeId
	 */
	public function setBikeId($bikeId) {
		$this->bikeId = $bikeId;
		return $this;
	}
   /**
	 *
	 * @return the string
	 */
	public function getBikeIdName() {
		return $this->bikeName;
	}
	
	/**
	 *
	 * @param
	 *        	$bikeName
	 */
	public function setBikeIdName($bikeName) {
		$this->bikeName = $bikeName;
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
