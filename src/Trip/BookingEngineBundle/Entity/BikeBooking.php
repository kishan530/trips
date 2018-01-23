<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * BikeBooking
 *
 * @ORM\Table(name="booking_bike_services")
 * @ORM\Entity
 */
class BikeBooking
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
     * @var integer
     * @ORM\Column(name="bikeid", type="integer")
     */
    private $bikeId;
    /**
     * @var string
     * @ORM\Column(name="bikename", type="string")
     */
    private $bikename;
    
    /**
     * @var string
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    /**
     * @var string
     * @ORM\Column(name="pdate", type="string")
     */
    private $pdate;
    /**
     * @var string
     * @ORM\Column(name="rdate", type="string")
     */
    private $rdate;
    /**
     * @var integer
     * @ORM\Column(name="leftdays", type="integer")
     */
    private $leftdays;
    /**
     * @var integer
     * @ORM\Column(name="hours", type="integer")
     */
    private $hours;
    /**
     * @var string
     * @ORM\Column(name="bikelocation", type="string")
     */
    private $bikelocation;
    
    /**
     * @ORM\OneToOne(targetEntity="Trip\BookingEngineBundle\Entity\Booking", inversedBy="bikeBooking")
     * @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     */
    private $booking;
    
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
	 *
	 * @return the integer
	 */
	public function getBikeId() {
		return $this->hotelId;
	}
	
	/**
	 *
	 * @param
	 *        	$bikeId
	 */
	public function setBikeId($bikeId) {
		$this->bikeId = $bikeId;
		return $this;
	}
     /**
	 *
	 * @return the string
	 */
	public function getPrice() {
		return $this->price;
	}
	
	/**
	 *
	 * @param
	 *        	$price
	 */
	public function setPrice($price) {
		$this->price = $price;
		return $this;
	}
     /**
	 * @return the integer
	 */
	public function getBooking() {
		return $this->booking;
	}
	
	/**
	 * @param
	 *        	$booking
	 */
	public function setBooking($booking) {
		$this->booking = $booking;
		return $this;
	}
    /**
     * @return string
     */
    public function getBikename()
    {
        return $this->bikename;
    }

    /**
     * @param string $bikename
     */
    public function setBikename($bikename)
    {
        $this->bikename = $bikename;
    }
    /**
     * @return string
     */
    public function getBikelocation()
    {
        return $this->bikelocation;
    }

    /**
     * @param string $bikelocation
     */
    public function setBikelocation($bikelocation)
    {
        $this->bikelocation = $bikelocation;
    }
    /**
     * @return string
     */
    public function getPdate()
    {
        return $this->pdate;
    }

    /**
     * @param string $pdate
     */
    public function setPdate($pdate)
    {
        $this->pdate = $pdate;
    }
    /**
     * @return string
     */
    public function getRdate()
    {
        return $this->rdate;
    }

    /**
     * @param string $rdate
     */
    public function setRdate($rdate)
    {
        $this->rdate = $rdate;
    }
    /**
     * @return integer
     */
    public function getLeftdays()
    {
        return $this->leftdays;
    }

    /**
     * @param integer $leftdays
     */
    public function setLeftdays($leftdays)
    {
        $this->leftdays = $leftdays;
    }
    /**
     * @return integer
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param integer $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }


    
}
