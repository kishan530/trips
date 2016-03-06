<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 * @ORM\Table(name="vehicle")
 * @ORM\Entity
 */
class Vehicle
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="model", type="string", length=50)
     * @Assert\Length(max = 100, maxMessage="Your Name cannot contain more then 50")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z&]+([s ][A-Za-z&]+)*$/",
     *     match=true,
     *     message="Please enter a valid Name"
     * )
     */
    private $model;
    /**
     * @var string
     * @ORM\Column(name="capcity", type="string", length=80)
     * @Assert\Length(max = 100, maxMessage="Your Name cannot contain more then 80")
     */
    private $capcity;
    

    
    /**
     * @var string
     * @ORM\Column(name="imgPath", type="string", length=50)
     */
    private $imgPath;
    /**
     * @var string
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    /**
     * @var string
     * @ORM\Column(name="extra_day_price", type="float")
     */
    private $extraPrice;
    /**
     * @var string
     * @ORM\Column(name="daily_rent", type="float")
     */
    private $dailyRent;
    /**
     * @var string
     * @ORM\Column(name="mileage", type="string")
     */
    private $mileage;
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
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
	 * @return the string
	 */
	public function getModel() {
		return $this->model;
	}
	
	/**
	 *
	 * @param
	 *        	$model
	 */
	public function setModel($model) {
		$this->model = $model;
		return $this;
	}
	
	
	

    /**
	 *
	 * @return the string
	 */
	public function getImgPath() {
		return $this->imgPath;
	}
	
	/**
	 *
	 * @param
	 *        	$imgPath
	 */
	public function setImgPath($imgPath) {
		$this->imgPath = $imgPath;
		return $this;
	}
    
        /**
	 *
	 * @return the string
	 */
	public function getCapcity() {
		return $this->capcity;
	}
	
	/**
	 *
	 * @param
	 *        	$capcity
	 */
	public function setCapcity($capcity) {
		$this->capcity = $capcity;
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
	 *
	 * @return the string
	 */
	public function getExtraPrice() {
		return $this->extraPrice;
	}
	
	/**
	 *
	 * @param
	 *        	$extraPrice
	 */
	public function setExtraPrice($extraPrice) {
		$this->extraPrice = $extraPrice;
		return $this;
	}
     /**
	 *
	 * @return the string
	 */
	public function getDailyRent() {
		return $this->dailyRent;
	}
	
	/**
	 *
	 * @param
	 *        	$dailyRent
	 */
	public function setDailyRent($dailyRent) {
		$this->dailyRent = $dailyRent;
		return $this;
	}
    /**
	 *
	 * @return the string
	 */
	public function getMileage() {
		return $this->mileage;
	}
	
	/**
	 *
	 * @param
	 *        	$mileage
	 */
	public function setMileage($mileage) {
		$this->mileage = $mileage;
		return $this;
	}
    
    /**
     * Set active
     *
     * @param $active
     * @return Hotel
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return active 
     */
    public function getActive()
    {
        return $this->active;
    }
	
    
}
