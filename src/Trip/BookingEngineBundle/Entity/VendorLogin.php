<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Trip\SiteManagementBundle\DTO\TestCustomer as TestCustomerDto;

/**
 * Vendor
 *
 * @ORM\Table(name="vendor_login")
 * @ORM\Entity
 */
class VendorLogin
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
     * @ORM\Column(name="name", type="string")
     */
   
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string")
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="mobileNo", type="string")
     */
    private $mobileNo;
     /**
     * @var string
     *
     * @ORM\Column(name="vendorPwd", type="string")
     * 
     */
    private $vendorPwd;
   
    /**
     * @var string
     *
     * @ORM\Column(name="vendor_id", type="string")
     *
     */
    private $vendor_id;
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
     * Set vendorPwd
     *
     * @param string $vendorPwd
     * @return Vendor
     */
    public function setVendorPwd($vendorPwd)
    {
    	$this->vendorPwd= $vendorPwd;
    	
    	return $this;
    }
    /**
     * Get vendorPwd
     *
     * @return string
     */
    public function getVendorPwd()
    {
    	return $this->vendorPwd;
    }
   
    /**
     * Set vendor_id
     *
     * @param string $vendor_id
     * @return Vendor
     */
    public function setVendor_id($vendor_id)
    {
        $this->vendor_id = $vendor_id;

        return $this;
    }
    /**
     * Get vendor_id
     *
     * @return string
     */
    public function getVendor_id()
    {
    	return $this->vendor_id;
    }
  
	
	
}
