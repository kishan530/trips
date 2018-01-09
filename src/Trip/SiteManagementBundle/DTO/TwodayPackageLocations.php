<?php

namespace Trip\SiteManagementBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact

 */
class TwodayPackageLocations
{


    /**
     * @var string
     */
    private $location;
     /**
     * @var string
     */

    private $type;
    /**
     * @var string
     */
    private $package;

    /**
     * @var string
     */function getLocation() {
        return $this->location;
    }

    function getType() {
        return $this->type;
    }

    function getPackage() {
        return $this->package;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setPackage($package) {
        $this->package = $package;
    }
    
	
	
    
}
