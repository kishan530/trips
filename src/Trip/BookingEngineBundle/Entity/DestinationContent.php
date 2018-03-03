<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 * @ORM\Table(name="destination_page_contents")
 * @ORM\Entity
 */
class DestinationContent
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
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    /**
     * @ORM\ManyToOne(targetEntity="Trip\BookingEngineBundle\Entity\Destinationlocations", inversedBy="destcont")
     * @ORM\JoinColumn(name="dest_loc_id", referencedColumnName="id")
     */
    private $dest_loc_id;
    
    
	
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
    public function getDest_loc_id()
    {
        return $this->dest_loc_id;
    }

    /**
     * @param mixed $dest_loc_id
     */
    public function setDest_loc_id($dest_loc_id)
    {
        $this->dest_loc_id = $dest_loc_id;
    }

	
	


    
}
