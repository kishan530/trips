<?php

namespace Trip\BookingEngineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Trip\BookingEngineBundle\Form\SearchType;
use Trip\BookingEngineBundle\DTO\SearchFilter;
use Trip\BookingEngineBundle\Form\SearchHotelType;
use Trip\BookingEngineBundle\DTO\SearchHotel;
use Trip\BookingEngineBundle\Entity\Customer;
use Trip\BookingEngineBundle\Entity\Booking;
use Trip\BookingEngineBundle\Entity\VehicleBooking;
use Trip\BookingEngineBundle\Entity\HotelBooking;
use Trip\BookingEngineBundle\Form\CustomerType;
use Trip\BookingEngineBundle\Form\GuestType;
use Trip\BookingEngineBundle\DependencyInjection\Instamojo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
class BookingController extends Controller
{

    /**
     * 
     * @param Search $entity
     * @return unknown
     */
    private function createSearchForm(SearchFilter $entity){
		
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new SearchType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_booking_engine_search'),
    			'method' => 'GET',
    	));
    	
    	return $form;
    }
    /**
     * 
     * @param Search $entity
     * @return unknown
     */
    private function createBookingForm(Customer $entity){
    	$form = $this->createForm(new CustomerType(), $entity, array(
    			'action' => $this->generateUrl('trip_booking_engine_book_submit'),
    			'method' => 'POST',
    	));
    	
    	return $form;
    }
    
    /**
	 * 
	 */
    public function indexAction(){
    	return $this->getHome('TripSiteManagementBundle:Default:index.html.twig');
    }
    /**
	 * 
	 */
    public function hotelsAction(){
    	return $this->getHome('TripSiteManagementBundle:Default:hotels.html.twig');
    }
    /**
	 * 
	 */
    public function packagesAction(){
    	return $this->getHome('TripSiteManagementBundle:Default:packages.html.twig');
    }
    /**
	 * 
	 */
    public function dealsAction(){
    	return $this->getHome('TripSiteManagementBundle:Default:deals.html.twig');
    }
    /**
    *
    */    
    private function getHome($view){
        $searchFilter = new SearchFilter();
    	$form   = $this->createSearchForm($searchFilter);
         $searchHotel = new SearchHotel();
    	$hotelForm   = $this->createSearchHotelForm($searchHotel);      
        return $this->render($view, array(
    			'form'   => $form->createView(),
                'hotelForm'   => $hotelForm->createView(),
        ));
    }
    
    
    /**
     * 
     * @param Search $entity
     * @return unknown
     */
    private function createSearchHotelForm(SearchHotel $entity){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new SearchHotelType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_booking_engine_search_hotel'),
    			'method' => 'GET',
    	));
    	
    	return $form;
    }
    public function searchAction(Request $request)
    {
        $searchFilter = new SearchFilter();
        $searchFilter->setDate(new \DateTime());
    	$form   = $this->createSearchForm($searchFilter);
        $form->handleRequest($request);
    	if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $session = $request->getSession();
           $session->set('searchHotel',null);
            $date = $searchFilter->getDate(); 
            $returnDate = $searchFilter->getReturnDate();
            
             $tripType = $request->get('tripType');
            if($tripType=="multicity"){
                 $numdays = $searchFilter->getNumdays(); 
                $multiple = $searchFilter->getMultiple(); 
                $count = count($multiple);
                 $start = $multiple[0]->getLeavingFrom(); 
                 $end = $multiple[$count-1]->getGoingTo();
                 $startDate = $multiple[0]->getDate(); 
                 $endDate = $multiple[$count-1]->getDate();
                 $interval = $endDate->diff($startDate);
                 $noDays = $interval->d+1;
                $resultCollection = array();
                foreach($multiple as $multicity){
                    $goingFrom = $multicity->getLeavingFrom();       
                    $goingTo = $multicity->getGoingTo();           
                    $result = $this->getVehicles($goingFrom,$goingTo);
                    $result = $this->getResultByCars($result,$noDays);
                    $resultCollection[]=$result;
                }
                /*if($start != $end){
                    $result = $this->getResult($end,$start);
                    $result = $this->getResultByCars($result);
                    $resultCollection[]=$result;
                }*/
                $resultSet = $this->getResultSet($resultCollection);
            }else{
                $goingFrom = $searchFilter->getLeavingFrom();       
                $goingTo = $searchFilter->getGoingTo();  
                $noDays =0;
                if($tripType=="roundtrip"){
                    $interval = $returnDate->diff($date);
                    $noDays = $interval->d;
                }
                $resultSet = $this->getResult($goingFrom,$goingTo,$noDays);
                if(count($resultSet)==0)
                    $resultSet = $this->getResult($goingTo,$goingFrom,$noDays);
            }
            $searchFilter->setTripType($tripType);
            $searchFilter->setNumDays($noDays);
            $session->set('selectedData',$searchFilter);
            $session->set('resultSet',$resultSet);
        
            return $this->render('TripBookingEngineBundle:Default:search.html.twig', array(
                'form'   => $form->createView(),
                'result'=>$resultSet,
                'tripType'=>$tripType
            ));
            
        }
         return $this->render('TripSiteManagementBundle:Default:index.html.twig', array(
    			'form'   => $form->createView(),
        ));
        
    }
    public function getVehicles($goingFrom,$goingTo){
            $dql3 = "SELECT v.id,v.imgPath, v.model,v.capcity,v.price vPrice,v.mileage, c1.name lFrom,c2.name to FROM TripBookingEngineBundle:Vehicle v, TripSiteManagementBundle:city c1,TripSiteManagementBundle:city c2 WHERE v.active=1 and c1.id=$goingFrom and c2.id=$goingTo";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);					
            $result = $query->getResult();
         return $result;        
     }
     public function getResult($goingFrom,$goingTo,$noDays){
         if($noDays>0){
            // $noDays = $noDays-1;
             $price = "(CASE WHEN c2.extraPrice = 1 THEN s.returnPrice+v.extraPrice*$noDays ELSE s.returnPrice END) returnPrice";
             //$price = "(s.returnPrice+v.extraPrice*$noDays) returnPrice";
         }else{
             $price = "s.returnPrice";
         }
            $dql3 = "SELECT v.id,v.imgPath, v.model,v.capcity,v.price vPrice,v.extraPrice,v.mileage, s.price,$price, s.multiPrice, c1.name lFrom,c2.name to,c2.extraPrice needExtraPrice FROM TripBookingEngineBundle:Vehicle v, TripBookingEngineBundle:Services s,TripSiteManagementBundle:city c1,TripSiteManagementBundle:city c2 WHERE s.leavingFrom=c1.id and s.goingTo=c2.id and s.vehicleId=v.id and v.active=1 and s.leavingFrom=$goingFrom and s.goingTo=$goingTo";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);					
            $result = $query->getResult();
         return $result;        
     }
    public function getResultByCars($result,$numdays){
        $tempCollection = array();
        foreach($result as $row){
            $car = array();
            $car['id']=$row['id'];
            $car['imgPath']=$row['imgPath'];
            $car['model']=$row['model'];
             $car['capcity']=$row['capcity'];
            $car['price']=$row['vPrice']*$numdays;
            $car['lFrom']=$row['lFrom'];
            $car['to']=$row['to'];
            $car['mileage']=$row['mileage'];
            
            $tempCollection[$row['id']]=$car;
        }
        return $tempCollection;        
    }
    public function getResultSet($resultCollection){
        $sumArray = array();
        $count = array();
        foreach($resultCollection as $id=>$result){
            foreach($result as $k=>$row){
                 $count[$k] = isset($count[$k]) ?  $count[$k]+1 : 1;               
                foreach($row as $index=>$value){
                    if($index=='price')
                        //$sumArray[$k][$index] = isset($sumArray[$k][$index]) ?  $value + $sumArray[$k][$index] : $value;
                        $sumArray[$k][$index] = isset($sumArray[$k][$index]) ?  $value : $value;
                    else
                        if($index=='lFrom')
                            $sumArray[$k][$index] = isset($sumArray[$k][$index]) ?  $this->addFrom($sumArray[$k][$index],$value)  : new ArrayCollection(array($value));
                        else
                            $sumArray[$k][$index] = isset($sumArray[$k][$index]) ?  $value : $value;
                        
                }
            }
        }
        
        foreach($count as $i=>$v){
                if($v<count($resultCollection)){
                    unset($sumArray[$i]);
                }           
        }
        return $sumArray;
    }
     public function addFrom($collection,$value){
        $collection->add($value);
         return $collection;
     }
    public function searchHotelAction(Request $request)
    {
         $searchHotel = new SearchHotel();
    	$form   = $this->createSearchHotelForm($searchHotel); 
        $form->handleRequest($request);
    	if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $session = $request->getSession();      
            $goingTo = $searchHotel->getGoingTo();
            $date = $searchHotel->getDate(); 
            $returnDate = $searchHotel->getReturnDate();
            $session->set('searchHotel',$searchHotel);
            $dql3 = "SELECT h FROM TripSiteManagementBundle:Hotel h WHERE h.active=1 and h.cityId=$goingTo";
            $query = $em->createQuery($dql3);					
            $result = $query->getResult();
            $session->set('selectedData',$searchHotel);
            $session->set('resultSet',$result);
            return $this->render('TripBookingEngineBundle:Default:searchHotel.html.twig', array(
                'form'   => $form->createView(),
                'result'=>$result,
            ));
            
        }
        
    }
    
    public function bookAction(Request $request)
    {
         $session = $request->getSession();
         $resultSet = $session->get('resultSet');
        $searchFilter = $session->get('selectedData');
        $searchHotel = $session->get('searchHotel');
         $selectedService = $session->get('selected');
        
        $customer = new Customer();
    	$form   = $this->createBookingForm($customer);
        if(!is_null($searchHotel)){
             return $this->render('TripBookingEngineBundle:Default:hotelBooking.html.twig', array(
                'form'   => $form->createView(),
               'service'=>$selectedService,
                'discount'=>0,
             'filter'=>$searchFilter,
            ));
        }else{
         return $this->render('TripBookingEngineBundle:Default:booking.html.twig', array(
                'form'   => $form->createView(),
               'service'=>$selectedService,
             'discount'=>0,
             'filter'=>$searchFilter,
            ));
        }
        
    }
    
    public function applyCouponAction(Request $request)
    {
         $session = $request->getSession();
        $searchFilter = $session->get('selectedData');
         $selectedService = $session->get('selected');
         $couponCode = $request->get('coupon');
        
       $tripType =  $searchFilter->getTripType();
       
        if($couponCode=='FIRSTRIDE'){
             if($tripType=='roundtrip'){
                $price = $selectedService['returnPrice'];
            }else{
                $price = $selectedService['price'];
            }
            $price = $price-50;
            return new response("$price");
        }else{
            return new response('false');
        }       
    }
    
    /**
     * 
     * @param Search $entity
     * @return unknown
     */
    private function createGuestForm(Customer $entity){
    	$form = $this->createForm(new GuestType(), $entity, array(
    			'action' => $this->generateUrl('trip_booking_engine_confirm'),
    			'method' => 'POST',
    	));
    	
    	return $form;
    }
    public function confirmAction(Request $request)
    {

        $selected = $request->get('selected');
        $session = $request->getSession();
        $resultSet = $session->get('resultSet');
        $selectedService = $resultSet[$selected];
        $searchFilter = $session->get('selectedData');
        $searchHotel = $session->get('searchHotel');
         $session->set('selected',$selectedService);
        
        $customer = new Customer();
    	$form   = $this->createGuestForm($customer);
        $form->handleRequest($request);
    	if ($form->isValid()) {
            
    		return $this->redirect($this->generateUrl('trip_booking_engine_book'));
        }
    
        if(!is_null($searchHotel)){
             return $this->render('TripBookingEngineBundle:Default:hotelConfirm.html.twig', array(
                'form'   => $form->createView(),
               'service'=>$selectedService,
             'filter'=>$searchFilter,
                 'discount'=>0,
                 'selected'=>$selected
            ));
        }else{
         return $this->render('TripBookingEngineBundle:Default:confirm.html.twig', array(
                'form'   => $form->createView(),
               'service'=>$selectedService,
             'filter'=>$searchFilter,
             'discount'=>0,
             'selected'=>$selected
            ));
        }
        
    }
    
    public function bookSubmitAction(Request $request)
    {


         $session = $request->getSession();
         $resultSet = $session->get('resultSet');
        $searchFilter = $session->get('selectedData');
        $selectedService = $session->get('selected');
        $searchHotel = $session->get('searchHotel');
        
        $customer = new Customer();
    	$form   = $this->createBookingForm($customer);
        $form->handleRequest($request);
    	if ($form->isValid()) {
            $couponApplyed = $customer->getHaveCoupon();
            $couponCode = $customer->getCouponCode();
             $paymentMode = $customer->getPaymentMode();
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
    		$em->flush();
             $session->set('customer',$customer);
                if($searchFilter->getTripType()=='roundtrip'){
                    $price = $selectedService['returnPrice'];
                }else{
                    $price = $selectedService['price'];
                }
                $finalPrice = $price;
                if($couponCode=='FIRSTRIDE'){
                    $finalPrice = $price-50;
                }     
                if($searchFilter->getTripType()=='roundtrip'){
                    $selectedService['returnPrice'] = $finalPrice;
                }else{
                    $selectedService['price'] = $finalPrice;
                }
            $booking = new Booking();
            $booking->setCustomerId($customer->getId());
            $booking->setBookingId($this->getBookingId());
            $booking->setTotalPrice($price);
            $booking->setFinalPrice($finalPrice);
            $booking->setStatus('pending');
            $booking->setBookedOn(new \DateTime());
            $booking->setNumDays($searchFilter->getNumDays());
            $booking->setNumAdult($searchFilter->getNumAdult());
            $booking->setPreferTime($searchFilter->getPreferTime());
            $discount = 0;
            if($couponApplyed){
                $booking->setCouponApplyed(1);
                $booking->setCouponCode($couponCode);
                $booking->setDiscount(50);
                $discount = 50;
            }else{
                $booking->setCouponApplyed(0);
            }

             if(!is_null($searchHotel)){
                 $booking = $this->setVehicleBooking($selectedService,$searchFilter,$price,$booking);
             }else{
                if($searchFilter->getTripType()=='multicity'){
                    $multiple = $searchFilter->getMultiple(); 
                    foreach($multiple as $multicity){
                        $leavingFrom = $multicity->getLeavingFrom();
                        $goingTo = $multicity->getGoingTo();
                        $returnDate = null;
                        $date = $multicity->getDate();
                        $booking = $this->setVehicleBooking($selectedService,$searchFilter,$leavingFrom,$goingTo,$date,$returnDate,0,$booking);
                    }
                }else{
                    $leavingFrom = $searchFilter->getLeavingFrom();
                    $goingTo = $searchFilter->getGoingTo();
                    $returnDate = $searchFilter->getReturnDate();
                    $date = $searchFilter->getDate();
                    $booking = $this->setVehicleBooking($selectedService,$searchFilter,$leavingFrom,$goingTo,$date,$returnDate,$price,$booking);

                }
             }
            $booking->setPaymentMode($paymentMode);
            $em->persist($booking);
    		$em->flush();
            $session->set('bookingObj',$booking);
            $amountToPay = $finalPrice; 
            if($paymentMode=='advance'){
                $amountToPay = round($finalPrice*(10/100));
                $tax = round($amountToPay*(3/100));
                $amountToPay = $amountToPay+$tax; 
            }else{
                $tax = round($finalPrice*(3/100));
                $amountToPay = $finalPrice+$tax;              
            }
            $paymentLink = $this->getPaymentLink($amountToPay);
        //$paymentLink = "https://www.instamojo.com/Waseemsyed/tirupati-caars-services-cb8a4/";
        $paymentLink.="?data_name=".$customer->getName()."&data_email=".$customer->getEmail()."&data_phone=".$customer->getMobile()."&embed=form";
        return $this->render('TripBookingEngineBundle:Default:payment.html.twig', array(
                'customer'   => $customer,
               'service'=>$selectedService,
             'filter'=>$searchFilter,
            'discount'=>$discount,
            'paymentLink'   => $paymentLink,
            ));
        }
        if(!is_null($searchHotel)){
             return $this->render('TripBookingEngineBundle:Default:hotelBooking.html.twig', array(
                'form'   => $form->createView(),
               'service'=>$selectedService,
                 'discount'=>0,
             'filter'=>$searchFilter,
            ));
        }else{
         return $this->render('TripBookingEngineBundle:Default:booking.html.twig', array(
                'form'   => $form->createView(),
               'service'=>$selectedService,
             'discount'=>0,
             'filter'=>$searchFilter,
            ));
        }
        
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
    private function setVehicleBooking($selectedService,$searchFilter,$leavingFrom,$goingTo,$date,$returnDate,$price,$booking){
            $vehicleBooking = new VehicleBooking();
            $vehicleBooking->setVehicleId($selectedService['id']);
            $vehicleBooking->setModel($selectedService['model']);
            $vehicleBooking->setLeavingFrom($leavingFrom);
            $vehicleBooking->setGoingTo($goingTo);
            $vehicleBooking->setDate($date);
            $vehicleBooking->setReturnDate($returnDate);
            $vehicleBooking->setTripType($searchFilter->getTripType());
            $vehicleBooking->setPrice($price);
            $vehicleBooking->setBooking($booking);
            $booking->addVehicleBooking($vehicleBooking);
            return $booking;
    }
    private function setHotelBooking($selectedService,$searchFilter,$price,$booking){
            $hotelBooking = new HotelBooking();
            $hotelBooking->setHotelId($selectedService->getId());
            $hotelBooking->setHotelName($selectedService->getName());
            $hotelBooking->setLocation($searchFilter->getGoingTo());
            $hotelBooking->setChekIn($searchFilter->getDate());
            $hotelBooking->setChekOut($searchFilter->getReturnDate());
            $hotelBooking->setPrice($price);
            $hotelBooking->setBooking($booking);
            $booking->addHotelBooking($hotelBooking);
            return $booking;
    }
    public function paymentAction(Request $request)
    {


         $session = $request->getSession();
         $resultSet = $session->get('resultSet');
        $searchFilter = $session->get('selectedData');
        $selectedService = $session->get('selected');
        
        $customer = $session->get('customer');
        
        $paymentLink = $this->getPaymentLink($pay);
        //$paymentLink = "";
        return $this->render('TripBookingEngineBundle:Default:payment.html.twig', array(
                'customer'   => $customer,
               'service'=>$selectedService,
             'filter'=>$searchFilter,
            'paymentLink'   => $paymentLink,
            ));
        
    }
    
    
    public function successAction(Request $request)
    {


        $session = $request->getSession();
        $slug = $session->get('slug');
        $api = new Instamojo('ef3f69991b90c0e0f1c7220ff941cdae','9e9707de38d0ff4d2f17df778e3347ef');
    	try {	
    			$response = $api->linkDelete($slug);
    		}
    		catch (\Exception $e) {
    			//print('Error: ' . $e->getMessage());
    			//exit();
    		}
        $paymentId = $request->get('payment_id');
    	$status = $request->get('status');
         $resultSet = $session->get('resultSet');
        $searchFilter = $session->get('selectedData');
        $selectedService = $session->get('selected');
        
        $customer = $session->get('customer');
        
        $booking = $session->get('bookingObj');
         $em = $this->getDoctrine()->getManager();
        if($status=='success'){
            $booking->setStatus('booked');
            $paymentMode = $booking->getPaymentMode();
            $finalPrice = $booking->getFinalPrice();
            $amountToPay = $finalPrice; 
            if($paymentMode=='advance'){
                $amountToPay = round($finalPrice*(10/100));
                $tax = round($amountToPay*(3/100));
                $amountToPay = $amountToPay+$tax; 
            }else{
                $tax = round($finalPrice*(3/100));
                $amountToPay = $finalPrice+$tax;              
            }
            $booking->setAmountPaid($amountToPay);
            $booking->setPaymentId($paymentId);
            $em->merge($booking);
            $em->flush();
            $email =  $customer->getEmail();
            $name = $customer->getName();
            $mobile = $customer->getMobile();
            $bookingId = $booking->getBookingId();
            $body = "Dear $name <br> Your Booking has been Successfully completed.Your Booking Id is $bookingId <br>
            <tabel>";
            
                $mail = $this->renderView(
    								'TripBookingEngineBundle:Mail:mailer.html.twig',
    								array(
    										'customer'   => $customer,
    										'booking'=>$booking,
    										'service'=>$booking->getVehicleBooking()[0],
    								)
    						);

            $mailService = $this->container->get( 'mail.services' );
            $mailService->mail($email,'Just Trip:Booking Confirmation',$mail);
        }else{
            $booking->setStatus('fail');
            $em->merge($booking);
            $em->flush();
        }

        
        return $this->render('TripBookingEngineBundle:Default:success.html.twig', array(
                'customer'   => $customer,
               'service'=>$selectedService,
             'filter'=>$searchFilter,
             'status'=>$status,
            ));
        
    }
    
        /**
     * payment
     * @param Request $request
     */
   private function getPaymentLink($pay)
    {    
    	$request = $this->container->get ( 'request' );
    	$session = $request->getSession();
    	$api = new Instamojo('85655d9228c3d547cc845cdb4d8fbb7f','90d771ae26098c1d76f69f76e518cdfb');
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
}
