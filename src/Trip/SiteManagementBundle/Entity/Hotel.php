<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var string
     *
     * @ORM\Column(name="image_path", type="string", length=100)
     */
    private $imagePath;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_rooms", type="integer")
     */
    private $numRooms;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer")
     */
    private $cityId;
    /**
     * @var text
     *
     * @ORM\Column(name="overview", type="text")
     */
	 private $overview;
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    /**
     * @var Collection
     * @ORM\OneToOne(targetEntity="Trip\SiteManagementBundle\Entity\HotelAddress", mappedBy="hotel", cascade={"persist"})
	 
     */
    protected $address;
	/**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\HotelImage", mappedBy="hotel", cascade={"persist"})
     */
	protected $image;

	 
    /**
    *
    */
  public function __construct() {
        //$this->address = new ArrayCollection();
		$this->image = new ArrayCollection();
    }


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
     * Set name
     *
     * @param string $name
     * @return Hotel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
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
     * Set city
     *
     * @param string $city
     * @return Hotel
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set imagePath
     *
     * @param string $imagePath
     * @return Hotel
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * Get imagePath
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Set numRooms
     *
     * @param integer $numRooms
     * @return Hotel
     */
    public function setNumRooms($numRooms)
    {
        $this->numRooms = $numRooms;

        return $this;
    }

    /**
     * Get numRooms
     *
     * @return integer 
     */
    public function getNumRooms()
    {
        return $this->numRooms;
    }

    /**
     * Set cityId
     *
     * @param integer $cityId
     * @return Hotel
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * Get cityId
     *
     * @return integer 
     */
    public function getCityId()
    {
        return $this->cityId;
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
     * Set address
     *
     * @param $address
     * @return Hotel
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return address 
     */
    public function getAddress()
    {
        return $this->address;
    }
	 /**
     * Set image
     *
     * @param $image
     * @return Hotel
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return image 
     */
    public function getImage()
    {
        return $this->image;
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
