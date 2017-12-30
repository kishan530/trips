<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 * @ORM\Table(name="packages")
 * @ORM\Entity
 */
class Package
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
     * @ORM\Column(name="package_name", type="string", length=50)
     * @Assert\Length(max = 100, maxMessage="Your Name cannot contain more then 50")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z&]+([s ][A-Za-z&]+)*$/",
     *     match=true,
     *     message="Please enter a valid Name"
     * )
     */
     private $name;
    
    /**
     * @var integer
     * @ORM\Column(name="title", type="string", length=250,nullable=true)
     */
    private $title;
    
    /**
     * @var string
     * @ORM\Column(name="overview", type="string", length=10000,nullable=true)
     */
    private $overview; 
    
    
    /**
     * @var integer
     * @ORM\Column(name="meta_keywords", type="string", length=5000,nullable=true)
     */
    private $metaKeywords;
    /**
     * @var integer
     * @ORM\Column(name="meta_discription", type="string", length=5000,nullable=true)
     */
    private $metaDescription;
    /**
     * @var integer
     * @ORM\Column(name="meta_title", type="string", length=250,nullable=true)
     */
    private $metaTitle;
    /**
     * @var integer
     * @ORM\Column(name="package_url", type="string", length=250,nullable=true)
     */
    private $packageUrl;
    
     /**
     * @var string
     * @ORM\Column(name="package_type", type="string", length=50)
     * @Assert\Length(max = 100, maxMessage="Your Type cannot contain more then 50")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z&]+([s ][A-Za-z&]+)*$/",
     *     match=true,
     *     message="Please enter a valid Type"
     * )
     */
     private $type;
    
    /**
     * @var string
     * @ORM\Column(name="code", type="string", length=50)
     */
    private $code;
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
	/**
     * @var integer
     *
     * @ORM\Column(name="category", type="integer")
     */
    private $category;
    /**
     * @var string
     * @ORM\Column(name="imgPath", type="string", length=50)
     */
    private $imgPath;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\StartPoint", mappedBy="booking", cascade={"all"},  fetch="EAGER")
     */
    private $startPoint;
     /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\EndPoint", mappedBy="booking", cascade={"all"}, fetch="EAGER")
     */   
    private $endPoint;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\EndPoint2", mappedBy="booking", cascade={"all"}, fetch="EAGER")
     */ 
    private $endPoint2;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\PackagePrice", mappedBy="package", cascade={"all"},  fetch="EAGER")
     */
    private $price;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\PackageItinerary", mappedBy="package", cascade={"all"})
     */
    private $itinerary;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\PackageContent", mappedBy="package", cascade={"all"})
     */
    private $content;
    
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\PackageImages", mappedBy="package", cascade={"persist"}, fetch="EAGER")
     */
    private $images;
    /**
     * @var string
     */
    private $itineraryList;
    /**
     * @var string
     */
    private $contentList;
    /**
     * @var string
     */
    private $imageList;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\TwoStartPoint", mappedBy="booking", cascade={"all"},  fetch="EAGER")
     */
    private $twostartPoint;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\TwoEndPoint2", mappedBy="booking", cascade={"all"}, fetch="EAGER")
     */
    private $twoendPoint2;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\TwoEndPoint", mappedBy="booking", cascade={"all"}, fetch="EAGER")
     */
    private $twoendPoint;

    
    public function __construct() {
    	$this->startPoint = new ArrayCollection();
    	$this->endPoint = new ArrayCollection();
    	$this->endPoint2 = new ArrayCollection();
        $this->price = new ArrayCollection();
         $this->itinerary = new ArrayCollection();
         $this->content = new ArrayCollection();
         $this->images = new ArrayCollection();
         $this->itineraryList = new ArrayCollection();
         $this->contentList = new ArrayCollection();
         $this->imageList = new ArrayCollection();
         $this->twostartPoint = new ArrayCollection();
         $this->twoendPoint = new ArrayCollection();
         $this->twoendPoint2 = new ArrayCollection();
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
	 *        	$firstName
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
        /**
	 *
	 * @return the string
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 *
	 * @param
	 *        	$type
	 */
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
    /**
	 *
	 * @return the string
	 */
	public function getCode() {
		return $this->code;
	}
	
	/**
	 *
	 * @param
	 *        	$firstName
	 */
	public function setCode($code) {
		$this->code = $code;
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
	 * @return the integer
	 */
	public function getStartPoint() {
		return $this->startPoint;
	}
	
	/**
	 *
	 * @param
	 *        	$id
	 */
	public function setStartPoint($startPoint) {
		$this->startPoint = $startPoint;
		return $this;
	}
    /**
	 *
	 * @param
	 *        	$id
	 */
	public function addStartPoint($startPoint) {
		$this->startPoint->add($startPoint);
		return $this;
	} 
    
    /**
	 *
	 * @return the integer
	 */
	public function getEndPoint() {
		return $this->endPoint;
	}
	
	/**
	 *
	 * @param
	 *        	$id
	 */
	public function setEndPoint($endPoint) {
		$this->endPoint = $endPoint;
		return $this;
	}
    /**
	 *
	 * @param
	 *        	$id
	 */
	public function addEndPoint($endPoint) {
		$this->endPoint->add($endPoint);
		return $this;
	} 
        /**
	 *
	 * @return the integer
	 */
	public function getEndPoint2() {
		return $this->endPoint2;
	}
	
	/**
	 *
	 * @param
	 *        	$id
	 */
	public function setEndPoint2($endPoint2) {
		$this->endPoint = $endPoint2;
		return $this;
	}
    /**
	 *
	 * @param
	 *        	$id
	 */
	public function addEndPoint2($endPoint2) {
		$this->endPoint->add($endPoint2);
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
     * Set price
     *
     * @param float $price
     * @return Hotel
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
	 *
	 * @param
	 *        	$id
	 */
	public function addPrice($price) {
		$this->price->add($price);
		return $this;
	} 
    
    
    /**
	 *
	 * @return the integer
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 *
	 * @param
	 *        	$title
	 */
	public function setTitle($title) {
		$this->title = $title;
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
	 * @return the integer
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
	 * @return the integer
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
	 * @return the integer
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
	 * @return the integer
	 */
	public function getPackageUrl() {
		return $this->packageUrl;
	}
	
	/**
	 *
	 * @param
	 *        	$packageUrl
	 */
	public function setPackageUrl($packageUrl) {
		$this->packageUrl = $packageUrl;
		return $this;
	}
    
    /**
	 *
	 * @return the integer
	 */
	public function getItinerary() {
		return $this->itinerary;
	}
	
	/**
	 *
	 * @param
	 *        	$itinerary
	 */
	public function setItinerary($itinerary) {
		$this->itinerary = $itinerary;
		return $this;
	}
    
     /**
	 *
	 * @return the integer
	 */
	public function getItineraryList() {
		return $this->itineraryList;
	}
	
	/**
	 *
	 * @param
	 *        	$itineraryList
	 */
	public function setItineraryList($itineraryList) {
		$this->itineraryList = $itineraryList;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getImages() {
		return $this->images;
	}
	
	/**
	 *
	 * @param unknown_type $images        	
	 */
	public function setImages($images) {
		$this->images = $images;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getImageList() {
		return $this->imageList;
	}
	
	/**
	 *
	 * @param
	 *        	$imageList
	 */
	public function setImageList($imageList) {
		$this->imageList = $imageList;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getContent() {
		return $this->content;
	}
	
	/**
	 *
	 * @param unknown_type $content        	
	 */
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getContentList() {
		return $this->contentList;
	}
	
	/**
	 *
	 * @param
	 *        	$contentList
	 */
	public function setContentList($contentList) {
		$this->contentList = $contentList;
		return $this;
	}
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTwostartPoint()
    {
        return $this->twostartPoint;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $twostartPoint
     */
    public function setTwostartPoint($twostartPoint)
    {
        $this->twostartPoint = $twostartPoint;
    }
    /**
     * @return mixed
     */
    public function getTwoendPoint2()
    {
        return $this->twoendPoint2;
    }

    /**
     * @param mixed $twoendPoint2
     */
    public function setTwoendPoint2($twoendPoint2)
    {
        $this->twoendPoint2 = $twoendPoint2;
    }
    /**
     * @return mixed
     */
    public function getTwoendPoint()
    {
        return $this->twoendPoint;
    }

    /**
     * @param mixed $twoendPoint
     */
    public function setTwoendPoint($twoendPoint)
    {
        $this->twoendPoint = $twoendPoint;
    }


    

}
