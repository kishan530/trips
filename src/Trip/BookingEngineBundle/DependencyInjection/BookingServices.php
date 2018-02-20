<?php

namespace  Trip\BookingEngineBundle\DependencyInjection;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Trip\BookingEngineBundle\DTO\Catalogue;
use Trip\SiteManagementBundle\DTO\HotelDto;
/**
 * This is an Adoptor for booking engine server.    
 *
 */
class BookingServices
{
	private $container;
	private $em;
	private $session;
	private $logger;
	
	/**
	 * Constructor 
	 * @param EntityManager $entityManager
	 * @param ContainerInterface $container
	 * @param unknown $session
	 */
	public function __construct(EntityManager $entityManager,ContainerInterface $container,$session)
	{
		$this->session = $session;
		$this->container = $container;
        $this->em = $entityManager;
		$this->logger = $this->container->get('logger');
    }
    public function getHotelCities(){
        $locations = $this->em->getRepository('TripSiteManagementBundle:HotelCities')->findAll();
        return $locations;
    }
    public function getLocations(){
        $locations = $this->em->getRepository('TripSiteManagementBundle:City')->findAll();
        return $locations;
    }
    public function getVehicles(){
        $vehicles = $this->em->getRepository('TripBookingEngineBundle:Vehicle')->findAll();
        return $vehicles;
    }
    
    public function getDriver(){
    	
    	$drivers = $this->em->getRepository('TripSiteManagementBundle:Driver')->findAll();
    	return $drivers;
    }
    public function getAmenities(){
        $locations = $this->em->getRepository('TripSiteManagementBundle:HotelAmenities')->findAll();
        return $locations;
    }
    public function getDriverByIndex($drivers)
    {
    	$tempDriver = array();
    	foreach ($drivers as $driver){
    		$tempDriver[$driver->getId()] = $driver;
    	}
    	return $tempDriver;
    }
	
	/**
	* Get catalog service. Will be calleat at entry. 
	* This metod shouyld chek the cache srvice for availability, before calling the 
	* API service ????
	*  
	* @param unknown $result
	* @param unknown $sub
	* @param unknown $mailer
	*/
	public function getCatalog(){
		$catalogue = $this->session->get('catalogue');
		//if(is_null($catalogue)){
			try{
                $catalogue = new Catalogue();
				$locations = $this->getLocations();
                $vehicles = $this->getVehicles();
                $catalogue->setLocations($locations);
                $catalogue->setVehicles($vehicles);
			}catch(\Exception $ex){ 
				//throw new ApplicationException();
			}
			$this->session->set('catalogue',$catalogue);
		//}
		return $catalogue;			
	}
        public function getPackageList(){
        $packagelist = $this->em->getRepository('TripSiteManagementBundle:Package')->findAll();
        return $packagelist;
    }
	
    public function getFilters($hotels,$amenitiesMstr){
        $filters = array();
        $locations = array();
        $price = array();
        $amenities = array();
        $categories = array();
        $properties = array();
        $maxPrice = 0;
        $minPrice = 100000;
        $amenitiesMstr = $this->getAmenitiesById($amenitiesMstr);
        foreach($hotels as $hotel){
            //$address = $hotel->getAddress();
            $hotelAmenities = $hotel->getAmenities();
            $category = $hotel->getCategory();
            
            $property = $hotel->getPropertyType();
            
            $location = $hotel->getLocation();
            $price = $hotel->getPrice();
            
            if($price>$maxPrice)
                $maxPrice = $price;
                if($price<$minPrice)
                    $minPrice = $price;
                    
                    if(!is_null($category))
                        $categories[$category] = $category.' Star';
                        $locations[$location] = $location;
                        
                        if(!is_null($property))
                            $properties[$property] = $property;
                            $locations[$location] = $location;
                            
                            
                            foreach($hotelAmenities as $amenity){
                                $mstrAmenity = $amenitiesMstr[$amenity->getId()];
                                $amenities[$mstrAmenity->getId()] = $mstrAmenity->getName();
                            }
        }
        
        $filters['locations'] = $locations;
        $filters['categories'] = $categories;
        $filters['properties'] = $properties;
        $filters['amenities'] = $amenities;
        $filters['price']=array('maxPrice'=>$maxPrice,'minPrice'=>$minPrice);
        //echo var_dump($filters);
        //exit();
        return $filters;
    }	
    public function getAmenitiesById($amenitiesMstr){
        $amenities = array();
        foreach($amenitiesMstr as $a){
            $amenities[$a->getId()] = $a;
        }
        return $amenities;
    }
    public function getHotelsByCity($city){
        $hotels = $this->em->getRepository('TripSiteManagementBundle:Hotel')->findByCityId($city);
        
        $tempHotels = array();
        foreach($hotels as $hotel){
            $rooms = $hotel->getHotelRooms();
            //echo $location;
            $minPrice = 0;
            $minPromoPrice = 0;
            $selectedPromoStartDate = 0;
            $selectedPromoEndDate = 0;
            foreach($rooms as $room){
                $roomPrice = $room->getPrice();
                $promoStartDate = $room->getPromotionStartDate();
                $promoEndDate = $room->getPromotionEndDate();
                $promoPrice = $room->getPromotionPrice();
                
                
                if($minPrice==0){
                    $minPrice = $roomPrice;
                    $minPromoPrice = $promoPrice;
                    $selectedPromoStartDate = $promoStartDate;
                    $selectedPromoEndDate = $promoEndDate;
                }
                //	echo $slectedLocation;
                if ($minPrice>$roomPrice){
                    $minPrice = $roomPrice;
                    $minPromoPrice = $promoPrice;
                    $selectedPromoStartDate = $promoStartDate;
                    $selectedPromoEndDate = $promoEndDate;
                }
            }
            
            
            $hotelDetail = new HotelDto();
            $address = $hotel->getAddress();
            $hotelDetail->setId($address->getId());
            $hotelDetail->setAddressLine1($address->getAddressLine1());
            $hotelDetail->setAddressLine2($address->getAddressLine2());
            $hotelDetail->setLocation($address->getLocation());
            $hotelDetail->setPincode($address->getPincode());
            
            //$hotelDetail->setCity($address->getCity());
            //$hotelDetail->setCityId($address->getCityId());
            
            //$hotelDetail->setHotel($address->getHotel());
            
            
            $hotelDetail->setId($hotel->getId());
            $hotelDetail->setName($hotel->getName());
            $hotelDetail->setOverview($hotel->getOverview());
            //$hotelDetail->setId($hotel->getId());
            
            $hotelDetail->setPropertyType($hotel->getPropertyType());
            $hotelDetail->setCategory($hotel->getCategory());
            $hotelDetail->setCheckIn($hotel->getCheckIn());
            $hotelDetail->setCheckOut($hotel->getCheckOut());
            $hotelDetail->setCity($hotel->getCity());
            $hotelDetail->setNumRooms($hotel->getNumRooms());
            $hotelDetail->setCityId($hotel->getCityId());
            $hotelDetail->setActive($hotel->getActive());
            
            $hotelDetail->setSoldOut($hotel->getSoldOut());
            $hotelDetail->setPriority($hotel->getPriority());
            
            $hotelDetail->setFooterDisplay($hotel->getFooterDisplay());
            $hotelDetail->setUrl($hotel->getUrl());
            $hotelDetail->setMetaTitle($hotel->getMetaTitle());
            $hotelDetail->setMetaKeywords($hotel->getMetaKeywords());
            $hotelDetail->setMetaDescription($hotel->getMetaDescription());
            $hotelDetail->setHotelblockStartDate($hotel->getHotelblockStartDate());
            $hotelDetail->setHotelblockEndDate($hotel->getHotelblockEndDate());
            
            $hotelDetail->setHotelRooms($hotel->getHotelRooms());
            //$hotelDetail->setAddress($hotel->getAddress());
            $hotelDetail->setImages($hotel->getImages());
            $hotelDetail->setAmenities($hotel->getAmenities());
            
            
            
            
            
            
            $hotelDetail->setPrice($minPrice);
            $hotelDetail->setPromotionStartDate($selectedPromoStartDate);
            $hotelDetail->setPromotionEndDate($selectedPromoEndDate);
            $hotelDetail->setPromotionPrice($minPromoPrice);
            
            $activehotel=$hotel->getActive();
            if($activehotel=='Active')
            {//$tempHotels[] = $hotel;
                $tempHotels[] = $hotelDetail;
            }
        }
        //var_dump($tempHotels);
        //exit();
        return $tempHotels;
    }
    /**
     *
     * @param unknown $search
     * @param unknown $hotels
     * @return multitype:
     */
    public function filterHotels($search,$hotels,$minPrice,$maxPrice){
        
        $slectedLocations = $search->getLocation();
       // $slectedCategories = $search->getCategories();
        $slectedProperties = $search->getProperties();
        
        if(count($slectedLocations)>0)
            $hotels = $this->filterByLocation($slectedLocations,$hotels);
            //var_dump($hotels);exit();
             $hotels = $this->filterByPrice($search,$hotels,$minPrice,$maxPrice);
            
           /* if(count($slectedCategories)>0)
                $hotels = $this->filterByCategory($slectedCategories,$hotels);*/
                
                if(count($slectedProperties)>0)
                    $hotels = $this->filterByPropertyType($slectedProperties,$hotels);
                    return $hotels;
    }
    /**
     *
     * @param unknown $search
     * @param unknown $hotels
     * @return multitype:
     */
    public function filterByLocation($slectedLocations,$hotels){
        $tempHotels = array();
        foreach($hotels as $hotel){
            //$address = $hotel->getAddress();
            $hotelAmenities = $hotel->getAmenities();
            $category = $hotel->getCategory();
            $location = $hotel->getLocation();
            //var_dump($location);exit();
            $price = $hotel->getPrice();
            //echo $location;
            
            foreach($slectedLocations as $slectedLocation){
                //	echo $slectedLocation;
                if ($location==$slectedLocation)
                    $tempHotels[] = $hotel;
                    
                    
            }
        }
        return $tempHotels;
    }
    /**
     *
     * @param unknown $search
     * @param unknown $hotels
     * @return multitype:
     */
    public function filterByPrice($search,$hotels,$minPrice,$maxPrice){
        $tempHotels = array();
        foreach($hotels as $hotel){
            //	$address = $hotel->getAddress();
            $hotelAmenities = $hotel->getAmenities();
            $category = $hotel->getCategory();
            $location = $hotel->getLocation();
            $price = $hotel->getPrice();
            //echo $price;
            //echo $minPrice;
            //echo $maxPrice;
            if ($price>=$minPrice && $price<=$maxPrice)
                $tempHotels[] = $hotel;
        }
        //echo var_dump($tempHotels);
        //exit();
        return $tempHotels;
    }
    /**
     *
     * @param unknown $search
     * @param unknown $hotels
     * @return multitype:
     */
    public function filterByCategory($slectedCategories,$hotels){
        $tempHotels = array();
        foreach($hotels as $hotel){
            //	$address = $hotel->getAddress();
            $hotelAmenities = $hotel->getAmenities();
            $category = $hotel->getCategory();
            $location = $hotel->getLocation();
            $price = $hotel->getPrice();
            //echo var_dump($slectedCategories);
            foreach($slectedCategories as $selectedCategory){
                //echo $category;
                //echo $selectedCategory;
                if ($category==$selectedCategory)
                    $tempHotels[] = $hotel;
            }
        }
        //exit();
        return $tempHotels;
    }
    public function filterByPropertyType($slectedProperties,$hotels){
        $tempHotels = array();
        foreach($hotels as $hotel){
            //	$address = $hotel->getAddress();
            $hotelAmenities = $hotel->getAmenities();
            $property = $hotel->getPropertyType();
            $location = $hotel->getLocation();
            $price = $hotel->getPrice();
            //echo var_dump($slectedCategories);
            foreach($slectedProperties as $slectedProperty){
                //echo $category;
                //echo $selectedCategory;
                if ($property==$slectedProperty)
                    $tempHotels[] = $hotel;
            }
        }
        //exit();
        return $tempHotels;
    }
    public function  getavailablerooms($hotels,$roomCountByHotel){
        
        foreach($hotels as $hotel){
            $totalRooms = $hotel->getNumRooms();
            $id = $hotel->getId();
            //if (array_key_exists('first', $search_array))
            if (array_key_exists($id, $roomCountByHotel))
                $countofBookedRooms = $roomCountByHotel[$id];
                else
                    $countofBookedRooms = 0;
                    $totalRooms = $hotel->getNumRooms();
                    $availableRoom = $totalRooms - $countofBookedRooms;
                    //var_dump($id);
                    //var_dump($totalRooms);
                    //var_dump($countofBookedRooms);
                    //var_dump($availableRoom);
                    $hotel->setAvailableRooms($availableRoom);
                    //var_dump($hotel);
                    //exit();
        }
        //	var_dump($hotels);
        //exit();
        return $hotels;
    }
}
