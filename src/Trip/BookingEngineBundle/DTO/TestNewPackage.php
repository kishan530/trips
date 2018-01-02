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
class TestNewPackage
{
	
	/**
     * @var date
     */
    private $date;
	/**
     * @var string
     *
     */
    private $diesel;
	/**
     * @var integer
     */
    private $price;
	/**
     * @var integer
     */
    private $advance;
    /**
     * @var integer
     */
    private $cash;
    /**
     * @var string
     */
    private $expenses;
        /**
     * @var string
     */
    private $comments;
    /**
     * @var string
     */
    private $pickup;
    /**
     * @var integer
     */
    private $goingTo;
     /**
     * @var Collection
     */
    private $locations;
   
       /**
     * @var integer
     */
    private $vehicleId;
    /**
     * @var string
   
     */
    private $carnumber;
    
     /**
     * @var string
     */
    private $driverId;
	
	 

   
    

   
	
	public function setDiesel($diesel)
    {
    	$this->diesel= $diesel;

        return $this;
    }

    /**
     * Get diesel
     *
     * @return string 
     */
    public function getdiesel()
    {
    	return $this->diesel;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Billing
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
    	return $this->price;
    }
    
    /**
     * Set advance
     *
     * @param integer $advance
     * @return Billing
     */
    public function setAdvance($advance)
    {
    	$this->advance = $advance;
    	
    	return $this;
    }
    /**
     * Get advance
     *
     * @return integer
     */
    public function getAdvance()
    {
    	return $this->advance;
    }
    
    /**
     * Set cash
     *
     * @param integer $cash
     * @return Billing
     */
    public function setCash($cash)
    {
    	$this->cash = $cash;
    	
    	return $this;
    }
    /**
     * Get cash
     *
     * @return integer
     */
    public function getCash()
    {
    	return $this->cash;
    }

    /**
     * Set expenses
     *
     * @param string $expenses
     * @return Billing
     */
    public function setExpenses($expenses)
    {
    	$this->expenses= $expenses;

        return $this;
    }

    /**
     * Get expenses
     *
     * @return string 
     */
    public function getExpenses()
    {
    	return $this->expenses;
    }

    
    /**
	 *
	 * @return the string
	 */
    public function getComments() {
    	return $this->comments;
	}
	
	/**
	 *
	 * @param
	 *        	$comments
	 */
	public function setComments($comments) {
		$this->comments= $comments;
		return $this;
	}
	/**
	 * Set date
	 *
	 * @param date $date
	 * @return Billing
	 */
	public function setDate($date)
	{
		$this->date = $date;
		
		return $this;
	}
	
	/**
	 * Get date
	 *
	 * @return date
	 */
	public function getDate()
	{
		return $this->date;
	}
	/**
	 *
	 * @return the string
	 */
	public function getPickup() {
		return $this->pickup;
	}
	
	/**
	 *
	 * @param
	 *        	$pickup
	 */
	public function setPickup($pickup) {
		$this->pickup = $pickup;
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
	public function getDriverId() {
		return $this->driverId;
	}
	
	/**
	 *
	 * @param
	 *        	$driverId
	 */
	public function setDriverId($driverId) {
		$this->driverId = $driverId;
		return $this;
	}
	/**
     * Set locations
     *
     * @param $locations
     * @return Billing
     */
	public function setLocations($locations)
    {
    	$this->locations= $locations;

        return $this;
    }

    /**
     * Get locations
     *
     * @return locations
     */
    public function getLocations()
    {
    	return $this->locations;
    }
    
    
    /**
     * Set carnumber
     *
     * @param string $carnumber
     * @return Billing
     */
    public function setCarnumber($carnumber)
    {
    	$this->carnumber= $carnumber;
    	
    	return $this;
    }
    
    /**
     * Get carnumber
     *
     * @return carnumber
     */
    public function getCarnumber()
    {
    	return $this->carnumber;
    }
	
	
    
}
