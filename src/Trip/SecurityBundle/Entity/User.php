<?php
namespace Trip\SecurityBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	public function __construct()
	{
		parent::__construct();
		// your own logic
	}
    
    	public function setEmail($email)

	{

			 parent::setEmail($email);

			 $this->setUsername($email);

	}
    
    /**

     * @var string

     *

   	 * @ORM\Column(name="first_name", type="string", length=255, nullable=true)

     */

    protected $firstname;



    /**

     * @var string

     *

   	 * @ORM\Column(name="last_name", type="string", length=255, nullable=true)

     */

    protected $lastname;
	    /**
     * @var string
     *
     * @ORM\Column(name="profile_pic", type="string", length=100)
     */
    private $profilePic;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=100)
     */
    private $mobile;
	    /**
     * @var string
     *
     * @ORM\Column(name="dob", type="date")
     */
    private $dob;



	

	/**

     * @var string

     *

     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)

     */

    protected $facebookId;



public function serialize()

    {

        return serialize(array($this->facebookId, parent::serialize()));

    }



    public function unserialize($data)

    {

        list($this->facebookId, $parentData) = unserialize($data);

        parent::unserialize($parentData);

    }



	

	

	 /**

     * @return string

     */

    public function getFirstname()

    {

        return $this->firstname;

    }



    /**

     * @param string $firstname

     */

    public function setFirstname($firstname)

    {

        $this->firstname = $firstname;

    }



    /**

     * @return string

     */

    public function getLastname()

    {

        return $this->lastname;

    }



    /**

     * @param string $lastname

     */

    public function setLastname($lastname)

    {

        $this->lastname = $lastname;

    }
	
	 /**
     * Set profilePic
     *
     * @param string $profilePic
     * @return Customer
     */
    public function setProfilePic($profilePic)
    {
        $this->profilePic = $profilePic;

        return $this;
    }

    /**
     * Get profilePic
     *
     * @return string 
     */
    public function getProfilePic()
    {
        return $this->profilePic;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Customer
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }
	
	  /**
     * Set dob
     *
     * @param string $dob
     * @return Customer
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return string 
     */
    public function getDob()
    {
        return $this->dob;
    }



   

    /**

     * Get the full name of the user (first + last name)

     * @return string

     */

    public function getFullName()

    {

        return $this->getFirstname() . ' ' . $this->getLastname();

    }



    /**

     * <a href="/param">@param</a> string $facebookId

     * @return void

     */

    public function setFacebookId($facebookId)

    {

        $this->facebookId = $facebookId;

    }



    /**

     * @return string

     */

    public function getFacebookId()

    {

        return $this->facebookId;

    }



    /**

     * <a href="/param">@param</a> Array

     */

    public function setFBData($fbdata)

    {

        if (isset($fbdata['id'])) {

            $this->setFacebookId($fbdata['id']);

            $this->addRole('ROLE_FACEBOOK');

        }

        if (isset($fbdata['first_name'])) {

            $this->setFirstname($fbdata['first_name']);

        }

        if (isset($fbdata['last_name'])) {

            $this->setLastname($fbdata['last_name']);

        }

        if (isset($fbdata['email'])) {

            $this->setEmail($fbdata['email']);

        }

    }

}