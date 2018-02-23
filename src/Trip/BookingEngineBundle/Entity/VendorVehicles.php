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
	  * @var string
	  *
	  * @ORM\Column(name="vehicle_number", type="string")
	  */
	 private $vehicleNumber;
	 /**
	  * @var string
	  *
	  * @ORM\Column(name="vehicle_color", type="string")
	  */
	 private $vehicleColor;
	 /**
	  * @var integer
	  *
	  * @ORM\Column(name="vehicle_capacity", type="integer")
	  */
	 private $vehicleCapacity;
	 /**
	  * @var string
	  *
	  * @ORM\Column(name="fuel_type", type="string")
	  */
	 private $fuelType;
	 /**
	  * @var integer
	  *
	  * @ORM\Column(name="manfacture_year", type="integer")
	  */
	 private $vehicleManfactureYear;
	 
	 /**
	  * @var string
	  *
	  * @ORM\Column(name="manfacture_company", type="string")
	  */
	 private $vehicleManfactureCompany;
	 /**
	  * @var string
	  *
	  * @ORM\Column(name="chassis_number", type="string")
	  */
	 private $vehicleChassisNumber;
	 /**
	  * @var string
	  *
	  * @ORM\Column(name="engine_number", type="string")
	  */
	 private $vehicleEngineNumber;
    /**
     * @return string
     */
    public function getVehicleNumber()
    {
        return $this->vehicleNumber;
    }

    /**
     * @return string
     */
    public function getVehicleColor()
    {
        return $this->vehicleColor;
    }

    /**
     * @return integer
     */
    public function getVehicleCapacity()
    {
        return $this->vehicleCapacity;
    }

    /**
     * @return string
     */
    public function getFuelType()
    {
        return $this->fuelType;
    }

    /**
     * @return integer
     */
    public function getVehicleManfactureYear()
    {
        return $this->vehicleManfactureYear;
    }

    /**
     * @return string
     */
    public function getVehicleManfactureCompany()
    {
        return $this->vehicleManfactureCompany;
    }

    /**
     * @return string
     */
    public function getVehicleChassisNumber()
    {
        return $this->vehicleChassisNumber;
    }

    /**
     * @return string
     */
    public function getVehicleEngineNumber()
    {
        return $this->vehicleEngineNumber;
    }

    /**
     * @param string $vehicleNumber
     */
    public function setVehicleNumber($vehicleNumber)
    {
        $this->vehicleNumber = $vehicleNumber;
    }

    /**
     * @param string $vehicleColor
     */
    public function setVehicleColor($vehicleColor)
    {
        $this->vehicleColor = $vehicleColor;
    }

    /**
     * @param integer $vehicleCapacity
     */
    public function setVehicleCapacity($vehicleCapacity)
    {
        $this->vehicleCapacity = $vehicleCapacity;
    }

    /**
     * @param string $fuelType
     */
    public function setFuelType($fuelType)
    {
        $this->fuelType = $fuelType;
    }

    /**
     * @param integer $vehicleManfactureYear
     */
    public function setVehicleManfactureYear($vehicleManfactureYear)
    {
        $this->vehicleManfactureYear = $vehicleManfactureYear;
    }

    /**
     * @param string $vehicleManfactureCompany
     */
    public function setVehicleManfactureCompany($vehicleManfactureCompany)
    {
        $this->vehicleManfactureCompany = $vehicleManfactureCompany;
    }

    /**
     * @param string $vehicleChassisNumber
     */
    public function setVehicleChassisNumber($vehicleChassisNumber)
    {
        $this->vehicleChassisNumber = $vehicleChassisNumber;
    }

    /**
     * @param string $vehicleEngineNumber
     */
    public function setVehicleEngineNumber($vehicleEngineNumber)
    {
        $this->vehicleEngineNumber = $vehicleEngineNumber;
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
