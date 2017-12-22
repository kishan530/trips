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


class RestController extends Controller
{
	
    public function indexAction(Request $request)
    {
    	header("Access-Control-Allow-Origin: *");
    	$catalougService = $this->container->get ( 'booking.services' );
    	$getCity = $catalougService->getLocations();
    	$cityList = array();
    	$cataloglist = array();
    	foreach ($getCity as $city)
    	{
    		$cityId =  $city->getId();
    		$name =  $city->getName();
    		
    		$description = $city->getDescription();
    		$active = $city->getActive();
    		$extraPrice = $city->getExtraPrice();
    		
    		$Locations['id']=$cityId;
    		$Locations['name']=$name;
    		$Locations['description']=$description;
    		$Locations['active']=$active;
    		$Locations['extraPrice']=$extraPrice;
    		
    	
    		$cityList[]=$Locations;
    	}
    	//$cataloglist['cityList']=$cityList;
    	$data['success']=true;
    	$extras['msg']='';
    	$extras['cityList'] = $cityList;
    	$data['extras']=$extras;
    	return new Response (json_encode($data));
    	}

    	public function searchAction(Request $request)
    	{
    		header("Access-Control-Allow-Origin: *");
    		//$searchFilter = new SearchFilter();
    		//$searchFilter->setDate(new \DateTime());
    		
    		//$form   = $this->createSearchForm($searchFilter);
    		//$form->handleRequest($request);
    		//if ($form->isValid()) {
    			$em = $this->getDoctrine()->getManager();
    			//$session = $request->getSession();
    			//$session->set('searchHotel',null);
    			$date = $request->get('fromDate');
    			$returnDate = $request->get('returnDate');
    			$date = new \DateTime($date);
    			$returnDate = new \DateTime($returnDate);
    			//$date = date_create_from_format('d/M/Y:H:i:s', $date);
    			//$returnDate = date_create_from_format('d/M/Y:H:i:s', $returnDate);
    			$date->getTimestamp();
    			
    			$numAdult = $request->get('numAdult');
    			$preferTime = $request->get('preferTime');
    			
    			$tripType = $request->get('tripType');
    			$noData = 0;
    			if($tripType=="multicity"){
//     				$numdays = $searchFilter->getNumdays();
//     				$multiple = $searchFilter->getMultiple();
//     				$count = count($multiple);
//     				$start = $multiple[0]->getLeavingFrom();
//     				$end = $multiple[$count-1]->getGoingTo();
//     				$startDate = $multiple[0]->getDate();
//     				$endDate = $multiple[$count-1]->getDate();
//     				$interval = $endDate->diff($startDate);
//     				$noDays = $interval->d+1;
//     				$resultCollection = array();
//     				foreach($multiple as $multicity){
//     					$goingFrom = $multicity->getLeavingFrom();
//     					$goingTo = $multicity->getGoingTo();
//     					$result = $this->getVehicles($goingFrom,$goingTo);
//     					$result = $this->getResultByCars($result,$noDays);
//     					$resultCollection[]=$result;
//     				}
//     				/*if($start != $end){
//     				 $result = $this->getResult($end,$start);
//     				$result = $this->getResultByCars($result);
//     				$resultCollection[]=$result;
//     				}*/
//     				$resultSet = $this->getResultSet($resultCollection);
    			}elseif($tripType=="dailyRent"){
    				$goingFrom = $request->get('leavingFrom');
    				$goingTo = $request->get('goingTo');
    				$noDays =0;
    				if(!is_null($returnDate)){
    					$interval = $returnDate->diff($date);
    					$noDays = $interval->d;
    				}
    				$resultSet = $this->getVehicles($goingFrom,$goingTo);
    				$resultSet = $this->getDailyRent($resultSet,$noDays);
    			}else{
    				$goingFrom = $request->get('leavingFrom');
    				$goingTo = $request->get('goingTo');
    				$noDays =0;
    				if($tripType=="roundtrip"){
    					$interval = $returnDate->diff($date);
    					$noDays = $interval->d;
    				}
    				$resultSet = $this->getResult($goingFrom,$goingTo,$noDays,$noData);
    				if(count($resultSet)==0){
    					$noData = 1;
    					$resultSet = $this->getResult($goingTo,$goingFrom,$noDays,$noData);
    				}
    			}
    			//echo var_dump($searchFilter);
    			//echo var_dump($resultSet);
    			//exit();
    			$errors = array();
    			if(($tripType=="roundtrip")&&($returnDate<$date)){
    				$resultSet = array();
    				// $errors[] = '';
    		
    			}
    			//echo var_dump($resultSet);
    			//exit();
    			
    			foreach($resultSet as $result)
    			{
    				$id =  $result['id'];
    				
    				$imgPath =  'http://test.justtrip.in/images/cars/'.$result['imgPath'];
    			
    				$model = $result['model'];
    				$capcity = $result['capcity'];
    				$vPrice = $result['vPrice'];
    				$extraPrice = $result['extraPrice'];
    				$mileage = $result['mileage'];
    				$price = $result['price'];
    				$returnPrice = $result['returnPrice'];
    				$multiPrice = $result['multiPrice'];
    				$lFrom = $result['lFrom'];
    				$to = $result['to'];
    				$needExtraPrice = $result['needExtraPrice'];
    				
    			
    				$Searchdetails['id']=$id;
    				$Searchdetails['imgPath']=$imgPath;
    				$Searchdetails['model']=$model;
    				$Searchdetails['capcity']=$capcity;
    				$Searchdetails['vPrice']=$vPrice;
    				$Searchdetails['mileage']=$mileage;
    				$Searchdetails['price']=$price;
    				$Searchdetails['returnPrice']=$returnPrice;
    				$Searchdetails['multiPrice']=$multiPrice;
    				$Searchdetails['lFrom']=$lFrom;
    				
    				$Searchdetails['to']=$to;
    				$Searchdetails['needExtraPrice']=$needExtraPrice;
    			
    				 
    				$searchList[]=$Searchdetails;
    			}
    			
    			$data['success']=true;
    			$extras['msg']='';
    			$extras['searchList'] = $searchList;
    			$data['extras']=$extras;
    			return new Response (json_encode($data));
    			//$request->setTripType($tripType);
    			//$request->setNumDays($noDays);
    			//$session->set('selectedData',$searchFilter);
    			//$session->set('resultSet',$resultSet);
    			
    		
    		
    			//$contact = new Contact();
    			//$contactForm   = $this->createContactForm($contact);
    		
//     			return $this->render('TripBookingEngineBundle:Default:search.html.twig', array(
//     					'form'   => $form->createView(),
//     					'contactForm'   => $contactForm->createView(),
//     					'result'=>$resultSet,
//     					'tripType'=>$tripType,
//     			));
    		
    	//	}
//     		return $this->render('TripSiteManagementBundle:Default:index.html.twig', array(
//     				'form'   => $form->createView(),
//     		));
    		
    	}
    	
    	public function getVehicles($goingFrom,$goingTo){
    		$dql3 = "SELECT v.id,v.imgPath, v.model,v.capcity,v.price vPrice,v.mileage,v.dailyRent, c1.name lFrom,c2.name to FROM TripBookingEngineBundle:Vehicle v, TripSiteManagementBundle:City c1,TripSiteManagementBundle:City c2 WHERE v.active=1 and c1.id=$goingFrom and c2.id=$goingTo";
    		$em = $this->getDoctrine()->getManager();
    		$query = $em->createQuery($dql3);
    		$result = $query->getResult();
    		return $result;
    	}
    	public function getDailyRent($result,$numdays){
    		$tempCollection = array();
    		$numdays = $numdays+1;
    		foreach($result as $row){
    			$car = array();
    			$car['id']=$row['id'];
    			$car['imgPath']=$row['imgPath'];
    			$car['model']=$row['model'];
    			$car['capcity']=$row['capcity'];
    			$car['vPrice']=$row['dailyRent'];
    			$numdays = $numdays-1;
    			$nightHalt = 300*$numdays;
    			$car['kms']=$nightHalt;
    			$car['price']=$row['dailyRent'];
    			if($numdays>0){
    				$numdays = $numdays+1;
    				$car['price']=($row['dailyRent']*$numdays)+$nightHalt;
    			}
    			$car['lFrom']=$row['lFrom'];
    			$car['to']=$row['to'];
    			$car['mileage']=$row['mileage'];
    	
    			$tempCollection[$row['id']]=$car;
    		}
    		return $tempCollection;
    	}
    	
    	public function getResult($goingFrom,$goingTo,$noDays,$noData){
    		if($noDays>0){
    			// $noDays = $noDays-1;
    			$price = "(CASE WHEN c2.extraPrice = 1 THEN s.returnPrice+v.extraPrice*$noDays ELSE s.returnPrice END) returnPrice";
    			//$price = "(s.returnPrice+v.extraPrice*$noDays) returnPrice";
    		}else{
    			$price = "s.returnPrice";
    		}
    		$fromAndTo = "c1.name lFrom,c2.name to,c2.extraPrice needExtraPrice";
    		if($noData==1){
    			$fromAndTo = "c2.name lFrom,c1.name to,c1.extraPrice needExtraPrice";
    		}
    		$dql3 = "SELECT v.id,v.imgPath, v.model,v.capcity,v.price vPrice,v.extraPrice,v.mileage, s.price,$price, s.multiPrice, $fromAndTo FROM TripBookingEngineBundle:Vehicle v, TripBookingEngineBundle:Services s,TripSiteManagementBundle:City c1,TripSiteManagementBundle:City c2 WHERE s.leavingFrom=c1.id and s.goingTo=c2.id and s.vehicleId=v.id and v.active=1 and s.leavingFrom=$goingFrom and s.goingTo=$goingTo";
    		$em = $this->getDoctrine()->getManager();
    		$query = $em->createQuery($dql3);
    		$result = $query->getResult();
    		return $result;
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
    	
    	public function bookSubmitAction(Request $request)
    	{
    		header("Access-Control-Allow-Origin: *");
    		//$em = $this->getDoctrine()->getManager();
    		    		
    		$tripType = $request->get('tripType');
    		$leavingFrom = $request->get('leavingFrom');
    		$goingTo = $request->get('goingTo');
    		//$date = $request->get('date');    		
    		//$returnDate = $request->get('returnDate');
    		$date = $request->get('fromDate');
    		$returnDate = $request->get('returnDate');
    		$date = new \DateTime($date);
    		$returnDate = new \DateTime($returnDate);
    		$numAdult = $request->get('numAdult');
    		$preferTime = $request->get('preferTime');
    		
    		$id = $request->get('id');
    		$imgPath = $request->get('imgPath');
    		$model = $request->get('model');
    		$vPrice = $request->get('vPrice');
    		$extraPrice = $request->get('extraPrice');
    		$mileage = $request->get('mileage');
    		$price = $request->get('price');
    		$returnPrice = $request->get('returnPrice');
    		$multiPrice = $request->get('multiPrice');
    		$lFrom = $request->get('lFrom');
    		$to = $request->get('to');
    		$needExtraPrice = $request->get('needExtraPrice');
    		
    		$name = $request->get('name');
    		$email = $request->get('email');
    		$mobileno = $request->get('mobileno');
    		
    		
    		
    	
    		//$session = $request->getSession();
    		//$resultSet = $session->get('resultSet');
    		//$searchFilter = $session->get('selectedData');
    		//$selectedService = $session->get('selected');
    		//$searchHotel = $session->get('searchHotel');
    		//$locations = $session->get('locations');
    		//$guest = $session->get('guest');
    	
    	
    		$customer = new Customer();
    		$customer->setName($name);
    		$customer->setEmail($email);
    		$customer->setMobile($mobileno);
    		//$form   = $this->createBookingForm($customer);
    		//$form->handleRequest($request);
    	//	if ($form->isValid()) {
    		//	$couponApplyed = $customer->getHaveCoupon();
    		//	$couponCode = $customer->getCouponCode();
    		//	$paymentMode = $customer->getPaymentMode();
    			$em = $this->getDoctrine()->getManager();
    			$em->persist($customer);
    			$em->flush();
    			//$session->set('customer',$customer);
    			if($tripType=='roundtrip'){
    				$price = $returnPrice;
    			}else{
    				//if($searchFilter->getTripType()=='package'){
    				//	$price = $selectedService->getPrice()->first()->getPrice();
    				//}
//     				else{
//     				//	$price = $selectedService['price'];
//     				}
    			}
    			$finalPrice = $price;
//     			if($couponCode=='FIRSTRIDE'){
//     				$finalPrice = $price-50;
//     			}
    			if($tripType=='roundtrip'){
    				$returnPrice = $finalPrice;
    			}else{
//     				if($tripType=='package'){
//     					$selectedService->getPrice()->first()->setPrice($finalPrice);
//     				}else{
//     					$selectedService['price'] = $finalPrice;
//     				}
    			}
    			$booking = new Booking();
    			$booking->setCustomerId($customer->getId());
    			$bookingId = $this->getBookingId();
    			$booking->setBookingId($bookingId);
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
    	
    			
    		//	$booking->setPaymentMode($paymentMode);
    	
    			$amountToPay = $finalPrice;
    			$tax = 0;
//     			if($paymentMode=='advance'){
//     				$amountToPay = round($finalPrice*(50/100));
//     				//$tax = round($amountToPay*(3/100));
//     				//$amountToPay = $amountToPay+$tax;
//     			}else{
//     				$amountToPay = round($finalPrice*(30/100));
//     				//$tax = round($amountToPay*(3/100));
//     				// $amountToPay = $amountToPay+$tax;
//     			}
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
    			$em->persist($booking);
    			$em->flush();
    			//$session->set('bookingObj',$booking);
    			//$session->set('amountToPay',$amountToPay);
    			//$paymentLink = $this->getPaymentLink($request,$amountToPay,$customer,$booking);
    			
    			//$paymentLink = "https://www.instamojo.com/Waseemsyed/tirupati-caars-services-cb8a4/";
    			// $paymentLink.="?data_name=".$customer->getName()."&data_email=".$customer->getEmail()."&data_phone=".$customer->getMobile()."&embed=form";
    			//  $paymentLink = '';
    			$payuLink = $this->generateUrl ( 'trip_booking_engine_payment_payu' );
    			
    			//$key =  $paymentLink['key'];
    		/*	$key =  $paymentLink['key'];
    			$txnid =  $paymentLink['txnid'];
    			$amount =  $paymentLink['amount'];
    			$name =  $paymentLink['firstname'];
    			$email =  $paymentLink['email'];
    			$phone =  $paymentLink['phone'];
    			
    			$productinfo =  $paymentLink['productinfo'];
    			$surl =  $paymentLink['surl'];
    			$furl =  $paymentLink['furl'];
    			$service_provider =  $paymentLink['service_provider'];
    			$hash =  $paymentLink['hash'];
    			$action =  $paymentLink['action'];*/
    			
    	//		echo var_dump($key);
    			
    		//	exit();
    			//http://localhost/hotel/web/app_dev.php/SH061217BDUM/pay-online
    			
    			$host = $request->getHost ();
    			//$paymentLink = 'http://' . $host .'/'. $bookingId.'/pay-online';
    			
    			//$redirectUrl = $this->generateUrl( 'room_booking_engine_payment_confirmation' );
    			$paymentLink = $this->generateUrl( 'trip_rest_payu_payment_trips',array (
    					'bookingId' => $bookingId
    			)  );
    			
    			
    			$txnid = 'PAYU'.$bookingId;
    			
    
    			$sUrl = 'http://' . $host . $paymentLink.'?payment_id='.$txnid.'&status=success';
    		   		
    		
    		
    		
    		/*$Payuinfo['key']=$key;
    		$Payuinfo['txnid']=$txnid;
    		$Payuinfo['amount']=$amount;
    		$Payuinfo['name']=$name;
    		$Payuinfo['email']=$email;
    		$Payuinfo['mobile']=$phone;
    		$Payuinfo['productinfo']=$productinfo;
    		$Payuinfo['surl']=$surl;
    		$Payuinfo['furl']=$furl;
    		$Payuinfo['service_provider']=$service_provider;
    		$Payuinfo['hash']=$hash;
    		$Payuinfo['action']=$action;*/
    		
    		
    	
    		$paymentList['url']=$sUrl;
    		$paymentList['leavingFrom']=$leavingFrom;
    		$paymentList['goingTo']=$goingTo;
    		$paymentList['name']=$name;
    		$paymentList['email']=$email;
    		$paymentList['mobileno']=$mobileno;
    		$paymentList['imgPath']=$imgPath;
    		$paymentList['finalPrice']=$finalPrice;
    		$paymentList['bookingId']=$bookingId;
    		
    		
    		
    	
    		$data['success']=true;
    		$extras['msg']='';
    		$extras['paymentList'] = $paymentList;
    		$data['extras']=$extras;
    		return new Response (json_encode($data));
    			
    		
    	
    	}
    	
    	
    	public function getPaymentLink($request,$amountToPay,$customer,$booking){
    	
    		$session = $request->getSession ();
    	
    		$bookingOld = $session->get('booking');
    	
    	
    	
    		$redirectUrl = $this->generateUrl ( 'trip_rest_booking_engine_success' );
    		$bookingId = $booking->getBookingId();
    	
    		//echo var_dump($redirectUrl);
    		//exit();
    	
    	
    		$data = $this->getData($request,$amountToPay,$bookingId,$customer,$redirectUrl);
    		//echo var_dump($data);
    		//exit();
    	
    		$info = $this->curlCall($data);
    	
    	
    	
    	
    		return  $data;
    	
    	
    	
    		$info['redirect_url']='https://test.payu.in/_payment';
    	
    		return $this->redirect($info['redirect_url']);
    	
    		//return $info['redirect_url'];
    	}
    	
    	
    	private function getData($request,$finalPrice,$bookingId,$customer,$redirectUrl){
    		// Merchant key here as provided by Payu
    		
    		//$MERCHANT_KEY = "ze3IGP8w";
    		//$SALT = "OAAknA88Xf";
    	
//payu test values    	
    		$SALT = "e5iIg1jwi8";
    		$MERCHANT_KEY = "rjQUPktU";
    	
    		// End point - change to https://secure.payu.in for LIVE mode
    		//$PAYU_BASE_URL = "https://secure.payu.in";
    	
    		//testing Mode
    		$PAYU_BASE_URL = "https://test.payu.in";
    	
    		$action = $PAYU_BASE_URL . '/_payment';
    		//$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    		$txnid = 'PAYU'.$bookingId;
    		$mobile = $customer->getMobile ();
    		$name = $customer->getName ();
    		$email = $customer->getEmail ();
    		$host = $request->getHost ();
    	
    		$sUrl = 'http://' . $host . $redirectUrl.'?payment_id='.$txnid.'&status=success';
    		$fUrl = 'http://' . $host . $redirectUrl.'?status=fail';
    	
    	
    		$data = array();
    		$data['key']= $MERCHANT_KEY;
    		$data['txnid']= $txnid;
    		$data['amount']= $finalPrice;
    		$data['firstname']= $name;
    		$data['email']= $email;
    		$data['phone']= $mobile;
    		$data['productinfo']= 'SterlingSuit services';
    		$data['surl']= $sUrl;
    		$data['furl']= $fUrl;
    		$data['service_provider']= 'payu_paisa';
    		$hash = $this->getHash($data,$SALT);
    		$data['hash']= $hash;
    		$data['action']= $action;
    	
    	
    		return $data;
    	
    	
    	}
    	
    	public function curlCall($data){
    		$headers = array("application/x-www-form-urlencoded");
    		$url = $data['action'];
    		$postData = http_build_query($data);
    	
    		$curl = curl_init($data['action']);
    	
    		curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    		curl_setopt($curl, CURLOPT_POST, true);
    		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    		curl_exec($curl);
    		$info = curl_getinfo($curl);
    	
    		if($errno = curl_errno($curl)) {
    			$error_message = curl_strerror($errno);
    			echo "cURL error ({$errno}):\n {$error_message}";
    		}
    	
    	
    		$errno = curl_errno($curl);
    		//echo var_dump($errno);
    		//echo var_dump(curl_strerror($errno));
    	
    		//echo var_dump($info);
    		//exit();
    	
    		return $info;
    	}
    		private function getHash($data,$SALT){
    		$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    	
    	$hashVarsSeq = explode('|', $hashSequence);
    				$hash_string = '';
    				foreach($hashVarsSeq as $hash_var) {
    				$hash_string .= isset($data[$hash_var]) ? $data[$hash_var] : '';
    					$hash_string .= '|';
    				}
    	
    				$hash_string .= $SALT;
    	
    	
    				$hash = strtolower(hash('sha512', $hash_string));
    				return $hash;
    		}
    		
    		private function getInstamojoPaymentLink($pay)
    		{
    			$request = $this->container->get('request');
    			$session = $request->getSession();
    			$api = new Instamojo('448a0f2cc618bb5df30044662a2fc2d4','febeeeac04668b90469cda6487914b1d');
    			$redirect_url = $this->generateUrl('trip_booking_engine_success');
    			$host = $request->getHost();
    			$Instamojo =true;
    			$url = "";
    			if($Instamojo){
    				try {
    					 
    					$response = $api->linkCreate(array(
    							'title'=>'Just Trip Services',
    							'description'=>'If you have any payment related issue please contact us',
    							'redirect_url'=>'http://'.$host.$redirect_url,
    							'base_price'=>$pay,
    							'currency'=>'INR'
    					));
    		
    					$url =$response['url'];
    					$slug =$response['slug'];
    					$session->set('url',$url);
    					$session->set('slug',$slug);
    					//print_r($response);
    				}
    				catch (\Exception $e) {
    					//print('Error: ' . $e->getMessage());
    					//exit();
    				}
    			}else {
    				$url ='http://'.$host.$redirect_url.'?status=success&payment_id=MOJOTEST12345';
    			}
    		
    			return $url;
    		
    		}
    		
    		public function bookSubmitInstamojoAction(Request $request)
    		{
    			header("Access-Control-Allow-Origin: *");
    			//$em = $this->getDoctrine()->getManager();
    		
    			$tripType = $request->get('tripType');
    			$leavingFrom = $request->get('leavingFrom');
    			$goingTo = $request->get('goingTo');
    			//$date = $request->get('date');
    			//$returnDate = $request->get('returnDate');
    			$date = $request->get('fromDate');
    			$returnDate = $request->get('returnDate');
    			$date = new \DateTime($date);
    			$returnDate = new \DateTime($returnDate);
    			$numAdult = $request->get('numAdult');
    			$preferTime = $request->get('preferTime');
    		
    			$id = $request->get('id');
    			$imgPath = $request->get('imgPath');
    			$model = $request->get('model');
    			$vPrice = $request->get('vPrice');
    			$extraPrice = $request->get('extraPrice');
    			$mileage = $request->get('mileage');
    			$price = $request->get('price');
    			$returnPrice = $request->get('returnPrice');
    			$multiPrice = $request->get('multiPrice');
    			$lFrom = $request->get('lFrom');
    			$to = $request->get('to');
    			$needExtraPrice = $request->get('needExtraPrice');
    		
    			$name = $request->get('name');
    			$email = $request->get('email');
    			$mobileno = $request->get('mobileno');
    		
    		
    		
    			 
    			//$session = $request->getSession();
    			//$resultSet = $session->get('resultSet');
    			//$searchFilter = $session->get('selectedData');
    			//$selectedService = $session->get('selected');
    			//$searchHotel = $session->get('searchHotel');
    			//$locations = $session->get('locations');
    			//$guest = $session->get('guest');
    			 
    			 
    			$customer = new Customer();
    			$customer->setName($name);
    			$customer->setEmail($email);
    			$customer->setMobile($mobileno);
    			//$form   = $this->createBookingForm($customer);
    			//$form->handleRequest($request);
    			//	if ($form->isValid()) {
    			//	$couponApplyed = $customer->getHaveCoupon();
    			//	$couponCode = $customer->getCouponCode();
    			//	$paymentMode = $customer->getPaymentMode();
    			$em = $this->getDoctrine()->getManager();
    			$em->persist($customer);
    			$em->flush();
    			//$session->set('customer',$customer);
    			if($tripType=='roundtrip'){
    				$price = $returnPrice;
    			}else{
    				//if($searchFilter->getTripType()=='package'){
    				//	$price = $selectedService->getPrice()->first()->getPrice();
    				//}
    				//     				else{
    				//     				//	$price = $selectedService['price'];
    				//     				}
    			}
    			$finalPrice = $price;
    			//     			if($couponCode=='FIRSTRIDE'){
    			//     				$finalPrice = $price-50;
    			//     			}
    			if($tripType=='roundtrip'){
    				$returnPrice = $finalPrice;
    			}else{
    				//     				if($tripType=='package'){
    				//     					$selectedService->getPrice()->first()->setPrice($finalPrice);
    				//     				}else{
    				//     					$selectedService['price'] = $finalPrice;
    				//     				}
    			}
    			$booking = new Booking();
    			$booking->setCustomerId($customer->getId());
    			$booking->setBookingId($this->getBookingId());
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
    			 
    			 
    			//	$booking->setPaymentMode($paymentMode);
    			 
    			$amountToPay = $finalPrice;
    			$tax = 0;
    			//     			if($paymentMode=='advance'){
    			//     				$amountToPay = round($finalPrice*(50/100));
    			//     				//$tax = round($amountToPay*(3/100));
    			//     				//$amountToPay = $amountToPay+$tax;
    			//     			}else{
    			//     				$amountToPay = round($finalPrice*(30/100));
    			//     				//$tax = round($amountToPay*(3/100));
    			//     				// $amountToPay = $amountToPay+$tax;
    			//     			}
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
    			$pay = $booking->setFinalPrice($finalPrice);
    			$em->persist($booking);
    			$em->flush();
    			//$session->set('bookingObj',$booking);
    			//$session->set('amountToPay',$amountToPay);
    			
    			
    			$paymentLink = $this->getInstamojoPaymentLink($pay);
    			
    			
    			//$paymentLink = "https://www.instamojo.com/@AAIRAHTECHNOLOGESPVTLTD/";
    			//$paymentLink = "https://www.instamojo.com/Waseemsyed/tirupati-caars-services-cb8a4/";
    			//$paymentLink.="?data_name=".$customer->getName()."&data_email=".$customer->getEmail()."&data_phone=".$customer->getMobile()."&embed=form";
    			//  $paymentLink = '';
    			
    			$Payuinfo['url']=$paymentLink;
    			
    		
    		
    			 
    			$paymentList[]=$Payuinfo;
    			 
    			$data['success']=true;
    			$extras['msg']='';
    			$extras['paymentList'] = $paymentList;
    			$data['extras']=$extras;
    			return new Response (json_encode($data));
    				 
    		}
    		public function instamojoAction(Request $request){
    			
    			try {
    				$response = $api->paymentRequestCreate(array(
    						"purpose" => "FIFA 16",
    						"amount" => "3499",
    						"send_email" => true,
    						"email" => "foo@example.com",
    						"redirect_url" => "http://www.example.com/handle_redirect.php"
    				));
    				print_r($response);
    			}
    			catch (Exception $e) {
    				print('Error: ' . $e->getMessage());
    			}
    		}
        
    		public function payonlineAction(Request $request,$bookingId){
    			

    			//$session = $request->getSession();
    			//$resultSet = $session->get('resultSet');
    			//$searchFilter = $session->get('search');
    			//$selectedService = $session->get('selected');
    			//$selectedRoom = $session->get('selectedRoom');
    			//$booking = $session->get('booking');
    			//$customer = $session->get('customer');
    			 
    			//$bookingDetails = $session->get('bookingDetails');
    			$session = $request->getSession();
    			$em = $this->getDoctrine()->getManager();
    			$bookingEntity = $em->getRepository('TripBookingEngineBundle:Booking')->findBy( array('bookingId' => $bookingId));
    			$booking=$bookingEntity[0];
    			
    			 
    			//var_dump($booking);
    			//	var_dump($bookingEntity->getFinalPrice());
    			 
    			 
    			$amountToPay = $booking->getFinalPrice();
    			$customerId = $booking->getCustomerId();
    			$customer = $em->getRepository('TripBookingEngineBundle:Customer')->findBy( array('id' => $customerId));
    			//var_dump($customer);
    			//exit();
    			$customer=$customer[0];
    			$redirectUrl = $this->generateUrl( 'trip_rest_booking_engine_success' );
    			$paymentLink = $this->getPaymentLink($request,$amountToPay,$customer,$booking,$redirectUrl);
    			 
    			$session->set('booking',$booking);
    			$session->set('customer',$customer);
    			//$session->set('booking',$booking);
    			//var_dump($paymentLink);
    			//exit();
    			 
    			//	$security = $this->container->get ( 'security.context' );
    			
    			//	$user = $security->getToken ()->getUser ();
    			 
    			return $this->render('TripBookingEngineBundle:Default:mobilePayment.html.twig', array(
    					'customer'   => $customer,
    					'booking'   => $booking,
    					
    					'paymentLink'   => $paymentLink,
    					 
    					 
    					 
    					 
    					 
    			));
    			
    		}
    		
    		
    		public function paymentcompleteAction(Request $request){
    		
    			//$session = $request->getSession();
    			header("Access-Control-Allow-Origin: *");
    			//$session = $request->getSession();
    			$name = $request->get('name');
    			$email = $request->get('email');
    			$mobileno = $request->get('mobileno');
    			
    			$paymentId = $request->get('payment_id');
    			$bookingId = $request->get('bookingId');
    			//var_dump($bookingId);
    			//exit();
    		//$security = $this->container->get ( 'security.context' );
    		$em = $this->getDoctrine()->getManager();
    		//$bookingId='JT151217DXHW';
    		
    	$booking = $em->getRepository('TripBookingEngineBundle:Booking')->findBy(array('bookingId' => $bookingId));
    	$booking=$booking[0];
    	 
    	//$customer = $em->getRepository('TripBookingEngineBundle:Customer')->find($booking->getCustomerId());    	 	
    	//var_dump($booking);
    	//exit();
    	$booking->setStatus('booked');
    	$booking->setPaymentId($paymentId);
    	date_default_timezone_set('Asia/Kolkata');
    	 
    	$today = new \DateTime();
    	$booking->setBookedOn($today);
    	
    	
    	$em->merge($booking);
    	$em->flush();
 //   	$paymentList['url']=$sUrl;
//     		$paymentList['leavingFrom']=$leavingFrom;
//     		$paymentList['goingTo']=$goingTo;
//     		$paymentList['name']=$name;
//     		$paymentList['email']=$email;
//     		$paymentList['mobileno']=$mobileno;
//     		$paymentList['imgPath']=$imgPath;
//     		$paymentList['finalPrice']=$finalPrice;
    		$payment['bookingId']=$bookingId; 
    	
    	$data['success']=true;
    	$extras['msg']='';
    	$extras['payment'] = $payment;
    	$data['extras']=$extras;
    	return new Response (json_encode($data));
    	
    	
    }
    
   
    public function paymentsucessAction(Request $request){
    
    	$session = $request->getSession();
    	$booking = $session->get ( 'booking' );
    	$customer = $session->get ( 'customer' );
    	 
    	 
    	$security = $this->container->get ( 'security.context' );
    	$em = $this->getDoctrine()->getManager();
    
    	//$booking = $em->getRepository('TripBookingEngineBundle:Booking')->findOneByBookingId($id);
    
    	//$customer = $em->getRepository('TripBookingEngineBundle:Customer')->find($booking->getCustomerId());
    	 
    	$booking->setStatus('booked');
    	$em->merge($booking);
    	$em->flush();
    	 
    	$email =  $customer->getEmail();
    	$name = $customer->getName();
    	$mobile = $customer->getMobile();
    	$bookingId = $booking->getBookingId();
    	/*$mail = "Dear $name <br> Your Booking has been Successfully completed.Your Booking Id is $bookingId";
    	 $adminMail = "Dear Admin, $name <br> has Done Booking Successfully and Booking Id is $bookingId";
    	$locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
    	$locations = $this->getLocationsByIndex($locations);
    	$mail = $this->renderView(
    			'TripBookingEngineBundle:Mail:packageMailer.html.twig',
    			array(
    					'customer'   => $customer,
    					'booking'=>$booking,
    					'locations'=>$locations,
    					'services'=>$booking->getVehicleBooking(),
    			)
    	);
    	 
    	$mailService = $this->container->get( 'mail.services' );
    	$mailService->mail($email,'Just Trip:Booking Confirmation',$mail);
    	 
    	// $mailService->mail('Payment@justtrip.in','Just Trip:Booking Confirmation',$adminMail);
    	$mailService->mail('info@justtrip.in','Just Trip:Booking Confirmation',$mail);*/
    	 
    	 
    	 
    	return $this->render('TripBookingEngineBundle:Default:success.html.twig',array(
    			'booking'   => $booking,
    	));
    }
    
}
