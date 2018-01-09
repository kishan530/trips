<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
//use Trip\SiteManagementBundle\DTO\TestCustomer as TestCustomerDto;

/**
 * Vendor
 *
 * @ORM\Table(name="vendor_driver")
 * @ORM\Entity
 */
class VendorDriver
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
     * @ORM\Column(name="drivername", type="string")
     */
   
    private $drivername;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_mobileno", type="string")
     */
    private $driverMobileno;
    /**
     * @var string
     *
     * @ORM\Column(name="driving_licence", type="string")
     */
    private $drivingLicence;
	 /**
     * @var string
     *
     * @ORM\Column(name="driver_idproof", type="string")
     */
    private $driverIdproof;
    /**
     * @var string
     *
     * @ORM\Column(name="policeVerificationLetter", type="string")
     */
    private $policeVerificationLetter;
    
	  /**
     * @ORM\ManyToOne(targetEntity="Trip\BookingEngineBundle\Entity\Vendor", inversedBy="drivers")
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
	 private $vendor;
	
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
     * Set policeVerificationLetter
     *
     * @param string $policeVerificationLetter
     * @return VendorDriver
     */
    public function setPoliceVerificationLetter($policeVerificationLetter)
    {
        $this->policeVerificationLetter = $policeVerificationLetter;
        
        return $this;
    }
    /**
     * Get policeVerificationLetter
     *
     * @return string
     */
    public function getPoliceVerificationLetter()
    {
        return $this->policeVerificationLetter;
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
	
}
