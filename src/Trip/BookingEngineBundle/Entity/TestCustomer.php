<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Trip\SiteManagementBundle\DTO\TestCustomer as TestCustomerDto;

/**
 * Customer
 *
 * @ORM\Table(name="billing")
 * @ORM\Entity
 */
class TestCustomer
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
     * @var date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="diesel", type="string", length=250)
     */
    private $diesel;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;
    /**
     * @var integer
     *
     * @ORM\Column(name="advance", type="integer")
     */
    private $advance;
    /**
     * @var integer
     *
     * @ORM\Column(name="cash", type="integer")
     */
    private $cash;

    /**
     * @var string
     *
     * @ORM\Column(name="expenses", type="string", length=250)
     */
    private $expenses;
    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="string")
     */
    private $comments;
   
    /**
     * @var string
     * @ORM\Column(name="pickup", type="integer")
     */
    private $pickup;
	/**
     * @var integer
     * @ORM\Column(name="going_to", type="integer")
     */
    private $goingTo;
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\BillingPlacesToVisit", mappedBy="billing", cascade={"all"})
     */
    private $locations;
    
    /**
     * @var integer
     * @ORM\Column(name="vehicle_id", type="integer")
     */
    private $vehicleId;
    /**
     * @var string
     * @ORM\Column(name="carnumber", type="string")
     */
    private $carnumber;
    /**
     * @var string
     * @ORM\Column(name="driver_id", type="string")
     */
    private $driverId;
     private $multiple;
    
	 
    /**
    *
    */
    public function __construct() {
    	$this->locations = new ArrayCollection();
    }
 /**
     * Get TestCustomerDto
     *
     * @return TestCustomerDto
     */
    public function getMultiple()
    {
        return $this->multiple;
    }

    /**
     * Set diesel
     *
     * @param TestCustomerDto $multiple
     * @return TestCustomerDto
     */
    public function setMultiple($multiple)
    {
    	$this->multiple= $multiple;

        return $this;
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
     * @return Collection
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
