<?php

namespace Trip\SiteManagementBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * HotelRoom
 *
 *
 * 
 */
class HotelRoomDto
{
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var string
     */
    private $roomType;
   
    /**
     * @var string
     *
     * 
     */
    private $capacity;
   
    /**
     * @var float
     *
     *
     */
    private $price;

    /**
     * @var string
     *
     * 
     */
    private $imagePath;

    
    /**
     * @var string
     *
     * 
     */
    private $maxAdult;
    
    /**
     * @var string
     *
     * 
     */
    private $maxChild;
    
    /**
     * @var string
     *
     *
     */
    private $description;
    
    /**
     * @var string
     *
     *
     */
    private $name;
    
    /**
     * @var boolean
     *
     *
     */
    private $soldOut;
    
    /**
     * @var date
     */
    private $blockStartDate;
    
    /**
     * @var date
     */
    private $blockEndDate;
    
    /**
     * @var integer
     *
     */
    private $sequence;
    
    /**
     * @var date
     */
    private $promotionStartDate;
    
    /**
     * @var date
     */
    private $promotionEndDate;
    
    /**
     * @var float
     *
     *
     */
    private $promotionPrice;
    
    /**
     * @var boolean
     *
     *
     */
    private $isDeleted;
      
     /**
     * @var string
     *
     * 
     */
    protected $hotel;
    
    public function __construct() {
    	$this->images = new ArrayCollection();
    	$this->amenities = new ArrayCollection();
    	$this->hotelRoom = new ArrayCollection();
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
	 *
	 * @return the string
	 */
	public function getRoomType() {
		return $this->roomType;
	}
	
	/**
	 *
	 * @param
	 *        	$roomType
	 */
	public function setRoomType($roomType) {
		$this->roomType = $roomType;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getCapacity() {
		return $this->capacity;
	}
	
	/**
	 *
	 * @param
	 *        	$capacity
	 */
	public function setCapacity($capacity) {
		$this->capacity = $capacity;
		return $this;
	}
	
	/**
	 *
	 * @return the float
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
	public function getImagePath() {
		return $this->imagePath;
	}
	
	/**
	 *
	 * @param
	 *        	$imagePath
	 */
	public function setImagePath($imagePath) {
		$this->imagePath = $imagePath;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getMaxAdult() {
		return $this->maxAdult;
	}
	
	/**
	 *
	 * @param
	 *        	$maxAdult
	 */
	public function setMaxAdult($maxAdult) {
		$this->maxAdult = $maxAdult;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getMaxChild() {
		return $this->maxChild;
	}
	
	/**
	 *
	 * @param
	 *        	$maxChild
	 */
	public function setMaxChild($maxChild) {
		$this->maxChild = $maxChild;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getHotel() {
		return $this->hotel;
	}
	
	/**
	 *
	 * @param
	 *        	$hotel
	 */
	public function setHotel($hotel) {
		$this->hotel = $hotel;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 *
	 * @param
	 *        	$description
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 *
	 * @param
	 *        	$name
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	/**
	 *
	 * @return the boolean
	 */
	public function getSoldOut() {
		return $this->soldOut;
	}
	
	/**
	 *
	 * @param
	 *        	$soldOut
	 */
	public function setSoldOut($soldOut) {
		$this->soldOut = $soldOut;
		return $this;
	}
	
	/**
	 *
	 * @return the date
	 */
	public function getBlockStartDate() {
		return $this->blockStartDate;
	}
	
	/**
	 *
	 * @param
	 *        	$blockStartDate
	 */
	public function setBlockStartDate($blockStartDate) {
		$this->blockStartDate = $blockStartDate;
		return $this;
	}
	
	/**
	 *
	 * @return the date
	 */
	public function getBlockEndDate() {
		return $this->blockEndDate;
	}
	
	/**
	 *
	 * @param
	 *        	$blockEndDate
	 */
	public function setBlockEndDate($blockEndDate) {
		$this->blockEndDate = $blockEndDate;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getSequence() {
		return $this->sequence;
	}
	
	/**
	 *
	 * @param
	 *        	$sequence
	 */
	public function setSequence($sequence) {
		$this->sequence = $sequence;
		return $this;
	}
	
	/**
	 *
	 * @return the date
	 */
	public function getPromotionStartDate() {
		return $this->promotionStartDate;
	}
	
	/**
	 *
	 * @param
	 *        	$promotionStartDate
	 */
	public function setPromotionStartDate($promotionStartDate) {
		$this->promotionStartDate = $promotionStartDate;
		return $this;
	}
	
	/**
	 *
	 * @return the date
	 */
	public function getPromotionEndDate() {
		return $this->promotionEndDate;
	}
	
	/**
	 *
	 * @param
	 *        	$promotionEndDate
	 */
	public function setPromotionEndDate($promotionEndDate) {
		$this->promotionEndDate = $promotionEndDate;
		return $this;
	}
	
	/**
	 *
	 * @return the float
	 */
	public function getPromotionPrice() {
		return $this->promotionPrice;
	}
	
	/**
	 *
	 * @param
	 *        	$promotionPrice
	 */
	public function setPromotionPrice($promotionPrice) {
		$this->promotionPrice = $promotionPrice;
		return $this;
	}
	
	/**
	 *
	 * @return the boolean
	 */
	public function getIsDeleted() {
		return $this->isDeleted;
	}
	
	/**
	 *
	 * @param
	 *        	$isDeleted
	 */
	public function setIsDeleted($isDeleted) {
		$this->isDeleted = $isDeleted;
		return $this;
	}
	
	
	
	
	
	
	
	

    
}