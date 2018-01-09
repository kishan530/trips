<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Trip\SiteManagementBundle\DTO\TestCustomer as TestCustomerDto;

/**
 * Vendor
 *
 * @ORM\Table(name="vendor_vehicle_fee")
 * @ORM\Entity
 */
class VendorVehicleFee
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
     * @ORM\Column(name="vehicleName", type="string")
     */
    private $vehicleName;

    /**
     * @var integer
     *
     * @ORM\Column(name="vehicleFee", type="integer", length=255)
     */
    private $vehicleFee;

    
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
     * @return VendorVehicleFee
     */
    public function setVehicleName($vehicleName)
    {
        $this->vehicleName= $vehicleName;

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
	 *
	 * @return the integer
	 */
    public function getVehicleFee() {
        return $this->vehicleFee;
	}
	
	/**
	 *
	 * @param
	 *        	$vehicleFee
	 */
	public function setVehicleFee($vehicleFee) {
	    $this->vehicleFee = $vehicleFee;
		return $this;
	}
	
	
}
