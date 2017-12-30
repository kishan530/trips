<?php

namespace Trip\BookingEngineBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * VendorDriver
 *
 * 
 */
class VendorDriver
{
     /**
     * @var integer
     *
     * 
     */
    private $id;
	 /**
     * @var string
     *
     */
   
    private $drivername;

    /**
     * @var string
     *
     */
    private $driverMobileno;
    /**
     * @var string
     *
     */
    private $drivingLicence;
	 /**
     * @var string
     *
     */
    private $driverIdproof;
     /**
     * @var string
     *
     * 
     */
    private $vendorId;
	
	  public function __construct()
    {
        $this->multiple = new ArrayCollection();
        //$this->placesToVisit = new ArrayCollection();
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
     * Set drivername
     *
     * @param string $drivername
     * @return VendorDriver
     */
    public function setDrivername($drivername)
    {
        $this->drivername = $drivername;

        return $this;
    }
    /**
     * Get drivername
     *
     * @return string
     */
    public function getDrivername()
    {
    	return $this->drivername;
    }
     /**
     * Set driverMobileno
     *
     * @param string $driverMobileno
     * @return VendorDriver
     */
    public function setDriverMobileno($driverMobileno)
    {
        $this->driverMobileno = $driverMobileno;

        return $this;
    }
    /**
     * Get driverMobileno
     *
     * @return string
     */
    public function getDriverMobileno()
    {
    	return $this->driverMobileno;
    }
    /**
     * Set drivingLicence
     *
     * @param string $drivingLicence
     * @return VendorDriver
     */
    public function setDrivingLicence($drivingLicence)
    {
    	$this->drivingLicence = $drivingLicence;
    	
    	return $this;
    }
    /**
     * Get drivingLicence
     *
     * @return string
     */
    public function getDrivingLicence()
    {
    	return $this->drivingLicence;
    }
	/**
     * Set driverIdproof
     *
     * @param string $driverIdproof
     * @return VendorDriver
     */
    public function setDriverIdproof($driverIdproof)
    {
    	$this->driverIdproof = $driverIdproof;
    	
    	return $this;
    }
    /**
     * Get driverIdproof
     *
     * @return string
     */
    public function getDriverIdproof()
    {
    	return $this->driverIdproof;
    }
    /**
     * Set vendorId
     *
     * @param string $vendorId
     * @return Vendor
     */
   public function setVendorId($vendorId) {
		$this->vendorId = $vendorId;
		return $this;
	}
    
  /**
	 *
	 * @return the string
	 */
	public function getVendorId() {
		return $this->vendorId;
	}
	

	
}
