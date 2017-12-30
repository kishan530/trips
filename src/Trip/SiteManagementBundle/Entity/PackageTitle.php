<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageTitle
 *
 * @ORM\Table(name="package_title")
 * @ORM\Entity
 */
class PackageTitle
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
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;


    

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
     * @return PackageTitle
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
    
    public function getLocation() {
        return $this->location;
    }

    public function setLocation($location) {
        $this->location = $location;
    }
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


}
