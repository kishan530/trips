<?php

namespace Trip\SiteManagementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Trip\SiteManagementBundle\Entity\City;
use Trip\SiteManagementBundle\Entity\HotelImage;
use Trip\SiteManagementBundle\Entity\Package;
use Trip\SiteManagementBundle\Entity\PackageTitle;
use Trip\SiteManagementBundle\Entity\StartPoint;
use Trip\SiteManagementBundle\Entity\EndPoint;
use Trip\SiteManagementBundle\Entity\EndPoint2;
use Trip\SiteManagementBundle\Entity\PackagePrice;
use Trip\SiteManagementBundle\Entity\PackageItinerary;
use Trip\SiteManagementBundle\Entity\PackageContent;
use Trip\SiteManagementBundle\Entity\PackageImages;
use Trip\SiteManagementBundle\DTO\PackageLocations;
use Trip\SiteManagementBundle\Form\PackageLocationsType;
use Trip\BookingEngineBundle\Form\SearchType;
use Trip\SiteManagementBundle\Form\PackageType;
use Trip\SiteManagementBundle\Form\MultiPackageTitleType;
use Trip\SiteManagementBundle\Form\MultiPackageTitle;
use Trip\SiteManagementBundle\Form\EditHotelType;
use Trip\SiteManagementBundle\Form\EditPackageType;
use Trip\SiteManagementBundle\Form\PackageItineraryType;
use Trip\SiteManagementBundle\Form\PackageContentType;
use Trip\SiteManagementBundle\Form\LocationType;
use Trip\SiteManagementBundle\Form\ServicesType;
use Trip\SiteManagementBundle\Form\VehicleType;
use Trip\SiteManagementBundle\Form\PriceType;
use Trip\BookingEngineBundle\DTO\SearchFilter;
use Trip\BookingEngineBundle\Form\SearchHotelType;
use Trip\BookingEngineBundle\DTO\SearchHotel;
use Trip\BookingEngineBundle\Entity\Services;
use Trip\BookingEngineBundle\Entity\Vehicle;
use Trip\SiteManagementBundle\Entity\Hotel;
use Trip\SiteManagementBundle\Entity\Billing;
use Trip\SiteManagementBundle\DTO\BillingDto;
use Trip\SiteManagementBundle\DTO\Billing as NewBilling;
use Trip\SiteManagementBundle\Entity\BillingPlacesToVisit;
use Trip\SiteManagementBundle\Entity\Driver;
use Trip\SiteManagementBundle\Form\BillingType;
use Trip\SiteManagementBundle\Form\HotelType;
use Trip\SiteManagementBundle\Entity\Contact;
use Trip\SiteManagementBundle\Form\ContactType;
use Trip\SiteManagementBundle\Entity\Cancel;
use Trip\SiteManagementBundle\Form\CancelType;
use Trip\SiteManagementBundle\DTO\BookingSearch;
use Trip\SiteManagementBundle\Form\BookingSearchType;
use Trip\SiteManagementBundle\Form\PackagePriceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Trip\SiteManagementBundle\Form\InsertImageType;

use Trip\SiteManagementBundle\Entity\InsertImage;


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
    public function faqAction(){
        return $this->render('TripSiteManagementBundle:Static:faq.html.twig');
    }
    /**
     * 
     * @param Search $entity
     * @return unknown
     */
    private function createPackageForm(SearchFilter $entity){
    	$form = $this->createForm(new packageType(), $entity, array(
    			'action' => $this->generateUrl('trip_booking_engine_search'),
    			'method' => 'GET',
    	));
    	
    	return $form;
    }
    /**
	 * 
	 */
    public function packagesAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $packages = $em->getRepository('TripSiteManagementBundle:Package')->findAll();
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $session = $request->getSession();
        $session->set('resultSet',$packages);
        return $this->render('TripSiteManagementBundle:Default:packages.html.twig',array(
    			'packages' => $packages,
                'locations' => $locations,
    	));
    }
    /**
	 * 
	 */
       public function specialPackagesAction(Request $request,$url){
          /* $from = $request->get('from');
           $q1 = "((ep.name='$id' OR sp.name='$id') OR ep2.name='$id')";
           if(!is_null($from)){
               if($from=='1')
                   $q1 = "sp.name='$id'";
               else
                   $q1 = "(ep.name='$id' OR  ep2.name='$id')";
           } */
            //$dql3 = "SELECT p FROM TripSiteManagementBundle:Package p,TripSiteManagementBundle:StartPoint sp, TripSiteManagementBundle:EndPoint ep,TripSiteManagementBundle:EndPoint2 ep2 where sp.name=c1.id and vb.goingTo=c2.id and b.id=vb.booking ORDER BY b.id DESC";
          /*$dql3 = "SELECT p FROM TripSiteManagementBundle:StartPoint sp,TripSiteManagementBundle:EndPoint ep,TripSiteManagementBundle:Package p LEFT JOIN TripSiteManagementBundle:EndPoint2 ep2 WITH p.id=ep2.booking  where   p.id= sp.booking AND p.id=ep.booking  AND $q1";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);					
            $packages = $query->getResult(); */
         
       $em = $this->getDoctrine()->getManager();
        //$packages = $em->getRepository('TripSiteManagementBundle:Package')->findAll();
        $packagetitle = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findBy(array('locationUrl' => $url));
           if($packagetitle){
               $packagetitle = $packagetitle[0];
                $id= $packagetitle->getId();
               $packages = $em->getRepository('TripSiteManagementBundle:Package')->findBy(array('category' => $id));
                $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
                $locations = $this->getLocationsByIndex($locations);
                $session = $request->getSession();
                $session->set('resultSet',$packages);
				 $session->set('locations',$locations);
				$packagetitles = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findAll();
				$packagetitlecontents = $em->getRepository('TripSiteManagementBundle:PackageTitleContent')->findBy(array('packageTitleId' => $id));
				$packagetitlelist = $em->getRepository('TripSiteManagementBundle:PackageTitleList')->findBy(array('packageTitleId' => $id));
                return $this->render('TripSiteManagementBundle:Default:specialPackages.html.twig',array(
                        'packages' => $packages,
                        'locations' => $locations,
                        'packagetitle'=>$packagetitle,
						'packagetitles'=>$packagetitles,
                		'packagetitlecontents'=>$packagetitlecontents,
                		'packagetitlelist'=>$packagetitlelist,
                ));
           }else{
               
           }
          
           
    }
    /**
	 * 
	 */
    public function packageSubmitAction(Request $request){
        $session = $request->getSession();
        $preferDate = $request->get('preferDate');
		$preferTime = $request->get('preferTime');
        $numAdult = $request->get('numAdult');
        $selected = $request->get('selected');
        $packageId = $request->get('packageId');
        $vehicleIndex = $request->get('vehicleIndex');
          
           if(!is_null($packageId)){
           	$em = $this->getDoctrine()->getManager();
           	//$selectedService = $em->getRepository('TripSiteManagementBundle:Package')->findAll();
           	$selectedService = $em->getRepository('TripSiteManagementBundle:Package')->find($packageId);
           //	echo var_dump($selectedService->getStartPoint()->first());
           //	exit();
           //	$selectedService = $selectedService[0];
           	$locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
           	$locations = $this->getLocationsByIndex($locations);
           	$session->set('locations',$locations);
           	$selected = 0;
           	$resultSet[$selected] = $selectedService;
           	$session->set('resultSet',$resultSet);
           }else {
     	 $resultSet = $session->get('resultSet');
         $selectedService = $resultSet[$selected];
           }
        $vehiclePrice = $selectedService->getPrice();
        $selectedVehicle = $vehiclePrice->get($vehicleIndex);
        $selectedService->setPrice(new ArrayCollection(array($selectedVehicle)));
        $searchFilter = new SearchFilter();
        list($d,$m,$y) = explode('/',$preferDate);
        $searchFilter->setDate(new \DateTime("$y-$m-$d"));
        $searchFilter->setTripType('package');
        $searchFilter->setNumDays(1);
        $searchFilter->setNumAdult($numAdult);
        $searchFilter->setPreferTime($preferTime);
        $searchFilter->setPackage($selectedService->getCode());
            $session->set('selectedData',$searchFilter);
         //$session->set('package','JTP01');
        $code = $selectedService->getCode();
        return $this->redirect($this->generateUrl('trip_booking_engine_confirm', array('selected' => $selected,'package'=>$code)));
        
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
            
                     $locations = $em->getRepository('TripSiteManagementBundle:city')->findAll();
         $customers = $em->getRepository('TripBookingEngineBundle:Customer')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        $customers = $this->getCustomersByIndex($customers);
		$data = $this->render('TripSiteManagementBundle:Default:exportBookings.html.twig',array(
    			'bookings' => $bookings,
            'locations' => $locations,
            'customers' => $customers,
    	));
		$request = $this->container->get('request');
		$session = $request->getSession();
        $session->set('exportBookings',$data);

			return $this->render ( 'TripSiteManagementBundle:Default:bookings.html.twig', array (

				    'bookings' => $bookings,
                    'locations' => $locations,
                    'customers' => $customers,
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
    private function createVehicleForm($entity){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new VehicleType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_add_vehicle'),
    			'method' => 'POST',
    	));
    	
    	return $form;
    }
	/**
     * 
     * @param Search $entity
     * @return unknown
     */
    private function createUpdatePriceForm($entity){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new PriceType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_booking_update_price'),
    			'method' => 'POST',
    	));
    	
    	return $form;
    }
	
	/**
     * 
     * @param Search $entity
     * @return unknown
     */
    private function createVehicleEditForm($entity,$id){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new VehicleType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_edit_vehicle',array (
						'id' => $id 
				) ),
    			'method' => 'POST',
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
    			'method' => 'POST',
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
    private function createAddPackageForm(Package $package){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new PackageType(), $package, array(
            'action' => $this->generateUrl('trip_site_management_add_package'),
            'method' => 'POST',
        ));
       $form->add('submit', 'submit', array('label' => 'submit'));

        return $form;
    }
   /* private function createAddPackageForm(Package $package){
        $form = $this->createForm(new PackageType(), $package, array(
            'action' => $this->generateUrl('trip_site_management_add_package'),
            'method' => 'POST',
        ));
       $form->add('submit', 'submit', array('label' => 'submit'));

        return $form;
    }*/
    private function createAddPackageLocationForm(PackageLocations $packagelocations){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new PackageLocationsType($bookingService), $packagelocations, array(
            'action' => $this->generateUrl('trip_site_management_add_packagelocations'),
            'method' => 'POST',
        ));
       $form->add('submit', 'submit', array('label' => 'submit'));

        return $form;
        
    }
     private function createAddPackagePriceForm(PackagePrice $packageprice){
         $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new PackagePriceType($bookingService), $packageprice, array(
            'action' => $this->generateUrl('trip_site_management_add_package_price'),
            'method' => 'POST',
        ));
       $form->add('submit', 'submit', array('label' => 'submit'));

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
    public function packageListAction(Request $request){
    	$em = $this->getDoctrine()->getManager();
    	
    	$packageList = $em->getRepository('TripSiteManagementBundle:Package')->findAll();
    	return $this->render('TripSiteManagementBundle:Default:packageList.html.twig',array(
    			'packageList' => $packageList,
    	));
    }
	//*********************Sreekanth*********************************************//
	public function multipackageListAction(Request $request){
    	$em = $this->getDoctrine()->getManager();
    	
    	$multipackageList = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findAll();
    	return $this->render('TripSiteManagementBundle:Default:multipackageList.html.twig',array(
    			'multipackageList' => $multipackageList,
    	));
    }
    public function billingListAction(Request $request){
	
		$security = $this->container->get ( 'security.context' );
    	if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
    		if (! $security->isGranted ( 'ROLE_ADMIN' ))
    			return $this->redirect ( $this->generateUrl ( "trip_security_sign_up" ) );
    	}
    	$em = $this->getDoctrine()->getManager();
    	//$booking = $em->getRepository('TripBookingEngineBundle:Booking')->findOneByBookingId($id);
    	
    	$locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
    	$locations = $this->getLocationsByIndex($locations);
    	$vehicles= $em->getRepository('TripBookingEngineBundle:Vehicle')->findAll();
    	$vehicles= $this->getLocationsByIndex($vehicles);
    	$bookingService = $this->container->get( 'booking.services' );
    	$drivers = $em->getRepository('TripSiteManagementBundle:Driver')->findAll();
    	$drivers= $bookingService->getDriverByIndex($drivers);
    	$billingList = $em->getRepository('TripBookingEngineBundle:TestCustomer')->findAll();
    	return $this->render('TripSiteManagementBundle:Default:billingList.html.twig',array(
    			'billingList' => $billingList,
    			'locations'=>$locations,
    			'vehicles' =>$vehicles,
    			'drivers' =>$drivers,
    			//'booking'=>$booking,
    			//'services'=>$booking->getVehicleBooking(),
    	));
    }
	//****************************end*****************************************************//
	/**
     *
     */
    public function updatePriceAction(Request $request){
        $em = $this->getDoctrine()->getManager();
    	$entity = new Services();
    	$form   = $this->createUpdatePriceForm($entity);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$services = $this->getServices($entity->getVehicleId());
			return $this->render('TripSiteManagementBundle:Default:updatePrice.html.twig',array(
					'services' => $services,
					'form'   => $form->createView(),
			));
    	}
    	return $this->render('TripSiteManagementBundle:Default:updatePrice.html.twig',array(
                'services' => array(),
    			'form'   => $form->createView(),
    	));
    }
		/**
     *
     */
    public function updateServicePriceAction(Request $request){
        $em = $this->getDoctrine()->getManager();
    	$id = $request->get('id');
		$price = $request->get('price');
		$returnPrice = $request->get('returnPrice');
		$service = $em->getRepository('TripBookingEngineBundle:Services')->find($id);
		$service->setPrice($price);
		$service->setReturnPrice($returnPrice);
    	$em->merge($service);			
		$em->flush();
		return new Response ("done");
    }
	/**
	*
	*/
	public function getServices($vid){
            $dql3 = "SELECT s.id,s.price,s.returnPrice, c1.name lFrom,c2.name to FROM TripBookingEngineBundle:Services s,TripSiteManagementBundle:city c1,TripSiteManagementBundle:city c2 WHERE s.leavingFrom=c1.id and s.goingTo=c2.id and s.vehicleId=$vid";
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($dql3);					
            $result = $query->getResult();
         return $result;        
     }
	 /**
     *
     */
    public function editVehicleAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
    	//$entity = new Vehicle();
		$entity = $em->getRepository('TripBookingEngineBundle:Vehicle')->find($id);
    	$form   = $this->createVehicleEditForm($entity,$id);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$em->merge($entity);
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
           // $entity->setVehicleId($vid);
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
    public function addPackageAction(Request $request){
        $em = $this->getDoctrine()->getManager();
    	$package = new Package();
        $itinerary = new PackageItinerary();
        $content = new PackageContent();
        $collection = $package->getItineraryList();
        $collection->add($itinerary);
        $contentList = $package->getContentList();
        $contentList->add($content);
        $packageImage = new PackageImages();
       	$packageImages = $package->getImageList();
        $packageImages->add($packageImage);
    	$form   = $this->createAddPackageForm($package);
    	$form->handleRequest($request);
        if ($form->isValid()) {
             $collection = $package->getItineraryList();
             $itineraryCollection = $package->getItinerary();
             foreach($collection as $itinerary){
             	if(!is_null($itinerary->getTitle()) or !is_null($itinerary->getDescription())){
             		$itinerary->setPackage($package);
             		$itineraryCollection->add($itinerary);
             	}
             }
             
             
             $contentList = $package->getContentList();
             $contentCollection = $package->getContent();
             foreach($contentList as $content){
             	//echo var_dump($content);
             	
             	if(!is_null($content->getTitle()) or !is_null($content->getDescription())){
             		$content->setPackage($package);
             		$content->setActive(1);
             		$contentCollection->add($content);
             	}
             }
            // exit();
             
             $packageImageList =$package->getImageList();
             $packageImages =$package->getImages();
             foreach($packageImageList as $packageImage){
             	$uploadedfile = $packageImage->getUrl ();
             	if (!is_null($uploadedfile)) {
             		$file_name = $uploadedfile->getClientOriginalName ();
             		$dir = 'images/packages/';
             		$uploadedfile->move ( $dir, $file_name );
             		$packageImage->setUrl ($file_name );
             		$packageImage->setPackage($package);
             		$packageImages->add($packageImage);
             			
             	}
             	
             }
             
            $em->persist($package);
    		$em->flush();
    		
    		$packageCode = 'JTP'.$package->getId();
    		$packageUrl = $package->getPackageUrl();
    		$packageUrl = $packageUrl.'-'.$packageCode;
    		$package->setCode($packageCode);
    		$package->setPackageUrl($packageUrl);
    		$package = $em->merge($package);
    		$em->flush();
    		
    		return $this->redirect($this->generateUrl('trip_site_management_add_package'));    
        
        }
        
        return $this->render('TripSiteManagementBundle:Default:addPackage.html.twig',array(
    			'package' => $package,
                		'form'   => $form->createView(),
    	));
    }
    public function addPackageLocationsAction(Request $request){
        $em = $this->getDoctrine()->getManager();
    	$packagelocations = new PackageLocations();
    	$form   = $this->createAddPackageLocationForm($packagelocations);
    	$form->handleRequest($request);
        if ($form->isValid()) {
            $type=$packagelocations->getType();
            $packageId= $packagelocations->getPackage();
                $package =$em->getRepository('TripSiteManagementBundle:Package')->find($packageId);
               //echo(var_dump($package));
               //exit();
            switch ($type) {
                case 'PickUp':
                     $startpoint = new StartPoint();
                    //$package->getStartPoint($startpoint);
                    break;
                  case 'FirstDay':
                     $startpoint = new EndPoint();
                     // $package->setStartPoint($startpoint);
                    break;
                  case 'SecondDay':
                     $startpoint = new EndPoint2();
                     // $package->setStartPoint($startpoint);
                    break;
                
            }
            
            $startpoint->setName($packagelocations->getLocation());
                 $startpoint->setBooking($package);
               $em->persist($startpoint);
    		$em->flush(); 
                return $this->redirect($this->generateUrl('trip_site_management_add_packagelocations')); 
   
        
        }
        
        return $this->render('TripSiteManagementBundle:Default:addPackagelocations.html.twig',array(
    			'packagelocations' => $packagelocations,
                		'form'   => $form->createView(),
    	));
    }
    public function addPackagePriceAction(Request $request){
		$security = $this->container->get ( 'security.context' );
    	if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
    		if (! $security->isGranted ( 'ROLE_ADMIN' ))
    			return $this->redirect ( $this->generateUrl ( "trip_security_sign_up" ) );
    	}
        $em = $this->getDoctrine()->getManager();
    	$packageprice = new PackagePrice();
    	$form   = $this->createAddPackagePriceForm($packageprice);
    	$form->handleRequest($request);
        if ($form->isValid()) {
            $packageId= $packageprice->getPackage();
            $package =$em->getRepository('TripSiteManagementBundle:Package')->find($packageId);
            $VehicleId= $packageprice->getVehicleId();
            $vehicle =$em->getRepository('TripBookingEngineBundle:Vehicle')->find($VehicleId);
            $packageprice->setName($vehicle->getModel());
            $packageprice->setPackage($package);
             $em->persist($packageprice);
    		$em->flush();
    		return $this->redirect($this->generateUrl('trip_site_management_add_package_price'));  
        
        }
        
        return $this->render('TripSiteManagementBundle:Default:addPackagePrice.html.twig',array(
    			'packageprice' => $packageprice,
                		'form'   => $form->createView(),
    	));
    }
    
    
    private function createEditPackageForm(Package $package,$id){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new EditPackageType(), $package, array(
    			'action' => $this->generateUrl('trip_site_management_edit_package',array('id'=>$id)),
    			'method' => 'POST',
    	));
    	$form->add('submit', 'submit', array('label' => 'Update'));
    
    	return $form;
    }
    
    public function editPackageAction(Request $request,$id){
    	$em = $this->getDoctrine()->getManager();
    	$package = new Package();
    	$package =$em->getRepository('TripSiteManagementBundle:Package')->find($id);
		$package_id = $package->getId();
    	$packageImg =$em->getRepository('TripSiteManagementBundle:PackageImages')->findBy(array('package' => $id));
		
		$packageImagesList = $package->getImages();
    	$package = $this->packageToPackage($package);
    	$itinerary = new PackageItinerary();
    	$content = new PackageContent();
    	$collection = new ArrayCollection();
    	$collection->add($itinerary);
    	$itineraryList = $package->getItinerary();
    	$contentList = $package->getContentList();
    	$contentList->add($content);
    	$contentCollection = $package->getContent();
    	$package->setItineraryList($collection);
    	$packageUrl =  $package->getPackageUrl();
    	$packageUrl = substr($packageUrl,0, strrpos($packageUrl, '-'));
    	$package->setPackageUrl($packageUrl);
		
		 $packageImage = new PackageImages();
		$packageImages = $package->getImageList();
        $packageImages->add($packageImage); 
		$insertImage = new InsertImage(); 
		$formupload   = $this->createInsertImageForm($insertImage,$id );
    	$formupload->handleRequest($request);
		$task = $formupload->getData();
		//print_r($packageImages);
    	$form   = $this->createEditPackageForm($package,$id);
    	$form->handleRequest($request);
    	if ($form->isValid()) {   		
    
    		//echo var_dump($package->getItinerary());
    		//exit();
    		$collection = $package->getItineraryList();
    		$itineraryCollection = new ArrayCollection();
    		foreach($collection as $itinerary){
    			if(!is_null($itinerary->getTitle()) or !is_null($itinerary->getDescription())){
    				//$itinerary->setPackage($package);
    				$itineraryCollection->add($itinerary);
    			}
    		}
    		
    		$package->setItinerary($itineraryCollection);
    		
    		$contentList = $package->getContentList();
    		$contentCollection = new ArrayCollection();
    		foreach($contentList as $content){
    			
    		
    			if(!is_null($content->getTitle()) or !is_null($content->getDescription())){
    				//$content->setPackage($package);
    				$content->setActive(1);
    				$contentCollection->add($content);
    			}
    			//echo var_dump($content);
    		}
    		//echo var_dump($itineraryCollection->count());
    		//exit();
    		$package->getContent()->clear();
    		$package->setContent($contentCollection);
    		$packageCode = $package->getCode();
    		$packageUrl =  $package->getPackageUrl();
    		$packageUrl = $packageUrl.'-'.$packageCode;
    		$package->setPackageUrl($packageUrl);
    		
    		//$package = $this->packageToPackage($package);
			 $packageImageList =$package->getImageList();
             $packageImages =$package->getImages();
             foreach($packageImageList as $packageImage){
             	$uploadedfile = $packageImage->getUrl ();
             	if (!is_null($uploadedfile)) {
             		$file_name = $uploadedfile->getClientOriginalName ();
             		$dir = 'images/packages/';
             		$uploadedfile->move ( $dir, $file_name );
             		$packageImage->setUrl ($file_name );
             		$packageImage->setPackage($package);
             		$packageImages->add($packageImage);
             			
             	}
             	
             }
    		
    		$package = $em->merge($package);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('trip_site_management_package_list'));
    
    	}
			
		
		 
    	return $this->render('TripSiteManagementBundle:Default:editPackage.html.twig',array(
    			'package' => $package,
				'packageImages' => $packageImg,
    			'itineraryList'=>$itineraryList,
    			'contentList'=>$contentCollection,
    			'form'   => $form->createView(),
				'formupload'   => $formupload->createView(),
    	));
    }
	
	
	//*****************************Sreekanth***********************//
	public function hotelsListAction(Request $request){
    	$em = $this->getDoctrine()->getManager();
    	
    	$hotelsList = $em->getRepository('TripSiteManagementBundle:Hotel')->findAll();
    	return $this->render('TripSiteManagementBundle:Default:hotelsList.html.twig',array(
    			'hotelsList' => $hotelsList,
    	));
    }
	public function editHotelAction(Request $request,$id){
    	$em = $this->getDoctrine()->getManager();
    	//$package = new Package();
    	$package =$em->getRepository('TripSiteManagementBundle:Hotel')->find($id);
    	 
    	$form   = $this->createEditHotelForm($package,$id);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$package = $em->merge($package);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('trip_site_management_hotels_list'));
    
    	}
    
    	return $this->render('TripSiteManagementBundle:Default:editHotel.html.twig',array(
    			'package' => $package,
    			'form'   => $form->createView(),
    	));
    }
	private function createEditHotelForm($package,$id){
    	//$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new EditHotelType(), $package, array(
    			'action' => $this->generateUrl('trip_site_management_edit_hotel',array('id'=>$id)),
    			'method' => 'POST',
    	));
    	$form->add('submit', 'submit', array('label' => 'Update'));
    
    	return $form;
    }
	
 public function editMultiPackageAction(Request $request,$id){
    	$em = $this->getDoctrine()->getManager();
    	//$package = new Package();
    	$package =$em->getRepository('TripSiteManagementBundle:PackageTitle')->find($id);
    	 
    	$form   = $this->createEditMultiPackageForm($package,$id);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$package = $em->merge($package);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('trip_site_management_multipackage_list'));
    
    	}
    
    	return $this->render('TripSiteManagementBundle:Default:editmultiPackage.html.twig',array(
    			'package' => $package,
    			'form'   => $form->createView(),
    	));
    }
	private function createEditMultiPackageForm($package,$id){
    	//$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new MultiPackageTitleType(), $package, array(
    			'action' => $this->generateUrl('trip_site_management_edit_multipackage',array('id'=>$id)),
    			'method' => 'POST',
    	));
    	$form->add('submit', 'submit', array('label' => 'Update'));
    
    	return $form;
    }
	public function viewHotelAction(Request $request,$id)
    {
    	//$search = new Search();
    	//$form   = $this->createSearchForm($search);
    	$em = $this->getDoctrine()->getManager();
    	$hotel = $em->getRepository('TripSiteManagementBundle:Hotel')->find($id);
    	return $this->render('TripSiteManagementBundle:Default:viewHotel.html.twig', array(
    			//'form'   => $form->createView(),
    			'hotel'=> $hotel
    	));
    }
    public function billingDetailsAction(Request $request){
	$security = $this->container->get ( 'security.context' );
    	if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
    		if (! $security->isGranted ( 'ROLE_ADMIN' ))
    			return $this->redirect ( $this->generateUrl ( "trip_security_sign_up" ) );
    	}
    	$em = $this->getDoctrine()->getManager();
    	$hotel = new BillingDto();
		$collection = $hotel->getMultiple();
		$newBilling = new NewBilling();
		 $collection->add($hotel);
    	$form   = $this->createBillingForm($hotel);
    	
    	//$collection = $hotel->getMultiple();
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    	
    	$billingObj = new Billing();
    	//$billingObj->setId($hotel->getId());
    	$billingObj->setDiesel($newBilling->getDiesel());
    	$billingObj->setPrice($newBilling->getPrice());
    	$billingObj->setAdvance($newBilling->getAdvance());
    	$billingObj->setCash($newBilling->getCash());
    	$billingObj->setExpenses($hotel->getExpenses());
    	$billingObj->setComments($hotel->getComments());
    	$billingObj->setDate($hotel->getDate());
    	$billingObj->setPickup($hotel->getPickup());
    	$billingObj->setGoingTo($hotel->getGoingTo());
    	$billingObj->setVehicleId($hotel->getVehicleId());
    	$billingObj->setDriverId($hotel->getDriverId());
    	
    	$collection = $hotel->getLocations();
    	$placesToVisitCollection= $billingObj->getLocations();
    	foreach($collection as $location){
    		$placesToVisitObj = new BillingPlacesToVisit();
    		$placesToVisitObj->setLocation($location);
    		$placesToVisitObj->setBilling($billingObj);
    		$placesToVisitCollection->add($placesToVisitObj);
    	}
    	
    	$em->persist($billingObj);
    		$em->flush();
    		return $this->redirect($this->generateUrl('trip_site_management_billing_details'));
    	}
    
    	return $this->render('TripSiteManagementBundle:Default:billingDetails.html.twig',array(
    			'form'   => $form->createView(),
    	));
    }
    
    private function createBillingForm($entity){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new BillingType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_billing_details'),
    			'method' => 'POST',
    	));
    	$form->add('submit', 'submit', array('label' => 'submit'));
    	
    	return $form;
    }
    
    public function exportBillingsAction(){
    	$request = $this->container->get('request');
    	$session = $request->getSession();
    	$view = $session->get('exportBillings');
    	header ( 'Content-Type: application/force-download' );
    	header ( 'Content-disposition: attachment; filename=bookings.xls' );
    	//echo var_dump($view);
    	//exit();
    	return $view;
    }
    
	//*****************end**************************************//
    private function createEditItineraryForm($package,$id){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new PackageItineraryType(), $package, array(
    			'action' => $this->generateUrl('trip_site_management_edit_itinerary',array('id'=>$id)),
    			'method' => 'POST',
    	));
    	$form->add('submit', 'submit', array('label' => 'Update'));
    
    	return $form;
    }
    
    private function createEditPackageContentForm($packageContent,$id){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new PackageContentType(), $packageContent, array(
    			'action' => $this->generateUrl('trip_site_management_edit_package_content',array('id'=>$id)),
    			'method' => 'POST',
    	));
    	$form->add('submit', 'submit', array('label' => 'Update'));
    
    	return $form;
    }
    
    
    /**
    
    *
    
    * @param Request $request
    
    */
    
    public function deleteItineraryAction(Request $request,$id){        	   	
    	$em = $this->getDoctrine()->getManager();
    	
    	$packageItinerary = $em->getRepository('TripSiteManagementBundle:PackageItinerary')->find($id);
    	
    	$em->remove ( $packageItinerary );
    	$em->flush();

       return new Response ( "true" );   
    
    }
    
    /**   
    *    
    * @param Request $request   
    */    
    public function deletePackageContentAction(Request $request,$id){
    	$em = $this->getDoctrine()->getManager();
    	 
    	$packageContent = $em->getRepository('TripSiteManagementBundle:PackageContent')->find($id);
    	 
    	$em->remove ( $packageContent );
    	$em->flush();
    
    	return new Response ( "true" );
    
    }
    
    /**
     * 
     * @param unknown $package
     * @return \Trip\SiteManagementBundle\Entity\Package
     */
    
    public function PackageToPackage($package){
    	$newPackage = new Package();
    	$newPackage->setId($package->getId());
    	$newPackage->setName($package->getName());
    	$newPackage->setType($package->getType());
    	$newPackage->setCode($package->getCode());
    	$newPackage->setActive($package->getActive());
    	$newPackage->setCategory($package->getCategory());
    	$newPackage->setTitle($package->getTitle());
    	$newPackage->setOverview($package->getOverview());
    	$newPackage->setMetaKeywords($package->getMetaKeywords());
    	$newPackage->setMetaDescription($package->getMetaDescription());
    	$newPackage->setMetaTitle($package->getMetaTitle());
    	$newPackage->setPackageUrl($package->getPackageUrl());
    	
    	
    	$collection = $package->getItinerary();
    	$itineraryCollection = $newPackage->getItinerary();
    	foreach($collection as $itinerary){
    		$newItinerary = new PackageItinerary();
    		$newItinerary->setId($itinerary->getId());
    		$newItinerary->setTitle($itinerary->getTitle());
    		$newItinerary->setDescription($itinerary->getDescription());
    		$newItinerary->setPackage($newPackage);
    		$itineraryCollection->add($newItinerary);
    	}
    	
    	$contentList = $package->getContent();
    	$contentCollection = $newPackage->getContent();
    	foreach($contentList as $content){
    		$newContent = new PackageContent();
    		$newContent->setId($content->getId());
    		$newContent->setTitle($content->getTitle());
    		$newContent->setActive(1);
    		$newContent->setDescription($content->getDescription());
    		$newContent->setPackage($newPackage);
    		$contentCollection->add($newContent);
    	}
    	
    	return $newPackage;
    }
    
    public function editItineraryAction(Request $request,$id){
    	$em = $this->getDoctrine()->getManager();
    	//$package = new Package();
    	$package =$em->getRepository('TripSiteManagementBundle:PackageItinerary')->find($id);
    	 
    	$form   = $this->createEditItineraryForm($package,$id);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$package = $em->merge($package);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('trip_site_management_package_list'));
    
    	}
    
    	return $this->render('TripSiteManagementBundle:Default:editItinerary.html.twig',array(
    			'package' => $package,
    			'form'   => $form->createView(),
    	));
    }
    
    public function editPackageContentAction(Request $request,$id){
    	$em = $this->getDoctrine()->getManager();
    	//$package = new Package();
    	$packageContent =$em->getRepository('TripSiteManagementBundle:PackageContent')->find($id);
    
    	$form   = $this->createEditPackageContentForm($packageContent,$id);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$package = $em->merge($packageContent);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('trip_site_management_package_list'));
    
    	}
    
    	return $this->render('TripSiteManagementBundle:Default:editPackageContent.html.twig',array(
    			'packageContent' => $packageContent,
    			'form'   => $form->createView(),
    	));
    }
    
    public function multipackagesAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $packagetitle = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findAll();
        
        $session = $request->getSession();
        $session->set('resultSet',$packagetitle);
        return $this->render('TripSiteManagementBundle:Default:multipackages.html.twig',array(
    			'packagetitle' => $packagetitle,
                
    	));
    }
     public function  viewPackageAction(Request $request,$url){
        $em = $this->getDoctrine()->getManager();
        $location = null;
		$error = null;
        $package =$em->getRepository('TripSiteManagementBundle:Package')->findBy(array('packageUrl' => $url));
        if($package){
        	$package = $package[0];	       
	        $drop = $package->getEndPoint2()->first();
	        if($drop){
	        $location =$em->getRepository('TripSiteManagementBundle:City')->find($drop->getName());
	        }
        }else{
			$error = "Package not found";
		}
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        //echo var_dump($package->getItinerary()->first());
        //exit();
        
        
        return $this->render('TripSiteManagementBundle:Default:viewPackage.html.twig',array(
    			'package' => $package,
				'error'=>$error,
        		'location'=>$location,
        		'locations'=>$locations
                
    	));
    }
	
	
	 
	
	private function createInsertImageForm(InsertImage $entity,$id)
    {
        $form = $this->createForm(new InsertImageType(), $entity, array(
            'action' => $this->generateUrl('trip_site_management_edit_package',array('id'=>$id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Insert'));

        return $form;
    }
	
}