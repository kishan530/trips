<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageTitleList
 *
 * @ORM\Table(name="packagetitlelist")
 * @ORM\Entity
 */
class PackageTitleList
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
     * @ORM\Column(name="text", type="string", length=5000)
     */
    private $text;   

    /**
     * @var string
     *
     * @ORM\Column(name="package_title_id", type="integer" )
     */
   private $packageTitleId;
	
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
	public function getText() {
		return $this->text;
	}
	
	/**
	 *
	 * @param
	 *        	$text
	 */
	public function setText($text) {
		$this->text = $text;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getPackageTitleId() {
		return $this->packageTitleId;
	}
	
	/**
	 *
	 * @param
	 *        	$packageTitleId
	 */
	public function setPackageTitleId($packageTitleId) {
		$this->packageTitleId = $packageTitleId;
		return $this;
	}
	
	
	
   
	
	

   
}
