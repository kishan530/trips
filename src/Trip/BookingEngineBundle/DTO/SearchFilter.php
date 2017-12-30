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
class SearchFilter
{

    /**
     * @var string
     */
    private $tripType;
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
    private $date;
    
    /**
     * @var string
     */
    private $returnDate;
    /**
     * @var string
     */
    private $numDays;
        /**
     * @var integer
     */
    private $numAdult;
    /**
     * @var string
     */
    private $preferTime;
    /**
     * @var string
     */
    private $package;
    /**
     * @var string
     */
    private $multiple;
    /**
     * @var string
     */
    private $type;
    
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
	public function getNumDays() {
		return $this->numDays;
	}
	
	/**
	 *
	 * @param
	 *        	$numDays
	 */
	public function setNumDays($numDays) {
		$this->numDays = $numDays;
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
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    
    
}
