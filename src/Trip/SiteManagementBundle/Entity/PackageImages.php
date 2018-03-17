<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 * @ORM\Table(name="package_images")
 * @ORM\Entity
 */
class PackageImages
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
     * @ORM\ManyToOne(targetEntity="Trip\SiteManagementBundle\Entity\Package", inversedBy="images")
     * @ORM\JoinColumn(name="package_id", referencedColumnName="id")
     */
    private $package;
	
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
	public function getPackage() {
		return $this->package;
	}
	
	/**
	 *
	 * @param unknown_type $package        	
	 */
	public function setPackage($package) {
		$this->package = $package;
		return $this;
	}
	
    
    
	
	
    
}
