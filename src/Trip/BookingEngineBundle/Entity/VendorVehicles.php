<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
//use Trip\SiteManagementBundle\DTO\TestCustomer as TestCustomerDto;

/**
 * Vendor
 *
 * @ORM\Table(name="vendor_vehicles")
 * @ORM\Entity
 */
class VendorVehicles
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
     *
     * @ORM\Column(name="vehicle_name", type="string")
     */
   
    private $vehicleName;

    /**
     * @var string
     *
     * @ORM\Column(name="vehicleImage", type="string")
     */
    private $vehicleImage;
    /**
     * @var string
     *
     * @ORM\Column(name="vehicle_regis_cer", type="string")
     */
    private $vehicleRegisCer;
	 /**
     * @var string
     *
     * @ORM\Column(name="vehicle_insurance", type="string")
     */
    private $vehicleInsurance;
     /**
     * @var string
     *
     * @ORM\Column(name="vehicle_population", type="string")
     * 
     */
    private $vehiclePopulation;
	
    //private $vendorId;
	 /**
     * @ORM\ManyToOne(targetEntity="Trip\BookingEngineBundle\Entity\Vendor", inversedBy="vehicles")
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
	 private $vendor;
	 /**
	  * @var string
	  *
	  * @ORM\Column(name="paymentStatus", type="string")
	  *
	  */
	 private $paymentStatus;
	 /**
	  * @var string
	  *
	  * @ORM\Column(name="insertdate", type="string")
	  *
	  */
	 private $insertdate;
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
	 * @param
	 *        	$vendor
	 */
   public function setVendor($vendor) {
		$this->vendor = $vendor;
		return $this;
	}
    
  /**
	 * @return the integer
	 */
	public function getVendor() {
		return $this->vendor;
	}
	
	/**
	 * Set paymentStatus
	 *
	 * @param string $paymentStatus
	 * @return VendorVehicles
	 */
	public function setPaymentStatus($paymentStatus)
	{
	    $this->paymentStatus = $paymentStatus;
	    
	    return $this;
	}
	/**
	 * Get paymentStatus
	 *
	 * @return string
	 */
	public function getPaymentStatus()
	{
	    return $this->paymentStatus;
	}
	/**
	 * Set insertdate
	 *
	 * @param string $insertdate
	 * @return VendorVehicles
	 */
	public function setInsertdate($insertdate)
	{
	    $this->insertdate = $insertdate;
	    
	    return $this;
	}
	/**
	 * Get insertdate
	 *
	 * @return string
	 */
	public function getInsertdate()
	{
	    return $this->insertdate;
	}
}
