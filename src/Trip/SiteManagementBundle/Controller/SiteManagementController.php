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

use Trip\BookingEngineBundle\Entity\Services;
use Trip\BookingEngineBundle\Entity\Vehicle;
use Trip\SiteManagementBundle\Entity\Hotel;
use Trip\SiteManagementBundle\Entity\Billing;
use Trip\SiteManagementBundle\DTO\BillingDto;
use Trip\SiteManagementBundle\Entity\BillingPlacesToVisit;
use Trip\SiteManagementBundle\Entity\Driver;
use Trip\SiteManagementBundle\Form\BillingType;
use Trip\SiteManagementBundle\Form\HotelType;
use Trip\SiteManagementBundle\Entity\Contact;
use Trip\SiteManagementBundle\Form\ContactType;
use Trip\SiteManagementBundle\Entity\Biketime;
use Trip\SiteManagementBundle\Form\biketimerangeType;
use Trip\SiteManagementBundle\Form\PriceviewbikesType;
use Trip\SiteManagementBundle\Entity\Cancel;
use Trip\SiteManagementBundle\Form\CancelType;
use Trip\SiteManagementBundle\DTO\BookingSearch;
use Trip\SiteManagementBundle\Form\BookingSearchType;
use Trip\SiteManagementBundle\Form\PackagePriceType;
use Trip\SiteManagementBundle\Form\AddMultiPackageTitleType;
use Trip\SiteManagementBundle\Form\EditBikesType;
use Trip\SiteManagementBundle\Entity\TwoStartPoint;
use Trip\SiteManagementBundle\Entity\TwoEndPoint;
use Trip\SiteManagementBundle\Entity\TwoEndPoint2;
use Trip\SiteManagementBundle\Form\TwodayPackageLocationsType;
use Trip\SiteManagementBundle\Form\AddBikesType;
use Trip\SiteManagementBundle\DTO\TwodayPackageLocations;
use Trip\SiteManagementBundle\Entity\bikes;
use Trip\BookingEngineBundle\Entity\BikeBooking;
use Trip\BookingEngineBundle\Entity\Booking;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

use Trip\SiteManagementBundle\DTO\Billing as NewBilling;
use Trip\SiteManagementBundle\Form\InsertImageType;
use Trip\SiteManagementBundle\Entity\InsertImage;
use Trip\SiteManagementBundle\Form\CustomerType;
use Trip\SiteManagementBundle\Entity\Customer;
use Trip\SiteManagementBundle\DTO\HotelDto;
use Trip\SiteManagementBundle\DTO\HotelRoomDto;
use Trip\SiteManagementBundle\Entity\HotelRoom;
use Trip\SiteManagementBundle\Entity\HotelAddress;
use Trip\SiteManagementBundle\Form\HotelDetailType;
use Trip\BookingEngineBundle\DTO\SearchHotel;
use Trip\BookingEngineBundle\Form\SearchHotelType; 
use Trip\BookingEngineBundle\DTO\SearchHotelAgain;
use Trip\BookingEngineBundle\Form\SearchHotelAgainType;
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
                $active = '1';
                $packages = $em->getRepository('TripSiteManagementBundle:Package')->findBy(array('category' => $id,'active' => $active));
                $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
                $locations = $this->getLocationsByIndex($locations);
                $session = $request->getSession();
                $session->set('resultSet',$packages);
				 $session->set('locations',$locations);
				 $type = 'one';
				 $packagetitles = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findBy(array('type' => $type));
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
   /*  private function createHotelForm($entity){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new HotelType($bookingService), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_add_hotel'),
    			'method' => 'POST',
    	));
    	
    	return $form;
    } */
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
            'action' => $this->generateUrl('trip_site_management_add_twoday_packagelocations'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Submit','attr'   =>  array('class'=>'search-bike')));

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
    public function addHotelAction(Request $request)
    {
        $security = $this->container->get ( 'security.context' );
        
        $user = $security->getToken ()->getUser ();
        
        if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
            
            return $this->redirect ( $this->generateUrl ('trip_security_sign_up') );
            
        }
        
        $em = $this->getDoctrine()->getManager();
        $hotelDetail = new HotelDto();
        $hotelImage = new HotelImage();
        $hotelImageList = $hotelDetail->getImageList();
        $hotelImageList->add($hotelImage);
        
        //newlyadded 3lines
        $hotelRoom  =new HotelRoomDto();
        $hotelRoomList = $hotelDetail->getRoomList();
        $hotelRoomList->add($hotelRoom);
        
        
       // $catalogueService = $this->container->get( 'catalogue.service' );
        $form = $this->createForm(new HotelDetailType(),$hotelDetail);
        $form->add('submit','submit', array('label' => 'Add Hotel'));
        $form ->handleRequest($request);
        
        if($form->isValid()) {
            
            $hotelObj = new Hotel();
            
            $hotelAddressObj = new HotelAddress();
            
           // $catalogueService = $this->container->get( 'catalogue.service' );
           // $cities = $catalogueService->getCities();
           // $cities = $catalogueService->getById($cities);
            
           // $selectedCity = $cities[$hotelDetail->getCity()];
            
            $hotelObj->setName($hotelDetail->getName());
            $hotelObj->setOverview($hotelDetail->getOverview());
            $hotelObj->setPropertyType($hotelDetail->getPropertyType());
            $hotelObj->setCategory($hotelDetail->getCategory());
            $hotelObj->setCheckIn($hotelDetail->getCheckIn());
            $hotelObj->setCheckOut($hotelDetail->getCheckOut());
            $hotelObj->setPrice($hotelDetail->getPrice());
            $hotelObj->setCity($hotelDetail->getCity());
            $hotelObj->setNumRooms($hotelDetail->getNumRooms());
            $hotelObj->setSoldOut($hotelDetail->getSoldOut());
            $hotelObj->setPriority($hotelDetail->getPriority());
           // $hotelObj->setCityId($selectedCity->getId());
            $hotelObj->setActive($hotelDetail->getActive());
            if($hotelDetail->getCity()=='Tirupati'){
                $hotelObj->setCityId(1);
            }elseif ($hotelDetail->getCity()=='Bangalore'){
                $hotelObj->setCityId(2);
            }else{
                $hotelObj->setCityId(3);
            }
            
            
            $hotelObj->setFooterDisplay($hotelDetail->getFooterDisplay());
            $hotelObj->setUrl($hotelDetail->getUrl());
            $hotelObj->setMetaTitle($hotelDetail->getMetaTitle());
            $hotelObj->setMetaKeywords($hotelDetail->getMetaKeywords());
            $hotelObj->setMetaDescription($hotelDetail->getMetaDescription());
            
            $hotelObj->setHotelblockStartDate($hotelDetail->getHotelblockStartDate());
            $hotelObj->setHotelblockEndDate($hotelDetail->getHotelblockEndDate());
            
            date_default_timezone_set('Asia/Kolkata');
            $date = new \DateTime();
            $adminname = $user->getEmail();
            //$timestamp = strtotime($date);
            //$new_date = date('Y-m-d',$date );
            
            $hotelObj->setAuditInfocreatedAt($date);
            $hotelObj->setAuditInfocreatedBy($adminname);
            $hotelObj->setAuditInfoupdatedBy($adminname);
            $hotelObj->setAuditInfoupdatedAt($date);
            //echo var_dump($hotelObj);
            //exit();
            
            $hotelAddressObj->setAddressLine1($hotelDetail->getAddressLine1());
            $hotelAddressObj->setAddressLine2($hotelDetail->getAddressLine2());
            $hotelAddressObj->setLocation($hotelDetail->getLocation());
            $hotelAddressObj->setPincode($hotelDetail->getPincode());
            $hotelAddressObj->setCity($hotelDetail->getCity());
            //$hotelAddressObj->setCityId($selectedCity->getId());
            
            
            $hotelObj->setAddress($hotelAddressObj);
            $hotelAddressObj->setHotel($hotelObj);
            //$hotelObj->setImages($hotelDetail->getImages());
            //$hotelObj->setAmenities($hotelDetail->getAmenities());
            
            
            
            $hotelImageList = $hotelDetail->getImageList();
            $hotelImages =$hotelObj->getImages();
            foreach($hotelImageList as $hotelImage){
                $uploadedfile = $hotelImage->getImagePath ();
                if (!is_null($uploadedfile)) {
                    $file_name = $uploadedfile->getClientOriginalName ();
                    $dir = 'images/Hotels/';
                    $uploadedfile->move ( $dir, $file_name );
                    $hotelImage->setImagePath ($file_name );
                    $hotelImage->setActive (1);
                    $hotelImage->setHotel($hotelObj);
                    $hotelImages->add($hotelImage);
                    
                }
                
                
            }
            
            
            
            $hotelRoomList = $hotelDetail->getRoomList();
            $hotelRooms =$hotelObj->getHotelRooms();
            foreach($hotelRoomList as $hotelRoom){
                $roomType = $hotelRoom->getRoomType();
                $capacity = $hotelRoom->getCapacity();
                $price = $hotelRoom->getPrice();
                $imagePath = $hotelRoom->getImagePath();
                $maxAdult = $hotelRoom->getMaxAdult();
                $maxChild = $hotelRoom->getMaxChild();
                $description = $hotelRoom->getDescription();
                $soldout = $hotelRoom->getSoldOut();
                
                $name = $hotelRoom->getName();
                
                
                
                $hotelRoomObj  =new HotelRoom();
                $hotelRoomObj->setRoomType ($roomType );
                $hotelRoomObj->setCapacity ($capacity );
                $hotelRoomObj->setPrice ($price );
                $hotelRoomObj->setMaxAdult ($maxAdult );
                $hotelRoomObj->setMaxChild ($maxChild );
                $hotelRoomObj->setDescription ($description );
                $hotelRoomObj->setSoldOut ($soldout );
                
                
                //$hotelRoomObj->setBlockEndDate(new \DateTime());
                
                $hotelRoomObj->setBlockStartDate($hotelRoom->getBlockStartDate());
                $hotelRoomObj->setBlockEndDate($hotelRoom->getBlockEndDate());
                $hotelRoomObj->setSequence($hotelRoom->getSequence());
                
                
                $hotelRoomObj->setPromotionStartDate($hotelRoom->getPromotionStartDate());
                $hotelRoomObj->setPromotionEndDate($hotelRoom->getPromotionEndDate());
                $hotelRoomObj->setPromotionPrice($hotelRoom->getPromotionPrice());
                
                
                
                $hotelRoomObj->setName($name );
                
                
                $uploadedfile = $hotelRoom->getImagePath ();
                if (!is_null($uploadedfile)) {
                    $file_name = $uploadedfile->getClientOriginalName ();
                    $dir = 'images/Hotels/';
                    $uploadedfile->move ( $dir, $file_name );
                    $hotelRoomObj->setImagePath ($file_name );
                    //$hotelRoom->setActive (1);
                    $hotelRoomObj->setHotel($hotelObj);
                    
                }
                
                
                
                $hotelRooms->add($hotelRoomObj);
                
                
            }
            
            //echo var_dump($hotelObj);
            //exit();
            
            $em->persist($hotelObj);
            
            $em->flush();
            /*
             $this->addFlash(
             'Notice',
             'Hotel Detail Added'
             ); */
            
            return $this->redirect ( $this->generateUrl ( "trip_sitemanagementbundle_add_hotel" ) );
        }
        
        return $this->render('TripSiteManagementBundle:Default:addHotel.html.twig',array(
            
            'hotel'=> $hotelDetail,
            'form' => $form->createView(),
        ));
        
    }
    /* public function addHotelAction(Request $request){
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
    } */
    public function addPackageAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        
        $cat = $request->get('cat');
        //echo var_dump($cat);
        //exit();
        
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
        
        $package->setCategory($cat);
       // echo var_dump($package);
        //exit();
        
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
            //$type='two';
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
    		return $this->redirect($this->generateUrl('trip_site_management_add_twoday_packagelocations'));  
        
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
    private function createInsertImageForm(InsertImage $entity,$id)
    {
        $form = $this->createForm(new InsertImageType(), $entity, array(
            'action' => $this->generateUrl('trip_site_management_edit_package',array('id'=>$id)),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Insert'));
        
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
    public function editHotelAction(Request $request,$id)
    {
        $security = $this->container->get ( 'security.context' );
        
        $user = $security->getToken ()->getUser ();
        
        if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
            
            return $this->redirect ( $this->generateUrl ('trip_security_sign_up') );
            
        }
        $em = $this->getDoctrine()->getManager();
        $hotelObj = $em->getRepository('TripSiteManagementBundle:Hotel')->find($id);
        $hotelDetail = new HotelDto();
        $hotelImage = new HotelImage();
        
        $hotelRooms =$hotelObj->getHotelRooms();
        $oldHotelRooms = array();
        foreach($hotelRooms as $hotelRoomObj){
            $hotelRoom  =new HotelRoomDto();
            $hotelRoom->setId ($hotelRoomObj->getId() );
            $hotelRoom->setRoomType ($hotelRoomObj->getRoomType() );
            $hotelRoom->setCapacity ($hotelRoomObj->getCapacity() );
            $hotelRoom->setPrice ($hotelRoomObj->getPrice() );
            $hotelRoom->setMaxAdult ($hotelRoomObj->getMaxAdult() );
            $hotelRoom->setMaxChild ($hotelRoomObj->getMaxChild() );
            $hotelRoom->setDescription ($hotelRoomObj->getDescription() );
            //$hotelRoom->setImagePath ($hotelRoomObj->getImagePath() );
            
            $hotelRoom->setSoldOut ($hotelRoomObj->getSoldOut() );
            
            $hotelRoom->setBlockStartDate ($hotelRoomObj->getBlockStartDate() );
            $hotelRoom->setBlockEndDate ($hotelRoomObj->getBlockEndDate());
            
            
            $hotelRoom->setSequence ($hotelRoomObj->getSequence());
            
            
            $hotelRoom->setPromotionStartDate ($hotelRoomObj->getPromotionStartDate() );
            $hotelRoom->setPromotionEndDate ($hotelRoomObj->getPromotionEndDate() );
            $hotelRoom->setPromotionPrice ($hotelRoomObj->getPromotionPrice() );
            
            $hotelRoom->setName ($hotelRoomObj->getName() );
            $hotelRoomList = $hotelDetail->getRoomList();
            $hotelRoomList->add($hotelRoom);
            
            $oldHotelRooms[$hotelRoomObj->getId()] = $hotelRoomObj;
        }
        
        $hotelImageList = $hotelDetail->getImageList();
        $hotelImageList->add($hotelImage);
        
       // $catalogueService = $this->container->get( 'catalogue.service' );
        
        
        $hotelDetail->setName($hotelObj->getName());
        $hotelDetail->setOverview($hotelObj->getOverview());
        $hotelDetail->setPropertyType($hotelObj->getPropertyType());
        $hotelDetail->setCategory($hotelObj->getCategory());
        $hotelDetail->setCheckIn($hotelObj->getCheckIn());
        $hotelDetail->setCheckOut($hotelObj->getCheckOut());
        $hotelDetail->setPrice($hotelObj->getPrice());
        $hotelDetail->setCity($hotelObj->getCity());
        $hotelDetail->setNumRooms($hotelObj->getNumRooms());
        $hotelDetail->setSoldOut($hotelObj->getSoldOut());
        
        $hotelDetail->setPriority($hotelObj->getPriority());
        //$HotelObj->setCityId($hotelObj->getCityId());
        $hotelDetail->setActive($hotelObj->getActive());
        
        $hotelDetail->setFooterDisplay($hotelObj->getFooterDisplay());
        $hotelDetail->setUrl($hotelObj->getUrl());
        $hotelDetail->setMetaTitle($hotelObj->getMetaTitle());
        $hotelDetail->setMetaKeywords($hotelObj->getMetaKeywords());
        $hotelDetail->setMetaDescription($hotelObj->getMetaDescription());
        
        $hotelDetail->setHotelblockStartDate($hotelObj->getHotelblockStartDate());
        $hotelDetail->setHotelblockEndDate($hotelObj->getHotelblockEndDate());
        
        
        
        
        
        
        $hotelAddressObj = $hotelObj->getAddress();
        
        $hotelDetail->setAddressLine1($hotelAddressObj->getAddressLine1());
        $hotelDetail->setAddressLine2($hotelAddressObj->getAddressLine2());
        $hotelDetail->setLocation($hotelAddressObj->getLocation());
        $hotelDetail->setPincode($hotelAddressObj->getPincode());
        
        
        $form = $this->createForm(new HotelDetailType(),$hotelDetail);
        $form->add('submit','submit', array('label' => 'Update'));
        $form ->handleRequest($request);
        
        
        
        if($form->isValid()) {
            
            
           // $cities = $catalogueService->getCities();
            //$cities = $catalogueService->getById($cities);
            
           // $selectedCity = $cities[$hotelDetail->getCity()];
            
            $hotelObj->setName($hotelDetail->getName());
            $hotelObj->setOverview($hotelDetail->getOverview());
            $hotelObj->setPropertyType($hotelDetail->getPropertyType());
            $hotelObj->setCategory($hotelDetail->getCategory());
            $hotelObj->setCheckIn($hotelDetail->getCheckIn());
            $hotelObj->setCheckOut($hotelDetail->getCheckOut());
            $hotelObj->setPrice($hotelDetail->getPrice());
            $hotelObj->setCity($hotelDetail->getCity());
            $hotelObj->setNumRooms($hotelDetail->getNumRooms());
            $hotelObj->setSoldOut($hotelDetail->getSoldOut());
            
            $hotelObj->setPriority($hotelDetail->getPriority());
            //$hotelObj->setCityId($selectedCity->getId());
            $hotelObj->setActive($hotelDetail->getActive());
            
            
            $hotelObj->setFooterDisplay($hotelDetail->getFooterDisplay());
            $hotelObj->setUrl($hotelDetail->getUrl());
            $hotelObj->setMetaTitle($hotelDetail->getMetaTitle());
            $hotelObj->setMetaKeywords($hotelDetail->getMetaKeywords());
            $hotelObj->setMetaDescription($hotelDetail->getMetaDescription());
            
            $hotelObj->setHotelblockStartDate($hotelDetail->getHotelblockStartDate());
            $hotelObj->setHotelblockEndDate($hotelDetail->getHotelblockEndDate());
            
            date_default_timezone_set('Asia/Kolkata');
            $date = new \DateTime();
            $hotelObj->setAuditInfoupdatedBy($user->getEmail());
            $hotelObj->setAuditInfoupdatedAt($date);
            //$hotelObj->>setAuditInfocreatedBy($user->getEmail());
            //$hotelObj->setAuditInfocreatedAt($date);
            
            $hotelAddressObj->setAddressLine1($hotelDetail->getAddressLine1());
            $hotelAddressObj->setAddressLine2($hotelDetail->getAddressLine2());
            $hotelAddressObj->setLocation($hotelDetail->getLocation());
            $hotelAddressObj->setPincode($hotelDetail->getPincode());
            $hotelAddressObj->setCity($hotelDetail->getCity());
           // $hotelAddressObj->setCityId($selectedCity->getId());
            
            
            $hotelObj->setAddress($hotelAddressObj);
            $hotelAddressObj->setHotel($hotelObj);
            //$hotelObj->setImages($hotelDetail->getImages());
            //$hotelObj->setAmenities($hotelDetail->getAmenities());
            
            
            
            $hotelImageList = $hotelDetail->getImageList();
            $hotelImages = new ArrayCollection();
            
            foreach($hotelImageList as $hotelImage){
                $uploadedfile = $hotelImage->getImagePath ();
                if (!is_null($uploadedfile)) {
                    $file_name = $uploadedfile->getClientOriginalName ();
                    $dir = 'images/Hotels/';
                    $uploadedfile->move ( $dir, $file_name );
                    $hotelImage->setImagePath ($file_name );
                    $hotelImage->setActive (1);
                    $hotelImage->setHotel($hotelObj);
                    $hotelImages->add($hotelImage);
                    
                }
                
            }
            
            $hotelRoomList = $hotelDetail->getRoomList();
            $hotelRooms =$hotelObj->getHotelRooms();
            foreach($hotelRoomList as $hotelRoom){
                $isdeleted = $hotelRoom->getIsDeleted();
                if($isdeleted==1){
                    $roomType = $hotelRoom->getRoomType();
                    $capacity = $hotelRoom->getCapacity();
                    $price = $hotelRoom->getPrice();
                    $imagePath = $hotelRoom->getImagePath();
                    $maxAdult = $hotelRoom->getMaxAdult();
                    $maxChild = $hotelRoom->getMaxChild();
                    $description = $hotelRoom->getDescription();
                    $soldout = $hotelRoom->getSoldOut();
                    
                    $blockStartDate = $hotelRoom->getBlockStartDate();
                    $blockEndDate = $hotelRoom->getBlockEndDate();
                    $sequence = $hotelRoom->getSequence();
                    
                    $promotionStartDate = $hotelRoom->getPromotionStartDate();
                    $promotionEndDate = $hotelRoom->getPromotionEndDate();
                    $promotionPrice = $hotelRoom->getPromotionPrice();
                    
                    
                    
                    
                    $name = $hotelRoom->getName();
                    
                    //echo var_dump($hotelRoom->getId());
                    $hotelRoomObj  =new HotelRoom();
                    if(!is_null($hotelRoom->getId()))
                        $hotelRoomObj = $oldHotelRooms[$hotelRoom->getId()];
                        $hotelRoomObj->setRoomType ($roomType );
                        $hotelRoomObj->setCapacity ($capacity );
                        $hotelRoomObj->setPrice ($price );
                        $hotelRoomObj->setMaxAdult ($maxAdult );
                        $hotelRoomObj->setMaxChild ($maxChild );
                        $hotelRoomObj->setDescription ($description );
                        $hotelRoomObj->setSoldOut ($soldout );
                        $hotelRoomObj->setBlockStartDate ($blockStartDate );
                        $hotelRoomObj->setBlockEndDate ($blockEndDate );
                        $hotelRoomObj->setSequence ($sequence );
                        $hotelRoomObj->setPromotionStartDate ($promotionStartDate );
                        $hotelRoomObj->setPromotionEndDate ($promotionEndDate );
                        $hotelRoomObj->setPromotionPrice ($promotionPrice );
                        
                        $hotelRoomObj->setName ($name);
                        //echo var_dump($hotelRoomObj);
                        $uploadedfile = $hotelRoom->getImagePath ();
                        if (!is_null($uploadedfile)) {
                            $file_name = $uploadedfile->getClientOriginalName ();
                            $dir = 'images/Hotels/';
                            $uploadedfile->move ( $dir, $file_name );
                            $hotelRoomObj->setImagePath ($file_name );
                            //$hotelRoom->setActive (1);
                            $hotelRoomObj->setHotel($hotelObj);
                            
                        }
                        $hotelRooms->add($hotelRoomObj);
                        
                }
                
            }
            
            //
            
            
            $hotelObj->setImages($hotelImages);
            
            
            $em->merge($hotelObj);
            
            $em->flush();
            /*
             $this->addFlash(
             'Notice',
             'Hotel Detail Added'
             ); */
            
            return $this->redirect ( $this->generateUrl ( "trip_site_management_hotels_list" ) );
        }
        
        return $this->render('TripSiteManagementBundle:Default:edithotel.html.twig',array(
            
            'hotel' => $hotelObj,
            'form' => $form->createView(),
        ));
        
    }
    public function deleteHotelAction($id)
    {
        $hotel = $this->getDoctrine()
        ->getRepository('TripSiteManagementBundle:Hotel')
        ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($hotel);
        $em->flush();
        return new Response('true');
        //return $this->redirect($this->generateUrl('room_hotel_search_hotel'));
    }
    
    public function deleteHotelRoomAction($id)
    {
        $hotelRoom = $this->getDoctrine()
        ->getRepository('TripSiteManagementBundle:HotelRoom')
        ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        //$hotelRoom->$repository->findOneBy(array('id' => 'id'));
        $em->remove($hotelRoom);
        $em->flush();
        return new Response('true');
        //	return $this->redirect($this->generateUrl('room_hotel_search_hotel'));
    }
    
    
    public function deleteHotelImageAction($id)
    {
        $hotelRoom = $this->getDoctrine()
        ->getRepository('TripSiteManagementBundle:HotelImage')
        ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        //$hotelRoom->$repository->findOneBy(array('id' => 'id'));
        $em->remove($hotelRoom);
        $em->flush();
        return new Response('true');
        //return $this->redirect($this->generateUrl('room_hotel_search_hotel'));
    }
    
	/* public function editHotelAction(Request $request,$id){
    	$em = $this->getDoctrine()->getManager();
    	//$package = new Package();
    	$hotel =$em->getRepository('TripSiteManagementBundle:Hotel')->find($id);
    	 
    	$form   = $this->createEditHotelForm($hotel,$id);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    	    $hotel = $em->merge($hotel);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('trip_site_management_hotels_list'));
    
    	}
    
    	return $this->render('TripSiteManagementBundle:Default:editHotel.html.twig',array(
    	    'hotel' => $hotel,
    			'form'   => $form->createView(),
    	));
    } */
	private function createEditHotelForm($package,$id){
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new EditHotelType($bookingService), $package, array(
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
    /**
     *
     * @param SearchHotel $entity
     * @return unknown
     */
    private function createSearchHotelsForm(SearchHotel $entity,$hotelId,$roomId){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new SearchHotelType($bookingService), $entity, array(
            'action' => $this->generateUrl('trip_site_management_view_hotel',array('id'=>$hotelId)),
            'method' => 'GET',
        ));
        $form->add('submit', 'submit', array('label' => 'Submit'));
        
        return $form;
    }
	public function viewHotelAction(Request $request,$id)
    {
	    
        $em = $this->getDoctrine()->getManager();
        $hotel = $em->getRepository('TripSiteManagementBundle:Hotel')->find($id);
       $hotelId = $hotel->getId();
       $hotelPrice = $hotel->getPrice();
        $hotelRoom = $em->getRepository('TripSiteManagementBundle:HotelRoom')->findBy(array('hotel' => $id));
        foreach ($hotelRoom as $room){
           $roomPrice =  $room->getPrice();
           if($roomPrice == $hotelPrice){
               $roomId = $room->getId();
           }
        }
       //$roomId = 7;
        //var_dump($roomId);die;
        $session = $request->getSession();
        $rooms = $session->get('rooms');
        //var_dump($rooms);die;
        $hotels = array();
        $searchHotel = $session->get('searchHotel');
       // $searchHotel = new SearchHotel();
        $form   = $this->createSearchHotelsForm($searchHotel,$hotelId,$roomId);
        $form->handleRequest($request);
        //var_dump($searchHotel);exit();
        
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $session = $request->getSession();
            $goingTo = $searchHotel->getGoingTo();
            //echo var_dump($goingTo);
            //exit();
            $date = $searchHotel->getDate();
            $returnDate = $searchHotel->getReturnDate();
            
            $dateNew = date_create($date);
            $returnDateNew = date_create($returnDate);
            
            $numDay = 1;
           
            $today = new \DateTime();
            
            $numRoom = $searchHotel->getNumRooms();
            $qb = $em->getRepository ( 'TripBookingEngineBundle:HotelBooking' )->createQueryBuilder("HotelBooking");
            $qb ->select('HotelBooking.hotelId','count(HotelBooking.hotelId) as bookedroom')
            ->andWhere('(:date BETWEEN HotelBooking.chekIn AND HotelBooking.chekOut OR :returnDate BETWEEN HotelBooking.chekIn AND HotelBooking.chekOut)' ) ->setParameter('date', $date ) ->setParameter('returnDate', $returnDate)
            ->groupBy('HotelBooking.hotelId');
            $Booking_hotel = $qb->getQuery()->getResult();
            $roomCountByHotel = array();
            
            foreach ( $Booking_hotel as $bookedHotel ) {
                
                $roomCountByHotel[$bookedHotel['hotelId']]=$bookedHotel['bookedroom'];
                
            }
            //$dql3 = "SELECT h FROM TripSiteManagementBundle:Hotel h WHERE h.active=1 and h.cityId=$goingTo";
            $city = $em->getRepository('TripSiteManagementBundle:HotelCities')->findOneBy(array( 'id' => $goingTo));
            
            $catalogueService = $this->container->get( 'booking.services' );
            $hotels = $catalogueService->getHotelsByCity($searchHotel->getGoingTo());
            
            
            $amenities = $catalogueService->getAmenities();
            $filters = $catalogueService->getFilters($hotels,$amenities);
          
            $today = new \DateTime();
            $viewMore=0;
            $date1 = $searchHotel->getDate();
            $date2 = $searchHotel->getReturnDate();
            if($date1)
            
            {
                list ( $d, $m, $y ) = explode ( '/', $date1 );
                $date1 = new \Datetime($y.'-'.$m.'-'.$d);
                
            }
            if($date2)
            
            {
                list ( $d, $m, $y ) = explode ( '/', $date2 );
                $date2 = new \Datetime($y.'-'.$m.'-'.$d);
                
            }
            if($date1 == $date2){
                $date2->modify('+1 day');
                //var_dump($date2);
                //exit();
            }
            $dteDiff  = $date1->diff($date2);
            $numDay = $dteDiff->format("%d");
            $session->set('numDay',$numDay);
            $session->set('searchHotel',$searchHotel);
            return $this->redirect($this->generateUrl('trip_booking_engine_hotel_book_room',array('roomId'=>$roomId,'hotelId'=>$hotelId)));
        }
    	$em = $this->getDoctrine()->getManager();
    	//$hotel = $em->getRepository('TripSiteManagementBundle:Hotel')->find($id);
    	//var_dump($searchHotel);
    	//exit();
    	$hotel->getName();
    	$session = $request->getSession();
    	$session->set('hotelName',$hotel->getName());
    	$session->set('searchHotel',$searchHotel);
    	//var_dump($searchHotel);exit();
    	//$hotelRoom = $em->getRepository('TripSiteManagementBundle:HotelRoom')->findBy(array('hotel' => $id));
    	
    	$today = new \DateTime();
    	$viewMore=0;
    	$date1 = $searchHotel->getDate();
    	$date2 = $searchHotel->getReturnDate();
    	if($date1)
    	
    	{
    	    list ( $d, $m, $y ) = explode ( '/', $date1 );
    	    $date1 = new \Datetime($y.'-'.$m.'-'.$d);
    	    
    	}
    	if($date2)
    	
    	{
    	    list ( $d, $m, $y ) = explode ( '/', $date2 );
    	    $date2 = new \Datetime($y.'-'.$m.'-'.$d);
    	    
    	}
    	$dteDiff  = $date1->diff($date2); 
    	//$numDays = $dteDiff->format("%d")
    	//var_dump();exit();
    	//$paymentLink = $this->getVendorPaymentLink($request,$hotel,$vendorId);
    	return $this->render('TripSiteManagementBundle:Default:viewHotel.html.twig', array(
    			//'form'   => $form->createView(),
    	'hotel'=> $hotel,
    	    'hotelRoom' => $hotelRoom,
    	    'today' =>$today,
    	    'form'   => $form->createView(),
    	    'searchHotel'=>$searchHotel,
    	    'numDays'=>$dteDiff->format("%d"),
    	    'numDay' => $session->get('numDay'),
    	    'rooms'=>$rooms,
    	    
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
    
    private function createBillingForm(BillingDto $entity){
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
    	header ( 'Content-disposition: attachment; filename=billing.xls' );
    	//echo var_dump($view);
    	//exit();
    	return $view;
    }
    
	//*****************end**************************************//
	 //************Bikes *******************//
    public function bikesonRentAction(Request $request){
    	$em = $this->getDoctrine()->getManager();
    	$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
		$locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
    	$locations = $this->getLocationsByIndex($locations);
    	$id='22/01/2018 05:00 PM';
    	
    	$dql3 = "SELECT b.id from TripBookingEngineBundle:BikeBooking b where b.rdate= '$id' ";
    	$query = $em->createQuery($dql3);
    	$query -> execute();
    	$brdate = $query->getResult();
    	    	
    	//exit();
    	
    	$sysdate= new \DateTime('Asia/Kolkata');
    	//echo var_dump($sysdate);
    	//echo var_dump($bikes);
        
    	$session = $request->getSession();
    	$session->set('resultSet',$bikes);
    	$entity= new Biketime();
    	$entity->setId($entity->getId());
    	$entity->setDate($entity->getDate());
    	$entity->setReturndate($entity->getReturndate());
    	//$entity->setDate(new \DateTime());
    	$form   = $this->createviewbikesForm($entity);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$entity->setDate($entity->getDate());
    		$entity->setReturndate($entity->getReturndate());
    		$em->persist($entity);
    		$em->flush();
    		return $this->redirect($this->generateUrl('trip_site_management_review_viewbikes',array('id'=>$entity->getId())));
    	}
    	return $this->render('TripSiteManagementBundle:Default:bikesonRent.html.twig',array(
    			'bikes' => $bikes,
    	    //'bookrdate'=> $bookrdate,
    			'form'   => $form->createView(),
				'locations' => $locations,
    			
    	));
    }
    public function viewBikesAction(Request $request,$url){
    	$em = $this->getDoctrine()->getManager();
		$session = $request->getSession();
    	$bike = $em->getRepository('TripSiteManagementBundle:bikes')->findBy(array('locationUrl' => $url));
    	if($bike){
    		$bike= $bike[0];
    		$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll(array('locationUrl' => $url));
    	}else{
    		
    	}
		$session->set('bikeurl',$bike);
		
    	$entity= new Biketime();
    	$entity->setId($entity->getId());
    	//$entity->setPreferTime($entity->getPreferTime());
    	//$entity->setReturnTime($entity->getReturnTime());
    	$entity->setDate($entity->getDate());
    	$entity->setReturndate($entity->getReturndate());
    	//$entity->setDate(new \DateTime());
    	$form   = $this->createpriceviewbikesForm($entity,$url);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		//$preferTime = $entity->getPreferTime();
    		//$entity->setPreferTime($entity->getPreferTime());
    		//$entity->setReturnTime($entity->getReturnTime());
    		$entity->setDate($entity->getDate());
    		$entity->setReturndate($entity->getReturndate());
    		$em->persist($entity);
    		$em->flush();
    		return $this->redirect($this->generateUrl('trip_site_management_price_viewbikes',array('id'=>$entity->getId())));
    	}
    	
    	 
    	 return $this->render('TripSiteManagementBundle:Default:viewBikes.html.twig',array(
    			
    			'bike'=>$bike,
    			'bikes'=>$bikes,
    	 		'form'   => $form->createView(),
    	));
    	 
    }
    private function createviewbikesForm($entity)
    {
    	$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new biketimerangeType(), $entity, array(
    			'action' => $this->generateUrl('trip_site_management_bikes_on_rent'),
    			'method' => 'POST',
    	));
    	$form->add('submit', 'submit', array('label' => 'Search','attr'   =>  array('class'=>'search-bikes-onrent')));
    	return $form;
    }
    
    public function reviewViewbikesAction(Request $request,$id){
    	
    	$bookingService = $this->container->get( 'booking.services' );
    	$em = $this->getDoctrine()->getManager();
		$session = $request->getSession();
		
    	$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
    	
		//$session->set('bikes',$bikes);
		//$searchFilter->setUr($url);
		//$bike->setEmail($bikes->getUrl());
    	//$booking = $em->getRepository('TripBookingEngineBundle:Booking')->findOneByBookingId($id);
    	
    	//$customer = $em->getRepository('TripBookingEngineBundle:Customer')->find($booking->getCustomerId());
    	$booking = $em->getRepository('TripSiteManagementBundle:Biketime')->findOneById($id);
    	
		
    	//$locations = test;
    	//$locations = $this->getLocationsByIndex($locations);
    	$form   = $this->createEditReviewbikesForm($booking,$id);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$booking= $em->merge($booking);
    		$em->flush();
    		
    		return $this->redirect($this->generateUrl('trip_site_management_review_viewbikes',array('id'=>$booking->getId())));
    		
    	}
    	
    	return $this->render('TripSiteManagementBundle:Default:reviewViewbikes.html.twig',array(
    			//'customer'   => $customer,
    			'booking'=>$booking,
    			'bikes' => $bikes,
    			'form'   => $form->createView(),
    			//'locations'=>$locations,
    			//'services'=>$booking->getVehicleBooking(),
    	));
    }
    public function priceViewbikesAction(Request $request,$id){
    	
    	$bookingService = $this->container->get( 'booking.services' );
    	$em = $this->getDoctrine()->getManager();
		$session = $request->getSession();
		$bikeurl = $session->get('bikeurl');
		$url = $bikeurl->getLocationUrl();
		 //echo var_dump($bikeurl);
		 
		 //echo var_dump($url);
		//exit();
		
		//$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
    	//$bike = $em->getRepository('TripSiteManagementBundle:bikes')->findBy(array('locationUrl' => $url));
		$bike = $em->getRepository('TripSiteManagementBundle:bikes')->findBy(array('locationUrl' => $url));
    	if($bike){
    		$bike= $bike[0];
    		$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll(array('locationUrl' => $url));
    	}else{
    		
    	}
    	
    	$booking = $em->getRepository('TripSiteManagementBundle:Biketime')->findOneById($id);
    	
    	$form   = $this->createpriceviewbikesForm($booking,$id);
		
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		$booking= $em->merge($booking);
    		$em->flush();
    		 
    		return $this->redirect($this->generateUrl('trip_site_management_price_viewbikes',array('id'=>$booking->getId())));
    		
    	}
    	//echo var_dump($url);
		//exit();
    	return $this->render('TripSiteManagementBundle:Default:priceViewbikes.html.twig',array(
    			//'customer'   => $customer,
    			'booking'=>$booking,
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
    			'action' => $this->generateUrl('trip_site_management_view_bikes',array('url'=>$url)),
    			'method' => 'POST',
    	));
    	$form->add('submit', 'submit', array('label' => 'Search','attr'   =>  array('class'=>'search-bikes-onrent')));
    	return $form;
    }
    
    private function createEditReviewbikesForm($booking,$id){
    	//$bookingService = $this->container->get( 'booking.services' );
    	$form = $this->createForm(new biketimerangeType(), $booking, array(
    			'action' => $this->generateUrl('trip_site_management_review_viewbikes',array('id'=>$id)),
    			'method' => 'POST',
    	));
    	
    	$form->add('submit', 'submit', array('label' => 'Search','attr'   =>  array('class'=>'search-bike')));
    	
    	return $form;
    }
    private function createEditPricebikesForm($booking,$id){
    	//$bookingService = $this->container->get( 'booking.services' );
		
    	$form = $this->createForm(new PriceviewbikesType(), $booking, array(
    			'action' => $this->generateUrl('trip_site_management_price_viewbikes',array('id'=>$id)),
    			'method' => 'POST',
    	));
    	$form->add('submit', 'submit', array('label' => 'Search','attr'   =>  array('class'=>'search-bike')));
    	
    	return $form;
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
		//echo var_dump($countadd);
		//echo var_dump($id);
		$countinsert = $count-$countadd;
		//$session->set('countinsert',$countinsert);
		//echo var_dump($countinsert);
		 //exit();
		 
		/* $dql3 = "UPDATE TripSiteManagementBundle:bikes b SET b.count = '$countinsert' WHERE b.id = '$id' ";
		 $query = $em->createQuery($dql3);
		 $query -> execute();
		 */
		 return $this->redirect($this->generateUrl('trip_booking_engine_booking_bike',array('id'=>$id,'title'=>$title,'pDate'=>$pDate,'rDate'=>$rDate,'price'=>$price,'leftdays'=>$leftdays,'hours'=>$hours,'location'=>$location,'countinsert'=>$countinsert)));
			
    }
    //***************************************end****************************************//
	
	//***************************************Two Day Packages****************************************//
	public function twodaypackagesAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $url = 'two' ;
       // $packagetitle = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findAll();
		$packagetitle = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findBy(array('type' => $url));
		
        
        $session = $request->getSession();
        $session->set('resultSet',$packagetitle);
        return $this->render('TripSiteManagementBundle:Default:twodaypackages.html.twig',array(
    			'packagetitle' => $packagetitle,
                
    	));
    }
    public function twospecialPackagesAction(Request $request,$url){
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
             $active = '1';
             $packages = $em->getRepository('TripSiteManagementBundle:Package')->findBy(array('category' => $id,'active' => $active));
             $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
             $locations = $this->getLocationsByIndex($locations);
             $session = $request->getSession();
             $session->set('resultSet',$packages);
             $session->set('locations',$locations);
             $type = 'two' ;
             
             //$packages = new package();
             //$packagetestid = $packages->getId();
            // echo var_dump( $packages);
             //$starttwoday= $em->getRepository('TripSiteManagementBundle:TwoStartPoint')->findBy(array('packageTitleId' => $id));
             //echo var_dump( $starttwoday);
             //exit();
             $packagetitles = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findBy(array('type' => $type));
             $packagetitlecontents = $em->getRepository('TripSiteManagementBundle:PackageTitleContent')->findBy(array('packageTitleId' => $id));
             $packagetitlelist = $em->getRepository('TripSiteManagementBundle:PackageTitleList')->findBy(array('packageTitleId' => $id));
             return $this->render('TripSiteManagementBundle:Default:twospecialPackages.html.twig',array(
                 'packages' => $packages,
                 'locations' => $locations,
                 'packagetitle'=>$packagetitle,
                 'packagetitles'=>$packagetitles,
                 'packagetitlecontents'=>$packagetitlecontents,
                 'packagetitlelist'=>$packagetitlelist,
                 //'starttwoday' => $starttwoday,
             ));
         }else{
             
         }
         
         
    }
    public function addMultiPackageAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $package = new PackageTitle();
        //$package =$em->getRepository('TripSiteManagementBundle:PackageTitle')->find($id);
        $packageImages = $package->getImgPath();
       // $packageImages->add($packageImage);
        
        $form   = $this->createAddMultiPackageForm($package);
        $form->handleRequest($request);
        if ($form->isValid()) {
           
            
            $packageImageList =$package->getImgPath();
            $packageImages =$package->getImgPath();
            
            //echo var_dump($packageImages);
            // exit();
            if (!is_null($packageImages)) {
                $file_name = $packageImages->getClientOriginalName ();
                $dir = 'images/package-titles/';
                $packageImages->move ( $dir, $file_name );
                $package->setImgPath ($file_name );
                // $packageImage->setImgPath($package);
                // echo var_dump($packageImage);
                //exit();
                // $packageImages->add($packageImage);
                
            }
            $package = $em->merge($package);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_site_management_add_multipackage'));
            
        }
        
        return $this->render('TripSiteManagementBundle:Default:addmultiPackage.html.twig',array(
            //'package' => $package,
            'form'   => $form->createView(),
        ));
    }
    private function createAddMultiPackageForm(PackageTitle $package){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new AddMultiPackageTitleType(), $package, array(
            'action' => $this->generateUrl('trip_site_management_add_multipackage'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'submit'));
        
        return $form;
    }
    public function addtwodayPackageLocationsAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $package =$em->getRepository('TripSiteManagementBundle:Package')->findAll();
        $city =$em->getRepository('TripSiteManagementBundle:City')->findAll();
        //$cat = $request->get('cat');
        //$packagecode =$em->getRepository('TripSiteManagementBundle:Package')->findAll);
        //echo var_dump($packagecode);
       
        $packagelocationstwo = new TwodayPackageLocations();
        $packageprice = new PackagePrice();
        $form1   = $this->createAddPackagePriceForm($packageprice);
        $form1 ->handleRequest($request);
        if ($form1->isValid()) {
            
            $packageId= $packageprice->getPackage();
            $package =$em->getRepository('TripSiteManagementBundle:Package')->find($packageId);
            $VehicleId= $packageprice->getVehicleId();
            $vehicle =$em->getRepository('TripBookingEngineBundle:Vehicle')->find($VehicleId);
            $packageprice->setName($vehicle->getModel());
            $packageprice->setPackage($package);
            $em->persist($packageprice);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_site_management_add_twoday_packagelocations')); 
            
        }
       
        $form   = $this->createStratpointForm($packagelocationstwo);
        $form ->handleRequest($request);
        if ($form->isValid()) {
            $type=$packagelocationstwo->getType();
            switch ($type) {
                case 'PickUp':
                    $startpoint = new StartPoint();
                    //$package->getStartPoint($startpoint);
                    $packageId= $packagelocationstwo->getPackage();
                    $package =$em->getRepository('TripSiteManagementBundle:Package')->find($packageId);
                    $startpoint->setName($packagelocationstwo->getLocation());
                    $startpoint->setBooking($package);
                    $em->persist($startpoint);
                    break;
                case 'FirstDay':
                    $startpoint = new EndPoint();
                    // $package->setStartPoint($startpoint);
                    $packageId= $packagelocationstwo->getPackage();
                    $package =$em->getRepository('TripSiteManagementBundle:Package')->find($packageId);
                    $startpoint->setName($packagelocationstwo->getLocation());
                    $startpoint->setBooking($package);
                    $em->persist($startpoint);
                    break;
                case 'SecondDay':
                    $startpoint = new EndPoint2();
                    // $package->setStartPoint($startpoint);
                    $packageId= $packagelocationstwo->getPackage();
                    $package =$em->getRepository('TripSiteManagementBundle:Package')->find($packageId);
                    $startpoint->setName($packagelocationstwo->getLocation());
                    $startpoint->setBooking($package);
                    $em->persist($startpoint);
                    break;
                case 'TwoPickUp':
                    $startpoint = new TwoStartPoint();
                    // $package->setStartPoint($startpoint);
                    $packageId= $packagelocationstwo->getPackage();
                    $package =$em->getRepository('TripSiteManagementBundle:Package')->find($packageId);
                    $startpoint->setName($packagelocationstwo->getLocation());
                    $startpoint->setBooking($package);
                    $em->persist($startpoint);
                    break;
                case 'TwoFirstDay':
                    $startpoint = new TwoEndPoint();
                    // $package->setStartPoint($startpoint);
                    $packageId= $packagelocationstwo->getPackage();
                    $package =$em->getRepository('TripSiteManagementBundle:Package')->find($packageId);
                    $startpoint->setName($packagelocationstwo->getLocation());
                    $startpoint->setBooking($package);
                    $em->persist($startpoint);
                    break;
                case 'TwoSecondDay':
                    $startpoint = new TwoEndPoint2();
                    // $package->setStartPoint($startpoint);
                    $packageId= $packagelocationstwo->getPackage();
                    $package =$em->getRepository('TripSiteManagementBundle:Package')->find($packageId);
                    $startpoint->setName($packagelocationstwo->getLocation());
                    $startpoint->setBooking($package);
                    $em->persist($startpoint);
                    break;
            }
            //$startpoint = new StartPoint();
            //$startpoint->setName($pickup);
            //$startpoint->setBooking($cat);
            
            //echo var_dump($package);
            //exit();
            
            $em->flush(); 
            
            return $this->redirect($this->generateUrl('trip_site_management_add_twoday_packagelocations'));
            
        }
        
        return $this->render('TripSiteManagementBundle:Default:addtwodayPackagelocations.html.twig',array(
            'package' => $package,
           // 'packagecode' => $packagecode,
            'city' => $city,
            //'ptype' => $ptype,
            'form'   => $form->createView(),
            'form1'   => $form1->createView(),
        ));
    }
    public function packagedetailsSubmitAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        
        $cat = $request->get('cat');
        //echo var_dump($cat);
        $pickup = $request->get('pickup');
       // $placestovisit = $request->get('placestovisit');
        //$drop = $request->get('drop');
        $id = $request->get('id');
       
        //echo var_dump($pickup);
        //echo var_dump($id);
        //exit();
      
        return $this->redirect($this->generateUrl('trip_site_management_add_twoday_packagelocations',array('cat'=>$cat)));
        
    }
    

    private function createStratpointForm(TwodayPackageLocations $entity){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new TwodayPackageLocationsType($bookingService), $entity, array(
            'action' => $this->generateUrl('trip_site_management_add_twoday_packagelocations'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Submit','attr'   =>  array('class'=>'search-bike')));
        return $form;
    }
    
   
    public function addpackagedetailsAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        //$session = $request->getSession();
        $cat = $request->get('cat');
        //echo var_dump($cat);
        $package =$em->getRepository('TripSiteManagementBundle:Package')->findBy(array('id' => $cat));
         //$package = new package();
        // $id= $package->getId();
         //echo var_dump($package);
        //exit();
        
        return $this->redirect($this->generateUrl('trip_site_management_homepage_addPackage_details'));
        
        
    }
    
   
    public function addPackagecatAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id = 10;
        $packagetitle =$em->getRepository('TripSiteManagementBundle:PackageTitle')->findAll();
        
       // $title= $packagetitle->getTitle();
        //echo var_dump($title);
        // exit();   
        
        return $this->render('TripSiteManagementBundle:Default:addPackagecat.html.twig',array(
            'packagetitle' => $packagetitle,
            //'form'   => $form->createView(),
        ));
    }
    public function catpackageSubmitAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $cat = $request->get('cat');
         //echo var_dump($cat);
         //echo var_dump($id);
       // exit();
        
        return $this->redirect($this->generateUrl('trip_site_management_add_package',array('cat'=>$cat)));
        
    }
    public function editBikesAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        //$package = new Package();
        $package =$em->getRepository('TripSiteManagementBundle:bikes')->find($id);
        
        $form   = $this->createEditBikesForm($package,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $package = $em->merge($package);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_bikes_list'));
            
        }
        
        return $this->render('TripSiteManagementBundle:Default:editBikes.html.twig',array(
            'package' => $package,
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
        return $this->render('TripSiteManagementBundle:Default:bikesList.html.twig',array(
            'multipackageList' => $multipackageList,
        ));
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
        
        return $this->render('TripSiteManagementBundle:Default:addbike.html.twig',array(
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
	//***************************************end****************************************//
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
        $url= 'one';
        //$packagetitle = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findAll();
        $packagetitle = $em->getRepository('TripSiteManagementBundle:PackageTitle')->findBy(array('type' => $url));
        
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
  
    public function confirmRoomAction(Request $request)
    {
        
        return $this->render('TripSiteManagementBundle:Default:bookRoom.html.twig');
    }
    /**
     *
     * @param SearchHotel $entity
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
    /**
     *
     * @param SearchHotelAgain $entity
     * @return unknown
     */
    private function createSearchHotelAgainForm(SearchHotelAgain $entity,$id){
        //$bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new SearchHotelAgainType(), $entity, array(
            'action' => $this->generateUrl('trip_site_management_view_hotel',array('id' => $id)),
            'method' => 'GET',
        ));
        
        return $form;
    }
}