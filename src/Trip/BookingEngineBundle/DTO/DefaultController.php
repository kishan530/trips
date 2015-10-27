<?php

namespace Boat\Bundles\BookingEngineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boat\Bundles\BookingEngineBundle\DTO\Search;
use Boat\Bundles\BookingEngineBundle\DTO\SearchResults;
use Boat\Bundles\BookingEngineBundle\Form\SearchType;
use Boat\Bundles\BookingEngineBundle\Form\SearchResultType;
use Boat\Bundles\BookingEngineBundle\Form\BookingType;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boat\Bundles\BookingEngineBundle\DTO\SearchFilter;
use Boat\Bundles\BookingEngineBundle\DTO\PersonalDetail;
use Boat\Bundles\BookingEngineBundle\DTO\GuestDetail;
use Boat\Bundles\CommonBundle\DependencyInjection\Instamojo;
use Boat\Bundles\BookingEngineBundle\DTO\BookingResponse;
/**
 * This is the controller for the Booking engine.
 *
 * @author 4th Dymension Teknocrats
 * @copyright   <a> 4th Dymension Teknocrats India LLP - 2014</a>
 */
class DefaultController extends Controller
{
    /**
     * 
     * @param Request $request
     */
	
	private function search($request,$entity){
		
		$form   = $this->createSearchForm($entity);
		$form->handleRequest($request);		
		$city = $entity->getLocation();
		$weather = $this->getWeather($city);
		$BoatService = $this->container->get( 'boat_home.services' );
		$result = $BoatService->getSearchResults($entity);
		$minPrice = $result->getMinPrice();
		$maxPrice = $result->getMaxPrice();
		$minRoom = $result->getMinRoom();
		$maxRoom = $result->getMaxRoom();
		$entity->setPrice("$minPrice;$maxPrice");
		$entity->setNumRoom("$minRoom;$maxRoom");
		$entity->setCurrency('INR');
		$filter  = $this->createSearchResultForm($entity);
    	$session = $request->getSession();
    	$session->set('converted_result',null);
    	$session->set('converted_selected_boat',null);
    	$session->set('filter',$entity);
		return $this->render('BoatBundlesBookingEngineBundle:Default:searchResult.html.twig', array(
				'entity' => $entity,
				'weather'=>$weather,
				'result'=>$result,
				'searchResult'=>$result,
				'form'   => $form->createView(),
				'filter'=> $filter->createView()));
	}
	/**
	 * 
	 * @param Request $request
	 */
    public function searchAction(Request $request){ 
    	$entity = new SearchFilter();
    	return $this->search($request,$entity);
    	      
    }
    /**
     * 
     * @param Request $request
     */
    public function bookingByLocationAction(Request $request){
    	$entity = new SearchFilter();
    	$location = $request->get('location');
    	$entity->setLocation($location);
    	date_default_timezone_set('Asia/Kolkata');
    	$current = date ( 'd/m/Y' );
    	$entity->setArrivalTime($current);
    	list ( $d, $m, $y ) = explode ( '/', $current );
    	$next_date = Date ( 'd/m/Y', mktime ( 0, 0, 0, $m, $d+1, $y ) );
    	$entity->setDepartureTime($next_date);
    	$entity->setHouseboat('1');
    	$entity->setNumAdult('2');
    	$entity->setNumChild(0);
    	$entity->setNumInfant(0);
    	return $this->search($request,$entity); 	
    }
    
    /**
     * 
     * @param Request $request
     */
    public function filterAction(Request $request){
    	$entity = new SearchFilter();
    	
 		$filter  = $this->createSearchResultForm($entity);
    	$filter->handleRequest($request);
    	$form   = $this->createSearchForm($entity);
    	$city = $entity->getLocation();
    	$currency = $entity->getCurrency();
    	$weather = $this->getWeather($city);
    	$bookingTransformer = $this->container->get( 'booking_transform.services' );
    	$session = $request->getSession();
    	$session->set('filter',$entity);
    	$searchResult = $session->get('search_result');
    	$copyResult = clone $searchResult;
    	$copyResult = $bookingTransformer->convertCurrency($copyResult,$currency);
    	
    	if ($filter->get('apply')->isClicked()) {
    		$result = $this->getFilterData($entity,$bookingTransformer,$copyResult);
    	}else{
    		$entity->setCategory(array());
    		$rooms = $copyResult->getMinRoom().";".$copyResult->getMaxRoom();
    		$entity->setNumRoom($rooms);
    		$filter  = $this->createSearchResultForm($entity);
    		$result = $copyResult;
    	}
    	$result = $bookingTransformer->sort($result,'ASC');

    	$session->set('converted_result',$result);
     	return $this->render('BoatBundlesBookingEngineBundle:Default:searchResult.html.twig', array(
    			'entity' => $entity,
    			'weather'=>$weather,
    			'result'=>$result,
     			'searchResult'=>$searchResult,
    			'form'   => $form->createView(),
    			'filter'=> $filter->createView()));
    	 
    }
    
    
    /**
     *
     * @param Request $request
     */
    public function getFilterData($entity,$bookingTransformer,$copyResult){
    	$price = $entity->getPrice();
    	$minMaxPrice = explode(";",$price);
    	$numRooms = $entity->getNumRoom();
    	$minMaxRooms = explode(";",$numRooms);
    	$minPrice = (float) $minMaxPrice[0];
    	$maxPrice = (float) $minMaxPrice[1];
    	$minRoom = (int) $minMaxRooms[0];
    	$maxRoom =(int) $minMaxRooms[1];
    	$categories = $entity->getCategory();
    	$copyResult->setMinPrice($minPrice);
    	$copyResult->setMaxPrice($maxPrice);
    	$copyResult->setMinRoom($minRoom);
    	$copyResult->setMaxRoom($maxRoom);
    	if(count($categories)>0)
    		$copyResult = $bookingTransformer->filterResultByCategory($copyResult,$categories);
    	$result = $bookingTransformer->filterResultByPrice($copyResult);
    	$result = $bookingTransformer->filterResultByRoom($result);
    	
    	return $result;
    }
    
    /**
     *
     * @param Request $request
     */
    public function convertCurrencyAction(Request $request){
    	$session = $request->getSession();
    	$filter = $session->get('filter');
    	$currency = $request->get('currency');
    	$bookingTransformer = $this->container->get( 'booking_transform.services' );
    	$searchResult = $session->get('search_result');
    	//$temp = new $searchResult;
    	$copyResult = clone $searchResult;
    	$result = $bookingTransformer->convertCurrency($copyResult,$currency);
    	$result = $bookingTransformer->getMinMax($result);
    	$min = $result->getMinPrice();
    	$max = $result->getMaxPrice();
    	$searchResult->setMinPrice($min);
    	$searchResult->setMaxPrice($max);
    	$priceRange = $min.';'.$max;
    	$filter->setPrice($priceRange);
    	$filter->setCurrency($currency);
    	if(!is_null($filter))
    		$result = $this->getFilterData($filter,$bookingTransformer,$result);
    	 $session->set('converted_result',$result);
    	 $filterForm  = $this->createSearchResultForm($filter);
    	 $form   = $this->createSearchForm($filter);
    	 $city = $filter->getLocation();
    	 $weather = $this->getWeather($city);
     	return $this->render('BoatBundlesBookingEngineBundle:Default:searchResult.html.twig', array(
    			'entity' => $filter,
    			'weather'=>$weather,
    			'result'=>$result,
     			'searchResult'=>$searchResult,
    			'form'   => $form->createView(),
    			'filter'=> $filterForm->createView()));
    
    }
    /**
     *
     * @param Request $request
     */
    public function sortAction(Request $request){
    	$session = $request->getSession();
    	$entity = $session->get('filter');
    	$sortType = $request->get('sort_type');
    	$bookingTransformer = $this->container->get( 'booking_transform.services' );
    	$searchResult = $session->get('search_result');
    	$converted = $session->get('converted_result');
    	if(!is_null($converted)){
    		$result = $bookingTransformer->sort($converted,$sortType);
    	}else{
    		$result = $bookingTransformer->sort($searchResult,$sortType);
    	}
    	$session->set('converted_result',$result);
    	return $this->render('BoatBundlesBookingEngineBundle:Default:result.html.twig', array(
    			'result'=>$result,
    	));
    
    }
    
    /**
     *
     * @param Request $request
     */
    public function getConvertedAction(Request $request){
    	$session = $request->getSession();
    	$result = $session->get('converted_result');
    	return $this->render('BoatBundlesBookingEngineBundle:Default:result.html.twig', array(
    			'result'=>$result,
    	));
    
    }
    
    /**
     *
     * @param Search $entity
     * @return unknown
     */
    private function getWeather($city){
    	// Language of data (try your own language here!):
    	$lang = 'en';    	
    	// Units (can be 'metric' or 'imperial' [default]):
    	$units = 'metric';    	
    	// Get OpenWeatherMap object. Don't use caching (take a look into Example_Cache.php to see how it works).
    	$owm = new OpenWeatherMap();    	
    	try {
    		$weather = $owm->getWeather($city, $units, $lang,'a93a74642c5599fe5ec0f05adeb0374c');
    	} catch(OWMException $e) {
    		//echo 'OpenWeatherMap exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
    		//echo "<br />\n";
    	} catch(\Exception $e) {
    		//echo 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
    		//echo "<br />\n";
    	}
    
    	return $weather;
    }
   
    /**
     *
     * @param Search $entity
     * @return unknown
     */
    private function createSearchForm(SearchFilter $entity){
		$BoatService = $this->container->get( 'boat_home.services' );
    	$em = $this->getDoctrine()->getManager();
    	$form = $this->createForm(new SearchType($BoatService), $entity, array(
    			'action' => $this->generateUrl('boat_bundles_booking_engine_search_result'),
    			'method' => 'GET',
    	));
    	$form->add('submit', 'submit', array('label' => 'Search'));
    	return $form;
    }
    /**
     *
     * @param Search $entity
     * @return unknown
     */
    private function createSearchResultForm(SearchFilter $entity){
    	$BoatService = $this->container->get( 'boat_home.services' );
    	$em = $this->getDoctrine()->getManager();
    	$form = $this->createForm(new SearchResultType($BoatService), $entity, array(
    			'action' => $this->generateUrl('boat_bundles_booking_engine_search_filter'),
    			'method' => 'GET',
    	));
    	//$form->add('filter', 'submit', array('label' => 'Search'));
    	return $form;
    }
    
    
    /**
     *
     * @param Search $entity
     * @return unknown
     */
    private function createBookingForm($guest){
    	$BoatService = $this->container->get( 'boat_home.services' );
    	$form = $this->createForm(new BookingType($BoatService), $guest, array(
    			'action' => $this->generateUrl('boat_bundles_booking_engine_booking_submit'),
    			'method' => 'POST',
    	));
    	//$form->add('submit', 'submit', array('label' => 'Next'));
    	return $form;
    }
    
    /**
     * 
     * @param Request $request
     */
    public function bookingAction(Request $request){
    	$guest = new PersonalDetail(); 
    	$hotelId = $request->get('operator');
    	$hotelAcc = $request->get('operatorAcc');
    	$BoatId = $request->get('boat');
		$session = $request->getSession();
		$result = $session->get('search_result');
		$filter = $session->get('filter');
		$converted = $session->get('converted_result');
		$currency = $result->getCurrencySign();
    	$hotels = $result->getHouseBoatDetails();
    	$selectedBoat = $hotels[$hotelAcc]->getBoatList()[0][$BoatId];
    	$session->set('selected_boat',$selectedBoat);
    	$session->set('hotel',$hotels[$hotelAcc]->getId());
    	if(!is_null($converted)){
    		$actualHotels = $hotels;
    		$hotels = $converted->getHouseBoatDetails();
    		$currency = $converted->getCurrencySign();
    		$selectedBoat = $hotels[$hotelAcc]->getBoatList()[0][$BoatId];
    		$session->set('converted_selected_boat',$selectedBoat);
    	}
    	$form   = $this->createBookingForm($guest);
    	$session = $request->getSession();
    	
    	
    	
    	
    	
    	return $this->render('BoatBundlesBookingEngineBundle:Default:booking.html.twig', array(
    			'guest' => $guest,
    			'boat' => $selectedBoat,
    			'filter'=> $filter,
    			'currency'=> $currency,
    			'form'   => $form->createView()));
    	 
    }
    /**
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bookingSubmitAction(Request $request){
    	$guest = new PersonalDetail();
    	$session = $request->getSession();
    	$selectedBoat = $session->get('selected_boat');
    	$filter = $session->get('filter');
    	$result = $session->get('search_result');
    	$convertedResult = $session->get('converted_result');
    	$currency = $result->getCurrencySign();
    	$converted = false;
    	if(!is_null($convertedResult)){
    		$hotels = $convertedResult->getHouseBoatDetails();
    		$currency = $convertedResult->getCurrencySign();
    		$selectedBoat=$session->get('converted_selected_boat');
    		$converted = true;
    	}
    	$form   = $this->createBookingForm($guest);
    	$form->handleRequest($request);
    	
    	//If all data are correct
    	if ($form->isValid()) {
    		$guestDetail = new GuestDetail();
    		$bookingTransformer = $this->container->get( 'booking_transform.services' );
    		$guestDetail = $bookingTransformer->mapObject($guest,$guestDetail);
    		$session->set('guestDetail',$guestDetail);
    		$hotel = $session->get('hotel');
    		$BoatService = $this->container->get( 'boat_home.services' );
    		$response = $BoatService->book($guestDetail,$selectedBoat,$filter,$hotel,$converted);
    		$session->set('bookingResponse',$response);
    		return new Response('true');	
    	}
    	return $this->render('BoatBundlesBookingEngineBundle:Default:booking.html.twig', array(
    			'guest' => $guest,
    			'boat' => $selectedBoat,
    			'filter'=> $filter,
    			'currency'=> $currency,
    			'form'   => $form->createView()));
    }
    /**
     * After booking payment confirmation
     */
    public function bookingConfirmAction(){
    	$request = $this->container->get ( 'request' );
    	$session = $request->getSession();
    	$payment_id = $request->get('payment_id');
    	$status = $request->get('status');
    	$guest = $session->get('guestDetail');
    	$hotel = $session->get('hotel');
    	$selectedBoat = $session->get('selected_boat');
		$convertedSelectedBoat = $session->get('converted_selected_boat');
		$converted = false;
    	if(!is_null($convertedSelectedBoat)){
			$selectedBoat = $session->get('converted_selected_boat');
			$converted = true;
		}
    	$filter = $session->get('filter');
    	$response = $session->get('bookingResponse');
    	$BoatService = $this->container->get( 'boat_home.services' );
    	if($status=='success')    
    	$response = $BoatService->confirmBooking($response);
    	
    	//$errorCode = $response->getCode();
    	return $this->render('BoatBundlesBookingEngineBundle:Default:bookingConfirmation.html.twig', array(
    			'status' => $status,
    			'paymentId' => $payment_id,
    			'response' => $response,
    			));
    
    }
    /**
     * 
     * @return Payment
     */
    public function bookingPaymentAction(){
    	$request = $this->container->get ( 'request' );
    	$session = $request->getSession();
    	$selectedBoat = $session->get('selected_boat');
    	$convertedSelectedBoat = $session->get('converted_selected_boat');
    	if(!is_null($convertedSelectedBoat)){
    		$converted = $session->get('converted_result');
    		$paymentLink = $this->getPaymentLink($convertedSelectedBoat->getNetAmount(),$converted->getCurrency());
    	}else{
    	$paymentLink = $this->getPaymentLink($selectedBoat->getTotalAmount(),'INR');
      return $this->redirect($paymentLink);
    }
   }
/**
 * 
 */
    public function bookingDetailAction(Request $request){
    	$session = $request->getSession();
    	$guest = $session->get('guestDetail');
    	$selectedBoat = $session->get('selected_boat');
    	$convertedSelectedBoat = $session->get('converted_selected_boat');
    	$response = $session->get('bookingResponse');  
    	$error = true;
    	$paymentLink = "";
    	if ($response instanceof BookingResponse) {
    		$error = false;
    		if(!is_null($convertedSelectedBoat)){
    			$converted = $session->get('converted_result');
    			$inrAmount = $convertedSelectedBoat->getInrAmount();
    			$paymentLink = $this->getPaymentLink($inrAmount,'INR');
    		}else{
    			$paymentLink = $this->getPaymentLink($selectedBoat->getNetAmount(),'INR');
    		}
    		 
    		$dataName=$guest->getFirstName();
    		$dataName=urlencode($dataName);
    		$dataEmail=$guest->getEmail();
    		$dataMobile=$guest->getPhoneNumber();
    		$paymentLink = 'https://www.instamojo.com/stayboat/stayboat-services-d4588/';
    		$paymentLink .= '?data_name='.$dataName.'&data_email='.$dataEmail.'&data_phone='.$dataMobile;
    		
    	}
    	return $this->render('BoatBundlesBookingEngineBundle:Default:bookingDetail.html.twig',array(
    		'guest' => $guest,
    		'paymentLink' => $paymentLink,
    		'response' => $response,
    		'error' => $error,
    	));
    }
    /**
     * payment
     * @param Request $request
     */
   private function getPaymentLink($pay,$currency)
    {    
    	$request = $this->container->get ( 'request' );
    	$session = $request->getSession();
    	$api = new Instamojo('f10fab2c0d6864fe81d284f720f3e7a3','2e1eba34c1e44b8cec1278ac8060afe2');
    	$redirect_url = $this->generateUrl('boat_bundles_booking_engine_booking_confirm');
    	$host = $request->getHost();
    	$Instamojo =$this->container->getParameter('Instamojo');
    	$url = "";
    	if($Instamojo){
    		try {
    			
    			$response = $api->linkCreate(array(
    					'title'=>'StayBoat services',
    					'description'=>'If you have any payment related issue please contact us at support@stayboat.in or 89-7000-0405',    					
    					'redirect_url'=>'http://'.$host.$redirect_url,
    					'base_price'=>$pay,
    					'currency'=>$currency
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
    
    
}