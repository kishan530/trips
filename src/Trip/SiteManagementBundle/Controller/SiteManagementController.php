<?php

namespace Trip\SiteManagementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Trip\SiteManagementBundle\Entity\City;
use Trip\BookingEngineBundle\Form\SearchType;
use Trip\SiteManagementBundle\Form\LocationType;
use Trip\SiteManagementBundle\Form\ServicesType;
use Trip\SiteManagementBundle\Form\VehicleType;
use Trip\BookingEngineBundle\DTO\SearchFilter;
use Trip\BookingEngineBundle\Form\SearchHotelType;
use Trip\BookingEngineBundle\DTO\SearchHotel;
use Trip\BookingEngineBundle\Entity\Services;
use Trip\BookingEngineBundle\Entity\Vehicle;
use Trip\SiteManagementBundle\Entity\Hotel;
use Trip\SiteManagementBundle\Form\HotelType;
use Trip\SiteManagementBundle\Entity\Contact;
use Trip\SiteManagementBundle\Form\ContactType;
use Trip\SiteManagementBundle\Entity\Cancel;
use Trip\SiteManagementBundle\Form\CancelType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteManagementController extends Controller
{
    
    /**
     *
     */
    public function aboutUsAction(){
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
    public function faqAction(){
        return $this->render('TripSiteManagementBundle:Static:faq.html.twig');
    }
    /**
     *
     */
    public function bookingsAction(){
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
    private function createVehicleForm($entity){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new VehicleType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_add_vehicle'),
    			'method' => 'GET',
    	));
    	
    	return $form;
    }
    /**
     * 
     * @param Search $entity
     * @return unknown
     */
    private function createServicesForm($entity){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new ServicesType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_add_services'),
    			'method' => 'GET',
    	));
    	
    	return $form;
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
     * @param Search $entity
     * @return unknown
     */
    private function createHotelForm($entity){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new HotelType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_add_hotel'),
    			'method' => 'POST',
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
     /**
     *
     */
    public function addVehicleAction(Request $request){
        $em = $this->getDoctrine()->getManager();
    	$entity = new Vehicle();
    	$form   = $this->createVehicleForm($entity);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$em->persist($entity);
    		$em->flush();
    		return $this->redirect($this->generateUrl('trip_site_management_add_vehicle'));
    	}
         $vehicles = $em->getRepository('TripBookingEngineBundle:Vehicle')->findAll();
    	return $this->render('TripSiteManagementBundle:Default:vehicles.html.twig',array(
    			'entity' => $entity,
                'vehicles' => $vehicles,
    			'form'   => $form->createView(),
    	));
    }
     /**
     *
     */
    public function addServicesAction(Request $request){
        $em = $this->getDoctrine()->getManager();
    	$entity = new Services();
    	$form   = $this->createServicesForm($entity);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
            $entity->setVehicleId($vid);
    		$em->persist($entity);
    		$em->flush();
    		return $this->redirect($this->generateUrl('trip_site_management_add_services'));
    	}
/*            $dql3 = "SELECT v.model, s.price,s.returnPrice , FROM TripBookingEngineBundle:Vehicle v, TripBookingEngineBundle:Services s WHERE        s.vehicleId=v.id and s.leavingFrom=$goingFrom and s.goingTo=$goingTo";
            $query = $em->createQuery($dql3);					
            $result = $query->getResult();*/
       //  $services = $this->em->getRepository('TripBookingEngineBundle:Services')->findAll();
    	return $this->render('TripSiteManagementBundle:Default:services.html.twig',array(
    			'entity' => $entity,
                //'services' => $services,
    			'form'   => $form->createView(),
    	));
    }
     /**
     *
     */
    public function addHotelAction(Request $request){
        $em = $this->getDoctrine()->getManager();
    	$hotel = new Hotel();
    	$form   = $this->createHotelForm($hotel);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
            $address = $hotel->getAddress();
            $cityId = $address->getCityId();
            $city = $address->getCity();
            $city ='Tirupati';
            $address->setHotel($hotel);
            $address->setCity($city);
            $hotel->setCity($city);
            $hotel->setCityId($cityId);
    		$em->persist($hotel);
    		$em->flush();
    		return $this->redirect($this->generateUrl('trip_site_management_add_hotel'));
    	}
         $hotels = $em->getRepository('TripSiteManagementBundle:Hotel')->findAll();
    	return $this->render('TripSiteManagementBundle:Default:addHotel.html.twig',array(
    			'hotel' => $hotel,
                'hotels' => $hotels,
    			'form'   => $form->createView(),
    	));
    }
}
