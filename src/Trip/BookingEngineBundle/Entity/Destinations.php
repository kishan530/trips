<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Destinations
 *
 * @ORM\Table(name="destinations")
 * @ORM\Entity
 */
class Destinations
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
     * @ORM\Column(name="dest_location", type="string", length=50)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="dest_url", type="string", length=100)
     */
    private $desturl;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    /**
     * @ORM\OneToMany(targetEntity="Trip\BookingEngineBundle\Entity\Destinationlocations", mappedBy="popular", cascade={"all"})
     */
    private $destloc;
    
    public function __construct() {
        $this->destloc = new ArrayCollection();
        
    }
   
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return string
     */
    public function getDesturl()
    {
        return $this->desturl;
    }

    /**
     * @param string $desturl
     */
    public function setDesturl($desturl)
    {
        $this->desturl = $desturl;
    }
    /**
     * @return mixed
     */
    public function getDestloc()
    {
        return $this->destloc;
    }

    /**
     * @param mixed $destloc
     */
    public function setDestloc($destloc)
    {
        $this->destloc = $destloc;
    }


    
}
