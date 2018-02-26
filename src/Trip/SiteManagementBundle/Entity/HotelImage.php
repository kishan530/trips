<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 * @ORM\Table(name="hotel_image")
 * @ORM\Entity
 */
class HotelImage
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
     *
     * @ORM\Column(name="url", type="string", length=150)
     */
    private $url;
    
    /**
     * @ORM\ManyToOne(targetEntity="Trip\SiteManagementBundle\Entity\Hotel", inversedBy="images")
     * @ORM\JoinColumn(name="Hotel_id", referencedColumnName="id")
     */
    private $hotel;
	
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
	public function getUrl() {
		return $this->url;
	}
	
	/**
	 *
	 * @param
	 *        	$url
	 */
	public function setUrl($url) {
		$this->url = $url;
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
	public function sethotel($hotel) {
		$this->hotel = $hotel;
		return $this;
	}
	
    
    
	
	
    
}
