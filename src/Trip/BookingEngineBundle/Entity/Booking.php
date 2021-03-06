<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity
 * @ORM\NamedQueries({
 *     @ORM\NamedQuery(name="bookings", query="SELECT b FROM TripBookingEngineBundle:Booking b WHERE ( :bookingId is null OR b.bookingId like :bookingId ) AND b.bookedOn BETWEEN  :start AND :end ORDER BY b.bookedOn DESC")
 * })
 */
class Booking
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var integer
     * @ORM\Column(name="customer_id", type="integer")
     */
    private $customerId;
    /**
     * @var integer
     * @ORM\Column(name="booking_id",type="string", length=100)
     */
    private $bookingId;
    /**
     * @var integer
     * @ORM\Column(name="total_price", type="float")
     */
    private $totalPrice;   
    /**
     * @var string
     * @ORM\Column(name="discount", type="float")
     */
    private $discount;
    /**
     * @var integer
     * @ORM\Column(name="final_price", type="float")
     */
    private $finalPrice;
    /**
     * Tax
     * @ORM\Column(name="tax", type="float")
     */
     private $tax;
    /**
     * Tax
     * @ORM\Column(name="service_tax", type="float")
     */
     private $serviceTax;
    /**
     * @var float
     *
     * @ORM\Column(name="swach_bharth_cess", type="float")
     */
    private $swachBharthCess;

    /**
     * @var float
     *
     * @ORM\Column(name="krishi_kalyan_cess", type="float")
     */
    private $krishiKalyanCess;
    /**
     * @var integer
     * @ORM\Column(name="amount_paid", type="float")
     */
    private $amountPaid;
    /**
     * @var integer
     * @ORM\Column(name="payment_id", type="string", length=100)
     */
    private $paymentId;
    /**
     * @var string
     * @ORM\Column(name="coupon_code", type="string", length=100)
     */
    private $couponCode; 
    /**
     * @var string
     * @ORM\Column(name="is_coupon_applyed", type="boolean")
     */
    private $couponApplyed; 
    /**
     * @var string
     * @ORM\Column(name="num_of_days", type="integer")
     */
    private $numDays;
    /**
     * @var integer
     * @ORM\Column(name="num_of_adult", type="integer")
     */
    private $numAdult;
    /**
     * @var string
     * @ORM\Column(name="prefer_time", type="string", length=100)
     */
    private $preferTime;
    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=100)
     */
    private $status;   
    /**
     * @var string
     * @ORM\Column(name="job_status", type="string", length=100)
     */
    private $jobStatus;
    
    /**
     * @var string
     * @ORM\Column(name="booked_on", type="date")
     */
    private $bookedOn;
    /**

     * @var integer

     * @ORM\Column(name="payment_mode", type="string")

     */

    private $paymentMode;
    
    /**
     * @ORM\OneToOne(targetEntity="Trip\BookingEngineBundle\Entity\BikeBooking", mappedBy="booking", cascade={"persist"})
     */
    private $bikeBooking;

    
    public function __construct() {
    	//$this->hotelBooking = new ArrayCollection();
    	//$this->vehicleBooking = new ArrayCollection();
    	//$this->bikeBooking = new ArrayCollection();
    }
     
    
    /**
	 *
	 * @return the integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @param
	 *        	$id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}  
     /**

     * Set customerId

     *

     * @param string $customerId

     * @return Booking

     */

    public function setCustomerId($customerId)

    {

        $this->customerId = $customerId;



        return $this;

    }



    /**

     * Get customerId

     *

     * @return string

     */

    public function getCustomerId()

    {

        return $this->customerId;

    }
     /**

     * Set bookingId

     *

     * @param string $bookingId

     * @return Booking

     */

    public function setBookingId($bookingId)
    {
        $this->bookingId = $bookingId;
        return $this;
    }
    /**
     * Get bookingId
     *
     * @return string
     */

    public function getBookingId()
    {
        return $this->bookingId;
    }
    
     /**

     * Set totalPrice

     *

     * @param integer $totalPrice

     * @return Booking

     */

    public function setTotalPrice($totalPrice)

    {

    	$this->totalPrice = $totalPrice;

    

    	return $this;

    }

    

    /**

     * Get totalPrice

     *

     * @return integer

     */

    public function getTotalPrice()

    {

    	return $this->totalPrice;

    }

    
     /**

     * Set discount

     *

     * @param string $discount

     * @return discount

     */

    public function setDiscount($discount)

    {

    	$this->discount = $discount;

    	return $this;

    }

    

    /**

     * Get discount

     *

     * @return integer

     */

    public function getDiscount()

    {

    	return $this->discount;

    }
    
    /**

     * Set finalPrice
     *
     * @param integer $finalPrice
     * @return Booking
     */

    public function setFinalPrice($finalPrice)

    {

    	$this->finalPrice = $finalPrice;

    

    	return $this;

    }

    

    /**

     * Get finalPrice

     *

     * @return integer

     */

    public function getFinalPrice()

    {

    	return $this->finalPrice;

    }
    /**
	 *
	 * @return the double
	 */
	public function getTax() {
		return $this->tax;
	}
	
	/**
	 *
	 * @param
	 *        	$tax
	 */
	public function setTax($tax) {
		$this->tax = $tax;
		return $this;
	}
    
     /**
	 *
	 * @return the double
	 */
	public function getServiceTax() {
		return $this->serviceTax;
	}
	
	/**
	 *
	 * @param
	 *        	$serviceTax
	 */
	public function setServiceTax($serviceTax) {
		$this->serviceTax = $serviceTax;
		return $this;
	}
    
    /**
	 *
	 * @return the float
	 */
	public function getSwachBharthCess() {
		return $this->swachBharthCess;
	}
	
	/**
	 *
	 * @param
	 *        	$swachBharthCess
	 */
	public function setSwachBharthCess($swachBharthCess) {
		$this->swachBharthCess = $swachBharthCess;
		return $this;
	}
	
	/**
	 *
	 * @return the float
	 */
	public function getKrishiKalyanCess() {
		return $this->krishiKalyanCess;
	}
	
	/**
	 *
	 * @param
	 *        	$krishiKalyanCess
	 */
	public function setKrishiKalyanCess($krishiKalyanCess) {
		$this->krishiKalyanCess = $krishiKalyanCess;
		return $this;
	}
	
    
    /**

     * Set amountPaid

     *

     * @param integer $amountPaid

     * @return amountPaid

     */

    public function setAmountPaid($amountPaid)

    {

    	$this->amountPaid = $amountPaid;

    

    	return $this;

    }

    

    /**

     * Get amountPaid

     *

     * @return integer

     */

    public function getAmountPaid()

    {

    	return $this->amountPaid;

    }

    

    /**

     * Set paymentId

     *

     * @param integer $paymentId

     * @return paymentId

     */

    public function setPaymentId($paymentId)

    {

    	$this->paymentId = $paymentId;

    

    	return $this;

    }

    

    /**

     * Get paymentId

     *

     * @return integer

     */

    public function getPaymentId()

    {

    	return $this->paymentId;

    }
    
     /**

     * Set status

     *

     * @param string $status

     * @return Booking

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
     * Set jobStatus
     *
     * @param string $jobStatus
     * @return RTO
     */
    public function setJobStatus($jobStatus)
    {
    	$this->jobStatus =$jobStatus;
    
    	return $this;
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
	 *
	 * @return the string
	 */
	public function getCouponCode() {
		return $this->couponCode;
	}
	
	/**
	 *
	 * @param
	 *        	$couponCode
	 */
	public function setCouponCode($couponCode) {
		$this->couponCode = $couponCode;
		return $this;
	}
    
    /**
	 *
	 * @return the integer
	 */
	public function getCouponApplyed() {
		return $this->couponApplyed;
	}
	
	/**
	 *
	 * @param
	 *        	couponApplyed
	 */
	public function setCouponApplyed($couponApplyed) {
		$this->couponApplyed = $couponApplyed;
		return $this;
	}
    
    
     /**
	 *
	 * @return the string
	 */
	public function getNumDays() {
		return $this->numDays;
	}
	
	/**
	 *
	 * @param
	 *        	$numDays
	 */
	public function setNumDays($numDays) {
		$this->numDays = $numDays;
		return $this;
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
    
    /**
     * Set preferTime
     * @param string $preferTime
     * @return Booking
     */

    public function setPreferTime($preferTime)
    {
    	$this->preferTime = $preferTime;
    	return $this;
    }
    /**
     * Get preferTime
     * @return string
     */
    public function getPreferTime()
    {
    	return $this->preferTime;
    }
    
    /**
	 *
	 * @return the string
	 */
	public function getBookedOn() {
		return $this->bookedOn;
	}
	
	/**
	 *
	 * @param
	 *        	$bookedOn
	 */
	public function setBookedOn($bookedOn) {
		$this->bookedOn = $bookedOn;
		return $this;
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
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getBikeBooking()
    {
        return $this->bikeBooking;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $bikeBooking
     */
    public function setBikeBooking($bikeBooking)
    {
        $this->bikeBooking = $bikeBooking;
    }

	 
    
    
}
