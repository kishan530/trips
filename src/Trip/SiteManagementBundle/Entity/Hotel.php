<?php

namespace Trip\SiteManagementBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity
 */
class Hotel
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="string", length=3000)
     */
    private $overview;
    /**
     * @var string
     *
     * @ORM\Column(name="property_type", type="string", length=50)
     */
    private $propertyType;
    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="integer")
     */
    private $category;
    /**
     * @var string
     *
     * @ORM\Column(name="check_in", type="string", length=100)
     */
    private $checkIn;
    /**
     * @var string
     *
     * @ORM\Column(name="check_out", type="string", length=100)
     */
    private $checkOut;
    
    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100)
     */
    private $city;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="num_rooms", type="integer")
     */
    private $numRooms;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="sold_out", type="boolean")
     */
    private $soldOut;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer")
     */
    private $priority;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer")
     */
    private $cityId;
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="footer_display", type="boolean")
     */
    private $footerDisplay;
    
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=100)
     */
    private $url;
    
    /**
     * @var string
     *
     * @ORM\Column(name="metaTitle", type="string", length=100)
     */
    private $metaTitle;
    
    /**
     * @var string
     *
     * @ORM\Column(name="metaKeywords", type="string", length=100)
     */
    private $metaKeywords;
    
    /**
     * @var string
     *
     * @ORM\Column(name="metaDescription", type="string", length=1000)
     */
    private $metaDescription;
    
    /**
     * @var string
     * @ORM\Column(name="hotelblock_start_date", type="date")
     */
    private $hotelblockStartDate;
    
    /**
     * @var string
     * @ORM\Column(name="hotelblock_end_date", type="date")
     */
    private $hotelblockEndDate;
    
    
    
    /**
     * @var string
     * @ORM\Column(name="audit_info_CREATED_AT", type="datetime", nullable=true)
     * @Assert\Date()
     */
    private $auditInfocreatedAt;
    
    /**
     * @var string
     *
     * @ORM\Column(name="audit_info_CREATED_BY", type="string", length=100)
     */
    private $auditInfocreatedBy;
    
    /**
     * @var string
     * @ORM\Column(name="audit_info_UPDATED_AT", type="datetime", nullable=true)
     * @Assert\Date()
     */
    private $auditInfoupdatedAt;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="audit_info_UPDATED_BY", type="string", length=5000)
     */
    private $auditInfoupdatedBy;
    
    
    
    
    
    /**
     * @var Collection
     * @ORM\OneToOne(targetEntity="Trip\SiteManagementBundle\Entity\HotelAddress", mappedBy="hotel", cascade={"persist"})
     */
    protected $address;
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\HotelImage", mappedBy="hotel", cascade={"persist"})
     */
    protected $images;
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\HotelAmenities", mappedBy="hotel", cascade={"persist"})
     */
    protected $amenities;
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\HotelRoom", mappedBy="hotel", cascade={"all"})
     */
    protected $hotelRooms;
    
    /**
     *
     */
    public function __construct() {
        $this->images = new ArrayCollection();
        $this->amenities = new ArrayCollection();
        $this->hotelRooms = new ArrayCollection();
        
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
     * @return the string
     */
    public function getOverview() {
        return $this->overview;
    }
    
    /**
     *
     * @param
     *        	$overview
     */
    public function setOverview($overview) {
        $this->overview = $overview;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getPropertyType() {
        return $this->propertyType;
    }
    
    /**
     *
     * @param
     *        	$propertyType
     */
    public function setPropertyType($propertyType) {
        $this->propertyType = $propertyType;
        return $this;
    }
    
    /**
     *
     * @return the integer
     */
    public function getCategory() {
        return $this->category;
    }
    
    /**
     *
     * @param
     *        	$category
     */
    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getCheckIn() {
        return $this->checkIn;
    }
    
    /**
     *
     * @param
     *        	$checkIn
     */
    public function setCheckIn($checkIn) {
        $this->checkIn = $checkIn;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getCheckOut() {
        return $this->checkOut;
    }
    
    /**
     *
     * @param
     *        	$checkOut
     */
    public function setCheckOut($checkOut) {
        $this->checkOut = $checkOut;
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
    public function getCity() {
        return $this->city;
    }
    
    /**
     *
     * @param
     *        	$city
     */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }
    
    /**
     *
     * @return the integer
     */
    public function getNumRooms() {
        return $this->numRooms;
    }
    
    /**
     *
     * @param
     *        	$numRooms
     */
    public function setNumRooms($numRooms) {
        $this->numRooms = $numRooms;
        return $this;
    }
    
    /**
     *
     * @return the integer
     */
    public function getCityId() {
        return $this->cityId;
    }
    
    /**
     *
     * @param
     *        	$cityId
     */
    public function setCityId($cityId) {
        $this->cityId = $cityId;
        return $this;
    }
    
    /**
     *
     * @return the boolean
     */
    public function getActive() {
        return $this->active;
    }
    
    /**
     *
     * @param
     *        	$active
     */
    public function setActive($active) {
        $this->active = $active;
        return $this;
    }
    
    /**
     *
     * @return the Collection
     */
    public function getAddress() {
        return $this->address;
    }
    
    /**
     *
     * @param
     *        	$address
     */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }
    
    /**
     *
     * @return the Collection
     */
    public function getImages() {
        return $this->images;
    }
    
    /**
     *
     * @param
     *        	$images
     */
    public function setImages($images) {
        $this->images = $images;
        return $this;
    }
    
    /**
     *
     * @return the Collection
     */
    public function getAmenities() {
        return $this->amenities;
    }
    
    /**
     *
     * @param
     *        	$amenities
     */
    public function setAmenities($amenities) {
        $this->amenities = $amenities;
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
     * @return the integer
     */
    public function getPriority() {
        return $this->priority;
    }
    
    /**
     *
     * @param
     *        	$priority
     */
    public function setPriority($priority) {
        $this->priority = $priority;
        return $this;
    }
    
    /**
     *
     * @return the Collection
     */
    public function getHotelRooms() {
        return $this->hotelRooms;
    }
    
    /**
     *
     * @param
     *        	$hotelRooms
     */
    public function setHotelRooms($hotelRooms) {
        $this->hotelRooms = $hotelRooms;
        return $this;
    }
    
    /**
     *
     * @return the boolean
     */
    public function getFooterDisplay() {
        return $this->footerDisplay;
    }
    
    /**
     *
     * @param
     *        	$footerDisplay
     */
    public function setFooterDisplay($footerDisplay) {
        $this->footerDisplay = $footerDisplay;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getUrl() {
        return $this->url;
    }
    
    /**
     *
     * @param
     *        	$url
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getMetaTitle() {
        return $this->metaTitle;
    }
    
    /**
     *
     * @param
     *        	$metaTitle
     */
    public function setMetaTitle($metaTitle) {
        $this->metaTitle = $metaTitle;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getMetaKeywords() {
        return $this->metaKeywords;
    }
    
    /**
     *
     * @param
     *        	$metaKeywords
     */
    public function setMetaKeywords($metaKeywords) {
        $this->metaKeywords = $metaKeywords;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getMetaDescription() {
        return $this->metaDescription;
    }
    
    /**
     *
     * @param
     *        	$metaDescription
     */
    public function setMetaDescription($metaDescription) {
        $this->metaDescription = $metaDescription;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getHotelblockStartDate() {
        return $this->hotelblockStartDate;
    }
    
    /**
     *
     * @param
     *        	$hotelblockStartDate
     */
    public function setHotelblockStartDate($hotelblockStartDate) {
        $this->hotelblockStartDate = $hotelblockStartDate;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getHotelblockEndDate() {
        return $this->hotelblockEndDate;
    }
    
    /**
     *
     * @param
     *        	$hotelblockEndDate
     */
    public function setHotelblockEndDate($hotelblockEndDate) {
        $this->hotelblockEndDate = $hotelblockEndDate;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getAuditInfocreatedAt() {
        return $this->auditInfocreatedAt;
    }
    
    /**
     *
     * @param
     *        	$auditInfocreatedAt
     */
    public function setAuditInfocreatedAt($auditInfocreatedAt) {
        $this->auditInfocreatedAt = $auditInfocreatedAt;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getAuditInfocreatedBy() {
        return $this->auditInfocreatedBy;
    }
    
    /**
     *
     * @param
     *        	$auditInfocreatedBy
     */
    public function setAuditInfocreatedBy($auditInfocreatedBy) {
        $this->auditInfocreatedBy = $auditInfocreatedBy;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getAuditInfoupdatedAt() {
        return $this->auditInfoupdatedAt;
    }
    
    /**
     *
     * @param
     *        	$auditInfoupdatedAt
     */
    public function setAuditInfoupdatedAt($auditInfoupdatedAt) {
        $this->auditInfoupdatedAt = $auditInfoupdatedAt;
        return $this;
    }
    
    /**
     *
     * @return the string
     */
    public function getAuditInfoupdatedBy() {
        return $this->auditInfoupdatedBy;
    }
    
    /**
     *
     * @param
     *        	$auditInfoupdatedBy
     */
    public function setAuditInfoupdatedBy($auditInfoupdatedBy) {
        $this->auditInfoupdatedBy = $auditInfoupdatedBy;
        return $this;
    }
    
    
}
