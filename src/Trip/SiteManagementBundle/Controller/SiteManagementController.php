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
