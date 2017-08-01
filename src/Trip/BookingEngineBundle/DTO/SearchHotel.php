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
class SearchHotel
{
    /**
     * @var string
     */
    private $goingTo;
    
    /**
     * @var string
     */
    private $date;
    
    /**
     * @var string
     */
    private $returnDate;
	/**
     * @var string
     */
    private $package;
	/**
     * @var string
     */
    private $multiple;
	
    public function __construct()
    {
        $this->multiple = new ArrayCollection();
    }
    
    /**
	 *
	 * @return the string
	 */
	public function getMultiple() {
		return $this->multiple;
	}
	
	/**
	 *
	 * @param
	 *        	$multiple
	 */
	public function setMultiple($multiple) {
		$this->multiple = $multiple;
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
     * Set package
     * @param string $package
     * @return Booking
     */

    public function setPackage($package)
    {
    	$this->package = $package;
    	return $this;
    }
    /**
     * Get package
     * @return string
     */
    public function getPackage()
    {
    	return $this->package;
    }
    
}
