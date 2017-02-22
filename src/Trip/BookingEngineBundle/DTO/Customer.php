<?php

namespace Trip\BookingEngineBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 */
class Customer
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
    private $name;

    /**
     * @var string
     *
     */
    private $email;

    /**
     * @var string
     *
     */
    private $mobile;

    /**
     * @var string
     */
    private $address; 
    /**
     * @var integer
     */
    private $paymentMode;
    /**
     * @var integer
     */
    private $numAdult;
    
     /**
     * @var string
     */
    private $multiple;
        public function __construct()
    {
        $this->multiple = new ArrayCollection();
    }
    
    /**
	 *
	 * @return the string
	 */
	public function getMultiple() {
		return $this->multiple;
	}
	
	/**
	 *
	 * @param
	 *        	$multiple
	 */
	public function setMultiple($multiple) {
		$this->multiple = $multiple;
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
     * Set name
     *
     * @param string $name
     * @return Customer
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
     * @return Customer
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
     * Set mobile
     *
     * @param string $mobile
     * @return Customer
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Customer
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

     * Set paymentMode

     *

     * @param integer $paymentMode

     * @return paymentMode

     */

    public function setPaymentMode($paymentMode)

    {

    	$this->paymentMode = $paymentMode;

    

    	return $this;

    }

    

    /**

     * Get paymentMode

     *

     * @return string

     */

    public function getPaymentMode()

    {

    	return $this->paymentMode;

    }
    
     /**
	 *
	 * @return the integer
	 */
	public function getNumAdult() {
		return $this->numAdult;
	}
	
	/**
	 *
	 * @param
	 *        	$numAdult
	 */
	public function setNumAdult($numAdult) {
		$this->numAdult = $numAdult;
		return $this;
	}
    


}
