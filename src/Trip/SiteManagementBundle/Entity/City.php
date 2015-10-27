<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 * @ORM\Table(name="city")
 * @ORM\Entity
 */
class City
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
     * @ORM\Column(name="name", type="string", length=50)
     * @Assert\Length(max = 100, maxMessage="Your Name cannot contain more then 50")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z&]+([s ][A-Za-z&]+)*$/",
     *     match=true,
     *     message="Please enter a valid Name"
     * )
     */
    private $name;
    /**
     * @var boolean
     *
     * @ORM\Column(name="hotel_service", type="boolean")
     */
    private $active;
    
	
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
