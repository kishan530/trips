<?php
namespace Trip\SiteManagementBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * This is a DTO to hold the data of BookingSearch
 */
class BookingSearch
{
    


   /**
     * @var string
     */
    private $area;

    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $jobStatus;
    /**
     * @var string
     */
    private $booked_by;
    /**
     * @var string
     */
    private $start_date;
    /**
     * @var string
     */
    private $end_date;
    /**
     * @var string
     */
    private $bookingID;
    /**
     * @var string
     */
    private $serviceType;
    /**
     * @var string
     */
    private $service;
    /**
     * @var integer
     */
    private $mobile;
    /**
     * @var string
     */
    private $firstName;
    
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $vehicleType;
    /**
     * @var string
     */
    private $active;
    /**
     * @var string
     */
    private $from_booking;
    /**
     * @var string
     */
    private $paymentMode;
    /**
     * @var integer
     * 
     */
    private $paymentMethod;
    /**
     * @var string
     */
    private $searchBy;
    /**
     * 
     * @var unknown
     */
    private $Vehicle;
    /**
     * Set area
     *
     * @param string $area
     * @return BookingSearch
     */    
    public function setArea($area)
    {
    	$this->area = $area;
    
    	return $this;
    }
    
    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
    	return $this->area;
    }
    
    /**
     * Set city
     *
     * @param string $city
     * @return BookingSearch
     */
    public function setCity($city)
    {
    	$this->city = $city;
    
    	return $this;
    }
    
    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
    	return $this->city;
    }
	
    /**
     * Set status
     *
     * @param string $status
     * @return BookingSearch
     */
    public function setStatus($status)
    {
    	$this->status = $status;
    
    	return $this;
    }
    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
    	return $this->status;
    }
    
    /**
     * Get jobStatus
     *
     * @return string
     */
    public function getJobStatus()
    {
    	return $this->jobStatus;
    }
    /**
     * Set jobStatus
     *
     * @param string $jobStatus
     * @return BookingSearch
     */
    public function setJobStatus($jobStatus)
    {
    	$this->jobStatus = $jobStatus;
    
    	return $this;
    }
    
   
    /**
     * Set booked_by
     *
     * @param string $booked_by
     * @return BookingSearch
     */
    public function setBookedBy($booked_by)
    {
    	$this->booked_by = $booked_by;
    
    	return $this;
    }
    
    /**
     * Get booked_by
     *
     * @return string
     */
    public function getBookedBy()
    {
    	return $this->booked_by;
    }
    /**
     * Set start_date
     *
     * @param string $start_date
     * @return Booking
     */
    public function setStartDate($start_date)
    {
    	$this->start_date = $start_date;
    
    	return $this;
    }
    
    /**
     * Get start_date
     *
     * @return string
     */
    public function getStartDate()
    {
    	return $this->start_date;
    }
    
    /**
     * Set end_date
     *
     * @param string $end_date
     * @return Booking
     */
    public function setEndDate($end_date)
    {
    	$this->end_date = $end_date;
    
    	return $this;
    }
    
    /**
     * Get end_date
     *
     * @return string
     */
    public function getEndDate()
    {
    	return $this->end_date;
    }
    /**
     * Set bookingID
     *
     * @param string $bookingID
     * @return Booking
     */
    public function setBookingID($bookingID)
    {
    	$this->bookingID = $bookingID;
    
    	return $this;
    }
    /**
     * Get bookingID
     *
     * @return string
     */
    public function getBookingID()
    {
    	return $this->bookingID;
    }
    
    /**
     * Set serviceType
     *
     * @param string $bookingID
     * @return Booking
     */
    public function setServiceType($serviceType)
    {
    	$this->serviceType = $serviceType;
    
    	return $this;
    }
    /**
     * Get serviceType
     *
     * @return string
     */
    public function getServiceType()
    {
    	return $this->serviceType;
    }
    /**
     * Set service
     *
     * @param string $service
     * @return Booking
     */
    public function setService($service)
    {
    	$this->service= $service;
    
    	return $this;
    }
    /**
     * Get service
     *
     * @return string
     */
    public function getService()
    {
    	return $this->service;
    }
    /**
     * Set mobile
     *
     * @param integer $mobile
     * @return Booking
     */
    public function setMobile($mobile)
    {
    	$this->mobile = $mobile;
    
    	return $this;
    }
    /**
     * Get mobile
     *
     * @return integer
     */
    public function getMobile()
    {
    	return $this->mobile;
    }
    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Booking
     */
    public function setFirstName($firstName)
    {
    	$this->firstName = $firstName;
    
    	return $this;
    }
    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
    	return $this->firstName;
    }
    /**
     * Set username
     *
     * @param string $username
     * @return Booking
     */
    public function setUserName($username)
    {
    	$this->username = $username;
    
    	return $this;
    }
    /**
     * Get username
     *
     * @return string
     */
    public function getUserName()
    {
    	return $this->username;
    }
    /**
     * Set vehicleType
     *
     * @param string $vehicleType
     * @return Booking
     */
    public function setVehicleType($vehicleType)
    {
    	$this->vehicleType = $vehicleType;
    
    	return $this;
    }
    /**
     * Get vehicleType
     *
     * @return string
     */
    public function getVehicleType()
    {
    	return $this->vehicleType;
    }
    /**
     * Set active
     *
     * @param integer $active
     * @return Promotion
     */
    public function setActive($active)
    {
    	$this->active = $active;
    
    	return $this;
    }
    
    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
    	return $this->active;
    }
    /**
     * Set from_booking
     *
     * @param boolean $from_booking
     * @return RTO
     */
    public function setFromBooking($from_booking)
    {
    	$this->from_booking = $from_booking;
    
    	return $this;
    }
    
    /**
     * Get from_booking
     *
     * @return boolean
     */
    public function getFromBooking()
    {
    	return $this->from_booking;
    }
    
    /**
     * Set  paymentMode
     *
     * @param string  $paymentMode
     * @return Booking
     */
    public function setPaymentMode( $paymentMode)
    {
    	$this->paymentMode =  $paymentMode;
    
    	return $this;
    }
    /**
     * Get firstName
     *
     * @return string
     */
    public function getPaymentMode()
    {
    	return $this->paymentMode;
    }

	/**
	 *
	 * @return the string
	 */
	public function getSearchBy() {
		return $this->searchBy;
	}
	
	/**
	 *
	 * @param $trainingDate
	 */
	public function setSearchBy($searchBy) {
		$this->searchBy = $searchBy;
		return $this;
	}
	/**
	 * 
	 */
	public function getVehicle() {
		return $this->Vehicle;
	}
	/**
	 * 
	 * @param unknown $Vehicle
	 * @return \Drive\DashboardBundle\Form\Model\BookingSearch
	 */
	public function setVehicle($Vehicle) {
		$this->Vehicle = $Vehicle;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getPaymentMethod() {
		return $this->paymentMethod;
	}
	
	/**
	 *
	 * @param
	 *        	$paymentMethod
	 */
	public function setPaymentMethod($paymentMethod) {
		$this->paymentMethod = $paymentMethod;
		return $this;
	}
	
	
}
?>