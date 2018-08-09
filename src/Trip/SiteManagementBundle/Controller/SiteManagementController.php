<?php

namespace Trip\SiteManagementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Trip\SiteManagementBundle\Entity\City;
use Trip\SiteManagementBundle\Form\LocationType;
use Trip\SiteManagementBundle\Entity\Contact;
use Trip\SiteManagementBundle\Form\ContactType;
use Trip\SiteManagementBundle\Entity\Biketime;
use Trip\SiteManagementBundle\Form\biketimerangeType;
use Trip\SiteManagementBundle\Form\PriceviewbikesType;
use Trip\SiteManagementBundle\Entity\Cancel;
use Trip\SiteManagementBundle\Form\CancelType;
use Trip\SiteManagementBundle\DTO\BookingSearch;
use Trip\SiteManagementBundle\Form\BookingSearchType;
use Trip\SiteManagementBundle\Form\EditBikesType;
use Trip\SiteManagementBundle\Form\AddBikesType;
use Trip\SiteManagementBundle\Entity\bikes;
use Trip\BookingEngineBundle\Entity\BikeBooking;
use Trip\SiteManagementBundle\Entity\BikesCityMain;
use Trip\SiteManagementBundle\Entity\BikesCity;
use Trip\SiteManagementBundle\Entity\BikesCityArea;
use Trip\SiteManagementBundle\Form\AddBikeMainCityType;
use Trip\SiteManagementBundle\Form\AddBikeCityType;
use Trip\SiteManagementBundle\Form\AddBikeCityAreaType;
use Trip\SiteManagementBundle\Form\EditBikeMainCityType;
use Trip\SiteManagementBundle\Form\EditBikeCityType;
use Trip\SiteManagementBundle\Form\EditBikeCityAreaType;
use Trip\BookingEngineBundle\Entity\Booking;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Trip\SiteManagementBundle\Entity\bikespackage;
use Trip\SiteManagementBundle\Form\EditBikesPackageType;
use Trip\SiteManagementBundle\Form\AddBikesPackageType;

class SiteManagementController extends Controller
{
    
    /**
     *
     */
    public function aboutUsAction()
            {
        return $this->render('TripSiteManagementBundle:Static:aboutUs.html.twig');
    }

    /**
     *
     */
    public function TermsAction(){
        return $this->render('TripSiteManagementBundle:Static:terms.html.twig');
    }
    
    /**
     *
     */
    public function BikesTermsAction(){
        return $this->render('TripSiteManagementBundle:Static:bikesterms.html.twig');
    }
    /**
     *
     */
    public function faqAction(){
        return $this->render('TripSiteManagementBundle:Static:faq.html.twig');
    }
    
 
    /**
	 *
	 * @param BookingSearch $bookingSearch        	
	 * @return unknown
	 */
	private function createBookingSearchForm(BookingSearch $bookingSearch) {
		$form = $this->createForm ( new BookingSearchType (), $bookingSearch, array (
				'action' => $this->generateUrl ( 'trip_site_management_booking_search' ),
				'method' => 'POST' 
		) );		
		$form->add ( 'submit', 'submit', array (
				'label' => 'Search' 
		) );
		return $form;
	}
    /**
	 * 
	 */
    public function changeStatusAction(Request $request){
        $id = $request->get('id');
        $status = trim($request->get('status'));
        $em = $this->getDoctrine()->getManager();
		$booking = $em->getRepository('TripBookingEngineBundle:Booking')->find($id);
        $booking->setJobStatus($status);
		$em->merge($booking);
    	$em->flush();
        return new Response ( "true" );
    }
    
    /**

	 *

	 * @param Request $request        	

	 */

	public function bookingSearchAction(Request $request) {

		$security = $this->container->get ( 'security.context' );

		$user = $security->getToken ()->getUser ();

		if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {

			return $this->redirect ( $this->generateUrl ('trip_security_sign_up') );

		}

		$bookingSearch = new BookingSearch ();

		$form = $this->createBookingSearchForm ( $bookingSearch );

		$form->handleRequest ( $request );

		if ($form->isValid ()) {

			$bookingId = $bookingSearch->getBookingId ();

			$from_date = $bookingSearch->getStartDate ();

			if($from_date)

			{
                list ( $d, $m, $y ) = explode ( '/', $from_date );
				$from_date = new \Datetime($y.'-'.$m.'-'.$d);

			}

			else

			{

				$from_date = new \Datetime('2012-01-01');

			}
            
            $to_date = $bookingSearch->getEndDate ();

            list ( $d, $m, $y ) = explode ( '/', $to_date );
			$to_date = new \Datetime($y.'-'.$m.'-'.$d);
            if(!is_null($bookingId)){
                $from_date = new \Datetime('2012-01-01');
                $to_date = new \Datetime();
            }

			$from_date->format('Y-m-d');			
			$to_date->format('Y-m-d');

			$em = $this->getDoctrine ()->getManager ();

			

				$doctrineQuery = $this->getDoctrine ()->getRepository ( 'TripBookingEngineBundle:Booking' )->createNamedQuery ( 'bookings' );

				$doctrineQuery->setParameter ( 'start', $from_date ); 

				$doctrineQuery->setParameter ( 'end', $to_date ); 

				$doctrineQuery->setParameter ( 'bookingId', '%' . $bookingId . "%" ); 

				$bookings = $doctrineQuery->getResult ();
            
                     //$locations = $em->getRepository('TripSiteManagementBundle:city')->findAll();
         $customers = $em->getRepository('TripBookingEngineBundle:Customer')->findAll();
         $bikesbookings = $em->getRepository('TripBookingEngineBundle:BikeBooking')->findAll();
         
         //echo var_dump($customers);
         //die();
        //$locations = $this->getLocationsByIndex($locations);
       // $customers = $this->getCustomersByIndex($customers);
		$data = $this->render('TripSiteManagementBundle:Default:exportBookings.html.twig',array(
    			'bookings' => $bookings,
            //'locations' => $locations,
            'customers' => $customers,
    	));
		$request = $this->container->get('request');
		$session = $request->getSession();
        $session->set('exportBookings',$data);

			return $this->render ( 'TripSiteManagementBundle:Default:bookings.html.twig', array (

				    'bookings' => $bookings,
                   // 'locations' => $locations,
                    'customers' => $customers,
			    'bikesbookings' => $bikesbookings,
                'form' => $form->createView () 

			) );

		}

		return $this->render ( 'TripSiteManagementBundle:Default:bookings.html.twig', array (

				'bookingSearch' => $bookingSearch,
                'bookings' => null,
				'form' => $form->createView () 

		) );

	}
    
    
    /**
     *
     */
    public function bookingsAction(){
        $security = $this->container->get ( 'security.context' );
        if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {

			return $this->redirect ( $this->generateUrl ('trip_security_sign_up') );

		}
        $em = $this->getDoctrine()->getManager();
        $bookings = $em->getRepository('TripBookingEngineBundle:Booking')->findBy(array(), array('id' => 'DESC'));
         $locations = $em->getRepository('TripSiteManagementBundle:city')->findAll();
         $customers = $em->getRepository('TripBookingEngineBundle:Customer')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $customers = $this->getCustomersByIndex($customers);		
    	return $this->render('TripSiteManagementBundle:Default:bookings.html.twig',array(
    			'bookings' => $bookings,
            'locations' => $locations,
            'customers' => $customers,
    	));
    }
	    /**
     *
     */
    public function exportBookingsAction(){
		$request = $this->container->get('request');
		$session = $request->getSession();
        $view = $session->get('exportBookings');
		header ( 'Content-Type: application/force-download' );
		header ( 'Content-disposition: attachment; filename=bookings.xls' );
		//echo var_dump($view);
		//exit();
		return $view;
	}
    /**
     *
     */
    public function myBookingsAction(){
        $security = $this->container->get ( 'security.context' );
    	if (! $security->isGranted ( 'IS_AUTHENTICATED_FULLY' )) {
    		return $this->redirect ( $this->generateUrl ( "trip_security_sign_up" ) );
    	}
        $user = $security->getToken ()->getUser ();
    	$username = $user->getUserName ();
        $em = $this->getDoctrine()->getManager();
        $bookings = $this->getMybookings($username);
         $locations = $em->getRepository('TripSiteManagementBundle:city')->findAll();
        $locations = $this->getLocationsByIndex($locations);
    	return $this->render('TripSiteManagementBundle:Default:myBookings.html.twig',array(
    			'bookings' => $bookings,
            'locations' => $locations,
            //'customers' => $customers,
    	));
    }
    
    
    /**
     * Creates a form to create a FeedBack entity.
     *
     * @param FeedBack $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
 private function createCancelForm(Cancel $entity)
    {
        $form = $this->createForm(new CancelType(), $entity, array(
            'action' => $this->generateUrl('trip_site_management_verify_booking'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Cancel Booking'));

        return $form;
    }
    /**
     * cancle_bookimg action
     */
    public function cancelAction(){		
		$request = $this->container->get('request');
		$session = $request->getSession();
		$session->remove('cancel_error');
		$session->remove('vrify_error');
        $cancel = new Cancel();
        $form   = $this->createCancelForm($cancel);

        return $this->render('TripSiteManagementBundle:Default:cancel.html.twig', array(
            'form'   => $form->createView(),
        ));
    }
    
     /**
     * 
     * @param Request $request
     */
    public function cancelVerifyAction(Request $request)
    {
    	 $cancel = new Cancel();
        $form   = $this->createCancelForm($cancel);
    	$form->handleRequest($request);
    	$session = $request->getSession();
    	if ($form->isValid()) {
    		$cancel = $form->getData();
    		$booking_id = $cancel->getBookingId();
    		$em = $this->getDoctrine()->getManager();
    		$booking = $em->getRepository('TripBookingEngineBundle:Booking')->findBy(array('bookingId' => $booking_id));
    		if (!$booking) {
    			$session->set('cancel_error','The Booking-Id you entered is incorrect. Please try again');
    			return $this->render('TripSiteManagementBundle:Default:cancel.html.twig', array(
    					'form'   => $form->createView(),
    			));
    		}
            $booking = $booking[0];
            if ($booking->getStatus()!='booked') {
    			$session = $request->getSession();    
    			$session->set('cancel_error','No such booking id exists');
    			return $this->render('TripSiteManagementBundle:Default:cancel.html.twig', array(
    					'form'   => $form->createView(),
    			));
    		}
    		$customer = $em->getRepository('TripBookingEngineBundle:Customer')->find($booking->getCustomerId());
    		
    		if ($cancel->getEmail()!=$customer->getEmail()) {
    			$session->set('cancel_error','The Email you entered is invalid');
    
    			return $this->render('TripSiteManagementBundle:Default:cancel.html.twig', array(
    					'form'   => $form->createView(),
    			));
    		}
    		 $locations = $em->getRepository('TripSiteManagementBundle:city')->findAll();
            $locations = $this->getLocationsByIndex($locations);
    		
    		return $this->render('TripSiteManagementBundle:Default:cancelConfirm.html.twig', array(
    				'customer'      => $customer,
    				'booking'      => $booking,
                    'locations' =>$locations
    		));
    	}
    	return $this->render('TripSiteManagementBundle:Default:cancel.html.twig', array(
    			'form'   => $form->createView(),
    	));
    }
    
    
     /**
     * Confirm cancle booking
     */
    public function cancelConfirmAction()
    {
    	$request = $this->container->get('request');
    	$session = $request->getSession();
    	$booking_id = $request->get('bookingId');
    	$em = $this->getDoctrine()->getManager();
    	$booking = $em->getRepository('TripBookingEngineBundle:Booking')->find($booking_id);
    	if ($booking->getStatus()=='cancelled') {
             $cancel = new Cancel();
    		$form = $this->createCancelForm($cancel);
    		$session->set('cancel_error','No such booking id exists');
    		return $this->render('TripSiteManagementBundle:Default:cancel.html.twig', array(   				
    				'form'   => $form->createView(),
    		));
    	}
    	$booking->setStatus('cancelled');
    	$em->persist($booking);
    	$em->flush();
        $customer = $em->getRepository('TripBookingEngineBundle:Customer')->find($booking->getCustomerId());
    	$email = $customer->getEmail();
            $mail = $this->renderView('TripBookingEngineBundle:Mail:cancelMailer.html.twig',
    								array(
    										'customer'   => $customer,
    										'booking'=>$booking,
    										'service'=>$booking->getVehicleBooking()[0],
    								)
    						);

            $mailService = $this->container->get( 'mail.services' );
            $mailService->mail($email,'Just Trip:Booking Cancelled',$mail);
    	return $this->render('TripSiteManagementBundle:Default:sucess.html.twig');
    }
    /**
     *
     */
    public function contactListAction(){
        $em = $this->getDoctrine()->getManager();
        $ContactList = $em->getRepository('TripSiteManagementBundle:Contact')->findAll();
    	return $this->render('TripSiteManagementBundle:Default:contactList.html.twig',array(
    			'contactList' => $ContactList,
    	));
    }
    /**
     *
     */
    public function userListAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('TripSecurityBundle:User')->findAll();
    	return $this->render('TripSiteManagementBundle:Default:users.html.twig',array(
    			'users' => $users,
    	));
    }
    
    public function getCustomersByIndex($customers){
        $temp = array();
         foreach($customers as $customer){
             $temp[$customer->getId()]=$customer;
         }
        return $temp;
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
    
    public function getBookings(){
            $dql3 = "SELECT b, c1.name lFrom,c2.name to FROM TripBookingEngineBundle:Booking b,TripBookingEngineBundle:VehicleBooking vb, TripSiteManagementBundle:city c1,TripSiteManagementBundle:city c2 where vb.leavingFrom=c1.id and vb.goingTo=c2.id and b.id=vb.booking ORDER BY b.id DESC";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);					
            $result = $query->getResult();
         return $result;        
     }
    public function getMybookings($username){
            $dql3 = "SELECT b FROM TripBookingEngineBundle:Booking b,TripBookingEngineBundle:Customer c where c.id=b.customerId and c.email='$username' ORDER BY b.id DESC";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);					
            $result = $query->getResult();
         return $result;        
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
    
    /**
     *
     */
    public function contactAction(Request $request){
    	$entity = new Contact();
    	$form   = $this->createContactForm($entity);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($entity);
    		$em->flush();
    		$email = $entity->getEmail();
    		$body="<br>";    		
    		$body.="<label>Name:</label>".$entity->getFirstName()."<br>";
    		$body.="<label>Email:</label>".$entity->getEmail()."<br>";
    		$body.="<label>Contact Number:</label>".$entity->getPhoneNumber()."<br>";
            $body.="<label>Subject:</label>".$entity->getSubject()."<br>";
    		$body.="<label>Message:</label>".$entity->getMessage()."<br>";
    		$Mailer='<table>
			<TR><TD>Dear Admin , bellow person has some query.Please do response to '.$entity->getFirstName().' on the earliest. </TD></TR>
			<tr style="background-color:#f2f2f2" width="100%">
              <td valign="top" align="center" colspan="2">
                <p style="margin:0 0 8px 0;font-size:14px;line-height:22px;text-align:left">
            		<b style="padding:20px;">
                       '.$body.'          
            		</b></p>
                
				<tr><td>Thank you</td></tr>
				<tr><td>Best Regards, <br>
    
						Just Trip Team <br><br></td></tr>
              </td>
            </tr>
            
			  </table>';
    		
    		$message="Dear ".$entity->getFirstName()."<br>
                            Greetings from Just Trip Team!<br>
                            Your request has been lodged successfully. We will contact you through call/mail within next 48 working hours.<br><br>
              
    		
                            Best Regards,<br>
                            Just Trip Team <br>
                            Ph: +91-9663133008 ";
    		$subject = "Contact Us: Request";
    		$adminSubject = "Contact Us: Request from ".$entity->getFirstName();
             $mailService = $this->container->get( 'mail.services' );
    		$mailService->mail($email,$subject,$message);
    		$mailService->mail('info@justtrip.in',$adminSubject,$Mailer);
    		return $this->redirect($this->generateUrl('trip_site_management_contact'));
    	}
    	return $this->render('TripSiteManagementBundle:Static:contact.html.twig',array(
    			'entity' => $entity,
    			'form'   => $form->createView(),
    	));
    }
    
    /**
     * 
     * @param Search $entity
     * @return unknown
     */
    private function createLocationForm($entity){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new LocationType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_add_locations'),
    			'method' => 'GET',
    	));
    	
    	return $form;
    }
  
     /**
     *
     */
     public function addLocationsAction(Request $request){
        $em = $this->getDoctrine()->getManager();
    	$entity = new City();
    	$form   = $this->createLocationForm($entity);
    	$form->handleRequest($request);
    	if ($form->isValid()) {   		
    		$em->persist($entity);
    		$em->flush();
    		return $this->redirect($this->generateUrl('trip_site_management_add_locations'));
    	}
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
    	return $this->render('TripSiteManagementBundle:Default:locations.html.twig',array(
    			'entity' => $entity,
                'locations' => $locations,
    			'form'   => $form->createView(),
    	));
    }
     
   
	 //************Bikes *******************//
    public function bikescityAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $cityId = $request->get('city');
        $cityName = $request->get('name');
        $cityView = $request->get('view');
        $city = array('id'=>$cityId,'cityName'=>$cityName,'cityView'=>$cityView);
        $session->set('selected-city',$city);
        setcookie('city',json_encode($city));
       // $_SESSION[$cityaction]; 
        
        $referer = $request->headers->get('referer');
        //echo var_dump($referer);
       // exit();
        return new RedirectResponse($referer);
       return $this->render('TripSiteManagementBundle:Default:bikesonRent.html.twig',array(
           
        ));
    }
    
    public function bikescitySelectAction(Request $request){
        
        
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $cityaction = $request->get('filtermainloc');
        //$session->set('geturl',$cityid);
        setcookie($cityaction);
        
        //die();
        return $this->render('TripSiteManagementBundle:Default:bikesonRent.html.twig',array(
            
        ));
    }
    public function bikesonRentAction(Request $request){
    	$em = $this->getDoctrine()->getManager();
    	$session = $request->getSession();
    	$selectedCity = $session->get('selected-city');
    	// echo var_dump($selectedCity);
    	//exit();
    	if(!is_null($selectedCity)){
    	    $selectedCityName = $selectedCity['cityName'];
    	    $selectedCityId = $selectedCity['id'];
    	    
    	    
    	        $bikesmaincity = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('cityid'=>$selectedCityId));
    	        $cityUrl = $bikesmaincity[0]->getSuburl();
    	        $url = $this->generateUrl('trip_site_management_bikes_city',array('cityid'=>$selectedCityName,'url'=>$cityUrl));
    	        
    	        return new RedirectResponse($url);
    	    
    	}
    	
    	$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
		$locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
		$bikesmaincity = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll();
    	$locations = $this->getLocationsByIndex($locations);
    	$id='22/01/2018 05:00 PM';
    	
    	$dql3 = "SELECT b.id from TripBookingEngineBundle:BikeBooking b where b.rdate= '$id' ";
    	$query = $em->createQuery($dql3);
    	$query -> execute();
    	$brdate = $query->getResult();
    	$sysdate= new \DateTime('Asia/Kolkata');
    	$session = $request->getSession();
    	$session->set('resultSet',$bikes);
    	$entity= new Biketime();
    	$form   = $this->createviewbikesForm($entity);
    	return $this->render('TripSiteManagementBundle:Default:bikesonRent.html.twig',array(
    			'bikes' => $bikes,
    	    //'bookrdate'=> $bookrdate,
    			'form'   => $form->createView(),
				'locations' => $locations,
    	    'bikesmaincity' => $bikesmaincity,
    	));
    }
    public function footerAction(){
        $em = $this->getDoctrine()->getManager();
        $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        $cities = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $url= 'one';
        $active='1';
        $dest = $em->getRepository('TripBookingEngineBundle:Destinations')->findBy(array('active' => $active));
        $onepackages = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findBy(array('type' => $url));
        return $this->render('TripBookingEngineBundle:Default:footerTabs.html.twig', array(
            'bikes' => $bikes,
            'cities'=> $cities,
            'onepackages' => $onepackages,
            'dest' => $dest,
        ));
        
        
    }
    
    public function bikesonRentBasedonlocationAction(Request $request,$cityid){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
       
        //$geturl= 'tirupathi';
        $geturl = $cityid;
        $selectedCity = $session->get('selected-city');
       // echo var_dump($selectedCity);
        //exit();
        if(!is_null($selectedCity)){
        $selectedCityName = $selectedCity['cityName'];
        $selectedCityId = $selectedCity['id'];
       
        if($selectedCityName!=$cityid){
            $bikesmaincity = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('cityid'=>$selectedCityId));
            $cityUrl = $bikesmaincity[0]->getSuburl();
            $url = $this->generateUrl('trip_site_management_bikes_city',array('cityid'=>$selectedCityName,'url'=>$cityUrl));
            
           return new RedirectResponse($url);
        }
        }
        
        $session->set('geturl',$geturl);
        $bikeslocbase= $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('url' => $geturl));
        if($bikeslocbase){
            $bikeslocbase= $bikeslocbase[0];
            $bikeslocbased = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('url' => $geturl));
        }else{
            
        }
        $session->set('bikemainloc',$geturl);
        $session->set('bikeslocbase',$bikeslocbase);
        $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $id='22/01/2018 05:00 PM';
        
        $dql3 = "SELECT b.id from TripBookingEngineBundle:BikeBooking b where b.rdate= '$id' ";
        $query = $em->createQuery($dql3);
        $query -> execute();
        $brdate = $query->getResult();
        $sysdate= new \DateTime('Asia/Kolkata');
        $session = $request->getSession();
        $session->set('resultSet',$bikes);
        //$entity= new Biketime();
        //$form   = $this->createviewbikesForm($entity);
        $bikesmaincity = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll();
        return $this->render('TripSiteManagementBundle:Default:bikesonRentBasedonloc.html.twig',array(
            'bikes' => $bikes,
            //'form'   => $form->createView(),
            'locations' => $locations,
            'bikeslocbase' => $bikeslocbase,
            'bikesmaincity'=> $bikesmaincity,
            'geturl' => $geturl,
        ));
    }
    
    public function homebannersearchAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $selectedCity = $session->get('selected-city');
        $filtermainloc = $selectedCity['cityName'];
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $bikesmaincity = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $bikeslocbase = $session->get('bikeslocbase');
        $bikemainloc = $session->get('bikemainloc');
        $entity= new Biketime();
        $form   = $this->createviewbikesForm($entity);
        return $this->render('TripSiteManagementBundle:Default:homeBannersearch.html.twig', array(
            'form'   => $form->createView(),
            'locations' => $locations,
            'bikeslocbase' => $bikeslocbase,
            'bikemainloc' => $bikemainloc,
            'bikesmaincity' => $bikesmaincity,
            'filtermainloc' => $filtermainloc,
        ));
        
        
    }
    public function bikeslocmenuAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $selectedCity = $session->get('selected-city');
        $cookies = $request->cookies;
        $cityJson = $cookies->get('city');
        if(!is_null($selectedCity)){
        $cityid = $selectedCity['id'];
        $cityName = $selectedCity['cityName'];
        
        }elseif(!is_null($cityJson)){
            //$cityJson = $_COOKIE['city'];
            
            $selectedCity = json_decode($cityJson);
            $session->set('selected-city',$selectedCity);
        }else {
            $selectedCity = '';
        }
       // echo $cityaction;
        //echo var_dump($_SESSION);
        //die();
       // die();
        $bikesmaincity = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll();
        return $this->render('TripSiteManagementBundle:Default:bikeslocmenu.html.twig', array(
            'bikesmaincity'=>$bikesmaincity,
            'selectedCity' => $selectedCity,
        ));
        
        
    }
    public function bikeslocpackagemenuAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $cityid = $session->get('bikemainloc');
        $bikesmaincity = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll();
        return $this->render('TripSiteManagementBundle:Default:bikeslocpackagemenu.html.twig', array(
            'bikesmaincity'=>$bikesmaincity,
            'cityid' => $cityid,
        ));
        
        
    }
   
    public function bikepackagesAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $geturl = 'bengaluru';
        $selectedCity = $session->get('selected-city');
        // echo var_dump($selectedCity);
        //exit();
        if(!is_null($selectedCity)){
            $selectedCityName = $selectedCity['cityName'];
            $selectedCityId = $selectedCity['id'];
            
            
                $bikesmaincity = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('cityid'=>$selectedCityId));
                $cityUrl = $bikesmaincity[0]->getPackageurl();
                $url = $this->generateUrl('trip_site_management_bikes_packageurl',array('cityid'=>$selectedCityName,'packageurl'=>$cityUrl));
                
                return new RedirectResponse($url);
           
        }
        $bikeslocbase= $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('url' => $geturl));
        
        if($bikeslocbase){
            $bikeslocbase= $bikeslocbase[0];
            $bikeslocbased = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('url' => $geturl));
        }else{
            
        }
        $session->set('bikemainloc',$geturl);
        
        $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $id='22/01/2018 05:00 PM';
        
        $dql3 = "SELECT b.id from TripBookingEngineBundle:BikeBooking b where b.rdate= '$id' ";
        $query = $em->createQuery($dql3);
        $query -> execute();
        $brdate = $query->getResult();
        $sysdate= new \DateTime('Asia/Kolkata');
        $session = $request->getSession();
        $session->set('resultSet',$bikes);
        $entity= new Biketime();
        $form   = $this->createviewbikesForm($entity);
        return $this->render('TripSiteManagementBundle:Default:bikepackagesBasedonloc.html.twig',array(
            'bikes' => $bikes,
            'form'   => $form->createView(),
            'locations' => $locations,
            'bikeslocbase' => $bikeslocbase,
            'geturl' => $geturl,
        ));
    }
    
    
    public function bikepackagesBasedonlocationAction(Request $request,$cityid){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $geturl = $cityid;
        $selectedCity = $session->get('selected-city');
        // echo var_dump($selectedCity);
        //exit();
        $filtermainloc = $selectedCity['cityName'];;
        if(!is_null($selectedCity)){
            $selectedCityName = $selectedCity['cityName'];
            $selectedCityId = $selectedCity['id'];
            
            if($selectedCityName!=$cityid){
                $bikesmaincity = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('cityid'=>$selectedCityId));
                $cityUrl = $bikesmaincity[0]->getSuburl();
                $url = $this->generateUrl('trip_site_management_bikes_packageurl',array('cityid'=>$selectedCityName,'packageurl'=>$cityUrl));
                
                return new RedirectResponse($url);
            }
        }
        $bikeslocbase= $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('url' => $geturl));
        
        if($bikeslocbase){
            $bikeslocbase= $bikeslocbase[0];
            $bikeslocbased = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('url' => $geturl));
        }else{
            
        }
        $session->set('bikemainloc',$geturl);
        
        $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $id='22/01/2018 05:00 PM';
        
        $dql3 = "SELECT b.id from TripBookingEngineBundle:BikeBooking b where b.rdate= '$id' ";
        $query = $em->createQuery($dql3);
        $query -> execute();
        $brdate = $query->getResult();
        $sysdate= new \DateTime('Asia/Kolkata');
        $session = $request->getSession();
        $session->set('resultSet',$bikes);
        $entity= new Biketime();
        $form   = $this->createviewbikesForm($entity);
        return $this->render('TripSiteManagementBundle:Default:bikepackagesBasedonloc.html.twig',array(
            'bikes' => $bikes,
            'form'   => $form->createView(),
            'locations' => $locations,
            'bikeslocbase' => $bikeslocbase,
            'geturl' => $geturl,
            'filtermainloc'=> $filtermainloc,
        ));
    }
    
     private function createbikepackageForm($entity)
    {
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new biketimerangeType(), $entity, array(
            'action' => $this->generateUrl('trip_site_management_bike_package_result'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Search','attr'   =>  array('class'=>'search-bikes-onrent')));
        return $form;
    }
  
    public function bikepackageresultAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $id = $request->get('id');
        $packageprice = $request->get('packageprice');
        $Kmlimit = $request->get('Kmlimit');
        $packagetitle =$request->get('packagename');
        $title =$request->get('title');
        $packageoffer= $request->get('packageoffer');
        $session->set('packageoffer',$packageoffer);
        $location= $request->get('location');
        $bike = $em->getRepository('TripSiteManagementBundle:bikes')->findBy(array('id' => $id));
        
        if($bike){
            $bike= $bike[0];
            $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll(array('id' => $id));
        }else{
            
        }
        
        
        $session = $request->getSession();
        //$packagebikemainloc = $session->get('bikemainloc');
        $packagefilterloc=$request->get('check_list_loc_package');
        $session->set('filterloc',$packagefilterloc);
        $packagefilterbikes=$request->get('check_list_bikes_package');
        $session->set('filterbikes',$packagefilterbikes);
        $selectedCity = $session->get('selected-city');
        $packagebikemainloc = $selectedCity['cityName'];
        $bikeslocbase= $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('url' => $packagebikemainloc));
        
        if($bikeslocbase){
            $bikeslocbase= $bikeslocbase[0];
            $bikeslocbased = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('url' => $packagebikemainloc));
        }else{
            
        }
        $suggestedbikes= $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        $entity= new Biketime();
        
        $session->set('id',$id);
        
        $pickupdate= $request->get('preferdate');
        $picdate = new \DateTime($pickupdate);
        $returndate= $request->get('returndate');
        $rtrdate = new \DateTime($returndate);
        
        $difference=date_diff($picdate,$rtrdate);
        //$leftDays = $difference->d;
        $leftDays =  $difference->days;
        $hours = $difference->h;
        //echo $difference->days;
        //die();
        
        $dayrent=$bike->getDayrent();
        $statingPrice=$bike->getStatingPrice();
        $packageofferprice=$packageoffer/100;
       
        
        $result=$this->getResultbybikesPackage($request,$id);
        $resultset=$this->getPackageResultbybikescal($request,$result,$leftDays,$hours);
        
        
        $result=$this->getPackageResultbybikespackage();
        $resultset1=$this->getPackageResultbybikescal($request,$result,$leftDays,$hours);
       
        return $this->render('TripSiteManagementBundle:Default:bikepackageresult.html.twig',array(
            
            'bike'=>$bike,
            'bikes'=>$bikes,
            'id'=>$id,
            'title'=>$title,
            'packagetitle'=>$packagetitle,
            'packageprice'=>$packageprice,
            'Kmlimit'=>$Kmlimit,
            'packageoffer'=>$packageoffer,
            // 'form'   => $form->createView(),
            'preferdate' => $pickupdate,
            'returndate' => $returndate,
            'leftDays' => $leftDays,
            'hours' => $hours,
            //'resultprice' => $finalprice,
            'location' => $location,
            'dayrent' => $dayrent,
            'statingPrice' =>$statingPrice,
            'bikeslocbase' => $bikeslocbase,
            'resultset1' => $resultset1,
            'resultset' => $resultset,
            'suggestedbikes' => $suggestedbikes,
            'filtermainloc' => $packagebikemainloc,
        ));
        
    }
    
    
    
    public function packagebikesSelectoptionsAction(Request $request,$id,$active,$cityid){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $packagefilterloc = $session->get('filterloc');
        
        if(!is_null($packagefilterloc))
        {
            $ids = join("','",$packagefilterloc);
            $dql3 = "SELECT b.id,b.area,b.active,b.bikeid from TripSiteManagementBundle:BikesCityArea
            b where b.bikes=$id and b.active=$active and b.cityid=$cityid and b.area in('$ids')";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);
            $bikesarea = $query->getResult();
        }else{
            $dql3 = "SELECT b.id,b.area,b.active from TripSiteManagementBundle:BikesCityArea b
            where b.bikes=$id and b.active=$active and b.cityid=$cityid";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);
            $bikesarea = $query->getResult();
        }
        
        
        return $this->render('TripSiteManagementBundle:Default:packagebikesSelectoptions.html.twig', array(
            'bikesarea' => $bikesarea,
            
        ));
        
        
    }
    public function packagebikesFiltersAction(Request $request,$active,$cityid){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $packagefilterloc = $session->get('filterloc');
        $packagefilterbikes = $session->get('filterbikes');
        $id = $session->get('id');
        $dql3 = "SELECT DISTINCT b.area from TripSiteManagementBundle:BikesCityArea b where b.active=$active and b.cityid=$cityid";
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql3);
        $bikesarea = $query->getResult();
        $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        return $this->render('TripSiteManagementBundle:Default:packagebikesFilters.html.twig', array(
            'bikesarea' => $bikesarea,
            'bike' => $bikes,
            'packagefilterloc' =>$packagefilterloc,
            'packagefilterbikes' => $packagefilterbikes,
            'id' => $id,
        ));
        
        
    }
    
    
    
    
    public function getResultbybikesPackage($request, $id){
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $packagefilterbikes = $session->get('filterbikes');
        if(!is_null($packagefilterbikes))
        {
            
            $ids = join("','",$packagefilterbikes);
            $dql3 = "SELECT
b.id,b.dayrent,b.kmlimit,b.statingPrice,b.imgPath,b.locationUrl,b.title,b.count,b.location,b.packageoffer
        from TripSiteManagementBundle:bikes b
         where b.active=1 and b.id in('$ids')";
            
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);
            $result = $query->getResult();
            
        }else{
            
            $dql3 = "SELECT
b.id,b.dayrent,b.kmlimit,b.statingPrice,b.imgPath,b.locationUrl,b.title,b.count,b.location,b.packageoffer
        from TripSiteManagementBundle:bikes b
         where b.active=1 and b.id=$id";
            
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);
            $result = $query->getResult();
            
        }
        
        
        //$bikes =
        $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        return $result;
    }
    
    
    public function getPackageResultbybikescal($request,$result,$leftDays,$hours){
        $session = $request->getSession();
        
        $tempCollection = array();
        foreach($result as $row){
            $bike = array();
            $bike['id']=$row['id'];
            $bike['dayrent']=$row['dayrent'];
            $bike['statingPrice']=$row['statingPrice'];
            $bike['imgPath']=$row['imgPath'];
            $bike['locationUrl']=$row['locationUrl'];
            $bike['title']=$row['title'];
            $bike['count']=$row['count'];
            $bike['location']=$row['location'];
            $bike['kmlimit']=$row['kmlimit'];
            $packageoffer = $session->get('packageoffer');
           
            //$bike['packageoffer']=$packageoffer;
            //$bike['packageoffer']=$row['packageoffer'];
            
            if ($hours==0){
                
                if ($leftDays<7){
                    $dayrent= $bike['dayrent'];
                    $finalprice=$dayrent*$leftDays;
                    
                }
                else{
                    $dayrent= $bike['dayrent'];
                    $price=$dayrent*$leftDays;
                    $packageoffer= $session->get('packageoffer');
                    $packageofferprice=$packageoffer/100;
                    $offerprice= $price*$packageofferprice;
                    $finalprice=$price-$offerprice;
                }
            }else{
                
                if ($hours <= 5){
                    
                    if ($leftDays<7){
                        $dayrent= $bike['dayrent'];
                        $fixhours= 5;
                        $statingPrice= $bike['statingPrice'];
                        $fivehoursbase = $statingPrice * $hours;
                        $finalprice=$fivehoursbase + $dayrent * $leftDays;
                        
                    }
                    else{
                        $dayrent= $bike['dayrent'];
                        $fixhours= 5;
                        $statingPrice= $bike['statingPrice'];
                        $fivehoursbase = $statingPrice * $hours;
                        $packageoffer= $session->get('packageoffer');
                        $packageofferprice=$packageoffer/100;
                        $pricecal=$dayrent * $leftDays;
                        $offerprice= $pricecal*$packageofferprice;
                        $price=$pricecal-$offerprice;
                        $finalprice= $price+$fivehoursbase;
                        
                    }
                }
                else{
                    if ($hours <= 10){
                        
                        
                        if ($leftDays<7){
                            $dayrent= $bike['dayrent'];
                            $statingPrice= $bike['statingPrice'];
                            $inc= $hours * $statingPrice;
                            $dayscal= $leftDays * $dayrent;
                            $finalprice=$dayscal + $inc;
                            
                        }
                        else{
                            $dayrent= $bike['dayrent'];
                            $statingPrice= $bike['statingPrice'];
                            $inc= $hours * $statingPrice;
                            $dayscal= $leftDays * $dayrent;
                            $packageoffer= $session->get('packageoffer');
                            $packageofferprice=$packageoffer/100;
                            $offerprice=$dayscal*$packageofferprice;
                            $price= $dayscal-$offerprice;
                            $finalprice=$price+$inc;
                            
                        }
                    }else{
                        $totaldays= $leftDays + 1;
                        
                        if ($totaldays<7){
                            $dayrent= $bike['dayrent'];
                            $finalprice=$dayrent*$totaldays;
                            
                        }
                        else{
                            $dayrent= $bike['dayrent'];
                            $price=$dayrent*$totaldays;
                            $packageoffer= $session->get('packageoffer');
                            $packageofferprice=$packageoffer/100;
                            
                            $offerprice= $price*$packageofferprice;
                            $finalprice=$price-$offerprice;
                            
                        }
                    }
                }
            }
            $bike['price']= $finalprice;
            $tempCollection[$row['id']]=$bike;
        }
        
        return $tempCollection;
        
    }
    
    
    public function getPackageResultbybikespackage(){
        $em = $this->getDoctrine()->getManager();
        $dql3 = "SELECT b.id,b.dayrent,b.kmlimit,b.statingPrice,b.imgPath,b.locationUrl,b.title,b.count,b.location,b.packageoffer
        from TripSiteManagementBundle:bikes b
         where b.active=1";
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql3);
        $result = $query->getResult();
        
        return $result;
    }
 
    public function editBikesPackageAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $bikeid= $session->get('bikeid');
        $bikesContent =$em->getRepository('TripSiteManagementBundle:bikespackage')->find($id);
        
        $form   = $this->createEditBikesPackageForm($bikesContent,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $bikesContent = $em->merge($bikesContent);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_edit_bikes',array('id'=>$bikeid)));
            
        }
        
        return $this->render('TripSiteManagementBundle:Default:editBikesPackage.html.twig',array(
            'bikesContent' => $bikesContent,
            'form'   => $form->createView(),
        ));
    }
    
    
    private function createEditBikesPackageForm($bikesContent,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new EditBikesPackageType(), $bikesContent, array(
            'action' => $this->generateUrl('trip_site_management_edit_bikes_package',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    
    
    
    public function deleteBikesPackageAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        
        $bikesContent = $em->getRepository('TripSiteManagementBundle:bikespackage')->find($id);
        
        $em->remove ( $bikesContent );
        $em->flush();
        
        return new Response ( "true" );
        
    }
   
    
    public function addBikesPackageAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $package = new bikes();
        $bikeid= $session->get('bikeid');
        $bikes =$em->getRepository('TripSiteManagementBundle:bikes')->find($bikeid);
        $bikespackage = new bikespackage();
        
        $form   = $this->createaddBikesPackageForm($bikespackage);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $bikespackage->setBikes($bikes);
            $em->persist($bikespackage);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_edit_bikes',array('id'=>$bikeid)));
            
        }
        
        
        return $this->render('TripSiteManagementBundle:Default:addBikespackage.html.twig',array(
            'bikespackage' => $bikespackage,
            
            'form'   => $form->createView(),
        ));
    }
    
    private function createaddBikesPackageForm($bikespackage){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new AddBikesPackageType(), $bikespackage, array(
            'action' => $this->generateUrl('trip_site_management_add_bike_package'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Insert'));
        
        return $form;
    }
 
    public function viewBikesAction(Request $request,$url,$cityid){
    	$em = $this->getDoctrine()->getManager();
		$session = $request->getSession();
		
		$selectedCity = $session->get('selected-city');
		$filtermainloc = $selectedCity['cityName'];
		if(!is_null($selectedCity)){
		    $selectedCityName = $selectedCity['cityName'];
		    $selectedCityId = $selectedCity['id'];
		    
		    if($selectedCityName!=$cityid){
		       
		        $bikesmaincity = $em->getRepository('TripSiteManagementBundle:BikesCity')->findBy(array('cityid'=>$selectedCityId));
		        
		        $cityUrl = $bikesmaincity[0]->getUrl();
		       
		        $url1 = $this->generateUrl('trip_site_management_view_bikes',array('cityid'=>$selectedCityName,'url'=>$url));
		        
		        return new RedirectResponse($url1);
		    }
		}
		$geturl = $filtermainloc;
		//die();
		    $bikeslocbase= $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('url' => $geturl));
		    if($bikeslocbase){
		        $bikeslocbase= $bikeslocbase[0];
		        $bikeslocbased = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('url' => $geturl));
		    }else{
		        
		    }
		
		$bikecity = $em->getRepository('TripSiteManagementBundle:BikesCity')->findBy(array('url' => $url));
		if($bikecity){
		    $bikecity = $bikecity[0];
		    $id= $bikecity->getBikes();
		    $bike = $em->getRepository('TripSiteManagementBundle:bikes')->findBy(array('id' => $id));
		   
		    $bikeurl = $em->getRepository('TripSiteManagementBundle:BikesCity')->findBy(array('bikeid' => $id));
		    if($bike){
		        $bike= $bike[0];
		        $bikes = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('id' => $id));
		    }else{
		        
		    }
		}else{
		    
		}
		
		
		$locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
		$locations = $this->getLocationsByIndex($locations);
		$session->set('bikeurl',$bike);
		$entity= new Biketime();
		$form   = $this->createpriceviewbikesForm($entity,$url);
		$bikeall = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
		return $this->render('TripSiteManagementBundle:Default:viewBikes.html.twig',array(
		    
		    'bike'=>$bike,
		    'bikes'=>$bikes,
		    'form'   => $form->createView(),
		    'bikecity' => $bikecity,
		    'locations' => $locations,
		    'bikemainloc' => $geturl,
		    'bikeslocbase' => $bikeslocbase,
		    'bikeurl' => $bikeurl,
		    'bikeall' => $bikeall,
		    'filtermainloc' => $filtermainloc,
		    'url' => $url,
		));
    	 
    }
    private function createviewbikesForm($entity)
    {
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new biketimerangeType(), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_review_viewbikes'),
    			'method' => 'GET',
    	));
    	$form->add('submit', 'submit', array('label' => 'RIDE NOW','attr'   =>  array('class'=>'new-button-bikes-onrent')));
    	return $form;
    }
    
    public function reviewViewbikesAction(Request $request){
    	
    	$bookingService = $this->container->get( 'booking.services' );
    	$em = $this->getDoctrine()->getManager();
		$session = $request->getSession();
	   $filterloc=$request->get('check_list_loc');
	   $session->set('filterloc',$filterloc);
	   $filterbikes=$request->get('check_list_bikes');
	   
	   $session->set('filterbikes',$filterbikes);
	   $selectedCity = $session->get('selected-city');
	   $filtermainloc = $selectedCity['cityName'];
	   
	   
	   
	   if(!is_null($filtermainloc))
	   {
	       $bikemainloc = $filtermainloc;
	       $bikeslocbase= $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('url' => $bikemainloc));
	       if($bikeslocbase){
	           $bikeslocbase= $bikeslocbase[0];
	           $bikeslocbased = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('url' => $bikemainloc));
	       }else{
	           
	       }
	       
	   }else{
	       
	       //$bikemainloc = $session->get('bikemainloc');
	       $bikemainloc = $request->get('bikemainloc');
	       $bikeslocbase= $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('url' => $bikemainloc));
	       if($bikeslocbase){
	           $bikeslocbase= $bikeslocbase[0];
	           $bikeslocbased = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('url' => $bikemainloc));
	       }else{
	           
	       }
	   }
	   
	   

	   
		$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
		$entity= new Biketime();
		
    	//$booking = $em->getRepository('TripSiteManagementBundle:Biketime')->findOneById($id);
    	$form   = $this->createviewbikesForm($entity);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    	    //$location=$entity->getLocation();
    	    $picdate=$entity->getDate();
    	    $returndate=$entity->getReturndate();
    	    //$location=$entity->getLocation();
    	    $difference=date_diff($picdate,$returndate);
    	    $leftDays = $difference->days;
    	    $hours = $difference->h;
    	    
    	    if(!is_null($filterbikes))
    	    {
    	        
    	        $result=$this->getResultbybikesfilters($filterbikes);
    	        
    	            $resultset=$this->getResultbybikescal($result,$leftDays,$hours);
    	    }else{
    	        
    	        $result=$this->getResultbybikes();
    	        $resultset=$this->getResultbybikescal($result,$leftDays,$hours);
    	        //echo var_dump($resultset);
    	        //die();
    	    }
    		$em->flush();
    		return $this->render('TripSiteManagementBundle:Default:reviewViewbikes.html.twig', array(
    		    'form'   => $form->createView(),
    		    'picdate' => $picdate,
    		    'returndate' => $returndate,
    		    'bikes' => $bikes,
    		    'leftDays' => $leftDays,
    		    'hours' => $hours,
    		    'resultset' => $resultset,
    		    'mainlocation' => $bikemainloc,
    		    'bikeslocbase' => $bikeslocbase,
    		    'filterloc' => $filterloc,
    		    'filtermainloc' => $filtermainloc,
    		    
    		    //'bike' =>$bike,
    		));
    	}
    	
    	return $this->render('TripSiteManagementBundle:Default:reviewViewbikes.html.twig',array(
    			
    			//'bikes' => $bikes,
    			'form'   => $form->createView(),
    	        
    	));
    }
    public function reviewbikesSelectoptionsAction(Request $request,$id,$active,$cityid){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $filterloc = $session->get('filterloc');
       // $filterloc = $session->get('filterloc');
        if(!is_null($filterloc))
        {
            $ids = join("','",$filterloc); 
            $dql3 = "SELECT b.id,b.area,b.active,b.bikeid from TripSiteManagementBundle:BikesCityArea 
            b where b.bikes=$id and b.active=$active and b.cityid=$cityid and b.area in('$ids')";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);
            $bikesarea = $query->getResult();
        }else{
            $dql3 = "SELECT b.id,b.area,b.active from TripSiteManagementBundle:BikesCityArea b 
            where b.bikes=$id and b.active=$active and b.cityid=$cityid";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);
            $bikesarea = $query->getResult();
        }
        
       /* $dql3 = "SELECT b.id,b.area from TripSiteManagementBundle:BikesCityArea b where b.bikes=$id and b.active=$active and b.cityid=$cityid";
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql3);
        $bikesarea = $query->getResult();*/
        return $this->render('TripSiteManagementBundle:Default:reviewbikesSelectoptions.html.twig', array(
            'bikesarea' => $bikesarea,
            
        ));
        
        
    }
    public function reviewbikesFiltersAction(Request $request,$active,$cityid){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $filterloc = $session->get('filterloc');
        $filterbikes = $session->get('filterbikes');
        $dql3 = "SELECT DISTINCT b.area from TripSiteManagementBundle:BikesCityArea b where b.active=$active and b.cityid=$cityid";
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql3);
        $bikesarea = $query->getResult();
        $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        return $this->render('TripSiteManagementBundle:Default:reviewbikesFilters.html.twig', array(
            'bikesarea' => $bikesarea,
            'bikes' => $bikes,
            'filterloc' =>$filterloc,
            'filterbikes' => $filterbikes,
        ));
        
        
    }
    
    
    public function getResultbybikesfilters($filterbikes){
        $em = $this->getDoctrine()->getManager();
        $ids = join("','",$filterbikes);   
        $dql3 = "SELECT b.id,b.dayrent,b.kmlimit,b.statingPrice,b.imgPath,b.locationUrl,b.title,b.count,b.location
                        from TripSiteManagementBundle:bikes b where b.id in('$ids') and b.active=1 ";
        $query = $em->createQuery($dql3);
        $result = $query->getResult();
        $result = $query->getResult();
        //$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        
        return $result;
    }
    public function getResultbybikes(){
        $em = $this->getDoctrine()->getManager();
        $dql3 = "SELECT b.id,b.dayrent,b.kmlimit,b.statingPrice,b.imgPath,b.locationUrl,b.title,b.count,b.location
        from TripSiteManagementBundle:bikes b where b.active=1
         ";
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql3);
        $result = $query->getResult();
        
        //$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        return $result;
    }
    public function getResultbybikescal($result,$leftDays,$hours){
       
        $tempCollection = array();
        foreach($result as $row){
            $bike = array();
            $bike['id']=$row['id'];
            $bike['dayrent']=$row['dayrent'];
            $bike['statingPrice']=$row['statingPrice'];
            $bike['imgPath']=$row['imgPath'];
            $bike['locationUrl']=$row['locationUrl'];
            $bike['title']=$row['title'];
            $bike['count']=$row['count'];
            $bike['location']=$row['location'];
            $bike['kmlimit']=$row['kmlimit'];
            if ($hours==0){
                $dayrent=$bike['dayrent'];
                $price=$dayrent*$leftDays;
                
            }else{
                
                if ($hours <= 5){
                $fixhours= 5;
                $startprice=$bike['statingPrice'];
                $dayrent=$bike['dayrent'];
                $fivehoursbase = $startprice * $hours;
                $price=$fivehoursbase + $dayrent * $leftDays;
               
                }
                else{
                    if ($hours <= 10){
                        $dayrent=$bike['dayrent'];
                        $startprice=$bike['statingPrice'];
                        $inc= $hours * $startprice;
                        $dayscal= $leftDays * $dayrent;
                        $price=$dayscal + $inc;
                        //echo $bike['price']= $price;
                       //echo ',';
                    }else{
                        $startprice=$bike['statingPrice'];
                        $dayrent=$bike['dayrent'];
                        $totaldays= $leftDays + 1;
                        $price=$totaldays * $dayrent;
                        
                    }
                }
            }
            $bike['price']= $price;
            $tempCollection[$row['id']]=$bike;
        }
       // echo $leftDays;
       // echo $hours;
       // die();
        return $tempCollection;
        
    }
    public function priceViewbikesAction(Request $request){
    	
    	$bookingService = $this->container->get( 'booking.services' );
    	$em = $this->getDoctrine()->getManager();
		$session = $request->getSession();
		$bikeurl = $session->get('bikeurl');
		$url = $bikeurl->getId();
		$session->set('url',$url);
		
		$pricefilterloc=$request->get('price_check_list_loc');
		$session->set('pricefilterloc',$pricefilterloc);
		$pricefilterbikes=$request->get('price_check_list_bikes');
		$session->set('pricefilterbikes',$pricefilterbikes);
		//$filtermainloc=$request->get('filtermainloc');
		$selectedCity = $session->get('selected-city');
		$filtermainloc = $selectedCity['cityName'];
		if(!is_null($filtermainloc))
		{
		    
		    $bikemainloc = $filtermainloc;
		    $bikeslocbase= $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('url' => $bikemainloc));
		    if($bikeslocbase){
		        $bikeslocbase= $bikeslocbase[0];
		        $bikeslocbased = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('url' => $bikemainloc));
		       
		    }else{
		        
		    }
		    
		}else
		{
		    $bikemainloc = $request->get('bikemainloc');
		    $bikeslocbase= $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findBy(array('url' => $bikemainloc));
		    if($bikeslocbase){
		        $bikeslocbase= $bikeslocbase[0];
		        $bikeslocbased = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('url' => $bikemainloc));
		       
		    }else{
		        
		    }
		    
		    
		}
		
		
		$bike = $em->getRepository('TripSiteManagementBundle:bikes')->findBy(array('id' => $url));
		if($bike){
		    $bike= $bike[0];
		    $bikes = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll(array('id' => $url));
		}else{
		    
		}
		
    	$entity= new Biketime();
    	$form   = $this->createpriceviewbikesForm($entity,$url);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    	    $location=$entity->getLocation();
    	    $picdate=$entity->getDate();
    	    $returndate=$entity->getReturndate();
    	    $location=$entity->getLocation();
    	    $difference=date_diff($picdate,$returndate);
    	    $leftDays = $difference->days;
    	    $hours = $difference->h;
    	    
    	    $result=$this->getResultbybikesprice($request,$url);
    	    
    	    $resultset=$this->getResultbybikespricecal($result,$leftDays,$hours);
    	   
    	    $em->flush();
    	    
    	    return $this->render('TripSiteManagementBundle:Default:priceViewbikes.html.twig', array(
    	        'form'   => $form->createView(),
    	        'picdate' => $picdate,
    	        'returndate' => $returndate,
    	        //'bikes' => $bikes,
    	        'leftDays' => $leftDays,
    	        'hours' => $hours,
    	        'resultset' => $resultset,
    	        'location' => $bikemainloc,
    	        'url' => $url,
    	        'bike'=>$bike,
    	        'bikeslocbase' => $bikeslocbase,
    	        'filtermainloc' => $filtermainloc,
    	    ));
    	    
    	}
    	
    	return $this->render('TripSiteManagementBundle:Default:priceViewbikes.html.twig',array(
    			//'customer'   => $customer,
    			//'booking'=>$booking,
    			'bike'=>$bike,
    			'bikes'=>$bikes,
    			'form'   => $form->createView(),
    			//'locations'=>$locations,
    			//'services'=>$booking->getVehicleBooking(),
    	));
    }
    
    private function createpriceviewbikesForm($entity,$url)
    {
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new PriceviewbikesType(), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_price_viewbikes',array('url'=>$url)),
    			'method' => 'GET',
    	));
    	$form->add('submit', 'submit', array('label' => 'RIDE NOW','attr'   =>  array('class'=>'new-button-bikes-onrent')));
    	return $form;
    }
    
    public function getResultbybikesprice($request, $url){
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $pricefilterbikes = $session->get('pricefilterbikes');
        if(!is_null($pricefilterbikes))
        {
            
            $ids = join("','",$pricefilterbikes);
            $dql3 = "SELECT b.id,b.dayrent,b.kmlimit,b.statingPrice,b.imgPath,b.locationUrl,b.title,b.count,b.location
        from TripSiteManagementBundle:bikes b
         where b.active=1 and b.id in('$ids')";
            
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);
            $result = $query->getResult();
            
        }else{
            
            
            $dql3 = "SELECT b.id,b.dayrent,b.kmlimit,b.statingPrice,b.imgPath,b.locationUrl,b.title,b.count,b.location
        from TripSiteManagementBundle:bikes b
         where b.active=1 and b.id=$url";
            
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);
            $result = $query->getResult();
            
            
        }
        
        
        //$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        return $result;
    }
    public function getResultbybikespricecal($result,$leftDays,$hours){
        
        $tempCollection = array();
        foreach($result as $row){
            $bike = array();
            $bike['id']=$row['id'];
            $bike['dayrent']=$row['dayrent'];
            $bike['statingPrice']=$row['statingPrice'];
            $bike['imgPath']=$row['imgPath'];
            $bike['locationUrl']=$row['locationUrl'];
            $bike['title']=$row['title'];
            $bike['count']=$row['count'];
            $bike['location']=$row['location'];
            $bike['kmlimit']=$row['kmlimit'];
            if ($hours==0){
                $dayrent=$bike['dayrent'];
                $price=$dayrent*$leftDays;
                
            }else{
                
                if ($hours <= 5){
                    $fixhours= 5;
                    $startprice=$bike['statingPrice'];
                    $dayrent=$bike['dayrent'];
                    $fivehoursbase = $startprice * $hours;
                    $price=$fivehoursbase + $dayrent * $leftDays;
                    
                }
                else{
                    if ($hours <= 10){
                        $dayrent=$bike['dayrent'];
                        $startprice=$bike['statingPrice'];
                        $inc= $hours * $startprice;
                        $dayscal= $leftDays * $dayrent;
                        $price=$dayscal + $inc;
                        //echo $bike['price']= $price;
                        //echo ',';
                    }else{
                        $startprice=$bike['statingPrice'];
                        $dayrent=$bike['dayrent'];
                        $totaldays= $leftDays + 1;
                        $price=$totaldays * $dayrent;
                        
                    }
                }
            }
            $bike['price']= $price;
            $tempCollection[$row['id']]=$bike;
        }
        // echo $leftDays;
        // echo $hours;
        // die();
        return $tempCollection;
        
    }
    public function pricereviewbikesFiltersAction(Request $request,$active,$cityid){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $pricefilterloc = $session->get('pricefilterloc');
        $pricefilterbikes = $session->get('pricefilterbikes');
        $url = $session->get('url');
        $dql3 = "SELECT DISTINCT b.area from TripSiteManagementBundle:BikesCityArea b where b.active=$active and b.cityid=$cityid";
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql3);
        $bikesarea = $query->getResult();
        $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        return $this->render('TripSiteManagementBundle:Default:pricereviewbikesFilters.html.twig', array(
            'bikesarea' => $bikesarea,
            'bikes' => $bikes,
            'filterloc' =>$pricefilterloc,
            'filterbikes' => $pricefilterbikes,
            'url' => $url,
        ));
        
        
    }
    
    public function pricereviewbikesSelectoptionsAction(Request $request,$id,$active,$cityid){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $pricefilterloc = $session->get('pricefilterloc');
        if(!is_null($pricefilterloc))
        {
            $ids = join("','",$pricefilterloc);
            $dql3 = "SELECT b.id,b.area,b.active,b.bikeid from TripSiteManagementBundle:BikesCityArea
            b where b.bikes=$id and b.active=$active and b.cityid=$cityid and b.area in('$ids')";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);
            $bikesarea = $query->getResult();
        }else{
            $dql3 = "SELECT b.id,b.area,b.active from TripSiteManagementBundle:BikesCityArea b
            where b.bikes=$id and b.active=$active and b.cityid=$cityid";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);
            $bikesarea = $query->getResult();
        }
        return $this->render('TripSiteManagementBundle:Default:pricereviewbikesSelectoptions.html.twig', array(
            'bikesarea' => $bikesarea,
            
        ));
        
        
    }
   
	public function bikesSubmitAction(Request $request){
	    $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $id = $request->get('id');
		$title = $request->get('title');
        $pDate = $request->get('pDate');
        $rDate = $request->get('rDate');
        $price = $request->get('price');
		$leftdays = $request->get('leftdays');
		$hours = $request->get('hours');
		$location = $request->get('location');
		$countadd = $request->get('countadd');
		$count = $request->get('count');
		$bikearea = $request->get('bikearea');
		//echo $bikearea;
		//die();
		//echo var_dump($id);
		$countinsert = $count-$countadd;
		//$session->set('countinsert',$countinsert);
		//echo var_dump($countinsert);
		 //exit();
		 
		/* $dql3 = "UPDATE TripSiteManagementBundle:bikes b SET b.count = '$countinsert' WHERE b.id = '$id' ";
		 $query = $em->createQuery($dql3);
		 $query -> execute();
		 */
		return $this->redirect($this->generateUrl('trip_booking_engine_book_bike_submit',array('id'=>$id,'title'=>$title,'pDate'=>$pDate,'rDate'=>$rDate,'price'=>$price,'leftdays'=>$leftdays,'hours'=>$hours,'location'=>$location,'countinsert'=>$countinsert,'bikearea'=>$bikearea)));
			
    }
    
    /**************** end Bikes *******************/
    /***************Bikes DhasBord******************/
   
    public function editBikesAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();

        //$package = new Package();
        $session = $request->getSession();
        $session->set('bikeid',$id);
        $package =$em->getRepository('TripSiteManagementBundle:bikes')->find($id);
        
        $bikecity =$em->getRepository('TripSiteManagementBundle:BikesCity')->findBy(array('bikeid' => $id));
        $bikecityarea =$em->getRepository('TripSiteManagementBundle:BikesCityArea')->findBy(array('bikeid' => $id));
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $session = $request->getSession();
        $package_id = $package->getId();
        $bikespackage =$em->getRepository('TripSiteManagementBundle:bikespackage')->findBy(array('bikes' => $id));
        $form   = $this->createEditBikesForm($package,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $packageImages = $package->getImgPath();
            if (!is_null($packageImages)) {
                $file_name = $packageImages->getClientOriginalName ();
                $dir = 'images/bikes/';
                $packageImages->move ( $dir, $file_name );
                $package->setImgPath ($file_name );
                // $packageImage->setImgPath($package);
                // echo var_dump($packageImage);
                //exit();
                // $packageImages->add($packageImage);
                
            }
            $package = $em->merge($package);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_edit_bikes',array('id'=>$id)));
            
        }
        
        return $this->render('TripSiteManagementBundle:Default:editBikes.html.twig',array(
            'package' => $package,
            'bikecity' => $bikecity,
            'bikecityarea' => $bikecityarea,
            'locations' => $locations,
            'bikespackage'=> $bikespackage,
            'form'   => $form->createView(),
        ));
    }
    private function createEditbikesForm($package,$id){
        //$bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new EditBikesType(), $package, array(
            'action' => $this->generateUrl('trip_site_management_edit_bikes',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    public function bikesListAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $multipackageList = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        $bikescitymain = $em->getRepository('TripSiteManagementBundle:BikesCityMain')->findAll();
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $citymain = new BikesCityMain();
        $form   = $this->createaddbikemaincityForm($citymain);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($citymain);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_site_management_bikes_list'));
            
        }
        return $this->render('TripSiteManagementBundle:Default:bikesList.html.twig',array(
            'multipackageList' => $multipackageList,
            'bikescitymain' => $bikescitymain,
            'locations' => $locations,
            'form'   => $form->createView(),
        ));
    }
    private function createaddbikemaincityForm($citymain){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new AddBikeMainCityType($bookingService), $citymain, array(
            'action' => $this->generateUrl('trip_site_management_bikes_list'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Insert'));
        
        return $form;
    }
    public function addbikeAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $package = new bikes();
        //$package =$em->getRepository('TripSiteManagementBundle:PackageTitle')->find($id);
        $packageImages = $package->getImgPath();
         //$packageImages->add($packageImage);
        
        $form   = $this->createAddBikeForm($package);
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            
            $packageImageList =$package->getImgPath();
            $packageImages =$package->getImgPath();
       
            //echo var_dump($packageImages);
               // exit();
            if (!is_null($packageImages)) {
                $file_name = $packageImages->getClientOriginalName ();
                    $dir = 'images/bikes/';
                    $packageImages->move ( $dir, $file_name );
                    $package->setImgPath ($file_name );
                   // $packageImage->setImgPath($package);
                    // echo var_dump($packageImage);
                    //exit();
                   // $packageImages->add($packageImage);
                    
                }
                
            
            $package = $em->merge($package);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_site_management_add_bike'));
            
        }
        
        return $this->render('TripSiteManagementBundle:Default:addBike.html.twig',array(
            //'package' => $package,
            'form'   => $form->createView(),
        ));
    }
    private function createAddBikeForm($package){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new AddBikesType(), $package, array(
            'action' => $this->generateUrl('trip_site_management_add_bike'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'submit'));
        
        return $form;
    }
   
    public function editBikesmaincityAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        //$package = new Package();
       $editbikesmaincity =$em->getRepository('TripSiteManagementBundle:BikesCityMain')->find($id);
       $form   = $this->createEditbikesmaincityForm($editbikesmaincity,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $editbikesmaincity = $em->merge($editbikesmaincity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_edit_bikes_maincity',array('id'=>$id)));
            
        }
        
        return $this->render('TripSiteManagementBundle:Default:editBikesmaincity.html.twig',array(
            'editbikesmaincity' => $editbikesmaincity,
            'form'   => $form->createView(),
        ));
    }
    private function createEditbikesmaincityForm($editbikesmaincity,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new EditBikeMainCityType($bookingService), $editbikesmaincity, array(
            'action' => $this->generateUrl('trip_site_management_edit_bikes_maincity',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    
    public function addbikescityAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $bikeid = $session->get('bikeid');
        $bike = $em->getRepository('TripSiteManagementBundle:bikes')->find($bikeid);
        $bikecity = new BikesCity();
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $form   = $this->createaddbikescityForm($bikecity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $bikecity->setBikes($bike);
            $em->persist($bikecity);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_site_management_edit_bikes',array('id'=>$bikeid)));
            
        }
        return $this->render('TripSiteManagementBundle:Default:addBikeCity.html.twig',array(
            'locations' => $locations,
            'form'   => $form->createView(),
        ));
    }
    private function createaddbikescityForm($bikecity){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new AddBikeCityType($bookingService), $bikecity, array(
            'action' => $this->generateUrl('trip_site_management_add_bikecity'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Insert'));
        
        return $form;
    }
    public function addbikescityareaAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $bikeid = $session->get('bikeid');
        $bike = $em->getRepository('TripSiteManagementBundle:bikes')->find($bikeid);
        $bikecityarea = new BikesCityArea();
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $form   = $this->createaddbikescityareaForm($bikecityarea);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $bikecityarea->setBikes($bike);
            $em->persist($bikecityarea);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_site_management_edit_bikes',array('id'=>$bikeid)));
            
        }
        return $this->render('TripSiteManagementBundle:Default:addBikeCityArea.html.twig',array(
            'locations' => $locations,
            'form'   => $form->createView(),
        ));
    }
    private function createaddbikescityareaForm($bikecityarea){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new AddBikeCityAreaType($bookingService), $bikecityarea, array(
            'action' => $this->generateUrl('trip_site_management_add_bikecityarea'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Insert'));
        
        return $form;
    }
    public function editBikescityAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $bikeid = $session->get('bikeid');
        $editbikescity =$em->getRepository('TripSiteManagementBundle:BikesCity')->find($id);
        $form   = $this->createEditbikescityForm($editbikescity,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $editbikescity = $em->merge($editbikescity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_edit_bikes',array('id'=>$bikeid)));
            
        }
        
        return $this->render('TripSiteManagementBundle:Default:editBikescity.html.twig',array(
            'editbikescity' => $editbikescity,
            'form'   => $form->createView(),
        ));
    }
    private function createEditbikescityForm($editbikescity,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new EditBikeCityType($bookingService), $editbikescity, array(
            'action' => $this->generateUrl('trip_site_management_edit_bikes_city',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    public function editBikescityareaAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $bikeid = $session->get('bikeid');
        $editbikescityarea =$em->getRepository('TripSiteManagementBundle:BikesCityArea')->find($id);
        $form   = $this->createEditbikescityareaForm($editbikescityarea,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $editbikescityarea = $em->merge($editbikescityarea);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_edit_bikes',array('id'=>$bikeid)));
            
        }
        
        return $this->render('TripSiteManagementBundle:Default:editBikescityArea.html.twig',array(
            'editbikescityarea' => $editbikescityarea,
            'form'   => $form->createView(),
        ));
    }
    private function createEditbikescityareaForm($editbikescityarea,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new EditBikeCityAreaType($bookingService), $editbikescityarea, array(
            'action' => $this->generateUrl('trip_site_management_edit_bikes_cityarea',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
	//***************************************end****************************************//

    
}