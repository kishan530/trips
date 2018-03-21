<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Destinationlocations
 *
 * @ORM\Table(name="destination_locations")
 * @ORM\Entity
 */
class Destinationlocations
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
     * @var string
     * @ORM\Column(name="meta_keywords", type="string", length=5000,nullable=true)
     */
    private $metakeywords;
    /**
     * @var string
     * @ORM\Column(name="meta_des", type="string", length=5000,nullable=true)
     */
    private $metades;
    /**
     * @var integer
     * @ORM\Column(name="pick_location", type="integer", length=100,nullable=true)
     */
    private $picklocation;
    /**
     * @var integer
     * @ORM\Column(name="drop_location", type="integer", length=100,nullable=true)
     */
    private $droplocation;
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=50)
     */
    private $url;
    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=25)
     */
    private $img;
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    /**
     * @var integer
     *
     * @ORM\Column(name="dest_id", type="integer", length=25)
     */
    private $destid;
    /**
     * @ORM\ManyToOne(targetEntity="Trip\BookingEngineBundle\Entity\Destinations", inversedBy="destloc")
     * @ORM\JoinColumn(name="dest_id", referencedColumnName="id")
     */
    private $popular;
	/**
     * @ORM\OneToMany(targetEntity="Trip\BookingEngineBundle\Entity\DestinationContent", mappedBy="dest_loc_id", cascade={"all"},  fetch="EAGER")
     */
    private $destcont;
    /**
     * @ORM\OneToMany(targetEntity="Trip\BookingEngineBundle\Entity\DestinationTaxitype", mappedBy="dest_loc_id", cascade={"all"},  fetch="EAGER")
     */
    private $desttaxitype;

    public function __construct() {
        $this->destcont = new ArrayCollection();
        $this->desttaxitype = new ArrayCollection();
    }
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
    public function getMetakeywords()
    {
        return $this->metakeywords;
    }

    /**
     * @param string $metakeywords
     */
    public function setMetakeywords($metakeywords)
    {
        $this->metakeywords = $metakeywords;
    }

    /**
     * @return string
     */
    public function getMetades()
    {
        return $this->metades;
    }

    /**
     * @param string $metades
     */
    public function setMetades($metades)
    {
        $this->metades = $metades;
    }

    

    /**
     * @return integer
     */
    public function getPicklocation()
    {
        return $this->picklocation;
    }

    /**
     * @param integer $picklocation
     */
    public function setPicklocation($picklocation)
    {
        $this->picklocation = $picklocation;
    }

    /**
     * @return integer
     */
    public function getDroplocation()
    {
        return $this->droplocation;
    }

    /**
     * @return integer
     */
    public function getDestid()
    {
        return $this->destid;
    }

    /**
     * @param integer $destid
     */
    public function setDestid($destid)
    {
        $this->destid = $destid;
    }

    /**
     * @param integer $droplocation
     */
    public function setDroplocation($droplocation)
    {
        $this->droplocation = $droplocation;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDestcont()
    {
        return $this->destcont;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $destcont
     */
    public function setDestcont($destcont)
    {
        $this->destcont = $destcont;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
     * @return mixed
     */
    public function getPopular()
    {
        return $this->popular;
    }

    /**
     * @param mixed $popular
     */
    public function setPopular($popular)
    {
        $this->popular = $popular;
    }
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDesttaxitype()
    {
        return $this->desttaxitype;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $desttaxitype
     */
    public function setDesttaxitype($desttaxitype)
    {
        $this->desttaxitype = $desttaxitype;
    }


   
}
