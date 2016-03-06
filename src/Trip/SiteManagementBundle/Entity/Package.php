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
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\StartPoint", mappedBy="booking", cascade={"persist"})
     */
    private $startPoint;
     /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\EndPoint", mappedBy="booking", cascade={"persist"})
     */   
    private $endPoint;
    /**
     * @ORM\OneToMany(targetEntity="Trip\SiteManagementBundle\Entity\PackagePrice", mappedBy="booking", cascade={"persist"})
     */     
    private $price;
        
    /**
     * @var string
     * @ORM\Column(name="imgPath", type="string", length=50)
     */
    private $imgPath;
    
    public function __construct() {
    	$this->startPoint = new ArrayCollection();
    	$this->endPoint = new ArrayCollection();
        $this->price = new ArrayCollection();
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
	
    
}
