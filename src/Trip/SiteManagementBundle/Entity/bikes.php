<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var integer
     *
     * @ORM\Column(name="kmlimit", type="integer")
     */
    private $kmlimit;
    
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\bikespackage", mappedBy="bikes", cascade={"all"},  fetch="EAGER")
     */
    private $bikespackage;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\BikesCity", mappedBy="bikes", cascade={"all"},  fetch="EAGER")
     */
    private $bikescity;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\BikesCityArea", mappedBy="bikes", cascade={"all"},  fetch="EAGER")
     */
    private $bikescityarea;
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    /**
     * @var integer
     *
     * @ORM\Column(name="packageoffer", type="integer")
     */
    private $packageoffer;
    /**
     * @var integer
     *
     * @ORM\Column(name="speedlimit", type="integer")
     */
    private $speedlimit;
    /**
     * @var integer
     *
     * @ORM\Column(name="excess", type="integer")
     */
    private $excess;
    /**
     * @var string
     */
    private $packagelist;
    
    public function __construct() {
        $this->bikespackage = new ArrayCollection();
        $this->packagelist = new ArrayCollection();
        $this->bikescity = new ArrayCollection();
        $this->bikescityarea = new ArrayCollection();
    }
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPackagelist()
    {
        return $this->packagelist;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $packagelist
     */
    public function setPackagelist($packagelist)
    {
        $this->packagelist = $packagelist;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @return integer
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @return integer
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @return float
     */
    public function getStatingPrice()
    {
        return $this->statingPrice;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getImgPath()
    {
        return $this->imgPath;
    }

    /**
     * @return integer
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * @return string
     */
    public function getLocationUrl()
    {
        return $this->locationUrl;
    }

    /**
     * @return string
     */
    public function getPreferTime()
    {
        return $this->preferTime;
    }

    /**
     * @return float
     */
    public function getFivehours()
    {
        return $this->fivehours;
    }

    /**
     * @return float
     */
    public function getDayrent()
    {
        return $this->dayrent;
    }

    /**
     * @return boolean
     */
    public function isSoldOut()
    {
        return $this->soldOut;
    }

    /**
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return integer
     */
    public function getKmlimit()
    {
        return $this->kmlimit;
    }

    /**
     * @return \Trip\SiteManagementBundle\Entity\ArrayCollection
     */
    public function getBikespackage()
    {
        return $this->bikespackage;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * @param integer $metaKeywords
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
    }

    /**
     * @param integer $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @param float $statingPrice
     */
    public function setStatingPrice($statingPrice)
    {
        $this->statingPrice = $statingPrice;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param string $imgPath
     */
    public function setImgPath($imgPath)
    {
        $this->imgPath = $imgPath;
    }

    /**
     * @param integer $locationId
     */
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
    }

    /**
     * @param string $locationUrl
     */
    public function setLocationUrl($locationUrl)
    {
        $this->locationUrl = $locationUrl;
    }

    /**
     * @param string $preferTime
     */
    public function setPreferTime($preferTime)
    {
        $this->preferTime = $preferTime;
    }

    /**
     * @param float $fivehours
     */
    public function setFivehours($fivehours)
    {
        $this->fivehours = $fivehours;
    }

    /**
     * @param float $dayrent
     */
    public function setDayrent($dayrent)
    {
        $this->dayrent = $dayrent;
    }

    /**
     * @param boolean $soldOut
     */
    public function setSoldOut($soldOut)
    {
        $this->soldOut = $soldOut;
    }

    /**
     * @param integer $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @param integer $kmlimit
     */
    public function setKmlimit($kmlimit)
    {
        $this->kmlimit = $kmlimit;
    }

    /**
     * @param \Trip\SiteManagementBundle\Entity\ArrayCollection $bikespackage
     */
    public function setBikespackage($bikespackage)
    {
        $this->bikespackage = $bikespackage;
    }
    /**
     * @return \Trip\SiteManagementBundle\Entity\ArrayCollection
     */
    public function getBikescity()
    {
        return $this->bikescity;
    }

    /**
     * @param \Trip\SiteManagementBundle\Entity\ArrayCollection $bikescity
     */
    public function setBikescity($bikescity)
    {
        $this->bikescity = $bikescity;
    }
    /**
     * @return \Trip\SiteManagementBundle\Entity\ArrayCollection
     */
    public function getBikescityarea()
    {
        return $this->bikescityarea;
    }

    /**
     * @param \Trip\SiteManagementBundle\Entity\ArrayCollection $bikescityarea
     */
    public function setBikescityarea($bikescityarea)
    {
        $this->bikescityarea = $bikescityarea;
    }
    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
    /**
     * @return integer
     */
    public function getPackageoffer()
    {
        return $this->packageoffer;
    }

    /**
     * @param integer $packageoffer
     */
    public function setPackageoffer($packageoffer)
    {
        $this->packageoffer = $packageoffer;
    }

    /**
     * @return integer
     */
    public function getSpeedlimit()
    {
        return $this->speedlimit;
    }

    /**
     * @param integer $speedlimit
     */
    public function setSpeedlimit($speedlimit)
    {
        $this->speedlimit = $speedlimit;
    }

    /**
     * @return integer
     */
    public function getExcess()
    {
        return $this->excess;
    }

    /**
     * @param integer $excess
     */
    public function setExcess($excess)
    {
        $this->excess = $excess;
    }





}
