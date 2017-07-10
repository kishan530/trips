<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 * @ORM\Table(name="billing_places_to_visit")
 * @ORM\Entity
 */
class BillingPlacesToVisit
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
     * @ORM\Column(name="location", type="integer")
     */
    private $location;
   
    private $active;
    /**
     * @ORM\ManyToOne(targetEntity="Trip\SiteManagementBundle\Entity\Billing", inversedBy="locations")
     * @ORM\JoinColumn(name="billing_id", referencedColumnName="id")
     */
    private $billing;
	
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
	public function getLocation() {
		return $this->location;
	}
	
	/**
	 *
	 * @param
	 *        	$location
	 */
	public function setLocation($location) {
		$this->location = $location;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getActive() {
		return $this->active;
	}
	
	/**
	 *
	 * @param unknown_type $active        	
	 */
	public function setActive($active) {
		$this->active = $active;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getBilling() {
		return $this->billing;
	}
	
	/**
	 *
	 * @param unknown_type $booking        	
	 */
	public function setBilling($billing) {
		$this->billing = $billing;
		return $this;
	}
	
    
    
    
}
