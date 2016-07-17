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
    public function setLocationId(\Integer $locationId)
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


}
