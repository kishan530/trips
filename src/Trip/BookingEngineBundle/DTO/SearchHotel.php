<?php

namespace Trip\BookingEngineBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This is a Entity to hold the data of City
 *
 *
 * SearchHotel
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
    /**
     * @var integer
     */
    private $numAdult;
    /**
     * @var integer
     */
    private $numRooms;
    /**
     * @var integer
     */
    private $numChildren;
    /**
     * @var string
     */
    private $location;
    /**
     * @var Collection
     */
    private $price;
    /**
     * @var Collection
     */
    private $minPrice;
    /**
     * @var Collection
     */
    private $maxPrice;
    /**
     * @var Collection
     */
    private $min;
    /**
     * @var Collection
     */
    private $max;
    /**
     * @var integer
     */
    private $categories;
    /**
     * @var string
     */
    private $properties;
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
     * @return the integer
     */
    public function getNumRooms() {
        return $this->numRooms;
    }
    
    /**
     *
     * @param
     *        	$numRooms
     */
    public function setNumRooms($numRooms) {
        $this->numRooms = $numRooms;
        return $this;
    }
    
    /**
     *
     * @return the integer
     */
    public function getNumChildren() {
        return $this->numChildren;
    }
    
    /**
     *
     * @param
     *        	$numChildren
     */
    public function setNumChildren($numChildren) {
        $this->numChildren = $numChildren;
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
     * @return the Collection
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
     * @return the Collection
     */
    public function getMinPrice() {
        return $this->minPrice;
    }
    
    /**
     *
     * @param
     *        	$minPrice
     */
    public function setMinPrice($minPrice) {
        $this->minPrice = $minPrice;
        return $this;
    }
    
    /**
     *
     * @return the Collection
     */
    public function getMaxPrice() {
        return $this->maxPrice;
    }
    
    /**
     *
     * @param
     *        	$maxPrice
     */
    public function setMaxPrice($maxPrice) {
        $this->maxPrice = $maxPrice;
        return $this;
    }
    
    /**
     *
     * @return the Collection
     */
    public function getMin() {
        return $this->min;
    }
    
    /**
     *
     * @param
     *        	$min
     */
    public function setMin($min) {
        $this->min = $min;
        return $this;
    }
    
    /**
     *
     * @return the Collection
     */
    public function getMax() {
        return $this->max;
    }
    
    /**
     *
     * @param
     *        	$max
     */
    public function setMax($max) {
        $this->max = $max;
        return $this;
    }
    /**
     *
     * @return the integer
     */
    public function getCategories() {
        return $this->categories;
    }
    
    /**
     *
     * @param
     *        	$categories
     */
    public function setCategories($categories) {
        $this->categories = $categories;
        return $this;
    }
    /**
     *
     * @return the string
     */
    public function getProperties() {
        return $this->properties;
    }
    
    /**
     *
     * @param
     *        	$properties
     */
    public function setProperties($properties) {
        $this->properties = $properties;
        return $this;
    }
}
