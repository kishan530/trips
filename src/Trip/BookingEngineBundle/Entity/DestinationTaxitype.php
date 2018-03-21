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
 * @ORM\Table(name="destination_pages_taxifare")
 * @ORM\Entity
 */
class DestinationTaxitype
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
     * @ORM\Column(name="taxi_type", type="string", length=150)
     */
    private $taxitype;
    /**
     * @var float
     *
     * @ORM\Column(name="priceper_day", type="float")
     */
    private $priceperday;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    /**
     * @ORM\ManyToOne(targetEntity="Trip\BookingEngineBundle\Entity\Destinationlocations", inversedBy="desttaxitype")
     * @ORM\JoinColumn(name="dest_loc_id", referencedColumnName="id")
     */
    private $dest_loc_id;
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
    public function getTaxitype()
    {
        return $this->taxitype;
    }

    /**
     * @param string $taxitype
     */
    public function setTaxitype($taxitype)
    {
        $this->taxitype = $taxitype;
    }

    /**
     * @return float
     */
    public function getPriceperday()
    {
        return $this->priceperday;
    }

    /**
     * @param float $priceperday
     */
    public function setPriceperday($priceperday)
    {
        $this->priceperday = $priceperday;
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
