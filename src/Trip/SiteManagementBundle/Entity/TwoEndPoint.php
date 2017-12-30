<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Endpoint2
 *
 * @ORM\Table(name="package_two_end_point")
 * @ORM\Entity
 */
class TwoEndPoint
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
     * @ORM\Column(name="end_point", type="string", length=50)
     * @Assert\Length(max = 100, maxMessage="Your Name cannot contain more then 50")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z&]+([s ][A-Za-z&]+)*$/",
     *     match=true,
     *     message="Please enter a valid Name"
     * )
     */
    private $name;
   
    private $active;
    /**
     * @ORM\ManyToOne(targetEntity="Trip\SiteManagementBundle\Entity\Package", inversedBy="twoendPoint")
     * @ORM\JoinColumn(name="package_id", referencedColumnName="id")
     */
    private $booking;
    
    
	
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
    
    /**
	 * @return the integer
	 */
	public function getBooking() {
		return $this->booking;
	}
	
	/**
	 * @param
	 *        	$booking
	 */
	public function setBooking($booking) {
		$this->booking = $booking;
		return $this;
	}
}
