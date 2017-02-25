<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageTitleContent
 *
 * @ORM\Table(name="packagetitlecontent")
 * @ORM\Entity
 */
class PackageTitleContent
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
     * @ORM\Column(name="title", type="string", length=150)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000)
     */
   private $description;

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
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 *
	 * @param
	 *        	$title
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 *
	 * @param
	 *        	$description
	 */
	public function setDescription($description) {
		$this->description = $description;
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
