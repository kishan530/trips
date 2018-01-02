<?php

namespace Trip\BookingEngineBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * VendorVehicles
 *
 * 
 */
class VendorVehicles
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
   
    private $vehicleName;

    /**
     * @var string
     *
     */
    private $vehicleImage;
    /**
     * @var string
     *
     */
    private $vehicleRegisCer;
	 /**
     * @var string
     *
     */
    private $vehicleInsurance;
     /**
     * @var string
     *
     * 
     */
    private $vehiclePopulation;
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
     * Set vehicleName
     *
     * @param string $vehicleName
     * @return VendorVehicles
     */
    public function setVehicleName($vehicleName)
    {
        $this->vehicleName = $vehicleName;

        return $this;
    }
    /**
     * Get vehicleName
     *
     * @return string
     */
    public function getVehicleName()
    {
    	return $this->vehicleName;
    }
     /**
     * Set vehicleImage
     *
     * @param string $vehicleImage
     * @return VendorVehicles
     */
    public function setVehicleImage($vehicleImage)
    {
        $this->vehicleImage = $vehicleImage;

        return $this;
    }
    /**
     * Get vehicleImage
     *
     * @return string
     */
    public function getVehicleImage()
    {
    	return $this->vehicleImage;
    }
    /**
     * Set vehicleRegisCer
     *
     * @param string $vehicleRegisCer
     * @return VendorVehicles
     */
    public function setVehicleRegisCer($vehicleRegisCer)
    {
    	$this->vehicleRegisCer = $vehicleRegisCer;
    	
    	return $this;
    }
    /**
     * Get vehicleRegisCer
     *
     * @return string
     */
    public function getVehicleRegisCer()
    {
    	return $this->vehicleRegisCer;
    }
	/**
     * Set vehicleInsurance
     *
     * @param string $vehicleInsurance
     * @return VendorVehicles
     */
    public function setVehicleInsurance($vehicleInsurance)
    {
    	$this->vehicleInsurance = $vehicleInsurance;
    	
    	return $this;
    }
    /**
     * Get vehicleInsurance
     *
     * @return string
     */
    public function getVehicleInsurance()
    {
    	return $this->vehicleInsurance;
    }
	/**
     * Set vehiclePopulation
     *
     * @param string $vehiclePopulation
     * @return VendorVehicles
     */
    public function setVehiclePopulation($vehiclePopulation)
    {
    	$this->vehiclePopulation = $vehiclePopulation;
    	
    	return $this;
    }
    /**
     * Get vehiclePopulation
     *
     * @return string
     */
    public function getVehiclePopulation()
    {
    	return $this->vehiclePopulation;
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
