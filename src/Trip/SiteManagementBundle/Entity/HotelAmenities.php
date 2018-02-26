<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotelAddress
 *
 * @ORM\Table(name="hotel_amenities")
 * @ORM\Entity
 */
class HotelAmenities
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(name="image", type="string", length=150)
     */
    private $image;
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
	

    /**
     * @ORM\ManyToOne(targetEntity="Trip\SiteManagementBundle\Entity\Hotel", inversedBy="amenities")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    protected $hotel;
	
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
	public function getImage() {
		return $this->image;
	}
	
	/**
	 *
	 * @param
	 *        	$image
	 */
	public function setImage($image) {
		$this->image = $image;
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
	 * @return the unknown_type
	 */
	public function getHotel() {
		return $this->hotel;
	}
	
	/**
	 *
	 * @param unknown_type $hotel        	
	 */
	public function setHotel($hotel) {
		$this->hotel = $hotel;
		return $this;
	}
	
	
	
	
	
	
}
