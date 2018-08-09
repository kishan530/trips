<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**

 * Contact
 * @ORM\Table(name="contact_us")
 * @ORM\Entity
 */
class Contact
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
     * @ORM\Column(name="first_name", type="string", length=50)
     * @Assert\Length(max = 100, maxMessage="Your Name cannot contain more then 50")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z&]+([s ][A-Za-z&]+)*$/",
     *     match=true,
     *     message="Please enter a valid Name"
     * )
     */
    private $firstName;
    /**
     * @var string
     * @ORM\Column(name="last_name", type="string", length=20)
     * @Assert\Length(max = 100, maxMessage="Your Name cannot contain more then 20")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z&]+([s ][A-Za-z&]+)*$/",
     *     match=true,
     *     message="Please enter a valid Name"
     * )
     */
    private $lastName;
    /**
     * @ORM\Column(name="email", type="string", length=50)
     * @Assert\Email(
     *     message = "The email-id '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

     /**
     * @var string
     * @ORM\Column(name="phone_number", type="string", length=100)
     * @Assert\Length(min = 10, max = 15, maxMessage="Your mobile cannot contain more then 15")
     * @Assert\Regex(
     *     pattern="/^([+0-9]{1,3})?([0-9]{10,12})$/i",
     *     message= "Invalid mobile no."
     * )
     */
    private $phoneNumber;
    /**
     * @var string
     * @ORM\Column(name="subject", type="string", length=100)
     */
    private $subject;
   /**
     * @ORM\Column(name="message", type="string", length=100)
     * @Assert\Length(max = 5000, maxMessage="Your address cannot contain more then 1000 Characters")
     * @var string
     * 
     */
    private $message;
	
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
	public function getFirstName() {
		return $this->firstName;
	}
	
	/**
	 *
	 * @param
	 *        	$firstName
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getLastName() {
		return $this->lastName;
	}
	
	/**
	 *
	 * @param
	 *        	$lastName
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 *
	 * @param unknown_type $email        	
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}
	
	/**
	 *
	 * @param
	 *        	$phoneNumber
	 */
	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
		return $this;
	}
    
    /**
     * Set subject
     *
     * @param string $subject
     * @return Mail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }
	
	/**
	 *
	 * @return the string
	 */
	public function getMessage() {
		return $this->message;
	}
	
	/**
	 *
	 * @param
	 *        	$message
	 */
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	
    
}
