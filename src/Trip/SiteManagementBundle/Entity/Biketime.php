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
 * @ORM\Table(name="biketime")
 * @ORM\Entity
 */
class Biketime
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
     * @var returndate
     *
     * @ORM\Column(name="return_date", type="datetime")
     */
    private $returndate;
    /**
     * @var preferTime
     *
     * @ORM\Column(name="time", type="string")
     */
    private $preferTime;
    /**
     * @var returntime
     *
     * @ORM\Column(name="return_time", type="string")
     */
    private $returntime;
    /**
     * @var string
     *
     * @ORM\Column(name="location_url", type="string", length=100)
     */
    private $locationUrl;
	/**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;
    
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
	 * Set date
	 *
	 * @param date $date
	 * @return Billing
	 */
	public function setDate($date)
	{
		$this->date = $date;
		
		return $this;
	}
	
	/**
	 * Get date
	 *
	 * @return date
	 */
	public function getDate()
	{
		return $this->date;
	}
	/**
	 *
	 * @return the returntime
	 */
	public function getReturntime() {
		return $this->returntime;
	}
	
	/**
	 *
	 * @param
	 *        	$returntime
	 */
	public function setReturntime($returntime) {
		$this->returntime = $returntime;
		return $this;
	}
	
	/**
	 *
	 * @return the preferTime
	 */
	public function getPreferTime() {
		return $this->preferTime;
	}
	
	/**
	 *
	 * @param
	 *        	$preferTime
	 */
	public function setPreferTime($preferTime) {
		$this->preferTime = $preferTime;
		return $this;
	}
	
	/**
	 *
	 * @return the returndate
	 */
	public function getReturndate() {
		return $this->returndate;
	}
	
	/**
	 *
	 * @param
	 *        	$returndate
	 */
	public function setReturndate($returndate) {
		$this->returndate = $returndate;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getLocationUrl() {
		return $this->locationUrl;
	}
	
	/**
	 *
	 * @param
	 *        	$locationUrl
	 */
	public function setLocationUrl($locationUrl) {
		$this->locationUrl = $locationUrl;
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
	
	
    
}
