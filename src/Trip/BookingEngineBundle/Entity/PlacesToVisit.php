<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 * @ORM\Table(name="booking_package_places_to_visit")
 * @ORM\Entity
 */
class PlacesToVisit
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
     * @ORM\Column(name="location", type="integer")
     */
    private $location;
   
    private $active;
    /**
     * @ORM\ManyToOne(targetEntity="Trip\BookingEngineBundle\Entity\VehicleBooking", inversedBy="placesToVisit")
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
	 * @return the unknown_type
	 */
	public function getActive() {
		return $this->active;
	}
	
	/**
	 *
	 * @param unknown_type $active        	
	 */
	public function setActive($active) {
		$this->active = $active;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getBooking() {
		return $this->booking;
	}
	
	/**
	 *
	 * @param unknown_type $booking        	
	 */
	public function setBooking($booking) {
		$this->booking = $booking;
		return $this;
	}
	
    
    
    
}
