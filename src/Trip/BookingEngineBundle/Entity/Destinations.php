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
     *
     * @ORM\Column(name="dest_location", type="integer", length=100)
     */
    private $dest_location;
    /**
     * @var string
     *
     * @ORM\Column(name="dest_url", type="string", length=100)
     */
    private $dest_url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    /**
     * @ORM\OneToMany(targetEntity="Trip\BookingEngineBundle\Entity\Destinationlocations", mappedBy="dest_id", cascade={"all"},  fetch="EAGER")
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
    public function getDest_location()
    {
        return $this->dest_location;
    }

    /**
     * @param string $dest_location
     */
    public function setDest_location($dest_location)
    {
        $this->dest_location = $dest_location;
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
    public function getDest_url()
    {
        return $this->dest_url;
    }

    /**
     * @param string $dest_url
     */
    public function setDest_url($dest_url)
    {
        $this->dest_url = $dest_url;
    }
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDestloc()
    {
        return $this->destloc;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $destloc
     */
    public function setDestloc($destloc)
    {
        $this->destloc = $destloc;
    }




   
}
