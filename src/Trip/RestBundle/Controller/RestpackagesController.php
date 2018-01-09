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
use Trip\BookingEngineBundle\DependencyInjection\Instamojo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


class RestpackagesController extends Controller
{
	
    public function multipackagesAction(Request $request)
    {
    	header("Access-Control-Allow-Origin: *");
    	$packagetitleList = array();
    	//$cataloglist = array();
    	$em = $this->getDoctrine()->getManager();
    	$getpackagetitle = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findAll();
    	
    	foreach ($getpackagetitle as $packagetitle)
    	{
    		$packagetitleId =  $packagetitle->getId();
    		$title =  $packagetitle->getTitle();
    		
    		$statingPrice = $packagetitle->getStatingPrice();
    		$location =  $packagetitle->getLocation();
    		//$imgPath = $packagetitle->getImgPath();
    		//$host = $request->getHost ();
    		$imgPath = '/trips/web/images/package-titles/'.$packagetitle->getImgPath();
    		$locationId = $packagetitle->getLocationId();
    		$locationUrl = $packagetitle->getLocationUrl();
    	
    		$packages['id']=$packagetitleId;
    		$packages['title']=$title;
    		$packages['statingPrice']=$statingPrice;
    		$packages['location']=$location;
    		$packages['imgPath']=$imgPath;
    		$packages['locationId']=$locationId;
    		$packages['locationUrl']=$locationUrl;
    		
    		
    	
    		 
    		$packagetitleList[]=$packages;
    	}
    	
    	$data['success']=true;
    	$extras['msg']='';
    	$extras['packagetitleList'] = $packagetitleList;
    	$data['extras']=$extras;
    	return new Response (json_encode($data));
    	}

    	/**
    	 *
    	 */
    	public function specialPackagesAction(Request $request){
    		header("Access-Control-Allow-Origin: *");
    		
    		$url = $request->get('locationUrl');
    		
    		$packagetitleList = array();
    		$packagesvalueinfoList = array();
    		$locationinfoList = array();
    		$packagetitleinfoList = array();
    		$packagetitlecontentsinfoList = array();
    		
    		$em = $this->getDoctrine()->getManager();
    		//$packages = $em->getRepository('TripSiteManagementBundle:Package')->findAll();
    		$packagetitle = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findBy(array('locationUrl' => $url));
    		if($packagetitle){
    			
    			$packagetitle = $packagetitle[0];
    			//echo var_dump($packagetitle);
    			//exit();
    			$id= $packagetitle->getId();
    			//echo var_dump($id);
    			//exit();
    			$packages = $em->getRepository('TripSiteManagementBundle:Package')->findBy(array('category' => $id));
    			
    			$locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
    			$locations = $this->getLocationsByIndex($locations);
    			//$session = $request->getSession();
    			//$session->set('resultSet',$packages);
    			//$session->set('locations',$locations);
    			$type = 'one';
    			$packagetitles = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findBy(array('type' => $type));
    			$packagetitlecontents = $em->getRepository('TripSiteManagementBundle:PackageTitleContent')->findBy(array('packageTitleId' => $id));
    			$packagetitlelist = $em->getRepository('TripSiteManagementBundle:PackageTitleList')->findBy(array('packageTitleId' => $id));
    			
    			//echo var_dump($packagetitlecontents);
//     			echo var_dump($locations);
//     			echo var_dump($packagetitles);
//     			echo var_dump($packagetitlecontents);
//     			echo var_dump($packagetitlelist);
	//echo var_dump($packagetitle);
   //			exit();
   			$packageinfo=$packagetitle;
   		//	foreach ($packagetitle as $packageinfo)
   			{
   				$packagetitleId =  $packageinfo->getId();
   				$title =  $packageinfo->getTitle();
   				$metaTitle =  $packageinfo->getMetaTitle();
   				$metaKeywords =  $packageinfo->getMetaKeywords();
   				$metaDescription =  $packageinfo->getMetaDescription();
   				$statingPrice =  $packageinfo->getStatingPrice();
   				$imgPath =  $packageinfo->getImgPath();
   				$locationId =  $packageinfo->getLocationId();
   				$type =  $packageinfo->getType();
   				$locationUrl = $packageinfo->getLocationUrl();
   				
   				$package['id']=$packagetitleId;
    			$package['title']=$title;
    			$package['metaTitle']=$metaTitle;
    			$package['metaKeywords']=$metaKeywords;
    			$package['metaDescription']=$metaDescription;
    			$package['statingPrice']=$statingPrice;
    			$package['locationUrl']=$locationUrl;
    			$package['imgPath']=$imgPath;
    			$package['locationId']=$locationId;
    			$package['locationUrl']=$locationUrl;
    			
    			
    			$packagetitleList[]=$package;
    			
   			}
   		//	echo var_dump($packagetitleList);
   			//exit();
   			
   			foreach($packages as $packagevalue){
   				$packagesvalueinfo['id']=$packagevalue->getId();
   				$packagesvalueinfo['name']=$packagevalue->getName();
   				$packagesvalueinfo['title']=$packagevalue->getTitle();
   				$packagesvalueinfo['overview']=$packagevalue->getOverview();
   				$packagesvalueinfo['metaKeywords']=$packagevalue->getMetaKeywords();
   				$packagesvalueinfo['metaDescription']=$packagevalue->getMetaDescription();
   				$packagesvalueinfo['metaTitle']=$packagevalue->getMetaTitle();
   				$packagesvalueinfo['packageUrl']=$packagevalue->getPackageUrl();
   				$packagesvalueinfo['type']=$packagevalue->getType();
   				$packagesvalueinfo['code']=$packagevalue->getCode();
   				$packagesvalueinfo['active']=$packagevalue->getActive();
   				$packagesvalueinfo['category']=$packagevalue->getCategory();
   				$packagesvalueinfo['imgPath']=$packagevalue->getImgPath();
   				$packagesvalueinfo['price']=$packagevalue->getPrice();
   				
   				
   				
   				$pricelist = array();
   				
   				$sartpoints = array();
   				$endpoints = array();
   				$endpoints2 = array();
   				
   				$endpointvalues = $packagevalue->getEndPoint();
   				$endpointvalues2= $packagevalue->getEndPoint2();
   				$pricevalues = $packagevalue->getPrice();
   				//echo var_dump($pricevalues);
   				//exit();
   				$starts = $packagevalue->getStartPoint();
   				
   				
   				foreach($starts as $start){
   					
   					$startpointinfo['id']=$start->getId();
   					$startpointinfo['name']=$start->getName();
   					$startpointinfo['active']=$start->getActive();
   					$startpointinfo['booking']=$start->getBooking();
   					$startpointinfo['type']=$start->getType();
   					$sartpoints[]=$startpointinfo;
   				}
   				foreach($pricevalues as $pricevalue){
   				
   					$pricevalueinfo['id']=$pricevalue->getId();
   					$pricevalueinfo['name']=$pricevalue->getName();
   					$pricevalueinfo['vehicleId']=$pricevalue->getVehicleId();
   					$pricevalueinfo['price']=$pricevalue->getPrice();
   					$pricevalueinfo['active']=$pricevalue->getActive();
   					$pricevalueinfo['package']=$pricevalue->getPackage();
   					$pricelist[]=$pricevalueinfo;
   				}
   				foreach($endpointvalues as $endpointvalue){
   				
   					$endpointvalueinfo['id']=$endpointvalue->getId();
   					$endpointvalueinfo['name']=$endpointvalue->getName();
   					$endpointvalueinfo['active']=$endpointvalue->getActive();
   					$endpointvalueinfo['booking']=$endpointvalue->getBooking();
   					
   					$endpoints[]=$endpointvalueinfo;
   				}
   				foreach($endpointvalues2 as $endpointvalue2){
   						
   					$endpointvalueinfo2['id']=$endpointvalue2->getId();
   					$endpointvalueinfo2['name']=$endpointvalue2->getName();
   					$endpointvalueinfo2['active']=$endpointvalue2->getActive();
   					$endpointvalueinfo2['booking']=$endpointvalue2->getBooking();
   				
   					$endpoints2[]=$endpointvalueinfo2;
   				}
   				//echo var_dump($endpoints2);
   				//exit();
   				//echo var_dump($sartpoints);
   				$packagesvalueinfo['startPoint']= $sartpoints;
   				$packagesvalueinfo['price']= $pricelist;
   				$packagesvalueinfo['endPoint']= $endpoints;
   				$packagesvalueinfo['endPoint2']= $endpoints2;
   				$packagesvalueinfoList[]=$packagesvalueinfo;
   				
   			}
   			foreach($locations as $location){
   				$locationinfo['id']=$location->getId();
   				$locationinfo['name']=$location->getName();
   				$locationinfo['description']=$location->getDescription();
   				$locationinfo['active']=$location->getActive();
   				$locationinfo['extraPrice']=$location->getExtraPrice();
   				
   				
   				$locationinfoList[]=$locationinfo;
   					
   			}
   			
   			foreach($packagetitles as $packagetitle){
   				$packagetitleinfo['id']=$packagetitle->getId();
   				$packagetitleinfo['title']=$packagetitle->getTitle();
   				$packagetitleinfo['metaTitle']=$packagetitle->getMetaTitle();
   				$packagetitleinfo['metaKeywords']=$packagetitle->getMetaKeywords();
   				$packagetitleinfo['metaDescription']=$packagetitle->getMetaDescription();
   				$packagetitleinfo['statingPrice']=$packagetitle->getStatingPrice();
   				$packagetitleinfo['location']=$packagetitle->getLocation();
   				$packagetitleinfo['imgPath']=$packagetitle->getImgPath();
   				$packagetitleinfo['locationId']=$packagetitle->getLocationId();
   				$packagetitleinfo['locationUrl']=$packagetitle->getLocationUrl();
   				$packagetitleinfo['type']=$packagetitle->getType();
   				
   				
   				
   					
   					
   				$packagetitleinfoList[]=$packagetitleinfo;
   			
   			}
   			foreach($packagetitlecontents as $packagetitlecontent){
   				$packagetitlecontentsinfo['id']=$packagetitlecontent->getId();
   				$packagetitlecontentsinfo['title']=$packagetitlecontent->getTitle();
   				$packagetitlecontentsinfo['description']=$packagetitlecontent->getDescription();
   				$packagetitlecontentsinfo['packageTitleId']=$packagetitlecontent->getPackageTitleId();
   					
   					
   				$packagetitlecontentsinfoList[]=$packagetitlecontentsinfo;
   			
   			}
   			
   			//echo var_dump($locationinfoList);
   				//exit();

   			
    			$data['success']=true;
    			$extras['msg']='';
    			$extras['packagetitleList'] = $packagetitleList;
    			$extras['packagesvalueinfoList'] = $packagesvalueinfoList;
    			
    			$extras['locationinfoList'] = $locationinfoList;
    			$extras['packagetitleinfoList'] = $packagetitleinfoList;
    			$extras['packagetitlecontentsinfoList'] = $packagetitlecontentsinfoList;
    			//$extras['packagetitleList'] = $packagetitleList;
    			$data['extras']=$extras;
    			return new Response (json_encode($data));
    			    			
    		}else{
    			 
    		}
    	
    		 
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
    	
    	public function packagebookingsubmitAction(Request $request)
    	{
    		header("Access-Control-Allow-Origin: *");
    		$name = $request->get('name');
    		$email = $request->get('email');
    		$mobileno = $request->get('mobileno');
    		$startPointId = $request->get('startPointId');
    		$endPoint2Id = $request->get('endPoint2Id');
    		
    		//echo var_dump($startPointId);
    		//echo var_dump($endPoint2Id);
    		
    		$date = $request->get('date');
    		$numAdult = $request->get('numAdult');
    		$preferTime = $request->get('preferTime');
    		//$startpointname = $request->get('startpointname');
    		//$endpointname = $request->get('endpointname');
    		//$endpointname2 = $request->get('endpointname2');
    		
    		
    		
    		$selectedpackageid = $request->get('selectedpackageid');
    		$selectedpackageidname = $request->get('selectedpackageidname');
    		$vehicleId = $request->get('vehicleId');
    		$price = $request->get('price');
    		$active = $request->get('active');
    		$mobileno = $request->get('mobileno');
    		
    		$paymentMode = $request->get('paymentmode');
   //packageinformation
    		$id = $request->get('id');
    		//$active = $request->get('active');
    		$category = $request->get('category');
    		$code = $request->get('code');
    		$endPointbefore = $request->get('endPoint');
    		$endPoint = json_decode($endPointbefore);
    		$endPoint2before = $request->get('endPoint2');
    		$endPoint2 = json_decode($endPoint2before);
    		
    		$imgPath = $request->get('imgPath');
    		$metaDescription = $request->get('metaDescription');
    		$metaKeywords = $request->get('metaKeywords');
    		$metaTitle = $request->get('metaTitle');
    		$packagename = $request->get('packagename');
    		$overview = $request->get('overview');
    		$packageUrl = $request->get('packageUrl');
    		
    		$packagepricebefore = $request->get('packageprice');
    		$packageprice = json_decode($packagepricebefore);
    		
    		$startPointbefore = $request->get('startPoint');
    		$startPoint = json_decode($startPointbefore);
    		
    		$title = $request->get('title');
    		$type = $request->get('type');

    	//	echo var_dump(json_decode($packageprice));
    		//echo var_dump($startPoint);
    		//echo var_dump($endPoint);
    		//echo var_dump($endPoint2);
    		//exit();
    		$em = $this->getDoctrine()->getManager();
    		$locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
    		//echo var_dump($locations);
    		$locations = $this->getLocationsByIndex($locations);
    		
    		$tripType = 'package';
    		
    		//echo var_dump($leavingFrom);
    	//	exit();
    	
//     		$session = $request->getSession();
//     		$resultSet = $session->get('resultSet');
//     		$searchFilter = $session->get('selectedData');
//     		$selectedService = $session->get('selected');
//     		$searchHotel = $session->get('searchHotel');
//     		$locations = $session->get('locations');
//     		$guest = $session->get('guest');
    	
    	
    		$customer = new Customer();
    		$customer->setName($name);
    		$customer->setEmail($email);
    		$customer->setMobile($mobileno);
    		//$form   = $this->createBookingForm($customer);
    		//$form->handleRequest($request);
    		// payment if starts
    		//if ($form->isValid()) { 
    			//$couponApplyed = $customer->getHaveCoupon();
    			//$couponCode = $customer->getCouponCode();
    			//$paymentMode = $customer->getPaymentMode();
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($customer);
    		$em->flush();
    		
    		
    		
    // 		$locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
//     		echo var_dump($locations);
//     		$locationstart = $em->getRepository('TripSiteManagementBundle:City')->findBy(array('id' => $startPointId));
//     		$locationend = $em->getRepository('TripSiteManagementBundle:City')->findBy(array('id' => $endPoint2Id));
//     		$locationstartnew = $locationstart[0];
//      		$locationendnew = $locationend[0];
    		
//      		$locationstartpointname = $locationstartnew->getName();
//      		$locationendpointname = $locationendnew->getName();
    		
    		
    		//echo var_dump($locationstart);
    		//echo var_dump($locationend);
    		
    		//echo var_dump($locationstartpointname);
    		//echo var_dump($locationendpointname);
    		//exit();
    		
    		
    		
    		
    		//$session->set('customer',$customer);
//     			if($searchFilter->getTripType()=='roundtrip'){
//     				$price = $selectedService['returnPrice'];
//     			}else{
//     				if($searchFilter->getTripType()=='package'){
//     					$price = $selectedService->getPrice()->first()->getPrice();
//     				}else{
//     					$price = $selectedService['price'];
//     				}
//     			}
    			$finalPrice = $price;
//     			if($couponCode=='FIRSTRIDE'){
//     				$finalPrice = $price-50;
//     			}
//     			if($searchFilter->getTripType()=='roundtrip'){
//     				$selectedService['returnPrice'] = $finalPrice;
//     			}else{
//     				if($searchFilter->getTripType()=='package'){
//     					$selectedService->getPrice()->first()->setPrice($finalPrice);
//     				}else{
//     					$selectedService['price'] = $finalPrice;
//     				}
//     			}
    			$booking = new Booking();
    			$booking->setCustomerId($customer->getId());
    			$bookingId = $this->getBookingId();
    			$booking->setBookingId($bookingId);
    			//$booking->setBookingId($this->getBookingId());
    			$booking->setTotalPrice($price);
    			$booking->setFinalPrice($finalPrice);
    			$booking->setStatus('pending');
    			$booking->setJobStatus('Open');
    			$booking->setBookedOn(new \DateTime());
    			//$booking->setNumDays($searchFilter->getNumDays());
    			$booking->setNumAdult($numAdult);
    			$booking->setPreferTime($preferTime);
    			$discount = 0;
    			$couponApplyed= 0;
    			if($couponApplyed){
    				$booking->setCouponApplyed(1);
    				$booking->setCouponCode($couponCode);
    				$booking->setDiscount(50);
    				$discount = 50;
    			}else{
    				$booking->setCouponApplyed(0);
    			}
    			
    			
    	
//     			if(!is_null($searchHotel)){
//     				$booking = $this->setVehicleBooking($selectedService,$searchFilter,$price,$booking);
//     			}
    		//	else{
//     				if($searchFilter->getTripType()=='multicity'){
//     					$multiple = $searchFilter->getMultiple();
//     					foreach($multiple as $multicity){
//     						$leavingFrom = $multicity->getLeavingFrom();
//     						$goingTo = $multicity->getGoingTo();
//     						$returnDate = null;
//     						$date = $multicity->getDate();
//     						$booking = $this->setVehicleBooking($selectedService,$searchFilter,$leavingFrom,$goingTo,$date,$returnDate,0,$booking);
//     					}
//     				}
    			//	else{
    			//		$tripType='package';
//     					if($tripType=='package'){
//              //$leavingFrom = $selectedService->getStartPoint()->first()->getName();
                        
//                    $leavingFrom = $startPoint;
//                    echo var_dump($leavingFrom);
//                    exit();
                        
//                     $date = $date;
//                       $returnDate = null;
//                       $endPoint = $endPoint2->getName();
//                         foreach($endPoint as $end){
//                             $goingTo = $end->getName();
//                             $booking = $this->setVehicleBooking($packageprice,$leavingFrom,$goingTo,$date,$returnDate,0,$booking);
//                             $leavingFrom = null;
//                         }
//                         //$endPoint2 = $selectedService->getEndPoint2();
//                         foreach($endPoint2 as $end){
//                             $goingTo = $end->getName();
//                             $booking = $this->setVehicleBooking($packageprice,$leavingFrom,$goingTo,$date,$returnDate,0,$booking);
//                         }
//                     }
    					
//     					else{
//     						$leavingFrom = $searchFilter->getLeavingFrom();
//     						$goingTo = $searchFilter->getGoingTo();
//     						$returnDate = $searchFilter->getReturnDate();
//     						$date = $searchFilter->getDate();
//     						$booking = $this->setVehicleBooking($selectedService,$searchFilter,$leavingFrom,$goingTo,$date,$returnDate,$price,$booking);
//     					}
    	
    		//		}
    		//	}
    			$booking->setPaymentMode($paymentMode);
    	
    			$amountToPay = $finalPrice;
    			$tax = 0;
    			if($paymentMode=='advance'){
    				$amountToPay = round($finalPrice*(50/100));
    				//$tax = round($amountToPay*(3/100));
    				//$amountToPay = $amountToPay+$tax;
    			}else{
    				
    				$amountToPay = round($finalPrice*(30/100));
    				//$tax = round($amountToPay*(3/100));
    				// $amountToPay = $amountToPay+$tax;
    			}
    			$serviceTax = round($finalPrice*(5.6/100),2);
    			$swachBharthCess = round($finalPrice*(0.2/100),2);
    			$krishiKalyanCess = round($finalPrice*(0.2/100),2);
    			$totalTax = $serviceTax+$swachBharthCess+$krishiKalyanCess;
    			$amountToPay = $amountToPay+$totalTax;
    			$finalPrice = $finalPrice+$totalTax;
    			$booking->setTax($tax);
    			$booking->setServiceTax($serviceTax);
    			$booking->setSwachBharthCess($swachBharthCess);
    			$booking->setKrishiKalyanCess($krishiKalyanCess);
    			$booking->setFinalPrice($finalPrice);
    			$booking->setAmountPaid($amountToPay);
    			
    			$em->persist($booking);
    			$em->flush();
    			//$session->set('bookingObj',$booking);
    			//$session->set('amountToPay',$amountToPay);
    			//$paymentLink = $this->getPaymentLink($request,$amountToPay,$customer,$booking);
    			//$paymentLink = "https://www.instamojo.com/Waseemsyed/tirupati-caars-services-cb8a4/";
    			// $paymentLink.="?data_name=".$customer->getName()."&data_email=".$customer->getEmail()."&data_phone=".$customer->getMobile()."&embed=form";
    			//  $paymentLink = '';
    			//$payuLink = $this->generateUrl ( 'trip_booking_engine_payment_payu' );
    	
    			//$packagepaymentList['url']=$sUrl;
    			//$packagepaymentList['leavingFrom']=$leavingFrom;
    			$packagepaymentList['endPoint']=$endPoint;
    			$packagepaymentList['date']=$date;
    			//$packagepaymentList['goingTo']=$goingTo;
    			$packagepaymentList['name']=$name;
    			$packagepaymentList['email']=$email;
    			$packagepaymentList['mobileno']=$mobileno;
    			
    			
    			
    			//$packagepaymentList['imgPath']=$imgPath;
    			$packagepaymentList['finalPrice']=$finalPrice;
    			$packagepaymentList['amountToPay']=$amountToPay;
    			$packagepaymentList['bookingId']=$bookingId;
    			
    			$data['success']=true;
    			$extras['msg']='';
    			$extras['packagepaymentList'] = $packagepaymentList;
    			$data['extras']=$extras;
    			return new Response (json_encode($data));
    			//var_dump($customer);
    			//var_dump($booking);
    			//var_dump($selectedService);
    			//var_dump($searchFilter);
    			//var_dump($paymentLink);
    	
    	
    	
    	}
    	
    	private function setVehicleBooking($packageprice,$leavingFrom,$goingTo,$date,$returnDate,$price,$booking){
    		$vehicleBooking = new VehicleBooking();
    		if($searchFilter->getTripType()=='package'){
    			//$vehicle = $packageprice->getPrice()->first();
    			$vehicleBooking->setVehicleId($packageprice->getVehicleId());
    			$vehicleBooking->setModel($packageprice->getName());
    		}else{
    			$vehicleBooking->setVehicleId($selectedService['id']);
    			$vehicleBooking->setModel($selectedService['model']);
    		}
    		$vehicleBooking->setLeavingFrom($leavingFrom);
    		$vehicleBooking->setGoingTo($goingTo);
    		$vehicleBooking->setDate($date);
    		$vehicleBooking->setReturnDate($returnDate);
    		$vehicleBooking->setTripType('package');
    		$vehicleBooking->setPrice($price);
    		$vehicleBooking->setBooking($booking);
    		$booking->addVehicleBooking($vehicleBooking);
    		return $booking;
    	}
    	
    	private function getBookingId(){
    		$characters = 'A5B0CD9EFG1HIJ3KLM46NOPQR7STUV8WXYZ';
    		$bookingId = 'JT';
    		date_default_timezone_set('Asia/Kolkata');
    		$current=date('d/m/Y');
    		list ( $d, $m, $y ) = explode ( '/', $current );
    		$bookingId.=$d.$m.substr($y,2);
    		for ($i = 0; $i < 4; $i++) {
    			$bookingId .= $characters[rand(0,strlen($characters)-1)];
    		}
    		return $bookingId;
    	}
    	
    	
    	
    	
    	
}
