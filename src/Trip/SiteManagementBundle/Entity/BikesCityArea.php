<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BikesCityArea
 *
 * @ORM\Table(name="bike_city_area")
 * @ORM\Entity
 */
class BikesCityArea
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
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer", length=11)
     */
    private $cityid;
    /**
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=255)
     */
    private $area;
    /**
     * @var boolean
     *
     * @ORM\Column(name="soldOut", type="boolean")
     */
    private $soldOut;
    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;
    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active;
    /**
     * @var integer
     *
     * @ORM\Column(name="bike_id", type="integer")
     */
    private $bikeid;
    
    /**
     * @ORM\ManyToOne(targetEntity="Trip\SiteManagementBundle\Entity\bikes", inversedBy="bikescityarea")
     * @ORM\JoinColumn(name="bike_id", referencedColumnName="id")
     */
    private $bikes;
    
    
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
     * @return integer
     */
    public function getCityid()
    {
        return $this->cityid;
    }

    /**
     * @param integer $cityid
     */
    public function setCityid($cityid)
    {
        $this->cityid = $cityid;
    }

    /**
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param string $area
     */
    public function setArea($area)
    {
        $this->area = $area;
    }

    /**
     * @return boolean
     */
    public function isSoldOut()
    {
        return $this->soldOut;
    }

    /**
     * @param boolean $soldOut
     */
    public function setSoldOut($soldOut)
    {
        $this->soldOut = $soldOut;
    }

    /**
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param integer $count
     */
    public function setCount($count)
    {
        $this->count = $count;
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
    public function getBikes()
    {
        return $this->bikes;
    }

    /**
     * @param mixed $bikes
     */
    public function setBikes($bikes)
    {
        $this->bikes = $bikes;
    }
    /**
     * @return integer
     */
    public function getBikeid()
    {
        return $this->bikeid;
    }

    /**
     * @param integer $bikeid
     */
    public function setBikeid($bikeid)
    {
        $this->bikeid = $bikeid;
    }


    
    
    
   

}
