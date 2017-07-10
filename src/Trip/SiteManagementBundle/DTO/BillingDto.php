<?php

namespace Trip\SiteManagementBundle\DTO;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * Billing
 *
 */
class BillingDto
{
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $diesel;

    /**
     * @var float
     *
     */
    private $price;
    /**
     * @var float
     *
     */
    private $advance;
    /**
     * @var float
     *
     */
    private $cash;

    /**
     * @var string
     *
     */
    private $expenses;
    /**
     * @var text
     *
     */
    private $comments;
    /**
     * @var date
     *
     */
    private $date;
    /**
     * @var string
     */
    private $pickup;
    /**
     * @var Collection
     */
    private $locations;
    /**
     * @var string
     */
    private $goingTo;
    /**
     * @var string
     */
    private $vehicleId;
    /**
     * @var string
     */
    private $driverId;
    
	 
    /**
    *
    */
    public function __construct() {
    	$this->locations = array();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set diesel
     *
     * @param string $diesel
     * @return Billing
     */
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
     * @param float $price
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
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set advance
     *
     * @param float $advance
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
     * @return float
     */
    public function getAdvance()
    {
    	return $this->advance;
    }
    
    /**
     * Set cash
     *
     * @param float $cash
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
     * @return float
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
}
