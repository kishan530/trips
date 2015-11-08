<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of City
 *
 *
 * Contact
 */
class Cancel
{
    /**
     * @var integer
     */
    private $bookingId;
    /**
     * @var string
     */
    private $email;
    
    
    /**

     * Set bookingId

     *

     * @param string $bookingId

     * @return Booking

     */

    public function setBookingId($bookingId)
    {
        $this->bookingId = $bookingId;
        return $this;
    }
    /**
     * Get bookingId
     *
     * @return string
     */

    public function getBookingId()
    {
        return $this->bookingId;
    }
    
        /**
     * Set email
     *
     * @param string $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
}
