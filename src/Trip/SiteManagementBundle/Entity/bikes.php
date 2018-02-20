<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * bikes
 *
 * @ORM\Table(name="bikes")
 * @ORM\Entity
 */
class bikes
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=100)
     */
    private $metaTitle;
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
     * @var float
     *
     * @ORM\Column(name="stating_price", type="float")
     */
    private $statingPrice;

     /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=50)
     */
    private $location;
    /**
     * @var string
     *
     * @ORM\Column(name="img_path", type="string", length=25)
     */    
    private $imgPath;

    /**
     * @var integer
     *
     * @ORM\Column(name="location_id", type="integer")
     */
    private $locationId;

    /**
     * @var string
     *
     * @ORM\Column(name="location_url", type="string", length=100)
     */
    private $locationUrl;
    /**
     * @var string
     * @ORM\Column(name="prefer_time", type="string", length=100)
     */
    private $preferTime;
    /**
     * @var float
     *
     * @ORM\Column(name="five_hours", type="float")
     */
    private $fivehours;
    /**
     * @var float
     *
     * @ORM\Column(name="day_rent", type="float")
     */
    private $dayrent;
    /**
     * @var boolean
     *
     * @ORM\Column(name="soldOut", type="boolean")
     */
    private $soldOut;
    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

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
     * Set title
     *
     * @param string $title
     * @return PackageTitle
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return PackageTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    
        return $this;
    }
    /**
     * Get metaTitle
     *
     * @return string 
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
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
	 * $metaKeywords
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
     * Set statingPrice
     *
     * @param float $statingPrice
     * @return PackageTitle
     */
    public function setStatingPrice($statingPrice)
    {
        $this->statingPrice = $statingPrice;
    
        return $this;
    }

    /**
     * Get statingPrice
     *
     * @return float 
     */
    public function getStatingPrice()
    {
        return $this->statingPrice;
    }

    /**
     * Set imgPath
     *
     * @param string $imgPath
     * @return PackageTitle
     */
    public function setImgPath($imgPath)
    {
        $this->imgPath = $imgPath;
    
        return $this;
    }

    /**
     * Get imgPath
     *
     * @return string 
     */
    public function getImgPath()
    {
        return $this->imgPath;
    }

    /**
     * Set locationId
     *
     * @param \Integer $locationId
     * @return PackageTitle
     */
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
    
        return $this;
    }

    /**
     * Get locationId
     *
     * @return \Integer 
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * Set locationUrl
     *
     * @param string $locationUrl
     * @return bikes
     */
    public function setLocationUrl($locationUrl)
    {
        $this->locationUrl = $locationUrl;
    
        return $this;
    }

    /**
     * Get locationUrl
     *
     * @return string 
     */
    public function getLocationUrl()
    {
        return $this->locationUrl;
    }
	
	/**
	 *
	 * @return the string
	 */
	public function getPreferTime() {
		return $this->preferTime;
	}
	
	/**
	 *
	 * @param
	 *        	$preferTime
	 */
	public function setPreferTime($preferTime) {
		$this->preferTime = $preferTime;
		return $this;
	}
	
	/**
	 *
	 * @return the float
	 */
	public function getFivehours() {
		return $this->fivehours;
	}
	
	/**
	 *
	 * @param
	 *        	$fivehours
	 */
	public function setFivehours($fivehours) {
		$this->fivehours = $fivehours;
		return $this;
	}
	
	/**
	 *
	 * @return the float
	 */
	public function getDayrent() {
		return $this->dayrent;
	}
	
	/**
	 *
	 * @param
	 *        	$dayrent
	 */
	public function setDayrent($dayrent) {
		$this->dayrent = $dayrent;
		return $this;
	}
    /**
     * @return boolean
     */
    public function isSoldOut()
    {
        return $this->soldOut;
    }

    /**
     * @param boolean $soldOut
     */
    public function setSoldOut($soldOut)
    {
        $this->soldOut = $soldOut;
    }
    /**
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param integer $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }


	
	
	
    
   

}
