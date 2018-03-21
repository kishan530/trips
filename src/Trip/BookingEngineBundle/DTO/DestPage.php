<?php

namespace Trip\BookingEngineBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This is a Entity to hold the data of City
 *
 *
 * DestPage
 */
class DestPage
{

    /**
     * @var string
     */
    private $title;
        /**
     * @var string
     */
    private $metaTitle;
    /**
     * @var string
     */
    private $metakeywords;
    /**
     * @var integer
     */
    private $metades;
    
    /**
     * @var integer
     */
    private $pick_location;
    /**
     * @var integer
     */
    private $drop_location;
       /**
     * @var integer
     */
    private $url;
    /**
     * @var string
     */
    private $img;
    /**
     * @var boolean
     */
    private $active;
    /**
     * @var Collection
     
     */
    private $destcont;
	
    /**
     *
     */
    public function __construct() {
        $this->destcont = new ArrayCollection();
    }
	
	
    
}
