<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Driver
 *
 * @ORM\Table(name="drivers")
 * @ORM\Entity
 */
class Driver
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
	 
    /**
    *
    */
  /*public function __construct() {
        //$this->address = new ArrayCollection();
		$this->image = new ArrayCollection();
    }*/


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
     * @return Driver
     */
    public function setName($name)
    {
    	$this->name= $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getname()
    {
    	return $this->name;
    }
    
}
