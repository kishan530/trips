<?php

namespace Trip\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Trip\BookingEngineBundle\Form\SearchType;
use Trip\BookingEngineBundle\DTO\SearchFilter;
use Trip\BookingEngineBundle\Form\SearchHotelType;
use Trip\BookingEngineBundle\DTO\SearchHotel;
use Trip\BookingEngineBundle\Entity\Customer;
use Trip\BookingEngineBundle\DTO\Customer as CustomerDto;
use Trip\BookingEngineBundle\DTO\NewPackage;
use Trip\BookingEngineBundle\Entity\Booking;
use Trip\BookingEngineBundle\Entity\Pickup;
use Trip\BookingEngineBundle\Entity\Drop;
use Trip\BookingEngineBundle\Entity\PlacesToVisit;
use Trip\BookingEngineBundle\Entity\VehicleBooking;
use Trip\BookingEngineBundle\Entity\HotelBooking;
use Trip\BookingEngineBundle\Entity\Billing;
use Trip\BookingEngineBundle\Form\CustomerType;
use Trip\BookingEngineBundle\Form\BillingType;
use Trip\BookingEngineBundle\Form\EditCustomerType;
use Trip\BookingEngineBundle\Form\NewPackageType;
use Trip\BookingEngineBundle\Form\GuestType;
use Trip\BookingEngineBundle\Form\CustomPackageType;
use Trip\SiteManagementBundle\Entity\Contact;
use Trip\SiteManagementBundle\Entity\City;
use Trip\SiteManagementBundle\Form\ContactType;

use Trip\SiteManagementBundle\Entity\Biketime;
use Trip\SiteManagementBundle\Form\biketimerangeType;
use Trip\SiteManagementBundle\Form\PriceviewbikesType;

use Trip\BookingEngineBundle\DependencyInjection\Instamojo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


class RestbikesController extends Controller
{
	
    public function bikesonRentAction(Request $request)
    {
    	header("Access-Control-Allow-Origin: *");
    	
    	$bikesearchList = array();
    	$locationinfoList = array();
    	
    	$date = $request->get('date');
    	$date = new \DateTime($date);
    	$returnDate = $request->get('returnDate');
    	$returnDate = new \DateTime($returnDate);
    	$location = $request->get('location');
    	
    	   	
    	
    	
    	$em = $this->getDoctrine()->getManager();
    	$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
    	$locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
    	$locations = $this->getLocationsByIndex($locations);
    	
    	//$session = $request->getSession();
    	//$session->set('resultSet',$bikes);
    	//$package->setPreferTime($service->getPreferTime());
    	
    	$entity = new Biketime();
    	//$entity->setId($entity->getId());
    	//$entity->setPreferTime($entity->getPreferTime());
    	//$entity->setReturnTime($entity->getReturnTime());
    	//$entity->setDate(new \DateTime());
    	$entity->setDate(new \DateTime());
    	$entity->setDate($date);
    	$entity->setLocation($location);
    	$entity->setReturndate($returnDate);
    	    
    	//$em->persist($entity);
    	//$em->flush();
    	//echo var_dump($entity);
    	//exit();
    	foreach($bikes as $bike)
    	{
    		//$packagetitleId =  $packagetitle->getId();
    	$id =  $bike->getId();
    	$title = $bike->getTitle();
    	$metaTitle = $bike->getMetaTitle();
    	$metaKeywords = $bike->getMetaKeywords();
    	$metaDescription = $bike->getMetaDescription();
    	$statingPrice = $bike->getStatingPrice();
    	//$location = $bike->getId();
    	
    	$imgPath = $bike->getImgPath();
    	$locationId = $bike->getLocationId();
    	$locationUrl = $bike->getLocationUrl();
    	$preferTime = $bike->getPreferTime();
    	$fivehours = $bike->getFivehours();
    	$dayrent = $bike->getDayrent();
    	
    	
    	
    	
    	$bikedetails['id']=$id;
    	$bikedetails['title']=$title;
    	$bikedetails['metaTitle']=$metaTitle;
    	$bikedetails['metaKeywords']=$metaKeywords;
    	$bikedetails['metaDescription']=$metaDescription;
    	$bikedetails['statingPrice']=$statingPrice;
    	$bikedetails['location']=$location;
    	//$imgPath =  'http://test.justtrip.in/images/cars/'.$imgPath;
    	$bikedetails['imgPath']=$imgPath;
    	$bikedetails['locationId']=$locationId;
    	$bikedetails['locationUrl']=$locationUrl;
    	$bikedetails['preferTime']=$preferTime;
    	$bikedetails['fivehours']=$fivehours;
    	$bikedetails['dayrent']=$dayrent;
    	
    	$bikesearchList[]=$bikedetails;
    	
    	}
    	//echo var_dump($bikesearchList);
    	//exit();
    	
    	foreach($locations as $location){
    		$locationinfo['id']=$location->getId();
    		$locationinfo['name']=$location->getName();
    		$locationinfo['description']=$location->getDescription();
    		$locationinfo['active']=$location->getActive();
    		$locationinfo['extraPrice']=$location->getExtraPrice();
    			
    			
    		$locationinfoList[]=$locationinfo;
    	
    	}
    	
    	$data['success']=true;
    	$extras['msg']='';
    	$extras['bikesearchList'] = $bikesearchList;
    	$extras['locationinfoList'] = $locationinfoList;
    	$data['extras']=$extras;
    	return new Response (json_encode($data));
    	    	
    }
    
    public function getLocationsByIndex($locations){
    	$temp = array();
    	foreach($locations as $location){
    		$temp[$location->getId()]=$location;
    		//$temp[4]='kishan';
    		// $temp[2]='kishan';
    		//$temp[1]='kishan';
    		//$temp[4]='kishan';
    		 
    		 
    		//$name = $temp[$id];
    
    	}
    	return $temp;
    }
    	
    
    	
}
