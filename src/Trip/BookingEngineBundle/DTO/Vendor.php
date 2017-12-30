<?php

namespace Trip\BookingEngineBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Vendor
 */
class Vendor
{
    /**
     * @var integer
     *
     */
    private $id;
	/**
     * @var string
     */
   private $companyname;
	/**
     * @var string
     */
    private $name;
	/**
     * @var string
     */
    private $email;
	 /**
     * @var string
     */
    private $mobileNo;
	/**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $pancard;
	/**
     * @var string
     *
     */
    private $pancardid;
	/**
     * @var string
     */
    private $gstno;
	/**
     * @var string
     */
	private $idproof;
	 /**
     * @var integer
     */
    private $registraionFee;
	
	
/**
     * @var Collection
     */
    private $vehicles;	
    /**
     * @var Collection
     */
    private $drivers;	
	/**
     * @var Collection
     */
    private $vehiclesList;
    /**
     * @var Collection
     */
    private $driversList;
    /**
     * @var string
     *
     */
    private $vendorId;
  

   
        public function __construct()
    {
        $this->vehicles = new ArrayCollection();
        $this->drivers = new ArrayCollection();
		$this->driversList = new ArrayCollection();
         $this->vehiclesList = new ArrayCollection();
    }
    
  /**
     * 
     *
     * @return integer
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }

   /**
	 *
	 * @param
	 *        	$id
	 */
    public function setVehicles($vehicles)
    {
    	$this->vehicles= $vehicles;

        return $this;
    }
	  /**
	 *
	 * @return the integer
	 */
	public function getVehiclesList() {
		return $this->vehiclesList;
	}
	
	/**
	 *
	 * @param
	 *        	$vehiclesList
	 */
	public function setVehiclesList($vehiclesList) {
		$this->vehiclesList = $vehiclesList;
		return $this;
	}
	/**
     * 
     *
     * @return integer
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    /**
     * 
     *
     * @param  $drivers
     * 
     */
    public function setDrivers($drivers)
    {
    	$this->drivers= $drivers;

        return $this;
    }
	  /**
	 *
	 * @return the integer
	 */
	public function getDriversList() {
		return $this->driversList;
	}
	
	/**
	 *
	 * @param
	 *        	$driversList
	 */
	public function setDriversList($driversList) {
		$this->driversList = $driversList;
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
     * Set companyname
     *
     * @param string $companyname
     * @return Vendor
     */
    public function setCompanyname($companyname)
    {
    	$this->companyname= $companyname;

        return $this;
    }

    /**
     * Get companyname
     *
     * @return string 
     */
    public function getCompanyname()
    {
    	return $this->companyname;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Vendor
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
    	return $this->name;
    }
	 /**
     * Set email
     *
     * @param string $email
     * @return Vendor
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
    	return $this->email;
    }
    
    /**
     * Set mobileNo
     *
     * @param string $mobileNo
     * @return Vendor
     */
    public function setmobileNo($mobileNo)
    {
    	$this->mobileNo = $mobileNo;
    	
    	return $this;
    }
    /**
     * Get mobileNo
     *
     * @return string
     */
    public function getmobileNo()
    {
    	return $this->mobileNo;
    }
    
    /**
     * Set address
     *
     * @param string $address
     * @return Vendor
     */
    public function setAddress($address)
    {
    	$this->address = $address;
    	
    	return $this;
    }
    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
    	return $this->address;
    }

    /**
     * Set pancard
     *
     * @param string $pancard
     * @return Vendor
     */
    public function setPancard($pancard)
    {
    	$this->pancard= $pancard;

        return $this;
    }

    /**
     * Get pancard
     *
     * @return string 
     */
    public function getPancard()
    {
    	return $this->pancard;
    }
/**
     * Set pancardid
     *
     * @param string $pancardid
     * @return Vendor
     */
    public function setPancardid($pancardid)
    {
    	$this->pancardid= $pancardid;

        return $this;
    }

    /**
     * Get pancardid
     *
     * @return string 
     */
    public function getPancardid()
    {
    	return $this->pancardid;
    }
    
    /**
	 *
	 * @return the integer
	 */
    public function getgstno() {
    	return $this->gstno;
	}
	
	/**
	 *
	 * @param
	 *        	$gstno
	 */
	public function setgstno($gstno) {
		$this->gstno= $gstno;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getRegistraionFee() {
		return $this->registraionFee;
	}
	
	/**
	 *
	 * @param
	 *        	$registraionFee
	 */
	public function setRegistraionFee($registraionFee) {
		$this->registraionFee = $registraionFee;
		return $this;
	}
	/**
	 *
	 * @return the string
	 */
	public function getidProof() {
		return $this->idproof;
	}
	
	/**
	 *
	 * @param
	 *        	$idproof
	 */
	public function setidProof($idproof) {
		$this->idproof = $idproof;
		return $this;
	}
	/**
	 *
	 * @return the string
	 */
	public function getVendorId() {
		return $this->vendorId;
	}
	
	/**
	 *
	 * @param
	 *        	$vendorId
	 */
	public function setVendorId($vendorId) {
		$this->vendorId = $vendorId;
		return $this;
	}
	
	
	


}
