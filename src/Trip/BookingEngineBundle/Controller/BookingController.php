<?php

namespace Trip\BookingEngineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Trip\BookingEngineBundle\Form\SearchType;
use Trip\BookingEngineBundle\DTO\SearchFilter;
use Trip\BookingEngineBundle\Form\SearchHotelType;
use Trip\BookingEngineBundle\Form\SearchHotelAgainType;
use Trip\BookingEngineBundle\DTO\SearchHotel;
use Trip\BookingEngineBundle\DTO\SearchHotelAgain;
use Trip\BookingEngineBundle\Entity\Customer;
use Trip\BookingEngineBundle\DTO\Customer as CustomerDto;
use Trip\BookingEngineBundle\DTO\NewPackage;
use Trip\BookingEngineBundle\Entity\Booking;
use Trip\BookingEngineBundle\Entity\Pickup;
use Trip\BookingEngineBundle\Entity\Drop;
use Trip\BookingEngineBundle\Entity\PlacesToVisit;
use Trip\BookingEngineBundle\Entity\VehicleBooking;
use Trip\BookingEngineBundle\Entity\HotelBooking;
use Trip\BookingEngineBundle\Entity\BikeBooking;
use Trip\BookingEngineBundle\Entity\Billing;
use Trip\BookingEngineBundle\Form\CustomerType;
use Trip\BookingEngineBundle\Form\BillingType;
use Trip\BookingEngineBundle\Form\EditCustomerType;
use Trip\BookingEngineBundle\Form\NewPackageType;
use Trip\BookingEngineBundle\Form\GuestType;
use Trip\BookingEngineBundle\Form\CustomPackageType;
use Trip\SiteManagementBundle\Entity\Contact;
use Trip\SiteManagementBundle\Form\ContactType;
use Trip\BookingEngineBundle\DependencyInjection\Instamojo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Trip\BookingEngineBundle\Entity\TestCustomer;
use Trip\BookingEngineBundle\Entity\Vendor;
use Trip\BookingEngineBundle\Entity\VendorLogin;
use Trip\BookingEngineBundle\Entity\VendorDriver;
use Trip\BookingEngineBundle\Entity\VendorVehicles;
use Trip\BookingEngineBundle\DTO\TestCustomer as TestCustomerDto;
use Trip\BookingEngineBundle\DTO\Vendor as VendorDto;
use Trip\BookingEngineBundle\DTO\TestNewPackage;
use Trip\BookingEngineBundle\DTO\VendorVehicles as VendorVehiclesDto;
use Trip\BookingEngineBundle\DTO\VendorDriver as VendorDriverDto;
use Trip\BookingEngineBundle\Form\VendorLoginType;
use Trip\BookingEngineBundle\Form\VendorRegistraionType;
use Trip\BookingEngineBundle\Form\TestCustomPackageType;
use Trip\BookingEngineBundle\Form\TestNewPackageType;
use Trip\SiteManagementBundle\Entity\BillingPlacesToVisit;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Trip\BookingEngineBundle\Form\VendorNewVehicleType;
use Trip\BookingEngineBundle\Form\VendorNewDriverType;
use Trip\BookingEngineBundle\Entity\VendorVehicleFee;
use Trip\BookingEngineBundle\Entity\HotelCustomer;
use Trip\BookingEngineBundle\Form\HotelCustomerType;
use Trip\BookingEngineBundle\Entity\HotelRoomBooking;
use Trip\BookingEngineBundle\Form\HotelBookingType;
use Trip\BookingEngineBundle\Form\HotelFilterType;
use Trip\BookingEngineBundle\DTO\Room;

class BookingController extends Controller
{
    
    
    /**
     *
     * @param Search $entity
     * @return unknown
     */
    private function createSearchForm(SearchFilter $entity){
        //this is test
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
    public function indexAction(Request $request){
        //$mailService = $this->container->get( 'mail.services' );
        //$mailService->mail('kishan.kish530@gmail.com','Just Trip:Booking Confirmation','this is test');
        $security = $this->container->get ( 'security.context' );
        if ($security->isGranted ( 'ROLE_ADMIN' )){
            return $this->redirect ( $this->generateUrl ( "trip_site_management_billing_list" ) );
        }
        return $this->getHome('TripSiteManagementBundle:Default:index.html.twig',$request);
    }
    /**
     *
     */
    public function hotelsAction(Request $request){
        return $this->getHome('TripSiteManagementBundle:Default:hotels.html.twig',$request);
    }
    
    public function dealsAction(){
        return $this->getHome('TripSiteManagementBundle:Default:deals.html.twig');
        
        //test
    }
    /**
     *
     */
    private function getHome($view ,$request){
        
        $searchFilter = new SearchFilter();
        $form   = $this->createSearchForm($searchFilter);
        $searchHotel = new SearchHotel();
        $hotelForm   = $this->createSearchHotelForm($searchHotel);
        //echo 'hi';
        //exit();
        //$search = new SearchHotel();
        $searchHotel->setNumAdult(1);
        $searchHotel->setNumRooms(1);
        $rooms = new ArrayCollection();
        $room = new Room;
        $room->setNumAdult(1);
        $room->setNumChildren(0);
        $rooms->add($room);
        $session = $request->getSession();
        //$rooms = $session->get('rooms');
        //echo var_dump($rooms);
        //exit();
        $session->set('rooms',$rooms);  
       // var_dump($searchHotel);exit();
        return $this->render($view, array(
            'form'   => $form->createView(),
            'hotelForm'   => $hotelForm->createView(),
            'search' =>$searchHotel,
            'rooms' =>$rooms,
        ));
    }
    /**
     *
     */
    public function addRoomAction(Request $request){
       // 
        $session = $request->getSession();
        $rooms = $session->get('rooms');
        $adults = (int) $request->get('adults');
        $child = (int) $request->get('child');
       // var_dump($child);exit();
        $room = new Room;
        $room->setNumAdult($adults);
        $room->setNumChildren($child);
        $rooms->add($room);
        //return new Response('true');
        return $this->render('TripBookingEngineBundle:Default:add-more.html.twig', array(
            'rooms'=>$rooms
        ));
    }
    
    public function updateRommsAction(Request $request){
        $session = $request->getSession();
        $rooms = $session->get('rooms');
        $adults = (int) $request->get('adults');
        $child = (int) $request->get('child');
        //var_dump($child);die;
        //$room = new Room;
        //$room->setNumAdult($adults);
        //$room->setNumChildren($child);
        //$rooms->add($room);
        //return new Response('true');
        return $this->render('TripBookingEngineBundle:Default:add-more.html.twig', array(
            'rooms'=>$rooms
        ));
    }
    
    public function addAdultsAction(Request $request){
        //var_dump($request);
        
        $session = $request->getSession();
        $rooms = $session->get('rooms');
        $adults = (int) $request->get('adults');
        $key = (int) $request->get('key');
        $room = $rooms->get($key);
        if($room){
            $room->setNumAdult($adults);
            return new Response('true');
        }else{
            
            return new Response('false');
        }
        
    }
    
    public function addChildsAction(Request $request){
        //var_dump($request);
        
        $session = $request->getSession();
        $rooms = $session->get('rooms');
        $child = (int) $request->get('child');
        $key = (int) $request->get('key');
        $room = $rooms->get($key);
        if($room){
            $room->setNumChildren($child);
            return new Response('true');
        }else{
            
            return new Response('false');
        }
        
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
            $noData = 0;
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
            }elseif($tripType=="dailyRent"){
                $goingFrom = $searchFilter->getLeavingFrom();
                $goingTo = $searchFilter->getGoingTo();
                $noDays =0;
                if(!is_null($returnDate)){
                    $interval = $returnDate->diff($date);
                    $noDays = $interval->d;
                }
                $resultSet = $this->getVehicles($goingFrom,$goingTo);
                $resultSet = $this->getDailyRent($resultSet,$noDays);
            }else{
                $goingFrom = $searchFilter->getLeavingFrom();
                $goingTo = $searchFilter->getGoingTo();
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
            // echo var_dump($searchFilter);
            //echo var_dump($resultSet);
            //exit();
            $errors = array();
            if(($tripType=="roundtrip")&&($returnDate<$date)){
                $resultSet = array();
                // $errors[] = '';
                
            }
            $searchFilter->setTripType($tripType);
            $searchFilter->setNumDays($noDays);
            $session->set('selectedData',$searchFilter);
            $session->set('resultSet',$resultSet);
            
            
            
            $contact = new Contact();
            $contactForm   = $this->createContactForm($contact);
            
            return $this->render('TripBookingEngineBundle:Default:search.html.twig', array(
                'form'   => $form->createView(),
                'contactForm'   => $contactForm->createView(),
                'result'=>$resultSet,
                'tripType'=>$tripType,
            ));
            
        }
        return $this->render('TripSiteManagementBundle:Default:index.html.twig', array(
            'form'   => $form->createView(),
        ));
        
    }
    public function getVehicles($goingFrom,$goingTo){
        $dql3 = "SELECT v.id,v.imgPath, v.model,v.capcity,v.price vPrice,v.mileage,v.dailyRent, c1.name lFrom,c2.name to FROM TripBookingEngineBundle:Vehicle v, TripSiteManagementBundle:city c1,TripSiteManagementBundle:city c2 WHERE v.active=1 and c1.id=$goingFrom and c2.id=$goingTo";
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql3);
        $result = $query->getResult();
        return $result;
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
        $dql3 = "SELECT v.id,v.imgPath, v.model,v.capcity,v.price vPrice,v.extraPrice,v.mileage, s.price,$price, s.multiPrice, $fromAndTo FROM TripBookingEngineBundle:Vehicle v, TripBookingEngineBundle:Services s,TripSiteManagementBundle:city c1,TripSiteManagementBundle:city c2 WHERE s.leavingFrom=c1.id and s.goingTo=c2.id and s.vehicleId=v.id and v.active=1 and s.leavingFrom=$goingFrom and s.goingTo=$goingTo";
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
            $car['vPrice']=$row['vPrice'];
            $kms = 300*$numdays;
            $car['kms']=$kms;
            $car['price']=$row['vPrice']*$kms;
            $car['lFrom']=$row['lFrom'];
            $car['to']=$row['to'];
            $car['mileage']=$row['mileage'];
            
            $tempCollection[$row['id']]=$car;
        }
        return $tempCollection;
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
        $session = $request->getSession();
        $rooms = $session->get('rooms');
        //var_dump($rooms);die;
        $hotels = array();
        $searchHotel = new SearchHotel();
        
        $form   = $this->createSearchHotelForm($searchHotel);
        $form->handleRequest($request);
       // var_dump($searchHotel);
        //exit();
       
            $em = $this->getDoctrine()->getManager();
            $session = $request->getSession();
            $goingTo = $searchHotel->getGoingTo();
            //echo var_dump($goingTo);
            //exit();
            $date = $searchHotel->getDate();
            $returnDate = $searchHotel->getReturnDate();
           // $session->set('searchHotel',$searchHotel);
            
               // $numDay = 1;
                //echo var_dump($numDay);
                //exit();
            //}
            //else{
           //     $numDay = (int)$numDays->format('%a');
           // }
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
            //$hotelsList = $em->getRepository('TripSiteManagementBundle:Hotel')->findBy(array( 'city' =>  $city->getName()));
            //$query = $em->createQuery($dql3);
            //$result = $query->getResult();
           /*  foreach ($result as $value){
                var_dump($value->getImages());
            } */
            //var_dump($result);
           // exit();
            $session->set('selectedData',$searchHotel);
            //$session->set('resultSet',$result);
            //$session->set('hotelsList',$hotelsList);
            $session->set('searchHotel',$searchHotel);
            $catalogueService = $this->container->get( 'booking.services' );
            $hotels = $catalogueService->getHotelsByCity($searchHotel->getGoingTo());
            
            //var_dump($hotels);exit();
            $amenities = $catalogueService->getAmenities();
            $filters = $catalogueService->getFilters($hotels,$amenities);
           // var_dump($filters);exit();
            //
            $searchHotel->setMinPrice($filters['price']['minPrice']);
            $searchHotel->setMaxPrice($filters['price']['maxPrice']);
            $searchHotel->setMin($filters['price']['minPrice']);
            $searchHotel->setMax($filters['price']['maxPrice']);
            $filterForm   = $this->createFilterForm($searchHotel,$filters);
            //
           // $session->set('search',$search);
           
            $hotels = $catalogueService->getavailablerooms($hotels,$roomCountByHotel);
            $session->set('numRoom',$numRoom);
            $session->set('hotels',$hotels);
            $session->set('filters',$filters);
            
            $numGuests = $searchHotel->getNumAdult();
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
           // var_dump($dteDiff->format("%d"));
            //exit();
            $session->set('numDay',$dteDiff->format("%d"));
            //$totalPrice=searchHotel->getNumRooms * hotel.price * numDay
            return $this->render('TripBookingEngineBundle:Default:searchHotel.html.twig', array(
                'form'   => $form->createView(),
                'filterForm'   => $filterForm->createView(),
                'result'=>$hotels,
                'today'=>$today,
                'searchHotel'=>$searchHotel,
                'city' =>$city,
                'numRoom'=>$numRoom,
                'numDay' => $dteDiff->format("%d"),
                'adults' => $searchHotel->getNumAdult(),
                'childs' => $searchHotel->getNumChildren(),
                'rooms'=>$rooms
               // 'price' => $numRoom*$dteDiff->format("%d")*$numGuests,
            ));
            
        
        
    } /**
    *
    * @param Request $request
    */
    public function hotelFilterAction(Request $request)
    {
        $session = $request->getSession();
       // $session = $request->getSession();
        $rooms = $session->get('rooms');
        $hotels = array();
        $search = $session->get('searchHotel');
        $form   = $this->createSearchHotelForm($search);
        
        //var_dump($search->getLocation());
        //exit();
        $hotels = $session->get('hotels');
        $filters = $session->get('filters');
        //var_dump($filters);
        //exit();
        $numRoom = $session->get('numRoom');
        
        $filterForm   = $this->createFilterForm($search,$filters);
        $filterForm->handleRequest($request);
        
        $price = $search->getPrice();
        $minMaxPrice = explode ( ";", $price );
        $minPrice = ( float ) $minMaxPrice [0];
        $maxPrice = ( float ) $minMaxPrice [1];
        $search->setMinPrice($minPrice);
        $search->setMaxPrice($maxPrice);
        
        $today = new \DateTime();
        
        $catalogueService = $this->container->get( 'booking.services' );
        $hotels = $catalogueService->filterHotels($search,$hotels,$minPrice,$maxPrice);
        //var_dump(searchHotel);
        $session->set('searchHotel',$search);
       //exit();
        return $this->render('TripBookingEngineBundle:Default:searchHotel.html.twig', array(
            'form'   => $form->createView(),
            'filterForm'   => $filterForm->createView(),
            'result'=>$hotels,
            'searchHotel'=>$search,
            'today'=>$today,
            'numRoom'=>$numRoom,
            'numDay' => $session->get('numDay'),
            'adults' => $search->getNumAdult(),
            'childs' => $search->getNumChildren(),
            'rooms'=>$rooms
        ));
        
    }
    
    /**
     *
     * @param Search $entity
     * @return unknown
     */
    private function createFilterForm(SearchHotel $dto,$filters){
        $form = $this->createForm(new HotelFilterType($filters), $dto, array(
            'action' => $this->generateUrl('trip_booking_engine_hotel_filter'),
            'method' => 'GET',
        ));
        
        return $form;
    }
    public function bookAction(Request $request)
    {
        $session = $request->getSession();
        $resultSet = $session->get('resultSet');
        $searchFilter = $session->get('selectedData');
        $searchHotel = $session->get('searchHotel');
        $selectedService = $session->get('selected');
        $locations = $session->get('locations');
        
        
        
        $guest = $session->get('guest');
        
        
        $customer = new Customer();
        $customer->setEmail($guest->getEmail());
        $customer->setMobile($guest->getMobile());
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
                'locations' => $locations,
                'step'=>'personal',
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
    
    public function bookSubmitAction(Request $request)
    {
        
        
        $session = $request->getSession();
        $resultSet = $session->get('resultSet');
        $searchFilter = $session->get('selectedData');
        $selectedService = $session->get('selected');
        $searchHotel = $session->get('searchHotel');
        $locations = $session->get('locations');
        $guest = $session->get('guest');
        
        
        $customer = new Customer();
        //$customer->setEmail($guest->getEmail());
       // $customer->setMobile($guest->getMobile());
        $form   = $this->createBookingForm($customer);
        $form->handleRequest($request);
        //var_dump($customer);exit();
        if ($form->isValid()) {
            $couponApplyed = $customer->getHaveCoupon();
            $couponCode = $customer->getCouponCode();
            $paymentMode = $customer->getPaymentMode();
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
            $session->set('customer',$customer);
           /*  if($searchFilter->getTripType()=='roundtrip'){
                $price = $selectedService['returnPrice'];
            }else{
                if($searchFilter->getTripType()=='package'){
                    $price = $selectedService->getPrice()->first()->getPrice();
                }else{
                    $price = $selectedService['price'];
                }
            } */
            $price = $selectedService['price'];
            $finalPrice = $price;
            if($couponCode=='FIRSTRIDE'){
                $finalPrice = $price-50;
            }
            if($searchFilter->getTripType()=='roundtrip'){
                $selectedService['returnPrice'] = $finalPrice;
            }else{
                if($searchFilter->getTripType()=='package'){
                    $selectedService->getPrice()->first()->setPrice($finalPrice);
                }else{
                    $selectedService['price'] = $finalPrice;
                }
            }
            $booking = new Booking();
            $booking->setCustomerId($customer->getId());
            $booking->setBookingId($this->getBookingId());
            $booking->setTotalPrice($price);
            $booking->setFinalPrice($finalPrice);
            $booking->setStatus('pending');
            $booking->setJobStatus('Open');
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
                    if($searchFilter->getTripType()=='package'){
                        $leavingFrom = $selectedService->getStartPoint()->first()->getName();
                        $date = $searchFilter->getDate();
                        $returnDate = null;
                        $endPoint = $selectedService->getEndPoint();
                        foreach($endPoint as $end){
                            $goingTo = $end->getName();
                            $booking = $this->setVehicleBooking($selectedService,$searchFilter,$leavingFrom,$goingTo,$date,$returnDate,0,$booking);
                            $leavingFrom = null;
                        }
                        $endPoint2 = $selectedService->getEndPoint2();
                        foreach($endPoint2 as $end){
                            $goingTo = $end->getName();
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
            }
            $booking->setPaymentMode($paymentMode);
            
            $amountToPay = $finalPrice;
            $tax = 0;
            if($paymentMode=='advance'){
                $amountToPay = round($finalPrice*(50/100));
                //$tax = round($amountToPay*(3/100));
                //$amountToPay = $amountToPay+$tax;
            }else{
                $amountToPay = round($finalPrice*(30/100));
                //$tax = round($amountToPay*(3/100));
                // $amountToPay = $amountToPay+$tax;
            }
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
            $session->set('bookingObj',$booking);
            $session->set('amountToPay',$amountToPay);
            $paymentLink = $this->getPaymentLink($request,$amountToPay,$customer,$booking);
            //$paymentLink = "https://www.instamojo.com/Waseemsyed/tirupati-caars-services-cb8a4/";
            // $paymentLink.="?data_name=".$customer->getName()."&data_email=".$customer->getEmail()."&data_phone=".$customer->getMobile()."&embed=form";
            //  $paymentLink = '';
            $payuLink = $this->generateUrl ( 'trip_booking_engine_payment_payu' );
            
            //var_dump($customer);
            //var_dump($booking);
            //var_dump($selectedService);
            //var_dump($searchFilter);
            //var_dump($paymentLink);
            
            // exit();
            return $this->render('TripBookingEngineBundle:Default:payment.html.twig', array(
                'customer'   => $customer,
                'booking'   => $booking,
                'step'=>'payment',
                'service'=>$selectedService,
                'filter'=>$searchFilter,
                'discount'=>$discount,
                'paymentLink'   => $paymentLink,
                'payuLink' => $payuLink,
                'locations' => $locations,
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
                'locations' => $locations,
                'step'=>'personal',
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
        if($searchFilter->getTripType()=='package'){
            $vehicle = $selectedService->getPrice()->first();
            $vehicleBooking->setVehicleId($vehicle->getVehicleId());
            $vehicleBooking->setModel($vehicle->getName());
        }else{
            $vehicleBooking->setVehicleId($selectedService['id']);
            $vehicleBooking->setModel($selectedService['model']);
        }
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
        if($status=='success'){
            $booking->setStatus('booked');
            $paymentMode = $booking->getPaymentMode();
            $finalPrice = $booking->getFinalPrice();
            
            $booking->setAmountPaid($amountToPay);
            $booking->setPaymentId($paymentId);
            $em->merge($booking);
            $em->flush();
            $email =  $customer->getEmail();
            $name = $customer->getName();
            $mobile = $customer->getMobile();
            $bookingId = $booking->getBookingId();
            $mail = "Dear $name <br> Your Booking has been Successfully completed.Your Booking Id is $bookingId";
            $adminMail = "Dear Admin, $name <br> has Done Booking Successfully and Booking Id is $bookingId";
            /*if($searchFilter->getTripType()=='package'){
             $mail = $this->renderView(
             'TripBookingEngineBundle:Mail:mailer.html.twig',
             array(
             'customer'   => $customer,
             'booking'=>$booking,
             'service'=>$booking->getVehicleBooking()[0],
             )
             );
             }*/
            
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
        
        return $this->redirect($info['redirect_url']);
        
        //return $info['redirect_url'];
    }
    public function getHotelPaymentLink($request,$amountToPay,$customer,$booking){
        
        $session = $request->getSession ();
        
        $bookingOld = $session->get('booking');
        
        
        
        $redirectUrl = $this->generateUrl ( 'trip_hotel_booking_engine_success' );
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
        //$MERCHANT_KEY = "rjQUPktU";
        $MERCHANT_KEY = "ze3IGP8w";
        
        
        //$MERCHANT_KEY = "OwPbxU2k";
        //$SALT = "aa70fUA5Hh";
        // Merchant Salt as provided by Payu
        
        //$SALT = "e5iIg1jwi8";
        $SALT = "OAAknA88Xf";
        
        // End point - change to https://secure.payu.in for LIVE mode
        $PAYU_BASE_URL = "https://secure.payu.in";
        
        //testing Mode
        //$PAYU_BASE_URL = "https://test.payu.in";
        
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
    
    
    
    private function createCustomPackageForm(CustomerDto $customer){
        $bookingService = $this->container->get( 'booking.services' );
        $security = $this->container->get ( 'security.context' );
        $form = $this->createForm(new CustomPackageType($bookingService,$security), $customer, array(
            'action' => $this->generateUrl('trip_booking_engine_customPackage'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'submit'));
        
        return $form;
    }
    public function customPackageAction(Request $request){
        
        $security = $this->container->get ( 'security.context' );
        $em = $this->getDoctrine()->getManager();
        $customer = new CustomerDto();
        $package = new NewPackage();
        $collection = $customer->getMultiple();
        $collection->add($package);
        $form   = $this->createCustomPackageForm($customer);
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $vehicles = $this->getVehicleByIndex();
            $collection = $customer->getMultiple();
            $pickUp = $customer->getPickUp();
            $drop = $customer->getDrop();
            
            $price = $customer->getPrice();
            $date = $customer->getDate();
            $preferTime = $customer->getPreferTime();
            
            $customerObj = new Customer();
            $customerObj->setName($customer->getName());
            $customerObj->setMobile($customer->getMobile());
            $customerObj->setEmail($customer->getEmail());
            $customerObj->setAddress($customer->getAddress());
            
            $em->persist($customerObj);
            $em->flush();
            
            $booking = new Booking();
            $booking->setCustomerId($customerObj->getId());
            $booking->setBookingId($this->getBookingId());
            
            $booking->setStatus('pending');
            $booking->setJobStatus('Open');
            $booking->setBookedOn(new \DateTime());
            $booking->setNumAdult($customer->getNumAdult());
            $booking->setCouponApplyed(0);
            $totalPrice = 0;
            if ($security->isGranted ( 'ROLE_SUPER_ADMIN' ))
                $totalPrice = $price;
                
                
                foreach($collection as $service){
                    $leavingFrom = $service->getLeavingFrom();
                    $goingTo = $service->getGoingTo();
                    $date = $service->getDate();
                    $preferTime = $service->getPreferTime();
                    $numAdult = $service->getNumAdult();
                    $price = $service->getPrice();
                    $description = $service->getDescription();
                    $placesToVisit = $service->getPlacesToVisit();
                    $totalPrice += $price;
                    $vehicleBooking = new VehicleBooking();
                    
                    $vehicleBooking->setVehicleId($service->getVehicleId());
                    $vehicleBooking->setModel($vehicles[$service->getVehicleId()]);
                    $vehicleBooking->setLeavingFrom($leavingFrom);
                    $vehicleBooking->setGoingTo($goingTo);
                    $vehicleBooking->setDescription($description);
                    $vehicleBooking->setDate($date);
                    $vehicleBooking->setTripType('custom package');
                    $vehicleBooking->setPrice($price);
                    $vehicleBooking->setNumAdult($numAdult);
                    $vehicleBooking->setPreferTime($preferTime);
                    $vehicleBooking->setBooking($booking);
                    $booking->addVehicleBooking($vehicleBooking);
                    
                    /* $pickUpCollection = $booking->getPickUp();
                     $pickObj = new Pickup();
                     $pickObj->setLocation($leavingFrom);
                     $pickObj->setBooking($booking);
                     $pickUpCollection->add($pickObj);
                     
                     $dropCollection = $booking->getDrop();
                     $dropObj = new Drop();
                     $dropObj->setLocation($goingTo);
                     $dropObj->setBooking($booking);
                     $dropCollection->add($dropObj); */
                    
                    $placesToVisitCollection = $vehicleBooking->getPlacesToVisit();
                    
                    foreach($placesToVisit as $location){
                        $placesToVisitObj = new PlacesToVisit();
                        $placesToVisitObj->setLocation($location);
                        $placesToVisitObj->setBooking($vehicleBooking);
                        $placesToVisitCollection->add($placesToVisitObj);
                    }
                    
                }
                
                
                /*  $vehicleBooking = new VehicleBooking();
                
                $vehicleBooking->setVehicleId($customer->getVehicleId());
                $vehicleBooking->setModel($vehicles[$customer->getVehicleId()]);
                $vehicleBooking->setDate($date);
                
                $vehicleBooking->setPrice($price);
                $vehicleBooking->setPreferTime($preferTime);
                $vehicleBooking->setBooking($booking);
                $booking->addVehicleBooking($vehicleBooking); */
                
                $paymentMode = $customer->getPaymentMode();
                $booking->setPaymentMode('advance');
                if ($security->isGranted ( 'ROLE_SUPER_ADMIN' ))
                    $booking->setPaymentMode($paymentMode);
                    
                    
                    $amountToPay = $totalPrice;
                    $tax = 0;
                    if($paymentMode=='advance'){
                        $amountToPay = round($totalPrice*(50/100));
                        //$tax = round($amountToPay*(3/100));
                        //$amountToPay = $amountToPay+$tax;
                    }else{
                        $amountToPay = round($totalPrice*(30/100));
                        //$tax = round($amountToPay*(3/100));
                        // $amountToPay = $amountToPay+$tax;
                    }
                    $serviceTax = round($totalPrice*(5.6/100),2);
                    $swachBharthCess = round($totalPrice*(0.2/100),2);
                    $krishiKalyanCess = round($totalPrice*(0.2/100),2);
                    $totalTax = $serviceTax+$swachBharthCess+$krishiKalyanCess;
                    $amountToPay = $amountToPay+$totalTax;
                    $finalPrice = $totalPrice+$totalTax;
                    $booking->setTax($tax);
                    $booking->setServiceTax($serviceTax);
                    $booking->setSwachBharthCess($swachBharthCess);
                    $booking->setKrishiKalyanCess($krishiKalyanCess);
                    $booking->setTotalPrice($totalPrice);
                    $booking->setFinalPrice($finalPrice);
                    $em->persist($booking);
                    $em->flush();
                    
                    
                    return $this->redirect($this->generateUrl('trip_booking_engine_review_custom_package',array('id'=>$booking->getBookingId())));
                    
        }
        
        return $this->render('TripBookingEngineBundle:Default:customPackage.html.twig',array(
            
            'form'   => $form->createView(),
        ));
    }
    
    
    public function reviewCustomPackageAction(Request $request,$id){
        
        $security = $this->container->get ( 'security.context' );
        $em = $this->getDoctrine()->getManager();
        
        $booking = $em->getRepository('TripBookingEngineBundle:Booking')->findOneByBookingId($id);
        
        $customer = $em->getRepository('TripBookingEngineBundle:Customer')->find($booking->getCustomerId());
        
        $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        
        return $this->render('TripBookingEngineBundle:Default:reviewCustomPackage.html.twig',array(
            'customer'   => $customer,
            'booking'=>$booking,
            'locations'=>$locations,
            'services'=>$booking->getVehicleBooking(),
        ));
    }
    
    private function createEditCustomerDetailsForm(CustomerDto $customer,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $security = $this->container->get ( 'security.context' );
        $form = $this->createForm(new EditCustomerType($bookingService,$security), $customer, array(
            'action' => $this->generateUrl('trip_booking_engine_edit_customer_details',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    
    public function editCustomerDetailsAction(Request $request,$id){
        
        $security = $this->container->get ( 'security.context' );
        $em = $this->getDoctrine()->getManager();
        $customer = new CustomerDto();
        $customerObj = $em->getRepository('TripBookingEngineBundle:Customer')->find($id);
        
        $customer->setEmail($customerObj->getEmail());
        $customer->setName($customerObj->getName());
        $customer->setMobile($customerObj->getMobile());
        $form   = $this->createEditCustomerDetailsForm($customer,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $customerObj->setEmail($customer->getEmail());
            $customerObj->setName($customer->getName());
            $customerObj->setMobile($customer->getMobile());
            $em->merge($customerObj);
            $em->flush();
            
            return $this->render('TripBookingEngineBundle:Default:customerDetails.html.twig',array(
                'customer'   => $customerObj,
            ));
            //return new Response ( "true" );
        }
        return $this->render('TripBookingEngineBundle:Default:editCustomerDetails.html.twig',array(
            'form'   => $form->createView(),
        ));
    }
    private function createEditCustomPackageForm(NewPackage $package,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $security = $this->container->get ( 'security.context' );
        $form = $this->createForm(new NewPackageType($bookingService,$security), $package, array(
            'action' => $this->generateUrl('trip_booking_engine_edit_custom_package',array('id'=>$id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    
    public function editCustomPackageAction(Request $request,$id){
        
        $security = $this->container->get ( 'security.context' );
        $em = $this->getDoctrine()->getManager();
        $package = new NewPackage();
        $service = $em->getRepository('TripBookingEngineBundle:VehicleBooking')->find($id);
        
        $package->setLeavingFrom($service->getLeavingFrom());
        $package->setGoingTo($service->getGoingTo());
        $package->setDate($service->getDate());
        $package->setPreferTime($service->getPreferTime());
        $package->setVehicleId($service->getVehicleId());
        $package->setPrice($service->getPrice());
        $package->setNumAdult($service->getNumAdult());
        $package->setDescription($service->getDescription());
        
        $oldPrice = $service->getPrice();
        $placesToVisitOld = array();
        $placesToVisitByLocation = array();
        $placesToVisitCollection = $service->getPlacesToVisit();
        foreach($placesToVisitCollection as $location){
            $placesToVisitOld[] = $location->getLocation();
            $placesToVisitByLocation[$location->getLocation()] = $location;
        }
        $package->setPlacesToVisit($placesToVisitOld);
        $form   = $this->createEditCustomPackageForm($package,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $vehicles = $this->getVehicleByIndex();
            $service->setLeavingFrom($package->getLeavingFrom());
            $service->setGoingTo($package->getGoingTo());
            $service->setDate($package->getDate());
            $service->setPreferTime($package->getPreferTime());
            $service->setVehicleId($package->getVehicleId());
            $service->setModel($vehicles[$service->getVehicleId()]);
            $service->setPrice($package->getPrice());
            $service->setNumAdult($package->getNumAdult());
            $service->setDescription($package->getDescription());
            $price = $package->getPrice();
            $placesToVisit = $package->getPlacesToVisit();
            
            $placesToVisitCollection = new ArrayCollection();
            
            foreach($placesToVisit as $location){
                if (!in_array($location, $placesToVisitOld)){
                    $placesToVisitObj = new PlacesToVisit();
                    $placesToVisitObj->setLocation($location);
                    $placesToVisitObj->setBooking($service);
                    $placesToVisitCollection->add($placesToVisitObj);
                }
            }
            $service->setPlacesToVisit($placesToVisitCollection);
            
            $em->merge($service);
            $em->flush();
            
            foreach($placesToVisitOld as $location){
                if (!in_array($location, $placesToVisit)){
                    $removedLocation = $placesToVisitByLocation[$location];
                    $em->remove ( $removedLocation );
                    $em->flush();
                }
            }
            
            
            $booking = $em->getRepository('TripBookingEngineBundle:Booking')->find($service->getBooking()->getId());
            
            if ($security->isGranted ( 'ROLE_SUPER_ADMIN' )){
                $totalPrice = $booking->getTotalPrice();
                
                $totalPrice = $totalPrice + $price - $oldPrice;
                $paymentMode = $booking->getPaymentMode();
                $tax = 0;
                $serviceTax = round($totalPrice*(5.6/100),2);
                $swachBharthCess = round($totalPrice*(0.2/100),2);
                $krishiKalyanCess = round($totalPrice*(0.2/100),2);
                $totalTax = $serviceTax+$swachBharthCess+$krishiKalyanCess;
                $finalPrice = $totalPrice+$totalTax;
                $booking->setTax($tax);
                $booking->setServiceTax($serviceTax);
                $booking->setSwachBharthCess($swachBharthCess);
                $booking->setKrishiKalyanCess($krishiKalyanCess);
                $booking->setTotalPrice($totalPrice);
                $booking->setFinalPrice($finalPrice);
                $em->merge($booking);
                $em->flush();
            }
            
            $locations = $em->getRepository('TripSiteManagementBundle:City')->findAll();
            $locations = $this->getLocationsByIndex($locations);
            
            $placesToVisitCollection = new ArrayCollection();
            
            foreach($placesToVisit as $location){
                $placesToVisitObj = new PlacesToVisit();
                $placesToVisitObj->setLocation($location);
                $placesToVisitCollection->add($placesToVisitObj);
            }
            $service->setPlacesToVisit($placesToVisitCollection);
            return $this->render('TripBookingEngineBundle:Default:serviceList.html.twig',array(
                'booking'=>$booking,
                'locations'=>$locations,
                'services'=>$booking->getVehicleBooking(),
            ));
        }
        return $this->render('TripBookingEngineBundle:Default:editCustomPackage.html.twig',array(
            'form'   => $form->createView(),
        ));
    }
    
    
    public function confirmCustomPackageAction(Request $request,$id){
        
        $security = $this->container->get ( 'security.context' );
        $em = $this->getDoctrine()->getManager();
        
        $booking = $em->getRepository('TripBookingEngineBundle:Booking')->findOneByBookingId($id);
        
        $customer = $em->getRepository('TripBookingEngineBundle:Customer')->find($booking->getCustomerId());
        
        $booking->setStatus('booked');
        $em->merge($booking);
        $em->flush();
        
        $email =  $customer->getEmail();
        $name = $customer->getName();
        $mobile = $customer->getMobile();
        $bookingId = $booking->getBookingId();
        $mail = "Dear $name <br> Your Booking has been Successfully completed.Your Booking Id is $bookingId";
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
        $mailService->mail('info@justtrip.in','Just Trip:Booking Confirmation',$mail);
        
        
        
        return $this->render('TripBookingEngineBundle:Default:success.html.twig',array(
            'booking'   => $booking,
        ));
    }
    
    
    public function getLocationsByIndex($locations){
        $temp = array();
        foreach($locations as $location){
            $temp[$location->getId()]=$location;
        }
        return $temp;
    }
    
    public function getVehicleByIndex()
    {
        $bookingService = $this->container->get( 'booking.services' );
        $catalogService = $bookingService->getCatalog();
        $locations = $catalogService->getVehicles();
        $tempLocations = array();
        foreach ($locations as $location){
            $tempLocations[$location->getId()] = $location->getModel();
        }
        return $tempLocations;
    }
    
    //********** Sreekanth**************//
    public function hotelBookingAction(Request $request){
        $security = $this->container->get ( 'security.context' );
        if (! $security->isGranted ( 'IS_AUTHENTICATED_FULLY' )) {
            return $this->redirect ( $this->generateUrl ( "trip_security_sign_up" ) );
        }
        $user = $security->getToken ()->getUser ();
        $username = $user->getUserName ();
        $em = $this->getDoctrine()->getManager();
        $bookings = $this->getHotelbooking($username);
        $session = $request->getSession();
        $searchFilter = $session->get('selectedData');
        
        //$package->setDate($service->getDate());
        //$package->setPrice($service->getPrice());
        
        $locations = $em->getRepository('TripSiteManagementBundle:city')->findAll();
        $locations = $this->getLocationsByIndex($locations);
        return $this->render('TripBookingEngineBundle:Default:hotelBooking.html.twig',array(
            'bookings' => $bookings,
            'locations' => $locations,
            'step'=>'review',
            'step'=>'personal',
            'filter'=>$searchFilter,
            //'customers' => $customers,
        ));
    }
    public function getHotelbooking($username){
        $dql3 = "SELECT b FROM TripBookingEngineBundle:Booking b,TripBookingEngineBundle:Customer c where c.id=b.customerId and c.email='$username' ORDER BY b.id DESC";
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql3);
        $result = $query->getResult();
        return $result;
    }
    
    //public function billingAccountsAction(){
    //return $this->render('TripBookingEngineBundle:Default:billingAccounts.html.twig');
    //}
    
    public function removeTrailingSlashAction(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        $requestUri = $request->getRequestUri();
        
        $url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);
        
        return $this->redirect($url, 301);
    }
    
    
    //**************End************//
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
        $leftdays = $request->get('leftdays');
        $hours = $request->get('hours');
        $location = $request->get('location');
        //echo var_dump($location);
        // exit();
        
        $session->set('id',$id);
        $session->set('title',$title);
        $session->set('pDate',$pDate);
        $session->set('rDate',$rDate);
        $session->set('price',$price);
        $session->set('leftdays',$leftdays);
        $session->set('hours',$hours);
        $session->set('location',$location);
        
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
        //echo var_dump($id);
       // echo var_dump($title);
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
            /*if($searchFilter->getTripType()=='roundtrip'){
             $price = $selectedService['returnPrice'];
             }else{
             if($searchFilter->getTripType()=='package'){
             $price = $selectedService->getPrice()->first()->getPrice();
             }else{
             $price = $selectedService['price'];
             }
             }*/
            $finalPrice = $price;
            if($couponCode=='FIRSTRIDE'){
                $finalPrice = $price-50;
            }
            /*if($searchFilter->getTripType()=='roundtrip'){
             $selectedService['returnPrice'] = $finalPrice;
             }else{
             if($searchFilter->getTripType()=='package'){
             $selectedService->getPrice()->first()->setPrice($finalPrice);
             }else{
             $selectedService['price'] = $finalPrice;
             }
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
            if($paymentMode=='advance'){
                $amountToPay = round($finalPrice*(50/100));
                //$tax = round($amountToPay*(3/100));
                //$amountToPay = $amountToPay+$tax;
            }else{
                $amountToPay = round($finalPrice*(30/100));
                //$tax = round($amountToPay*(3/100));
                // $amountToPay = $amountToPay+$tax;
            }
            $serviceTax = round($finalPrice*(5.6/100),2);
            $swachBharthCess = round($finalPrice*(2.5/100),2);
            $krishiKalyanCess = round($finalPrice*(2.5/100),2);
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
            $session->set('bookingObj',$booking);
            $session->set('amountToPay',$amountToPay);
            $paymentLink = $this->getPaymentLink($request,$amountToPay,$customer,$booking);
            //$paymentLink = "https://www.instamojo.com/Waseemsyed/tirupati-caars-services-cb8a4/";
            // $paymentLink.="?data_name=".$customer->getName()."&data_email=".$customer->getEmail()."&data_phone=".$customer->getMobile()."&embed=form";
            //  $paymentLink = '';
            $payuLink = $this->generateUrl ( 'trip_booking_engine_payment_payu' );
            
            //var_dump($customer);
            //var_dump($booking);
            //var_dump($selectedService);
            //var_dump($searchFilter);
            //var_dump($paymentLink);
            
            // exit();
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
            ));
        }
        
        return $this->render('TripBookingEngineBundle:Default:bookingBike.html.twig', array(
            'form'   => $form->createView(),
            'service'=>$selectedService,
            'discount'=>0,
            'filter'=>$searchFilter,
            'locations' => $locations,
            'step'=>'personal',
        ));
        
        
    }
    private function createTestCustomPackageForm(TestCustomerDto $customer){
        $bookingService = $this->container->get( 'booking.services' );
        $security = $this->container->get ( 'security.context' );
        $form = $this->createForm(new TestCustomPackageType($bookingService,$security), $customer, array(
            'action' => $this->generateUrl('trip_booking_engine_testcustomPackage'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'submit'));
        
        return $form;
    }
    public function testCustomPackageAction(Request $request){
        
        $security = $this->container->get ( 'security.context' );
        $em = $this->getDoctrine()->getManager();
        $hotel = new TestCustomerDto();
        $newBilling = new TestNewPackage();
        $collection = $hotel->getMultiple();
        //var_dump($collection);
        $collection->add($newBilling);
        
        $form   = $this->createTestCustomPackageForm($hotel);
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            
            //$billingObj->setId($hotel->getId());
            foreach($collection as $service){
                $billingObj = new TestCustomer();
                $billingObj->setDiesel($service->getDiesel());
                $billingObj->setPrice($service->getPrice());
                $billingObj->setAdvance($service->getAdvance());
                $billingObj->setCash($service->getCash());
                $billingObj->setExpenses($service->getExpenses());
                $billingObj->setComments($service->getComments());
                $billingObj->setDate($service->getDate());
                $billingObj->setPickup($service->getPickup());
                $billingObj->setGoingTo($service->getGoingTo());
                $billingObj->setVehicleId($service->getVehicleId());
                $billingObj->setDriverId($service->getDriverId());
                $billingObj->setCarnumber($service->getCarnumber());
                //$placesToVisitCollection = new ArrayCollection();
                //$collection = $hotel->getLocations();
                $billingObj->setLocations($service->getLocations());
                $placesToVisitCollection= $billingObj->getLocations();
                $test='test1';
                var_dump($test);
                foreach($placesToVisitCollection as $location){
                    var_dump('test2');
                    $placesToVisitObj = new BillingPlacesToVisit();
                    $placesToVisitObj->setLocation($location);
                    $placesToVisitObj->setBilling($billingObj);
                    $em->persist($placesToVisitObj);
                    //$placesToVisitCollection->add($placesToVisitObj);
                }
                $em->persist($billingObj);
            }
            
            $em->flush();
            
            
            
            return $this->redirect($this->generateUrl('trip_booking_engine_testcustomPackage'));
            
        }
        
        return $this->render('TripBookingEngineBundle:Default:testcustomPackage.html.twig',array(
            
            'form'   => $form->createView(),
        ));
    }
    private function createVendorRegistraionForm(Vendor $vendor,$vendorId){
        $bookingService = $this->container->get( 'booking.services' );
        $security = $this->container->get ( 'security.context' );
        $form = $this->createForm(new VendorRegistraionType($bookingService,$security), $vendor, array(
            'action' => $this->generateUrl('trip_booking_engine_vendor_registraion_form',array(
                'vendorId' => $vendorId,
                'vendorName' => $vendor->getName(),
                'vendorEmail' => $vendor->getEmail(),
                'vendorMobileno' => $vendor->getMobileNo(),
                
            )),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'submit'));
        
        return $form;
    }
    public function vendorRegistraionAction(Request $request){
        
        $security = $this->container->get ( 'security.context' );
        $em = $this->getDoctrine()->getManager();
        $vendorId = $request->query->get('vendorId');
        $session = $this->getRequest()->getSession();
        $vendorName = $session->get('vendorName');
        $vendorEmail = $session->get('vendorEmail');
        $vendorMobileno = $session->get('vendorMobileno');
        $vendorId = $session->get('vendorId');
        $vendorPwd = $session->get('vendorPwd');
        $vendor = new Vendor();
        
        $newVehicle = new VendorVehicles();
       
        $newDriver = new VendorDriver();
        $vehicleCollection = $vendor->getVehiclesList();
        $driverCollection = $vendor->getDriversList();
        $vehicleCollection->add($newVehicle);
        $driverCollection->add($newDriver);
        
        
        $form   = $this->createVendorRegistraionForm($vendor,$vendorId);
        $form->handleRequest($request);
        if ($form->isValid()) {
            //$vendorId = $request->query->get('vendorId');
            
            //var_dump($vendorId);
            //exit();
            $uploadedPanfile = $vendor->getPancardid();
            if (!is_null($uploadedPanfile)) {
                $file_name = $uploadedPanfile->getClientOriginalName ();
                $dir = 'images/packages/';
                $uploadedPanfile->move ( $dir, $file_name );
                $vendor->setPancardid ($file_name );
                
            }
            $uploadedfile = $vendor->getidProof();
            if (!is_null($uploadedfile)) {
                $file_name = $uploadedfile->getClientOriginalName ();
                $dir = 'images/packages/';
                $uploadedfile->move ( $dir, $file_name );
                $vendor->setidProof ($file_name );
                
                
            }
            
           
            //$count =0;
            $vehicleFeeOld =0;
            $vehicleCollection = $vendor->getVehiclesList();
            $collection = $vendor->getVehicles();
            foreach($vehicleCollection as $vehicle){
                $vehicleName = $vehicle->getVehicleName();
               // var_dump($vehicleName);
                $vendorVehicleFee = $em->getRepository('TripBookingEngineBundle:VendorVehicleFee')->findOneBy(
                    array('vehicleName' => $vehicleName)
                    );
                if($vendorVehicleFee != null){
                    $vehicleFee = $vendorVehicleFee->getVehicleFee();
                    //var_dump($vehicleFee);
                    $vehicleFeeOld = $vehicleFeeOld+$vehicleFee;
                   // var_dump($vehicleFeeOld);
                    //$vehicleFee = 
                }
               // $count++;
                $uploadedVehicleImage = $vehicle->getVehicleImage();
                if (!is_null($uploadedVehicleImage) && $uploadedVehicleImage instanceof UploadedFile) {
                    $file_name = $uploadedVehicleImage->getClientOriginalName ();
                    $dir = 'images/packages/';
                    $uploadedVehicleImage->move ( $dir, $file_name );
                    $vehicle->setVehicleImage ($file_name );
                    
                    
                }
                
                $uploadedVehicleRegisCer = $vehicle->getVehicleRegisCer();
                if (!is_null($uploadedVehicleRegisCer) && $uploadedVehicleRegisCer instanceof UploadedFile) {
                    $file_name = $uploadedVehicleRegisCer->getClientOriginalName ();
                    $dir = 'images/packages/';
                    $uploadedVehicleRegisCer->move ( $dir, $file_name );
                    $vehicle->setVehicleRegisCer ($file_name );
                    
                    
                }
                $uploadedVehicleInsurance = $vehicle->getVehicleInsurance();
                if (!is_null($uploadedVehicleInsurance) && $uploadedVehicleInsurance instanceof UploadedFile) {
                    $file_name = $uploadedVehicleInsurance->getClientOriginalName ();
                    $dir = 'images/packages/';
                    $uploadedVehicleInsurance->move ( $dir, $file_name );
                    $vehicle->setVehicleInsurance ($file_name );
                    
                    
                }
                $uploadedVehiclePopulation = $vehicle->getVehiclePopulation();
                if (!is_null($uploadedVehiclePopulation) && $uploadedVehiclePopulation instanceof UploadedFile) {
                    $file_name = $uploadedVehiclePopulation->getClientOriginalName ();
                    $dir = 'images/packages/';
                    $uploadedVehiclePopulation->move ( $dir, $file_name );
                    $vehicle->setVehiclePopulation ($file_name );
                    
                    
                }
                $vehicle->setInsertdate(date("d-m-Y"));
                $vehicle->setPaymentStatus('pending');
                $vehicle->setVendor($vendor);
                $collection->add($vehicle);
                
            }
           
            $driverCollection = $vendor->getDriversList();
            $dcollection = $vendor->getDrivers();
            foreach($driverCollection as $driver){
                $uploadedDrivingLicence = $driver->getDrivingLicence();
                if (!is_null($uploadedDrivingLicence) && $uploadedDrivingLicence instanceof UploadedFile) {
                    $file_name = $uploadedDrivingLicence->getClientOriginalName ();
                    $dir = 'images/packages/';
                    $uploadedDrivingLicence->move ( $dir, $file_name );
                    $driver->setDrivingLicence ($file_name );
                    
                    
                }
                $uploadedDriverIdproof = $driver->getDriverIdproof();
                if (!is_null($uploadedDriverIdproof) && $uploadedDriverIdproof instanceof UploadedFile) {
                    $file_name = $uploadedDriverIdproof->getClientOriginalName ();
                    $dir = 'images/packages/';
                    $uploadedDriverIdproof->move ( $dir, $file_name );
                    $driver->setDriverIdproof ($file_name );
                    
                    
                }
                $policeVerificationLetter = $driver->getPoliceVerificationLetter();
                if (!is_null($policeVerificationLetter) && $policeVerificationLetter instanceof UploadedFile) {
                    $file_name = $policeVerificationLetter->getClientOriginalName ();
                    $dir = 'images/packages/';
                    $policeVerificationLetter->move ( $dir, $file_name );
                    $driver->setPoliceVerificationLetter ($file_name );
                    
                    
                }
                
                $driver->setVendor($vendor);
                $dcollection->add($driver);
                $amountToPay = $vehicleFeeOld;
                $vendor->setRegistraionFee($amountToPay);
                $vendor->setVendorId($vendorId);
                $vendor->setVendorPwd($vendorPwd);
                $vendor->setStatus('pending');
                $vendor->setAmountPaid(0);
                $vendor->setAmountPending($amountToPay);
            }
            //exit();
            $em->persist($vendor);
            $session = $this->getRequest()->getSession();
            $session->set('vendor',$vendor);
            $em->flush();
           
            return $this->redirect($this->generateUrl('trip_booking_engine_vendor_profile',array(
                'email' => $vendorEmail,
                
                
               
            )));
            
           
            
            
        }
        
        return $this->render('TripBookingEngineBundle:Default:vendorRegistraion.html.twig',array(
            
            'form'   => $form->createView(),
            'vendorName' => $vendorName,
            'vendorEmail' => $vendorEmail,
            'vendorMobileno' => $vendorMobileno,
           
        ));
    }
    private function createVendorLoginForm(VendorLogin $vendor){
        
        $form = $this->createForm(new VendorLoginType(), $vendor, array(
            'action' => $this->generateUrl('trip_booking_engine_vendor_login'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'submit'));
        
        return $form;
    }
    public function vendorLoginAction(Request $request){
        $error = '';
        $session = $this->getRequest()->getSession();
        $name = $session->get('vName');
        $email = $session->get('vEmail');
        $mobileno = $session->get('vMobileno');
        $vendorPwd= $this->get('request')->request->get('pwd');
        $vendorConPwd= $this->get('request')->request->get('confirmpwd');
        if($vendorPwd == $vendorConPwd){
            $em = $this->getDoctrine()->getManager();
            $vendor = new VendorLogin();
            
            //$form   = $this->createVendorLoginForm($vendor);
            //$vendor_id ='VD001';
            $highest_id = $em->createQueryBuilder()
            ->select('MAX(e.id)')
            ->from('TripBookingEngineBundle:VendorLogin', 'e')
            ->getQuery()
            ->getSingleScalarResult();
            //$form->handleRequest($request);
            //$task = $form->getData();
            $highest_id++;
            $highest_id = 'VDJTTPTY00' .$highest_id;
            
            $vendor->setName($name);
            $vendor->setEmail($email);
            $vendor->setmobileNo($mobileno);
            $vendor->setVendorPwd($vendorPwd);
            //$vendor->setVendorConPwd($vendorConPwd);
            $vendor->setVendor_id($highest_id);
            //$vendor->setVendor_id($vendor_id);
            $em->persist($vendor);
            $em->flush();
            $session->set('vendorId',$highest_id);
            $session->set('vendorPwd',$vendorPwd);
            
            $mail = "Dear $name. <br> Click on the following link to rigister with justtrip <br>";
            $mailUrl=  $this->generateUrl('trip_booking_engine_vendor_registraion_form',array(
                'name'   => $name,
                'email'   => $email,
                'mobileno'   => $mobileno,
            ));
            $host = $request->getHost ();
            $sUrl = 'http://' . $host . $mailUrl;
            $mail .= "<a href=$sUrl style='text-decoration:none;'>Confirm Now</a>";
            //$mail .= "<a href='http://localhost/trips/web/app_dev.php/vendor-registraion-form?name=$name&email=$email&mobileno=$mobileno' style='text-decoration:none;'>Confirm Now</a>";
            //$mail .= $name;
            $mailService = $this->container->get( 'mail.services' );
            $mailService->mail($email,'Just Trip:Vendor Registration',$mail);
            //$mailService->mail('info@justtrip.in','Just Trip:Vendor Registration',$mail);
            return $this->redirect($this->generateUrl('trip_booking_engine_vendor_validate_login'));
        }
        else{
            $error = 'password and confirm password should be same';
            return $this->redirect($this->generateUrl('trip_booking_engine_test_vendor_password',array(
                'error' => $error,
                'name'   => $name,
                'email'   => $email,
                'mobileno'   => $mobileno,
            )));
        }
        
        
        return $this->render('TripBookingEngineBundle:Default:vendorLogin.html.twig');
    }
    private function createTestVendorLoginForm(VendorLogin $vendor){
        
        $form = $this->createForm(new VendorLoginType(), $vendor, array(
            'action' => $this->generateUrl('trip_booking_engine_test_vendor_success'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Register'));
        
        return $form;
    }
    public function vendorTestLoginAction(Request $request){
        
        
        $error = '';
        return $this->render('TripBookingEngineBundle:Default:vendorLogin.html.twig',array(
            
            'error'   => $error,
            
        ));
    }
    public function vendorTestSuccessAction(Request $request){
        $name = $this->get('request')->request->get('vendorName');
        //var_dump($name);
        $email =$this->get('request')->request->get('vendorEmail');
        $mobileno =$this->get('request')->request->get('vendorMobileno');
        //$data = array();
        //$data['name']=$name;
        //$data['email']=$email;
        //$data['mobileno']=$mobileno;
        //$query = http_build_query(array('data' => $data));
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository('TripBookingEngineBundle:VendorLogin')->findOneBy(
            array('email' => $email)
            );
        if($vendor == null){
            
            $mail = " <p>Dear $name .<br> Click on the following link to create a  password for your justtrip.in account<br></p>";
            $mailUrl=  $this->generateUrl('trip_booking_engine_test_vendor_password',array(
                'name'   => $name,
                'email'   => $email,
                'mobileno'   => $mobileno,
            ));
            $host = $request->getHost ();
            $sUrl = 'http://' . $host . $mailUrl;
            
            $mail .= "<a href=$sUrl style='text-decoration:none;'>Confirm Now</a>";
            //$mail .= $name;
            $mailService = $this->container->get( 'mail.services' );
            $mailService->mail($email,'Just Trip:Vendor Confirmation',$mail);
        }
        else
        {
            $error ='The mail is already registered with justtrip.in';
            return $this->redirect($this->generateUrl('trip_booking_engine_test_vendor_login',array(
                'error'   => $error,
            )));
        }
        return $this->render('TripBookingEngineBundle:Default:testvendor.html.twig');
    }
    public function vendorTestPasswordAction(Request $request){
        //$name = $this->get('request')->request->get('data');
        //http_build_query($name);
        $name = $_GET['name'];
        $email = $_GET['email'];
        $mobileno = $_GET['mobileno'];
        $session = $this->getRequest()->getSession();
        $session->set('vName', $name);
        $session->set('vEmail', $email);
        $session->set('vMobileno', $mobileno);
        
        return $this->render('TripBookingEngineBundle:Default:VendorPassword.html.twig',array(
            
            'name'   => $name,
            'email'   => $email,
            'mobileno'   => $mobileno,
        ));
    }
    public function vendorConfirmLoginAction(Request $request){
        
        
        return $this->render('TripBookingEngineBundle:Default:vendorConfirmLogin.html.twig');
    }
    public function vendorValidateLoginAction(Request $request){
        $error='';
        $email = $this->get('request')->request->get('email');
        $pwd = $this->get('request')->request->get('pwd');
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository('TripBookingEngineBundle:VendorLogin')->findOneBy(
            array('email' => $email, 'vendorPwd' => $pwd)
            );
        if($vendor != null){
            $vendorEmail = $vendor->getEmail();
            $vendorName = $vendor->getName();
            $vendorMobileno = $vendor->getMobileNo();
            $session = $this->getRequest()->getSession();
            $session->set('vendorName', $vendorName);
            $session->set('vendorEmail', $vendorEmail);
            $session->set('vendorMobileno', $vendorMobileno);
            
            $vendorPwd = $vendor->getVendorPwd();
            if($email ==$vendorEmail && $pwd == $vendorPwd){
                
                
                return $this->redirect($this->generateUrl('trip_booking_engine_vendor_registraion_form'));
            }
            
            else
            {
                $error='You entered an incorrect username or password';
                return $this->redirect($this->generateUrl('trip_booking_engine_vendor_confirm_login',array(
                    'error'   => $error,
                )));
                
            }
        }
        
        
        return $this->render('TripBookingEngineBundle:Default:vendorConfirmLogin.html.twig');
    }
    public function vendorResetPasswordAction(Request $request){
        
        
        return $this->render('TripBookingEngineBundle:Default:vendorResetPwd.html.twig');
    }
    public function vendorResetPasswordValidationAction(Request $request){
        $error='';
        $email = $this->get('request')->request->get('email');
        $pwd = $this->get('request')->request->get('pwd');
        $confirmpwd = $this->get('request')->request->get('confirmpwd');
        $em = $this->getDoctrine()->getManager();
        
        
        $vendor = $em->getRepository('TripBookingEngineBundle:VendorLogin')->findOneBy(
            array('email' => $email)
            );
        
        if($vendor != null){
            if($pwd == $confirmpwd){
                $qb = $em->createQueryBuilder();
                $q = $qb->update('Trip\BookingEngineBundle\Entity\VendorLogin', 'v')
                ->set('v.vendorPwd', $qb->expr()->literal($pwd))
                ->where('v.email = ?1')
                ->setParameter(1, $email)
                ->getQuery();
                $p = $q->execute();
                
                return $this->redirect($this->generateUrl('trip_booking_engine_vendor_confirm_login'));
                
            }
            else {
                $error = 'password and confirm password should be same';
                return $this->redirect($this->generateUrl('trip_booking_engine_vendor_reset_password',array(
                    'error'   => $error,
                )));
            }
            
        }
        else
        {
            $error='You are not registered with justtrip.in';
            return $this->redirect($this->generateUrl('trip_booking_engine_vendor_reset_password',array(
                'error'   => $error,
            )));
            
        }
        
        
        return $this->render('TripBookingEngineBundle:Default:vendorResetPwd.html.twig');
    }
    public function vendorProfileAction(Request $request){
        $paymentLink = '';
        $email = $_GET['email'];
        //$paymentLink = $_GET['paymentLink'];
       
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository('TripBookingEngineBundle:Vendor')->findOneBy(
            array( 'email' => $email)
            );
        $session = $this->getRequest()->getSession();
        $session->set('vendor', $vendor);
        $vendorId = $vendor->getVendorId();
        $paymentLink = $this->getVendorPaymentLink($request,$vendor,$vendorId);
        
        return $this->render('TripBookingEngineBundle:Default:vendorProfile.html.twig',array(
            'vendor' => $vendor,
            'paymentLink' => $paymentLink,
        ));
    }
    public function vendorEditLoginAction(Request $request){
        
        
        return $this->render('TripBookingEngineBundle:Default:vendorEditLogin.html.twig');
    }
    public function vendorEditValidateLoginAction(Request $request){
        $error='';
        $email = $this->get('request')->request->get('email');
        $pwd = $this->get('request')->request->get('pwd');
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository('TripBookingEngineBundle:Vendor')->findOneBy(
            array( 'vendorPwd' => $pwd,'email' => $email)
            );
        if($vendor != null){
            $vendorEmail = $vendor->getEmail();
            $vendorPwd = $vendor->getVendorPwd();
            if($email ==$vendorEmail &&  $pwd ==  $vendorPwd){
                
                
                return $this->redirect($this->generateUrl('trip_booking_engine_vendor_profile',array(
                    'email' => $email,
                )));
            }
        }
        else
        {
            $error='You entered an incorrect Email  or Password ';
            return $this->redirect($this->generateUrl('trip_booking_engine_vendor_edit_login',array(
                'error'   => $error,
            )));
            
        }
        
        
        return $this->render('TripBookingEngineBundle:Default:vendorEditLogin.html.twig');
    }
    private function createVendorAddVehicleForm(VendorVehicles $vendor,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $security = $this->container->get ( 'security.context' );
        
        $form = $this->createForm(new VendorNewVehicleType( $bookingService,$security), $vendor, array(
            'action' => $this->generateUrl('trip_booking_engine_vendor_add_vehicle',array(
                'id' => $id,
            )),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Add Vehicle'));
        
        return $form;
    }
    public function vendorAddVehicleAction(Request $request){
        $id = $_GET['id'];
        $amountPending =0;
        $vehicle = new VendorVehicles();
        
        $form =  $this->createVendorAddVehicleForm($vehicle,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $vendor = $em->getRepository('TripBookingEngineBundle:Vendor')->findOneBy(array( 'id' => $id));
            $registraionFee = $vendor->getRegistraionFee();
            $amountPending = $vendor->getAmountPending();
            $vehicle->setVendor($vendor);
            
            $collection = $vendor->getVehicles();
            $vehicleName = $vehicle->getVehicleName();
            // var_dump($vehicleName);
            $vendorVehicleFee = $em->getRepository('TripBookingEngineBundle:VendorVehicleFee')->findOneBy(
                array('vehicleName' => $vehicleName)
                );
            if($vendorVehicleFee != null){
                $vehicleFee = $vendorVehicleFee->getVehicleFee();
                $registraionFee = $registraionFee+$vehicleFee;
                $amountPending =$amountPending + $vehicleFee;
                $vendor->setRegistraionFee($registraionFee);
                $vendor->setAmountPending($amountPending);
                $em->merge($vendor);
            }
            
            
            $uploadedVehicleImage = $vehicle->getVehicleImage();
            if (!is_null($uploadedVehicleImage)) {
                $file_name = $uploadedVehicleImage->getClientOriginalName ();
                $dir = 'images/packages/';
                $uploadedVehicleImage->move ( $dir, $file_name );
                $vehicle->setVehicleImage ($file_name );
            }
            
            $uploadedVehicleRegisCer = $vehicle->getVehicleRegisCer();
            if (!is_null($uploadedVehicleRegisCer)) {
                $file_name = $uploadedVehicleRegisCer->getClientOriginalName ();
                $dir = 'images/packages/';
                $uploadedVehicleRegisCer->move ( $dir, $file_name );
                $vehicle->setVehicleRegisCer ($file_name );
            }
            $uploadedVehicleInsurance = $vehicle->getVehicleInsurance();
            if (!is_null($uploadedVehicleInsurance)) {
                $file_name = $uploadedVehicleInsurance->getClientOriginalName ();
                $dir = 'images/packages/';
                $uploadedVehicleInsurance->move ( $dir, $file_name );
                $vehicle->setVehicleInsurance ($file_name );
            }
            $uploadedVehiclePopulation = $vehicle->getVehiclePopulation();
            if (!is_null( $uploadedVehiclePopulation)) {
                $file_name = $uploadedVehiclePopulation->getClientOriginalName ();
                $dir = 'images/packages/';
                $uploadedVehiclePopulation->move ( $dir, $file_name );
                $vehicle->setVehiclePopulation ($file_name );
                
                
            }
           
            $vehicle->setInsertdate(date("d-m-Y"));
            $vehicle->setPaymentStatus('pending');
            $em->persist($vehicle);
            
            $em->flush();
            
            return $this->redirect($this->generateUrl('trip_booking_engine_vendor_profile',array(
                'email' => $vendor->getEmail(),
            )));
        }
        return $this->render('TripBookingEngineBundle:Default:vendorAddVehicle.html.twig',array(
            'form' => $form->createView(),
        ));
    }
    private function createVendorAddDriverForm(VendorDriver $driver,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $security = $this->container->get ( 'security.context' );
        
        $form = $this->createForm(new VendorNewDriverType( $bookingService,$security), $driver, array(
            'action' => $this->generateUrl('trip_booking_engine_vendor_add_driver',array(
                'id' => $id,
            )),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Add Driver'));
        
        return $form;
    }
    public function vendorAddDriverAction(Request $request){
        $id = $_GET['id'];
        
        
        $driver = new VendorDriver();
        
        $form =  $this->createVendorAddDriverForm($driver,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $vendor = $em->getRepository('TripBookingEngineBundle:Vendor')->findOneBy(array( 'id' => $id));
            
            $driver->setVendor($vendor);
            $collection = $vendor->getDrivers();
            
            $uploadedDrivingLicence = $driver->getDrivingLicence();
            if (!is_null($uploadedDrivingLicence)) {
                $file_name = $uploadedDrivingLicence->getClientOriginalName ();
                $dir = 'images/packages/';
                $uploadedDrivingLicence->move ( $dir, $file_name );
                $driver->setDrivingLicence ($file_name );
                
                
            }
            $uploadedDriverIdproof = $driver->getDriverIdproof();
            if (!is_null($uploadedDriverIdproof)) {
                $file_name = $uploadedDriverIdproof->getClientOriginalName ();
                $dir = 'images/packages/';
                $uploadedDriverIdproof->move ( $dir, $file_name );
                $driver->setDriverIdproof ($file_name );
                
            }
            $policeVerificationLetter = $driver->getPoliceVerificationLetter();
            if (!is_null($policeVerificationLetter)) {
                $file_name = $policeVerificationLetter->getClientOriginalName ();
                $dir = 'images/packages/';
                $policeVerificationLetter->move ( $dir, $file_name );
                $driver->setPoliceVerificationLetter ($file_name );
                
            }
            
            $em->persist($driver);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_booking_engine_vendor_profile',array(
                'email' => $vendor->getEmail(),
            )));
        }
        return $this->render('TripBookingEngineBundle:Default:vendorAddDriver.html.twig',array(
            'form' => $form->createView(),
        ));
    }
    public function vendorListDriversAction(Request $request){
        $id = $_GET['id'];
        
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository('TripBookingEngineBundle:Vendor')->findOneBy(array( 'id' => $id));
        
        $driverList = $em->getRepository('TripBookingEngineBundle:VendorDriver')->findBy(array( 'vendor' =>  $id));
        
        return $this->render('TripBookingEngineBundle:Default:vendorListDrivers.html.twig',array(
            'driverList' => $driverList,
        ));
    }
    public function vendorListVehiclesAction(Request $request){
        $id = $_GET['id'];
        
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository('TripBookingEngineBundle:Vendor')->findOneBy(array( 'id' => $id));
        
        $vehiclesList = $em->getRepository('TripBookingEngineBundle:VendorVehicles')->findBy(array( 'vendor' =>  $id));
        
        return $this->render('TripBookingEngineBundle:Default:vendorListVehicles.html.twig',array(
            'vehiclesList' => $vehiclesList,
        ));
    }
    public function vendorRemoveDriverAction(Request $request){
        $id = $_GET['id'];
        $session = $this->getRequest()->getSession();
        $vendor = $session->get('vendor');
        
        $em = $this->getDoctrine()->getManager();
        $vendorDriver = $em->getRepository('TripBookingEngineBundle:VendorDriver')->findOneBy(array( 'id' => $id));
        $id =  $vendorDriver->getId();
        
        $vendorDriver = $em->getRepository('TripBookingEngineBundle:VendorDriver')->find( $id);
        
        $em->remove($vendorDriver);
        $em->flush();
        return $this->redirect($this->generateUrl('trip_booking_engine_vendor_profile',array(
            'email' => $vendor->getEmail(),
        )));
        
    }
    public function vendorRemoveVehicleAction(Request $request){
        $id = $_GET['id'];
        $session = $this->getRequest()->getSession();
        $vendor = $session->get('vendor');
        $amountPending = $vendor->getAmountPending();
        $registraionFee = $vendor->getRegistraionFee();
        $em = $this->getDoctrine()->getManager();
        $vendorVehicle = $em->getRepository('TripBookingEngineBundle:VendorVehicles')->findOneBy(array( 'id' => $id));
        $id =  $vendorVehicle->getId();
        
        $vendorVehicle = $em->getRepository('TripBookingEngineBundle:VendorVehicles')->find( $id);
        $vehicleName = $vendorVehicle->getVehicleName();
        $vendorVehicleFee = $em->getRepository('TripBookingEngineBundle:VendorVehicleFee')->findOneBy(array( 'vehicleName' => $vehicleName));
        $vehicleFee =  $vendorVehicleFee->getVehicleFee();
        $paymentStatus = $vendorVehicle->getPaymentStatus();
        if($paymentStatus == 'pending'){
           
            $amountPending =$amountPending - $vehicleFee;
            $registraionFee = $registraionFee - $vehicleFee;
            $vendor->setAmountPending($amountPending);
            $vendor->setRegistraionFee($registraionFee);
            $em->merge($vendor);
        }
        $em->remove($vendorVehicle);
        $em->flush();
        return $this->redirect($this->generateUrl('trip_booking_engine_vendor_profile',array(
            'email' => $vendor->getEmail(),
        )));
    }
    private function createVendorEditProfileForm(Vendor $vendor,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $security = $this->container->get ( 'security.context' );
        $form = $this->createForm(new VendorRegistraionType($bookingService,$security), $vendor, array(
            'action' => $this->generateUrl('trip_booking_engine_vendor_edit_vendor',array(
                'id' => $id,
            ))));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    public function vendorEditProfileAction(Request $request){
        $id = $_GET['id'];
        //  $vendorNew = new Vendor();
        
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository('TripBookingEngineBundle:Vendor')->find($id);
        $uploadedPanfile =$vendor->getPancardid();
        $uploadedfile =$vendor->getidProof();
        $session = $this->getRequest()->getSession();
        
        $session->set('pan', $uploadedPanfile);
        $session->set('id', $uploadedfile);
        
        
        $form = $this->createVendorEditProfileForm($vendor,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $uploadedPanfile = $vendor->getPancardid();
            
            if (!is_null($uploadedPanfile)) {
                $file_name = $uploadedPanfile->getClientOriginalName ();
                $dir = 'images/packages/';
                $uploadedPanfile->move ( $dir, $file_name );
                $vendor->setPancardid ($file_name );
                
                
            }else{
                $vendor->setPancardid ($session->get('pan'));
            }
            $uploadedfile = $vendor->getidProof();
            if (!is_null($uploadedfile)) {
                $file_name = $uploadedfile->getClientOriginalName ();
                $dir = 'images/packages/';
                $uploadedfile->move ( $dir, $file_name );
                $vendor->setidProof ($file_name );
                
                
            }
            else{
                $vendor->setidProof ($session->get('id'));
            }
            
            $em->merge($vendor);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_booking_engine_vendor_profile',array(
                'email' => $vendor->getEmail(),
            )));
        }
        return $this->render('TripBookingEngineBundle:Default:vendorEditProfile.html.twig',array(
            'form' => $form->createView(),
            'vendor' => $vendor,
        ));
    }
    private function createVendorEditDriverForm(VendorDriver $driver,$id){
        $bookingService = $this->container->get( 'booking.services' );
        $security = $this->container->get ( 'security.context' );
        $form = $this->createForm(new VendorNewDriverType($bookingService,$security), $driver, array(
            'action' => $this->generateUrl('trip_booking_engine_vendor_edit_driver',array(
                'id' => $id,
            ))));
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }
    public function vendorEditDriverAction(Request $request){
        $id = $_GET['id'];
        
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        //$vendor = $em->getRepository('TripBookingEngineBundle:Vendor')->find($id);
       //$vendorDriver = $em->getRepository('TripBookingEngineBundle:VendorDriver')->findOneBy(array( 'id' => $id));
        //$id =  $vendorDriver->getId();
        
        $driver = $em->getRepository('TripBookingEngineBundle:VendorDriver')->find( $id);
        $vendorId = $driver->getVendor();
        $vendor = $em->getRepository('TripBookingEngineBundle:Vendor')->find($vendorId);
        $drivingLicence = $driver->getdrivingLicence();
        $driverIdproof = $driver->getdriverIdproof();
        $policeVerificationLetter = $driver->getPoliceVerificationLetter();
        $session = $this->getRequest()->getSession();
        $session->set('drivingLicence', $drivingLicence);
        $session->set('driverIdproof', $driverIdproof);
        $session->set('policeVerificationLetter', $policeVerificationLetter);
        
        
        $form = $this->createVendorEditDriverForm( $driver,$id);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $drivingLicence =  $driver->getdrivingLicence();
            
            if (!is_null($drivingLicence)) {
                $file_name = $drivingLicence->getClientOriginalName ();
                $dir = 'images/packages/';
                $drivingLicence->move ( $dir, $file_name );
                $driver->setdrivingLicence ($file_name );
                
                
            }else{
                $driver->setdrivingLicence ($session->get('drivingLicence'));
            }
            $driverIdproof =  $driver->getdriverIdproof();
            if (!is_null($driverIdproof)) {
                $file_name = $driverIdproof->getClientOriginalName ();
                $dir = 'images/packages/';
                $driverIdproof->move ( $dir, $file_name );
                $driver->setdriverIdproof ($file_name );
                
                
            }
            else{
                $driver->setdriverIdproof ($session->get('driverIdproof'));
            }
            $policeVerificationLetter =  $driver->getPoliceVerificationLetter();
            if (!is_null($policeVerificationLetter)) {
                $file_name = $policeVerificationLetter->getClientOriginalName ();
                $dir = 'images/packages/';
                $policeVerificationLetter->move ( $dir, $file_name );
                $driver->setPoliceVerificationLetter ($file_name );
                
                
            }
            else{
                $driver->setpoliceVerificationLetter ($session->get('policeVerificationLetter'));
            }
            
            $em->merge( $driver);
            $em->flush();
            return $this->redirect($this->generateUrl('trip_booking_engine_vendor_profile',array(
                'email' => $vendor->getEmail(),
            )));
        }
        return $this->render('TripBookingEngineBundle:Default:vendorEditDriver.html.twig',array(
            'form' => $form->createView(),
            'driver' =>  $driver,
        ));
    }
   
    public function getVendorPaymentLink($request,$vendor,$id){
        
        $session = $request->getSession ();
        $redirectUrl = $this->generateUrl ( 'trip_booking_engine_vendor_payment_success' );
        $redirectUrlFail = $this->generateUrl ( 'trip_booking_engine_vendor_payment_fail' );
        $data = $this->getVendorData($request,$vendor,$id,$redirectUrl,$redirectUrlFail);
        return  $data;
        $info['redirect_url']='https://test.payu.in/_payment';
        return $this->redirect($info['redirect_url']);
       
    }
   
    private function getVendorData($request,$vendor,$id,$redirectUrl,$redirectUrlFail){
        // Merchant key here as provided by Payu
        //$MERCHANT_KEY = "rjQUPktU";
        $MERCHANT_KEY = "ze3IGP8w";
        
        
        //$MERCHANT_KEY = "OwPbxU2k";
        //$SALT = "aa70fUA5Hh";
        // Merchant Salt as provided by Payu
        
        //$SALT = "e5iIg1jwi8";
        $SALT = "OAAknA88Xf";
        
        // End point - change to https://secure.payu.in for LIVE mode
        $PAYU_BASE_URL = "https://secure.payu.in";
        
        //testing Mode
        //$PAYU_BASE_URL = "https://test.payu.in";
        $bookingId = $id;
        $action = $PAYU_BASE_URL . '/_payment';
        //$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $txnid = 'PAYU'.$bookingId;
        $mobile = $vendor->getmobileNo ();
        $name = $vendor->getName ();
        $email = $vendor->getEmail ();
        $amount = $vendor->getAmountPending ();
        $host = $request->getHost ();
        
        $sUrl = 'http://' . $host . $redirectUrl.'?payment_id='.$txnid.'&status=success';
        $fUrl = 'http://' . $host . $redirectUrl.'?status=fail';
        
        
        $data = array();
        $data['key']= $MERCHANT_KEY;
        $data['txnid']= $txnid;
        $data['amount']=  $amount;
        $data['firstname']= $name;
        $data['email']= $email;
        $data['phone']= $mobile;
        $data['productinfo']= 'Justtrip Vendor';
        $data['surl']= $sUrl;
        $data['furl']= $fUrl;
        $data['service_provider']= 'payu_paisa';
        $hash = $this->getHash($data,$SALT);
         $data['hash']= $hash;
        $data['action']= $action;
        
        
        return $data;
        
        
    }
    
    public function vendorPaymentSuccessAction(Request $request)
    {
        
        
        $session = $request->getSession();
       // $slug = $session->get('slug');
       
        $paymentId = $request->get('payment_id');
        $status = $request->get('status');
       // $resultSet = $session->get('resultSet');
       // $searchFilter = $session->get('selectedData');
       // $selectedService = $session->get('selected');
        
        $vendor = $session->get('vendor');
        $amountPaid =  $vendor->getRegistraionFee();
       // $booking = $session->get('bookingObj');
       // $amountToPay = $session->get('amountToPay');
        $em = $this->getDoctrine()->getManager();
        if($status=='success'){
            $vendor->setStatus('Rigistered');
            $vendor->setAmountPaid($amountPaid);
            $vendor->setAmountPending(0);
            $em->merge($vendor);
            $em->flush();
            $email =  $vendor->getEmail();
            $name = $vendor->getName();
            $mobile = $vendor->getMobileno();
            $vendorId = $vendor->getVendorId();
            $vehicles = $em->getRepository('TripBookingEngineBundle:VendorVehicles')->findBy(array( 'vendor' => $vendor->getId()));
            //var_dump($vehicles);
            
            if($vehicles != ''){
                    var_dump($vehicles);
                foreach ($vehicles as $vehicle) {
                    var_dump($vehicle);
                    $vehicle->setPaymentStatus('paid');
                    $em->merge($vehicle);
                    $em->flush();
                }
            }
            //exit();
            $mail = "Dear $name <br> Your Vendor Registration has been Successfully completed.Your Vendor Id is $vendorId";
            $adminMail = "Dear Admin, $name <br> has done Vendor Registration Successfully and Vendor Id is $vendorId";
           
            
            $mailService = $this->container->get( 'mail.services' );
            $mailService->mail($email,'Just Trip:Vendor Registration Confirmation',$mail);
           
            $mailService->mail('info@justtrip.in','Just Trip:Vendor Registration Confirmation',$adminMail);
        }else{
            $status = 'fail';
        }
        
        
        return $this->render('TripBookingEngineBundle:Default:vendorPaymentSuccess.html.twig', array(
            'vendor'   => $vendor,
            'status'=>$status,
        ));
        
    }
    public function vendorListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $vendorList = $em->getRepository('TripBookingEngineBundle:Vendor')->findAll();
        return $this->render('TripBookingEngineBundle:Default:vendorList.html.twig', array(
            'vendorList'   => $vendorList,
            
        ));
        
    }
    public function vendorListViewMoreAction(Request $request)
    {
        $id = $request->get('vendorid');
        $em = $this->getDoctrine()->getManager();
        $vendorList = $em->getRepository('TripBookingEngineBundle:Vendor')->find( $id);
       
        return $this->render('TripBookingEngineBundle:Default:vendorListViewMore.html.twig', array(
            'vendor'   => $vendorList,
            
        ));
        
    }
    
    /**
     *
     * @param Search $entity
     * @return unknown
     */
    private function createHotelBookingForm(HotelCustomer $entity){
        $form = $this->createForm(new HotelCustomerType(), $entity, array(
            'action' => $this->generateUrl('trip_booking_engine_hotel_book_submit'),
            'method' => 'POST',
        ));
        
        return $form;
    }
    public function getSelectedRoom($hotel,$roomId){
        $rooms = $hotel->getHotelRooms();
        $selectedRoom = null;
        foreach($rooms as $room){
            if($room->getId()==$roomId)
                $selectedRoom = $room;
        }
        //var_dump($selectedRoom);
        //exit();
        return $selectedRoom;
    }
   
    /**
     *
     * @param Request $request
     */
    public function hotelBookRoomAction(Request $request)
    {
        $id = $request->get('roomId');
        $room = $request->get('hotelId');
        $session = $request->getSession();
        $session->set('roomId',$id);
        $session->set('hotelId',$room);
      
        $searchHotel = $session->get('searchHotel');
       // var_dump($searchHotel);exit();
        $numDay = $session->get('numDay');
        $numRoom = $session->get('numRoom');
        if($numDay==null && $numRoom==null){
            $numDay=1;
            $numRoom = 1;
        }
        
      
        
        $search = $session->get('search');
        //var_dump($search);
        //exit();
        
        $customer = new HotelCustomer();
        $form   = $this->createHotelBookingForm($customer);
        $em = $this->getDoctrine()->getManager();
        $hotel = $em->getRepository('TripSiteManagementBundle:Hotel')->find($room);
        $hotelRoom = $em->getRepository('TripSiteManagementBundle:HotelRoom')->findOneBy(array( 'id' => $id));
       
        $booking = new HotelRoomBooking();
        $price = $hotelRoom->getPrice();
        $hotelname = $hotel->getName();
        //var_dump($hotelname);exit();
        
        $session->set('hotelname',$hotelname);
        $promotionStartDate = $hotelRoom->getPromotionStartDate();
        $promotionEndDate = $hotelRoom->getPromotionEndDate();
        $rooomPromoprice = $hotelRoom->getPromotionPrice();
        $roomType = $hotelRoom->getRoomType();
        $today = new \DateTime();
        //$today = $today->format('d/m/Y');
        if(($promotionStartDate<=$today) && ($today<=$promotionEndDate) )
        {
            
            $newtotalprice = $rooomPromoprice*$numDay*$numRoom;
        }
        else
        {
            $newtotalprice = $price*$numDay*$numRoom;
        }
        
      
        
        
        $serviceTax = 0;
        $taxPercentage = 0;
        
        
        if($newtotalprice>999 && $newtotalprice<2499){
            $taxPercentage = 12;
        }elseif($newtotalprice>2499 && $newtotalprice<7499){
            $taxPercentage = 18;
        }elseif($newtotalprice>7499){
            $taxPercentage = 24;
        }
        
        //$serviceTax = round(($price*$numDay*$taxPercentage/100),2);
        $serviceTax = round(($newtotalprice*$taxPercentage/100),2);
        
        $totalTax = $serviceTax;
        //$finalPrice = $price+$totalTax;
        $finalPrice = $newtotalprice+$totalTax;
        //me	$booking->setTotalPrice($price);
        
        $booking->setTotalPrice($newtotalprice);
        $booking->setServiceTax($serviceTax);
        $booking->setDiscount(0);
        $booking->setCouponApplyed(0);
        $booking->setFinalPrice($finalPrice);
        
        //echo var_dump($booking);
        //exit();
        
        $session->set('taxPercentage',$taxPercentage);
        $session->set('booking',$booking);
        
        
        
        
      
        $customer = new HotelCustomer();
        $form   = $this->createHotelBookingForm($customer);
        $em = $this->getDoctrine()->getManager();
        $hotel = $em->getRepository('TripSiteManagementBundle:Hotel')->find($room);
     
        
    
       // var_dump($hotel);
       // exit();
        
        
        $session->set('selected',$hotel);
        
        $session->set('selectedRoom',$hotelRoom);
        $booking = $session->get('booking');
        
        
        //echo var_dump($session);
        //exit();
        
        $price = $hotelRoom->getPrice();
        $promotionStartDate = $hotelRoom->getPromotionStartDate();
        $promotionEndDate = $hotelRoom->getPromotionEndDate();
        $rooomPromoprice = $hotelRoom->getPromotionPrice();
        $roomType = $hotelRoom->getRoomType();
        $session->set('roomType',$roomType);
        $today  = new \DateTime();
        return $this->render('TripBookingEngineBundle:Default:bookRoom.html.twig', array(
            'form'   => $form->createView(),
            'customer'=> $customer,
            'hotel'=> $hotel,
            'searchHotel'=> $searchHotel,
            'room' =>$room,
            'booking'=> $booking,
            'search'=>$search,
            'step'=> 'review',
            'numDay'=>$numDay,
            'numRoom'=>$numRoom,
            'today'=>$today,
            'roomprice'=>$price,
            'rooomPromoprice'=>$rooomPromoprice,
            'promotionStartDate'=>$promotionStartDate,
            'promotionEndDate'=>$promotionEndDate,
            'taxPercentage'=>$taxPercentage,
            'roomType'=>$roomType,
            'session'=>$session,
            'hotelRoom'=>$hotelRoom
        ));
    }
    public function bookHotelSubmitAction(Request $request)
    {
        
        
        $session = $request->getSession();
        $resultSet = $session->get('resultSet');
        $searchFilter = $session->get('selectedData');
        $selectedService = $session->get('selected');
        $searchHotel = $session->get('searchHotel');
        $locations = $session->get('locations');
        $guest = $session->get('guest');
        
        
        $customer = new HotelCustomer();
        //$customer->setEmail($guest->getEmail());
        // $customer->setMobile($guest->getMobile());
        $form   = $this->createHotelBookingForm($customer);
        $form->handleRequest($request);
        //var_dump($customer);exit();
        if ($form->isValid()) {
            $couponApplyed = $customer->getHaveCoupon();
            $couponCode = $customer->getCouponCode();
            $paymentMode = $customer->getPaymentMode();
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
            $session->set('customer',$customer);
           
            $finalPrice = $session->get('finalprice');
           
            $booking = new HotelBooking();
            $booking->setCustomerId($customer->getId());
            $booking->setBookingId($this->getBookingId());
            $booking->setTotalPrice($session->get('totalprice'));
            $booking->setFinalPrice($finalPrice);
            $booking->setStatus('pending');
            $booking->setJobStatus('Open');
            $booking->setBookedOn(new \DateTime());
            $booking->setNumDays($session->get('numDay'));
            $booking->setNumRooms($searchHotel->getNumRooms());
            $booking->setNumAdult($searchHotel->getNumAdult());
            $booking->setChekIn($searchHotel->getDate());
            $booking->setChekOut($searchHotel->getReturnDate());
            $booking->setLocation($searchHotel->getGoingTo());
            $booking->setHotelId($session->get('hotelId'));
            $booking->setRoomId($session->get('roomId'));
            $booking->setHotelName($session->get('hotelname'));
            //$booking->setPreferTime($searchHotel->getPreferTime());
            $discount = 0;
            if($couponApplyed){
                $booking->setCouponApplyed(1);
                $booking->setCouponCode($couponCode);
                $booking->setDiscount(50);
                $discount = 50;
            }else{
                $booking->setCouponApplyed(0);
                $booking->setDiscount($discount);
            }
            
           
            }
            $booking->setPaymentMode($paymentMode);
            
            $amountToPay = $finalPrice;
            $tax = 0;
            if($paymentMode=='advance'){
                $amountToPay = round($finalPrice*(50/100));
               
            }else{
                $amountToPay = round($finalPrice*(30/100));
            
            }
            $serviceTax = round($finalPrice*(5.6/100),2);
          
            $booking->setServiceTax($session->get('taxprice'));
           
            $booking->setFinalPrice($finalPrice);
            $em->persist($booking);
            $em->flush();
            $session->set('bookingObj',$booking);
            $session->set('amountToPay',$finalPrice);
           // var_dump($finalPrice);exit();
            $paymentLink = $this->getHotelPaymentLink($request,$finalPrice,$customer,$booking);
           
           
            $payuLink = $this->generateUrl ( 'trip_booking_engine_payment_payu' );
         
            return $this->render('TripBookingEngineBundle:Default:hotelPayment.html.twig', array(
                'customer'   => $customer,
                'booking'   => $booking,
                'step'=>'payment',
                'service'=>$selectedService,
                'filter'=>$searchFilter,
                'discount'=>$discount,
                'paymentLink'   => $paymentLink,
                'payuLink' => $payuLink,
                'locations' => $locations,
            ));
        }
       
        public function hotelPaymentSuccessAction(Request $request)
        {
            
            
            $session = $request->getSession();
          
            $paymentId = $request->get('payment_id');
            $status = $request->get('status');
            $resultSet = $session->get('resultSet');
            $searchFilter = $session->get('selectedData');
            $selectedService = $session->get('selected');
            $searchHotel = $session->get('searchHotel');
            $address = $session->get('address');
            $addressLine1 = $address->getAddressLine1();
            $addressLine2 = $address->getAddressLine2();
            $addressLocation = $address->getLocation();
            $addressCity = $address->getCity();
            $checkIn = $searchHotel->getDate();
            $checkOut = $searchHotel->getReturnDate();
            $location = $searchHotel->getGoingTo();
            if($location ==1){
                $goingTo="Tirupati";
            }
            else {
                $goingTo="Bangalore";
            }
            $numAdult = $searchHotel->getNumAdult();
            $numChildren = $searchHotel->getNumChildren();
            $numRooms = $searchHotel->getNumRooms();
            $customer = $session->get('customer');
            $hotelname = $session->get('hotelname');
            $booking = $session->get('bookingObj');
            $amountToPay = $session->get('finalprice');
            $roomType = $session->get('roomType');
            $em = $this->getDoctrine()->getManager();
            if($status=='success'){
                $booking->setStatus('booked');
                $paymentMode = $booking->getPaymentMode();
                $finalPrice = $booking->getFinalPrice();
                
                $booking->setAmountPaid($amountToPay);
                $booking->setPaymentId($paymentId);
                $em->merge($booking);
                $em->flush();
                $email =  $customer->getEmail();
                $name = $customer->getName();
                $mobile = $customer->getMobile();
                $bookingId = $booking->getBookingId();
                $mail = "Dear $name <br> Your Booking has been Successfully completed.Your Booking Id is $bookingId";
                $adminMail = "Dear Admin,  <br>$name has Done Booking Successfully and Booking Id is $bookingId";
                $mail .= "<div class=row>
<p>*Here are your booking details :*</p>
                              
<p>Location&nbsp; : &nbsp;$goingTo</p>
                                        <p>Hotel Name&nbsp;:&nbsp;$hotelname</p>
                                        <p>Check-In&nbsp;:&nbsp;$checkIn</p>
                                        <p>Check-Out&nbsp;:&nbsp;$checkOut</p>
                                        <p>Room-Type&nbsp;:&nbsp;$roomType</p>
                                        <p>Guests &nbsp;:&nbsp;$numAdult &nbsp;Adults&nbsp;$numChildren&nbsp;Childs</p>
                                        <p>Rooms &nbsp;:&nbsp; $numRooms</p>
                                        <p>Total Price &nbsp;:&nbsp; $amountToPay</p>
                                         <p>Address &nbsp;:&nbsp; $addressLine1,&nbsp;$addressLine2,&nbsp;$addressLocation,&nbsp;$addressCity </p>
  

                            </div>";
				$adminMail .= "<div class=container>
                               
                                        <p>Location&nbsp; : &nbsp;$goingTo</p>
                                        <p>Hotel Name&nbsp;:&nbsp;$hotelname</p>
                                        <p>Check-In&nbsp;:&nbsp;$checkIn</p>
                                        <p>Check-Out&nbsp;:&nbsp;$checkOut</p>
                                        <p>Room-Type&nbsp;:&nbsp;$roomType</p>
                                        <p>Guests &nbsp;:&nbsp;$numAdult &nbsp;Adults&nbsp;$numChildren&nbsp;Childs</p>
                                        <p>Rooms &nbsp;:&nbsp; $numRooms</p>
                                        <p>Total Price &nbsp;:&nbsp; $amountToPay</p>
                                         <p>Address &nbsp;:&nbsp; $addressLine1,&nbsp;$addressLine2,&nbsp;$addressLocation,&nbsp;$addressCity </p>
                               
                            </div>";
                
                $mailService = $this->container->get( 'mail.services' );
                $mailService->mail($email,'Just Trip:Hotel Booking Confirmation',$mail);
                $mailService->mail('Payment@justtrip.in','Just Trip:Booking Confirmation',$adminMail);
                $mailService->mail('info@justtrip.in','Just Trip:Hotel Booking Confirmation',$adminMail);
            }else{
                $booking->setStatus('fail');
                $em->merge($booking);
                $em->flush();
            }
            
            
            return $this->render('TripBookingEngineBundle:Default:hotelSuccess.html.twig', array(
                'customer'   => $customer,
                'service'=>$selectedService,
                'filter'=>$searchFilter,
                'status'=>$status,
            ));
            
        }
    
    //**************End************//
}
