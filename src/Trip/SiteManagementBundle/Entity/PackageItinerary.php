<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 * @ORM\Table(name="package_itinerary")
 * @ORM\Entity
 */
class PackageItinerary
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
     * @ORM\Column(name="title", type="string", length=150)
     */
    private $title;
    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=4000,nullable=true)
     * @Assert\Length(max = 4000, maxMessage="Your description cannot contain more then 4000 Characters") 
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="Trip\SiteManagementBundle\Entity\Package", inversedBy="itinerary")
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
	 *
	 * @return the string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 *
	 * @param
	 *        	$description
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
    
    function getPackage() {
        return $this->package;
    }

    function setPackage($package) {
        $this->package = $package;
    }


    
}
