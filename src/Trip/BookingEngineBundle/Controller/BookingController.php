<?php

namespace Trip\BookingEngineBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Trip\BookingEngineBundle\Entity\Customer;
use Trip\BookingEngineBundle\DTO\Customer as CustomerDto;
use Trip\BookingEngineBundle\Entity\Booking;
use Trip\BookingEngineBundle\Entity\BikeBooking;
use Trip\BookingEngineBundle\Entity\Billing;
use Trip\BookingEngineBundle\Form\CustomerType;
use Trip\BookingEngineBundle\Form\BillingType;
use Trip\BookingEngineBundle\Form\EditCustomerType;
use Trip\BookingEngineBundle\Form\GuestType;
use Trip\SiteManagementBundle\Entity\Contact;
use Trip\SiteManagementBundle\Form\ContactType;
use Trip\SiteManagementBundle\Form\biketimerangeType;
use Trip\BookingEngineBundle\DependencyInjection\Instamojo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Trip\SiteManagementBundle\Entity\BillingPlacesToVisit;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class BookingController extends Controller
{
    
    
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
        //$mailService = $this->container->get( 'mail.services' );
        //$mailService->mail('kishan.kish530@gmail.com','Just Trip:Booking Confirmation','this is test');
        $security = $this->container->get ( 'security.context' );
        if ($security->isGranted ( 'ROLE_ADMIN' )){
            return $this->redirect ( $this->generateUrl ( "trip_site_management_billing_list" ) );
        }
       
        return $this->getHome('TripSiteManagementBundle:Default:index.html.twig');
    }
    
    
    public function dealsAction(){
        return $this->getHome('TripSiteManagementBundle:Default:deals.html.twig');
        
        //test
    }
    /**
     *
     */
    private function getHome($view){
        $em = $this->getDoctrine()->getManager();
       
        $active='1';
        $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findBy(array('active' => $active));
        return $this->render($view, array(
            //'form'   => $form->createView(),
            //'hotelForm'   => $hotelForm->createView(),
            'bikes' => $bikes,
        ));
    }
    public function footerAction(){
        $em = $this->getDoctrine()->getManager();
        $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        $cities = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        return $this->render('TripBookingEngineBundle:Default:footerTabs.html.twig', array(
            'bikes' => $bikes,
            'cities'=> $cities,
            
        ));
        
        
    }
        
    /**
     *
     * @param Contact $entity
     * @return unknown
     */
    private function createContactForm(Contact $entity)
    {
        $form = $this->createForm(new ContactType(), $entity, array(
            'action' => $this->generateUrl('trip_site_management_contact'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Submit Now'));
        return $form;
    }
    
    public function addFrom($collection,$value){
        $collection->add($value);
        return $collection;
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
                
                if($tripType=='package'){
                    $price = $selectedService->getPrice()->first()->getPrice();
                }else{
                    $price = $selectedService['price'];
                }
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
        $em = $this->getDoctrine()->getManager();
        $selected = $request->get('selected');
        $session = $request->getSession();
        $resultSet = $session->get('resultSet');
        $selectedService = $resultSet[$selected];
        $searchFilter = $session->get('selectedData');
        if($searchFilter->getTripType()=='package')
            if(!$selectedService->getStartPoint()->first())
                $selectedService = $em->getRepository('TripSiteManagementBundle:Package')->find($selectedService->getId());
                $searchFilter = $session->get('selectedData');
                $searchHotel = $session->get('searchHotel');
                $session->set('selected',$selectedService);
                $locations = $session->get('locations');
                
                $customer = new Customer();
                $form   = $this->createGuestForm($customer);
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $session->set('guest',$customer);
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
                    $searchFilter = $session->get('selectedData');
                    //echo var_dump($searchFilter->getTripType()=='package');
                    //exit();
                    return $this->render('TripBookingEngineBundle:Default:confirm.html.twig', array(
                        'form'   => $form->createView(),
                        'service'=>$selectedService,
                        'filter'=>$searchFilter,
                        'discount'=>0,
                        'selected'=>$selected,
                        'locations' => $locations,
                        'step'=>'review',
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
   

    public function paymentAction(Request $request)
    {
        
        
        $session = $request->getSession();
        $resultSet = $session->get('resultSet');
        $searchFilter = $session->get('selectedData');
        $selectedService = $session->get('selected');
        
        $customer = $session->get('customer');
        
        $paymentLink = $this->getPaymentLink($request,$amountToPay,$customer,$booking);
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
        $amountToPay = $session->get('amountToPay');
        $em = $this->getDoctrine()->getManager();
        $countinsert = $session->get('countinsert');
        $id = $session->get('id');
        //echo var_dump($countinsert);
        //die();
        if($status=='success'){
            $booking->setStatus('booked');
            $paymentMode = $booking->getPaymentMode();
            $finalPrice = $booking->getFinalPrice();
            $dql3 = "UPDATE TripSiteManagementBundle:bikes b SET b.count = '$countinsert' WHERE b.id = '$id' ";
            $query = $em->createQuery($dql3);
            $query -> execute();
            $booking->setAmountPaid($amountToPay);
            $booking->setPaymentId($paymentId);
            $em->merge($booking);
            $em->flush();
            $email =  $customer->getEmail();
            $name = $customer->getName();
            $mobile = $customer->getMobile();
            $bookingId = $booking->getBookingId();
            $bikesbookings = $em->getRepository('TripBookingEngineBundle:BikeBooking')->findAll();
            $mail = "Dear $name <br> Your Booking has been Successfully completed.Your Booking Id is $bookingId";
            $adminMail = "Dear Admin, $name <br> has Done Booking Successfully and Booking Id is $bookingId";
            
             $mail = $this->renderView(
             'TripBookingEngineBundle:Mail:mailer.html.twig',
             array(
             'customer'   => $customer,
             'booking'=>$booking,
             'bikesbookings' => $bikesbookings
              //'service'=>$booking->getBikeBooking()[0],
             )
             );
           
            
            $mailService = $this->container->get( 'mail.services' );
            $mailService->mail($email,'Just Trip:Booking Confirmation',$mail);
            $mailService->mail('Payment@justtrip.in','Just Trip:Booking Confirmation',$adminMail);
            $mailService->mail('info@justtrip.in','Just Trip:Booking Confirmation',$adminMail);
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
    
    
    
    public function payuAction(Request $request){
        $session = $request->getSession ();
        $customer = $session->get ( 'customer');
        $booking = $session->get ( 'booking' );
        $redirectUrl = $this->generateUrl( 'trip_booking_engine_confirm' );
        //$total = $booking->getFinalAmount();
        
        $finalPrice =$booking->getFinalPrice();
        $bookingId = $booking->getBookingId();
        
        
        $data = $this->getData($request,$finalPrice,$bookingId,$customer,$redirectUrl);
        $info = $this->curlCall($data);
        
        return $this->redirect($info['redirect_url']);
    }
    
    /**
     * payment
     * @param Request $request
     */
    
    public function getPaymentLink($request,$amountToPay,$customer,$booking){
        
        $session = $request->getSession ();
        
        $bookingOld = $session->get('booking');
        
        
        
        $redirectUrl = $this->generateUrl ( 'trip_booking_engine_success' );
        $bookingId = $booking->getBookingId();
        
        //echo var_dump($redirectUrl);
        //exit();
        
        
        $data = $this->getData($request,$amountToPay,$bookingId,$customer,$redirectUrl);
        //echo var_dump($data);
        //exit();
        
        $info = $this->curlCall($data);
        
        
        
        
        return  $data;
        
        
        
        $info['redirect_url']='https://test.payu.in/_payment';
        https://checkout.citruspay.com/payu
        return $this->redirect($info['redirect_url']);
        
        //return $info['redirect_url'];
    }
    
    
    private function getData($request,$finalPrice,$bookingId,$customer,$redirectUrl){
        // Merchant key here as provided by Payu
        $MERCHANT_KEY = "rjQUPktU";
        //$MERCHANT_KEY = "ze3IGP8w";
        
        
        //$MERCHANT_KEY = "OwPbxU2k";
        //$SALT = "aa70fUA5Hh";
        // Merchant Salt as provided by Payu
        
        $SALT = "e5iIg1jwi8";
        //$SALT = "OAAknA88Xf";
        
        // End point - change to https://secure.payu.in for LIVE mode
      //  $PAYU_BASE_URL = "https://secure.payu.in";
        
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
    

   
    public function getLocationsByIndex($locations){
        $temp = array();
        foreach($locations as $location){
            $temp[$location->getId()]=$location;
        }
        return $temp;
    }
    
    
    //********** Sreekanth**************//
    
    public function removeTrailingSlashAction(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        $requestUri = $request->getRequestUri();
        
        $url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);
        
        return $this->redirect($url, 301);
    }
   
    //********** Bikes Booking Controllers**************//
    private function createbikeGuestForm(Customer $entity){
        $form = $this->createForm(new GuestType(), $entity, array(
            'action' => $this->generateUrl('trip_booking_engine_confirm_bike'),
            'method' => 'POST',
        ));
        
        return $form;
    }
    public function confirmBikeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $id = $request->get('id');
        $title = $request->get('title');
        $pDate = $request->get('pDate');
        $rDate = $request->get('rDate');
        $price = $request->get('price');
        //$vehicleIndex = $request->get('vehicleIndex');
        //echo var_dump($selected);
        // exit();
        $customer = new Customer();
        $form   = $this->createbikeGuestForm($customer);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $session->set('guest',$customer);
            return $this->redirect($this->generateUrl('trip_booking_engine_booking_bike'));
        }
        
        //$searchFilter = $session->get('selectedData');
        //echo var_dump($searchFilter->getTripType()=='package');
        //exit();
        return $this->render('TripBookingEngineBundle:Default:confirmBike.html.twig', array(
            'form'   => $form->createView(),
            'service'=> $id,
            'filter'=> $title,
            'discount'=>0,
            'selected'=> $pDate,
            'locations' => $rDate,
            'price'=> $price,
            'step'=>'review',
        ));
        
        
    }
    
    public function bookingBikeAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        //$resultSet = $session->get('resultSet');
        //$searchFilter = $session->get('selectedData');
        //echo var_dump($session);
        //exit();
        // $session->set('guest',$customer);
        $id = $request->get('id');
        $title = $request->get('title');
        $pDate = $request->get('pDate');
        $rDate = $request->get('rDate');
       $price = $request->get('price');
        //$price=5;
        $leftdays = $request->get('leftdays');
        $hours = $request->get('hours');
        $location = $request->get('location');
        $countinsert = $request->get('countinsert');
        $bikearea = $request->get('bikearea');
        $package =$em->getRepository('TripSiteManagementBundle:bikes')->find($id);
        $count = $package->getCount();
        //echo var_dump($package);
        //echo var_dump($count);
        // exit();
        
        $session->set('id',$id);
        $session->set('title',$title);
        $session->set('pDate',$pDate);
        $session->set('rDate',$rDate);
        $session->set('price',$price);
        $session->set('leftdays',$leftdays);
        $session->set('hours',$hours);
        $session->set('location',$location);
        $session->set('count',$count);
        $session->set('countinsert',$countinsert);
        $session->set('bikearea',$bikearea);
        $guest = $session->get('guest');
        $customer = new Customer();
        //$customer->setEmail($guest->getEmail());
        //$customer->setMobile($guest->getMobile());
        $form   = $this->createBikeBookingForm($customer);
        
        return $this->render('TripBookingEngineBundle:Default:bookingBike.html.twig', array(
            'form'   => $form->createView(),
            'service'=> $id,
            'filter'=> $title,
            'discount'=>0,
            'selected'=> $pDate,
            'locations' => $rDate,
            'location' => $location,
            'price'=> $price,
            'leftdays' => $leftdays,
            'hours' => $hours,
            'bikearea' => $bikearea,
            'step'=>'personal',
        ));
        
    }
    private function createBikeBookingForm(Customer $entity){
        $form = $this->createForm(new CustomerType(), $entity, array(
            'action' => $this->generateUrl('trip_booking_engine_book_bike_submit'),
            'method' => 'POST',
        ));
        
        return $form;
    }
    public function bookbikeSubmitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        /*$resultSet = $session->get('resultSet');
         $searchFilter = $session->get('selectedData');
         $selectedService = $session->get('selected');
         $searchHotel = $session->get('searchHotel');
         $locations = $session->get('locations');*/
        $id = $session->get('id');
        $title = $session->get('title');
        $pDate = $session->get('pDate');
        $rDate = $session->get('rDate');
        $price = $session->get('price');
        $leftdays = $session->get('leftdays');
        $hours = $session->get('hours');
        $location = $session->get('location');
        $paymentMode = $request->get('mode');
        $countinsert = $session->get('countinsert');
        $bikearea = $session->get('bikearea');
        //$count = $session->get('count');
        //echo var_dump($countinsert);
        
        //$newDate = date("Y-m-d H:i:s", $pDate);
        //echo var_dump($paymentMode);
         //exit();
        $guest = $session->get('guest');
        $customer = new Customer();
        //$customer->setEmail($guest->getEmail());
        //$customer->setMobile($guest->getMobile());
        $form   = $this->createBookingForm($customer);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $couponApplyed = $customer->getHaveCoupon();
            $couponCode = $customer->getCouponCode();
            //$paymentMode = $customer->getPaymentMode();
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
            $session->set('customer',$customer);
            
            $finalPrice = $price;
            /*if($couponCode=='FIRSTRIDE'){
                $finalPrice = $price-50;
            }*/
            
            $booking = new Booking();
            $booking->setCustomerId($customer->getId());
            $booking->setBookingId($this->getBookingId());
            $booking->setTotalPrice($price);
            $booking->setFinalPrice($finalPrice);
            $booking->setStatus('pending');
            $booking->setJobStatus('Open');
            $booking->setBookedOn(new \DateTime());
            $booking->setNumDays($leftdays);
            $booking->setNumAdult($hours);
            $booking->setPreferTime($title);
           // $booking = $this->setBikeBooking($price,$title,$id,$booking);
            
            $bikebooking= new BikeBooking();
            $bikebooking->setPrice($price);
            $bikebooking->setBikeId($id);
            $bikebooking->setBikeId($id);
            $bikebooking->setBikeName($title);
            $bikebooking->setPdate($pDate);
            $bikebooking->setRdate($rDate);
            $bikebooking->setLeftdays($leftdays);
            $bikebooking->setHours($hours);
            $bikebooking->setBikelocation($location);
            $bikebooking->setBikearea($bikearea);
            $booking->setBikeBooking($bikebooking);
            $discount = 0;
            if($couponApplyed){
                $booking->setCouponApplyed(1);
                $booking->setCouponCode($couponCode);
                $booking->setDiscount(50);
                $discount = 50;
            }else{
                $booking->setCouponApplyed(0);
            }
            
            
            
            $booking->setPaymentMode($paymentMode);
            
            $amountToPay = $finalPrice;
            $tax = 0;
            /*if($paymentMode==50){
                $amountToPayadv = round($finalPrice*(50/100));
                
            }else{
                $amountToPayadv = round($finalPrice*(30/100));
                
            }*/
            $serviceTax = 0;
            $swachBharthCess = round($finalPrice*(2.5/100),2);
            //$swachBharthCess =0;
            $krishiKalyanCess = round($finalPrice*(2.5/100),2);
           // $krishiKalyanCess =0;
            $totalTax = $serviceTax+$swachBharthCess+$krishiKalyanCess;
            $amountToPay = round($amountToPay+$totalTax);
            $finalPrice = $finalPrice+$totalTax;
            $booking->setTax($tax);
            $booking->setServiceTax($serviceTax);
            $booking->setSwachBharthCess($swachBharthCess);
            $booking->setKrishiKalyanCess($krishiKalyanCess);
            $booking->setFinalPrice($finalPrice);
            
            
            $bikebooking->setBooking($booking);
            
            $em->persist($booking);
            $em->flush();
            $session->set('bookingObj',$booking);
            $session->set('amountToPay',$amountToPay);
            $paymentLink = $this->getPaymentLink($request,$amountToPay,$customer,$booking);
            //$paymentLink = "https://www.instamojo.com/Waseemsyed/tirupati-caars-services-cb8a4/";
            // $paymentLink.="?data_name=".$customer->getName()."&data_email=".$customer->getEmail()."&data_phone=".$customer->getMobile()."&embed=form";
            //  $paymentLink = '';
            $payuLink = $this->generateUrl ( 'trip_booking_engine_payment_payu' );
            
           // var_dump($customer);
            // var_dump($booking);
            //var_dump($selectedService);
            //var_dump($searchFilter);
           // var_dump($paymentLink);
            
             //exit();
            return $this->render('TripBookingEngineBundle:Default:paymentBike.html.twig', array(
                'customer'   => $customer,
                'booking'   => $booking,
                'step'=>'payment',
                //'service'=>$selectedService,
                //'filter'=>$searchFilter,
                //'discount'=>$discount,
                'paymentLink'   => $paymentLink,
                'payuLink' => $payuLink,
                //'locations' => $locations,
                'service'=> $id,
                'filter'=> $title,
                'discount'=>0,
                'selected'=> $pDate,
                'locations' => $rDate,
                'price'=> $price,
                'amountToPay' => $amountToPay,
                'leftdays' => $leftdays,
                'hours' => $hours,
                'location' => $location,
                'bikearea' => $bikearea,
                'paymentMode' => $paymentMode,
                'finalPrice' => $finalPrice,
               // 'amountToPayadv' => $amountToPayadv,
            ));
        }
        
        
        return $this->render('TripBookingEngineBundle:Default:bookingBike.html.twig', array(
            'form'   => $form->createView(),
            'service'=>$selectedService,
            'discount'=>0,
            'filter'=>$searchFilter,
            'locations' => $locations,
            'bikearea' => $bikearea,
            'step'=>'personal',
        ));
        
        
    }


   
    //**************End************//
}
