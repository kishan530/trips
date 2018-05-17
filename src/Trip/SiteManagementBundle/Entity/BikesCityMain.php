<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BikesCityMain
 *
 * @ORM\Table(name="bike_city_main")
 * @ORM\Entity
 */
class BikesCityMain
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
     *
     * @ORM\Column(name="city_id", type="integer", length=11)
     */
    private $cityid;
    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=200)
     */
    private $metaTitle;
     /**
     * @var string
     * @ORM\Column(name="meta_keywords", type="string", length=5000,nullable=true)
     */
    private $metaKeywords;
    /**
     * @var string
     * @ORM\Column(name="meta_discription", type="string", length=5000,nullable=true)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="location_url", type="string", length=100,nullable=true)
     */
    private $url;
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=100,nullable=true)
     */
    private $suburl;
    /**
     * @var string
     *
     * @ORM\Column(name="package_url", type="string", length=100,nullable=true)
     */
    private $packageurl;
    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=100,nullable=true)
     */
    private $img;
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getCityid()
    {
        return $this->cityid;
    }

    /**
     * @param integer $cityid
     */
    public function setCityid($cityid)
    {
        $this->cityid = $cityid;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param string $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param string $metaKeywords
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
     * @return string
     */
    public function getSuburl()
    {
        return $this->suburl;
    }

    /**
     * @param string $suburl
     */
    public function setSuburl($suburl)
    {
        $this->suburl = $suburl;
    }
    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }
    /**
     * @return string
     */
    public function getPackageurl()
    {
        return $this->packageurl;
    }

    /**
     * @param string $packageurl
     */
    public function setPackageurl($packageurl)
    {
        $this->packageurl = $packageurl;
    }





}
