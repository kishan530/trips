<?php

namespace Trip\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This is a Entity to hold the data of City
 *
 *
 * User_doc
 * @ORM\Table(name="user_doc")
 * @ORM\Entity
 */
class Docupload
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
     * @ORM\Column(name="imgfront",type="string", length=255)
     */
    private $imgfront;
    
    /**
     * @var integer
     * @ORM\Column(name="user_id",type="integer", length=100)
     */
    private $userid;
   
    public function __construct() {
        
        $this->imgfront = new ArrayCollection();
       
    }
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
     * @return \Trip\BookingEngineBundle\Entity\ArrayCollection
     */
    public function getImgfront()
    {
        return $this->imgfront;
    }

    /**
     * @param \Trip\BookingEngineBundle\Entity\ArrayCollection $imgfront
     */
    public function setImgfront($imgfront)
    {
        $this->imgfront = $imgfront;
    }

    /**
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param integer $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    
}
