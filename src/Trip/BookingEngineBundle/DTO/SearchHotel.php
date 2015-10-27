<?php

namespace Trip\BookingEngineBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This is a Entity to hold the data of City
 *
 *
 * SearchFilter
 */
class SearchHotel
{
    /**
     * @var string
     */
    private $goingTo;
    
    /**
     * @var string
     */
    private $date;
    
    /**
     * @var string
     */
    private $returnDate;
   
    /**
	 *
	 * @return the string
	 */
	public function getGoingTo() {
		return $this->goingTo;
	}
	
	/**
	 *
	 * @param
	 *        	$goingTo
	 */
	public function setGoingTo($goingTo) {
		$this->goingTo = $goingTo;
		return $this;
	}
    /**
	 *
	 * @return the string
	 */
	public function getDate() {
		return $this->date;
	}
	
	/**
	 *
	 * @param
	 *        	$date
	 */
	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
    
     /**
	 *
	 * @return the string
	 */
	public function getReturnDate() {
		return $this->returnDate;
	}
	
	/**
	 *
	 * @param
	 *        	$returnDate
	 */
	public function setReturnDate($returnDate) {
		$this->returnDate = $returnDate;
		return $this;
	}
    
    
}
