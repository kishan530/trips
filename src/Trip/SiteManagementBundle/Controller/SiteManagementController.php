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
use Trip\SiteManagementBundle\DTO\Billing as NewBilling;
use Trip\SiteManagementBundle\Form\InsertImageType;
use Trip\SiteManagementBundle\Entity\InsertImage;
use Trip\SiteManagementBundle\Entity\bikespackage;
use Trip\SiteManagementBundle\Form\EditBikesPackageType;
use Trip\SiteManagementBundle\Form\EditPackagePriceType;
use Trip\SiteManagementBundle\Form\EditPickuplocationType;
use Trip\SiteManagementBundle\Form\EditPlacetovisitlocationType;
use Trip\SiteManagementBundle\Form\EditDroplocationType;
use Trip\SiteManagementBundle\Form\PackageImageType;
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
       // echo var_dump($selected);
         // die();
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
        $type = $selectedService->getType();
        return $this->redirect($this->generateUrl('trip_booking_engine_book', array('selected' => $selected,'package'=>$code,'type'=>$type)));
        
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
        
        $packageprice =$em->getRepository('TripSiteManagementBundle:PackagePrice')->findBy(array('package' => $id));
        $pickuplocation =$em->getRepository('TripSiteManagementBundle:StartPoint')->findBy(array('booking' => $id));
        $placetovisitlocation =$em->getRepository('TripSiteManagementBundle:EndPoint')->findBy(array('booking' => $id));
        $droplocation =$em->getRepository('TripSiteManagementBundle:EndPoint2')->findBy(array('booking' => $id));
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        
        $packagepriceList = $package->getPrice();
        
        $collection = new ArrayCollection();
        $collection1 = new ArrayCollection();
        
        $package = $this->packageToPackage($package);
        
        $itinerary = new PackageItinerary();
        $collection->add($itinerary);
        $itineraryList = $package->getItinerary();
        $package->setItineraryList($collection);
        
        $images = new PackageImages();
        $collection1 = $package->getImageList();
        $collection1->add($images);
        $imageCollection =$package->getImages();
        
        $content = new PackageContent();
        $contentList = $package->getContentList();
        $contentList->add($content);
        $contentCollection = $package->getContent();
        
        
        
        $form   = $this->createEditPackageForm($package,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            
            $collection = $package->getItineraryList();
            $itineraryCollection = new ArrayCollection();
            
            foreach($collection as $itinerary){
                if(!is_null($itinerary->getTitle()) or !is_null($itinerary->getDescription())){
                    $itineraryCollection->add($itinerary);
                }
            }
            $package->setItinerary($itineraryCollection);
            
            
            
            
            $collection1 = $package->getImageList();
            $imageCollection = new ArrayCollection();
            
            foreach($collection1 as $images){
                $uploadedfile = $images->getUrl();
                    if (!is_null($uploadedfile)) {
                    $file_name = $uploadedfile->getClientOriginalName ();
                    $dir = 'images/packages/';
                    $uploadedfile->move ( $dir, $file_name );
                    $images->setUrl ($file_name );
                    $images->setPackage($package);
                    $imageCollection->add($images);
                    
                    
                }
            }
            $package->setImages($imageCollection);
            
            
            $contentList = $package->getContentList();
            $contentCollection = new ArrayCollection();
            foreach($contentList as $content){
                
                
                if(!is_null($content->getTitle()) or !is_null($content->getDescription())){
                    $content->setActive(1);
                    $contentCollection->add($content);
                }
              }
            
            $package->getContent()->clear();
            $package->setContent($contentCollection);
            
            
            
            
            
            $package = $em->merge($package);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_package_list'));
            
        }
        
        
        
        return $this->render('TripSiteManagementBundle:Default:editPackage.html.twig',array(
            'package' => $package,
            'Images' => $packageImg,
            'itineraryList'=>$itineraryList,
            'contentList'=>$contentCollection,
            'imageList' => $imageCollection,
            'form' => $form->createView(),
            'packageprice'=> $packageprice,
            'pickuplocation' => $pickuplocation,
            'placetovisitlocation' => $placetovisitlocation,
            'droplocation' => $droplocation,
            'locations' => $locations,
            //'formupload'   => $formupload->createView(),
        ));
    }
    public function deletePackageImage($id)
    {
        $hotel = $this->getDoctrine()
        ->getRepository('TripSiteManagementBundle:Package')
        ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($hotel);
        $em->flush();
        return new Response('true');
        //return $this->redirect($this->generateUrl('room_hotel_search_hotel'));
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
    	$packageImages = $package->getImgPath();
    	 
    	$form   = $this->createEditMultiPackageForm($package,$id);
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
    
    public function bikesonRentBasedonlocationAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $security = $this->container->get ( 'security.context' );
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);
        $geturl=$uri_segments[4];
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
        return $this->render('TripSiteManagementBundle:Default:bikesonRentBasedonloc.html.twig',array(
            'bikes' => $bikes,
            //'form'   => $form->createView(),
            'locations' => $locations,
            'bikeslocbase' => $bikeslocbase,
            
            
        ));
    }
    
    public function homebannersearchAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
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
        ));
        
        
    }
    //****************************************************jagadeesh*************************************************//
    
    public function bikepackagesAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        //$bikespackage = $em->getRepository('TripSiteManagementBundle:bikespackage')->findAll();
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        
        
        $sysdate= new \DateTime('Asia/Kolkata');
        
        $session = $request->getSession();
        $session->set('resultSet',$bikes);
        //$session->set('resultSet',$bikespackage);
        $entity= new Biketime();
        $entity->setId($entity->getId());
        $entity->setDate($entity->getDate());
        $entity->setReturndate($entity->getReturndate());
        //$entity->setDate(new \DateTime());
        $form   = $this->createbikepackageForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $entity->setDate($entity->getDate());
            $entity->setReturndate($entity->getReturndate());
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_site_management_bike_package_result',array('id'=>$entity->getId())));
        }
        return $this->render('TripSiteManagementBundle:Default:bikepackages.html.twig',array(
            'bikes' => $bikes,
            //'bikepackage'=>$bikespackage,
            //'bookrdate'=> $bookrdate,
            'form'   => $form->createView(),
            'locations' => $locations,
            
        ));
    }
    
    
    public function bikepackagesBasedonlocationAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $security = $this->container->get ( 'security.context' );
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);
        $geturl=$uri_segments[4];
        
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
    
 //******************************************bikepackage***********************************************************//   
    
    public function bikepackageresultAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $id = $request->get('id');
        $packageprice = $request->get('packageprice');
        $Kmlimit = $request->get('Kmlimit');
        $packagetitle =$request->get('packagename');
        $title =$request->get('title');
        $packageoffer= $request->get('packageoffer');
        
        $location= $request->get('location');
        $bike = $em->getRepository('TripSiteManagementBundle:bikes')->findBy(array('id' => $id));
        
        if($bike){
            $bike= $bike[0];
            $bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll(array('id' => $id));
        }else{
            
        }
        
        
        $session = $request->getSession();
        $packagebikemainloc = $session->get('bikemainloc');
        $packagefilterloc=$request->get('check_list_loc_package');
        $session->set('filterloc',$packagefilterloc);
        $packagefilterbikes=$request->get('check_list_bikes_package');
        $session->set('filterbikes',$packagefilterbikes);
        
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
        $leftDays = $difference->d;
        $hours = $difference->h;
        
        $dayrent=$bike->getDayrent();
        $statingPrice=$bike->getStatingPrice();
        $packageofferprice=$packageoffer/100;
        
        
        
        
        
        $result=$this->getResultbybikesPackage($request,$id);
        $resultset=$this->getPackageResultbybikescal($result,$leftDays,$hours);
        
        
        $result=$this->getPackageResultbybikespackage();
        $resultset1=$this->getPackageResultbybikescal($result,$leftDays,$hours);
        
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
    
    
    public function getPackageResultbybikescal($result,$leftDays,$hours){
        
        
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
            $bike['packageoffer']=$row['packageoffer'];
            
            if ($hours==0){
                
                if ($leftDays<7){
                    $dayrent= $bike['dayrent'];
                    $finalprice=$dayrent*$leftDays;
                    
                }
                else{
                    $dayrent= $bike['dayrent'];
                    $price=$dayrent*$leftDays;
                    $packageoffer= $bike['packageoffer'];
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
                        $packageoffer= $bike['packageoffer'];
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
                            $packageoffer= $bike['packageoffer'];
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
                            $packageoffer= $bike['packageoffer'];
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
    
    
    
    //*************************************************jagadeesh new***************************************//
    
    
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
    
    //****************************************************************package**************************************//
    
    public function editPackagePriceAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        //$package = new Package();
        $priceContent =$em->getRepository('TripSiteManagementBundle:PackagePrice')->find($id);
        
        $form   = $this->createditPackagePriceForm($priceContent,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $priceContent = $em->merge($priceContent);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_package_list'));
            
        }
        
        return $this->render('TripSiteManagementBundle:Default:editpackagePrice.html.twig',array(
            'priceContent' => $priceContent,
            'form'   => $form->createView(),
        ));
    }
    
    
    private function createditPackagePriceForm($priceContent,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new EditPackagePriceType(), $priceContent, array(
            'action' => $this->generateUrl('trip_site_management_edit_package_Price',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    
    
    
    public function deletePackagePriceAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        
        $priceContent = $em->getRepository('TripSiteManagementBundle:PackagePrice')->find($id);
        
        $em->remove ( $priceContent );
        $em->flush();
        
        return new Response ( "true" );
        
    }
    
    //****************************************location******************************//
   
    public function editpickuplocationAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        //$package = new Package();
        $StartPoint =$em->getRepository('TripSiteManagementBundle:StartPoint')->find($id);
        
        $form   = $this->createditpickuplocationForm($StartPoint,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $StartPoint = $em->merge($StartPoint);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_package_list'));
            
        }
        
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        
        return $this->render('TripSiteManagementBundle:Default:editpickuplocation.html.twig',array(
            'StartPoint' => $StartPoint,
            'locations' => $locations,
            'form'   => $form->createView(),
        ));
    }
    
    
    private function createditpickuplocationForm($StartPoint,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new EditPickuplocationType($bookingService), $StartPoint, array(
            'action' => $this->generateUrl('trip_site_management_edit_pickup_location',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    
    
    
    public function deletepickuplocationAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        
        $StartPoint = $em->getRepository('TripSiteManagementBundle:StartPoint')->find($id);
        
        $em->remove ( $StartPoint );
        $em->flush();
        
        return new Response ( "true" );
        
    }
    
    
    
    public function editplacetovisitlocationAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        //$package = new Package();
        $EndPoint =$em->getRepository('TripSiteManagementBundle:EndPoint')->find($id);
        
        $form   = $this->createditplacetovisitlocationForm($EndPoint,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $EndPoint = $em->merge($EndPoint);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_package_list'));
            
        }
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        
        return $this->render('TripSiteManagementBundle:Default:editplacetovisitlocation.html.twig',array(
            'EndPoint' => $EndPoint,
            'locations' => $locations,
            'form'   => $form->createView(),
        ));
    }
    
    
    private function createditplacetovisitlocationForm($EndPoint,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new EditPlacetovisitlocationType($bookingService), $EndPoint, array(
            'action' => $this->generateUrl('trip_site_management_edit_placetovisit_location',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    
    
    
    public function deleteplacetovisitlocationAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        
        $EndPoint = $em->getRepository('TripSiteManagementBundle:EndPoint')->find($id);
        
        $em->remove ( $EndPoint );
        $em->flush();
        
        return new Response ( "true" );
        
    }
    
    
    
    public function editdroplocationAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        //$package = new Package();
        $EndPoint2 =$em->getRepository('TripSiteManagementBundle:EndPoint2')->find($id);
        
        $form   = $this->createditdroplocationForm($EndPoint2,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $EndPoint2 = $em->merge($EndPoint2);
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_site_management_package_list'));
            
        }
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        
        return $this->render('TripSiteManagementBundle:Default:editdroplocation.html.twig',array(
            'EndPoint2' => $EndPoint2,
            'locations' => $locations,
            'form'   => $form->createView(),
        ));
    }
    
    
    private function createditdroplocationForm($EndPoint2,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $form = $this->createForm(new EditDroplocationType($bookingService), $EndPoint2, array(
            'action' => $this->generateUrl('trip_site_management_edit_drop_location',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    
    
    
    public function deletedroplocationAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        
        $EndPoint2 = $em->getRepository('TripSiteManagementBundle:EndPoint2')->find($id);
        
        $em->remove ( $EndPoint2 );
        $em->flush();
        
        return new Response ( "true" );
        
    }
    
    
    //**********************************************************jagadeeshnew**************************************************//
    
    
    
    public function deletepackageimageAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        
        $package = $em->getRepository('TripSiteManagementBundle:PackageImages')->find($id);
        
        $em->remove ( $package );
        $em->flush();
        
        return new Response ( "true" );
        
    }
    
    //****************************************************add package****************************************//
    
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
    
    
    //*******************************************************jagadeesh*******************************************************//
    
    
    public function viewBikesAction(Request $request,$url){
    	$em = $this->getDoctrine()->getManager();
		$session = $request->getSession();
		//$bikemainloc = $session->get('bikemainloc');
		
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
    	 return $this->render('TripSiteManagementBundle:Default:viewBikes.html.twig',array(
    			
    			'bike'=>$bike,
    			'bikes'=>$bikes,
    	 		'form'   => $form->createView(),
    	     'bikecity' => $bikecity,
    	     'locations' => $locations,
    	     //'bikemainloc' => $bikemainloc,
    	     'bikeurl' => $bikeurl,
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

	   $filtermainloc=$request->get('filtermainloc');
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
	       
	       $bikemainloc = $session->get('bikemainloc');
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
    	    $leftDays = $difference->d;
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
    		    'location' => $bikemainloc,
    		    'bikeslocbase' => $bikeslocbase,
    		    'filterloc' => $filterloc,
    		    
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
        from TripSiteManagementBundle:bikes b
         where b.active=1";
        
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
		$filtermainloc=$request->get('filtermainloc');
		
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
    	    $leftDays = $difference->d;
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
		return $this->redirect($this->generateUrl('trip_booking_engine_booking_bike',array('id'=>$id,'title'=>$title,'pDate'=>$pDate,'rDate'=>$rDate,'price'=>$price,'leftdays'=>$leftdays,'hours'=>$hours,'location'=>$location,'countinsert'=>$countinsert,'bikearea'=>$bikearea)));
			
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
    public function  viewtwodayPackageAction(Request $request,$url){
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
        
        
        return $this->render('TripSiteManagementBundle:Default:viewtwodayPackage.html.twig',array(
            'package' => $package,
            'error'=>$error,
            'location'=>$location,
            'locations'=>$locations
            
        ));
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
}