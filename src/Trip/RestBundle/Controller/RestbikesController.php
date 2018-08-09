<?php

namespace Trip\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Trip\BookingEngineBundle\Form\SearchType;
use Trip\BookingEngineBundle\DTO\SearchFilter;
use Trip\BookingEngineBundle\Form\SearchHotelType;
use Trip\BookingEngineBundle\DTO\SearchHotel;
use Trip\BookingEngineBundle\Entity\Customer;
use Trip\BookingEngineBundle\DTO\Customer as CustomerDto;
use Trip\BookingEngineBundle\DTO\NewPackage;
use Trip\BookingEngineBundle\Entity\Booking;
use Trip\BookingEngineBundle\Entity\BikeBooking;
use Trip\BookingEngineBundle\Entity\Pickup;
use Trip\BookingEngineBundle\Entity\Drop;
use Trip\BookingEngineBundle\Entity\PlacesToVisit;
use Trip\BookingEngineBundle\Entity\VehicleBooking;
use Trip\BookingEngineBundle\Entity\HotelBooking;
use Trip\BookingEngineBundle\Entity\Billing;
use Trip\BookingEngineBundle\Form\CustomerType;
use Trip\BookingEngineBundle\Form\BillingType;
use Trip\BookingEngineBundle\Form\EditCustomerType;
use Trip\BookingEngineBundle\Form\NewPackageType;
use Trip\BookingEngineBundle\Form\GuestType;
use Trip\BookingEngineBundle\Form\CustomPackageType;
use Trip\SiteManagementBundle\Entity\Contact;
use Trip\SiteManagementBundle\Entity\City;
use Trip\SiteManagementBundle\Form\ContactType;

use Trip\SiteManagementBundle\Entity\Biketime;
use Trip\SiteManagementBundle\Form\biketimerangeType;
use Trip\SiteManagementBundle\Form\PriceviewbikesType;

use Trip\BookingEngineBundle\DependencyInjection\Instamojo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


class RestbikesController extends Controller
{
	
    public function bikesonRentAction(Request $request)
    {
    	header("Access-Control-Allow-Origin: *");
    	
    	$bikesearchList = array();
    	$locationinfoList = array();
    	
		$search = $request->get('search');
		$city = $request->get('city');
		$isPackage = $request->get('isPackage');
		//$city = 1;
		
		$em = $this->getDoctrine()->getManager();
    	//$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
    	$locations = $em->getRepository('TripSiteManagementBundle:BikesCityArea')->findBy(array('cityid'=>$city));
		$locations = $this->getLocationsByBike($locations);
		 $leftDays = 0;
    	 $hours = 0;
		if($search==1){
    	$date = $request->get('date');
		//$date = '27-04-2018';
		date_default_timezone_set('Asia/Kolkata');
    	$date = new \DateTime($date);
    	$returnDate = $request->get('returnDate');
		//$returnDate = '29-04-2018';
    	$returnDate = new \DateTime($returnDate);
		$location = $request->get('location');
		 $difference=date_diff($date,$returnDate);
    	 $leftDays = $difference->days;
    	 $hours = $difference->h;
		}
		
		
		//if($isPackage){
		$packages = $em->getRepository('TripSiteManagementBundle:bikespackage')->findAll();
		$packages = $this->getPackagesByBike($packages);
		//}else{
			//$packages = array();
		//}
		
		$result=$this->getResultbybikes();
		$resultset=$this->getResultbybikescal($result,$leftDays,$hours,$locations,$packages);
    	
    	
    	$data['success']=true;
    	$extras['msg']='';
    	$extras['bikesearchList'] = $resultset;
    	
    	$data['extras']=$extras;
    	return new Response (json_encode($data));
    	    	
    }
	
	
	
	
	
	 public function priceOnChangeAction(Request $request)
    {
    	header("Access-Control-Allow-Origin: *");
    	
		
		$em = $this->getDoctrine()->getManager();

		
		$date = $request->get('date');
		//$date = '27-04-2018';
    	$date = new \DateTime($date);
    	$returnDate = $request->get('returnDate');
		//$returnDate = '29-04-2018';
    	$returnDate = new \DateTime($returnDate);
		$location = $request->get('location');
		$isPackage = $request->get('isPackage');
		$difference=date_diff($date,$returnDate);
    	$leftDays = $difference->days;
    	$hours = $difference->h;
		
		$price = 0;
		$dayrent = $request->get('dayrent');
		$startprice = $request->get('startprice');
		if(($leftDays>0)|| ($hours>0)){
		if ($hours <= 10){							
				$inc= $hours * $startprice;
				$dayscal= $leftDays * $dayrent;
				$price=$dayscal + $inc;
			}else{
				$totaldays= $leftDays + 1;
				$price=$totaldays * $dayrent;	
			}
		}
		
            $bike['price']= $price;
		
		$data['success']=true;
    	$extras['msg']='';
    	$extras['bikedetails'] = $bike;
    	//$extras['locationinfoList'] = $locationinfoList;
    	$data['extras']=$extras;
    	return new Response (json_encode($data));
		
	}
    
    public function getLocationsByIndex($locations){
    	$temp = array();
    	foreach($locations as $location){
    		$temp[$location->getId()]=$location;
    
    	}
    	return $temp;
    }
	public function getLocationsByBike($locations){
    	$temp = array();
    	foreach($locations as $location){
			$bikeId = $location->getBikeId();
			$bikeLocation = array();
			$bikeLocation['id'] = $location->getId();
			$bikeLocation['bikeId'] = $location->getBikeId();
			$bikeLocation['name'] = $location->getArea();
			if(array_key_exists($bikeId, $temp))
				$bikeLocations = $temp[$bikeId];
			else
				$bikeLocations = array();
				
				$bikeLocations[] = $bikeLocation;
				
    		$temp[$bikeId]=$bikeLocations;
    
    	}
    	return $temp;
    }
	public function getPackagesByBike($packages){
    	$temp = array();
    	foreach($packages as $package){
			$bikeId = $package->getBikeId();
			$bikePackage = array();
			$bikePackage['id'] = $package->getId();
			$bikePackage['bikeId'] = $package->getBikeId();
			$bikePackage['name'] = $package->getPackagename();
			$bikePackage['packageprice'] = $package->getPackageprice();
			$bikePackage['packageoffer'] = $package->getPackageoffer();
			$bikePackage['packagekmlimit'] = $package->getPackagekmlimit();
			$bikePackage['packageexcesskm'] = $package->getPackageexcesskm();
			$bikePackage['packageadditionalkmlimit'] = $package->getPackageadditionalkmlimit();
			$bikePackage['packageadditionalpriceday'] = $package->getPackageadditionalpriceday();
			if(array_key_exists($bikeId, $temp))
				$bikePackages = $temp[$bikeId];
			else
				$bikePackages = array();
				
				$bikePackages[] = $bikePackage;
				
    		$temp[$bikeId]=$bikePackages;
    
    	}
    	return $temp;
    }
	
	public function getResultbybikes(){
        $em = $this->getDoctrine()->getManager();
        $dql3 = "SELECT b.id,b.dayrent,b.kmlimit,b.statingPrice,b.imgPath,b.locationUrl,b.title,b.count,b.location
        from TripSiteManagementBundle:bikes b where b.active=1 order by b.sequence DESC";
        
        $query = $em->createQuery($dql3);
        $result = $query->getResult();
        
        //$bikes = $em->getRepository('TripSiteManagementBundle:bikes')->findAll();
        return $result;
    }
	
	
	 public function getResultbybikescal($result,$leftDays,$hours,$locations,$packages){
       
        $tempCollection = array();
        foreach($result as $row){
            $bike = array();
			 $id = $row['id'];
            $bike['id']=$row['id'];
            $bike['dayrent']=$row['dayrent'];
            $bike['statingPrice']=$row['statingPrice'];
            $imgPath = $row['imgPath'];
			$imgPath =  'http://www.justtrip.in/images/bikes/'.$imgPath;
			$bike['imgPath']=$imgPath;
            $bike['locationUrl']=$row['locationUrl'];
            $bike['title']=$row['title'];
			  $bike['leftDays']=$leftDays;
			    $bike['hours']=$hours;
            $bike['count']=$row['count'];
            $bike['location']=$row['location'];
            $bike['kmlimit']=$row['kmlimit'];
			$price = 0;
			$inc = 0;
			$dayrent=$bike['dayrent'];
			$startprice=$bike['statingPrice'];
			if(($leftDays>0)|| ($hours>0)){
					if ($hours>0 && $hours <= 5){
							$inc= 5 * $startprice;
							$dayscal= $leftDays * $dayrent;
					}elseif ($hours <= 10){							
							$inc= $hours * $startprice;
							$dayscal= $leftDays * $dayrent;
						}else{
							if ($hours>0)
							$totaldays= $leftDays + 1;
							else
							$totaldays= $leftDays;
							$dayscal=$totaldays * $dayrent;	
						}
					if($leftDays<7){
						$dayscal = $dayscal;
					}elseif($leftDays<15){
						$dayscal = $dayscal*0.80;
					}elseif($leftDays<30){
						$dayscal = $dayscal*0.70;
					}else{
						$dayscal = $dayscal*0.50;
					}
					
					$price=$dayscal + $inc;
					
				}
		
            $bike['price']= $price;
			
			
			if(array_key_exists($id, $locations))
				$bike['locations'] = $locations[$id];
			else
				$bike['locations'] = array();
			if(array_key_exists($id, $packages))
				$bike['packages'] = $packages[$id];
			else
				$bike['packages'] = array();
			
            $tempCollection[]=$bike;
        }
    	
    
    	return $tempCollection;
	}
	 public function bikebookingsubmitAction(Request $request){

    	header("Access-Control-Allow-Origin: *");
    	$em = $this->getDoctrine()->getManager();
    	
    	$id = $request->get('id');
    	//$imgPath = $request->get('imgPath');
    	$title = $request->get('title');
    	$location = $request->get('location');
    	$statingPrice = $request->get('statingPrice');
    	$dayrent = $request->get('dayrent');

    	$dropdate = $request->get('dropdate');
    	$pickupdate = $request->get('pickupdate');
		$city = $request->get('city');  	
    	$totalPrice = $request->get('totalPrice');
    	
    	$name = $request->get('name');
    	$email = $request->get('email');
    	$mobileno = $request->get('mobileno');
    	$paymentMode = $request->get('paymentmode');
    	
    	


    	$pDate = new \DateTime($pickupdate);
    	$rDate = new \DateTime($dropdate);
		$difference=date_diff($pDate,$rDate);
    	$days = $difference->days;
    	$hours = $difference->h;

    	$customer = new Customer();
    	$customer->setName($name);
    	$customer->setEmail($email);
    	$customer->setMobile($mobileno);
		
		$em = $this->getDoctrine()->getManager();
    	$em->persist($customer);
    	$em->flush();

    		$booking = new Booking();
    		$booking->setCustomerId($customer->getId());
    		$bookingId = $this->getBookingId();
    		$booking->setBookingId($bookingId);
    		$booking->setStatus('pending');
    		$booking->setJobStatus('Open');
    		$booking->setBookedOn(new \DateTime());
    		$booking->setNumDays($days);
    		$booking->setNumAdult($hours);
    		$booking->setPreferTime($title);
    	
    		$bikebooking= new BikeBooking();
    		$bikebooking->setPrice($totalPrice);
    		$bikebooking->setBikeId($id);
    		$bikebooking->setBikeName($title);
    		$bikebooking->setPdate($pickupdate);
    		$bikebooking->setRdate($dropdate);
    		$bikebooking->setLeftdays($days);
    		$bikebooking->setHours($hours);
    		$bikebooking->setBikelocation($city);
            $bikebooking->setBikearea($location);
    		$booking->setBikeBooking($bikebooking);
    		$discount = 0;
    		$couponApplyed= 0;
    		if($couponApplyed){
    			$booking->setCouponApplyed(1);
    			$booking->setCouponCode($couponCode);
    			$booking->setDiscount(50);
    			$discount = 50;
    		}else{
    			$booking->setCouponApplyed(0);
    		}
    	
    		$booking->setPaymentMode($paymentMode);
			
			$serviceTax = round($totalPrice*(18/100),2);
    		$finalPrice = $totalPrice+$serviceTax;
			$booking->setTotalPrice($totalPrice);
    		$booking->setServiceTax($serviceTax);
    		$booking->setFinalPrice($finalPrice);
    	
    	
    		$bikebooking->setBooking($booking);
    	
    		$em->persist($booking);
    		$em->flush();
    		
			$bikepaymentList['bikeName']=$title;
    		$bikepaymentList['pickupdate']=$pickupdate;
    		$bikepaymentList['dropdate']=$dropdate;
    		$bikepaymentList['location']=$location;
    		$bikepaymentList['name']=$name;
    		$bikepaymentList['email']=$email;
    		$bikepaymentList['mobileno']=$mobileno;
    		$bikepaymentList['totalPrice']=$totalPrice;
			$bikepaymentList['gst']=$serviceTax;
			$bikepaymentList['finalPrice']=$finalPrice;
    		$bikepaymentList['bookingId']=$bookingId;
    		$bikepaymentList['days']=$days;
			$bikepaymentList['hours']=$hours;
    		$data['success']=true;
    		$extras['msg']='';
    		$extras['bikepaymentList'] = $bikepaymentList;
    		$data['extras']=$extras;
    		return new Response (json_encode($data));

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
	
}