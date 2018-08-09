<?php

namespace Trip\BookingEngineBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 */
class Docuploaddto
{
   
/**

     * @var integer

     *

     */

    private $id;



   
    

    

    /**

     * @var Collection

     * 

     */

    protected $images;

    

    

    /**

     * @var Collection

     *

     */

    private $imageList;

   

    

    /**

     * 

     */

    public function __construct() {

    	$this->images = new ArrayCollection();
    	$this->imageList = new ArrayCollection();
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
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getImageList()
    {
        return $this->imageList;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $imageList
     */
    public function setImageList($imageList)
    {
        $this->imageList = $imageList;
    }


	

	
}



