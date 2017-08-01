<?php

namespace  Trip\BookingEngineBundle\DependencyInjection;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Trip\BookingEngineBundle\DTO\Catalogue;
/**
 * This is an Adoptor for booking engine server.    
 *
 */
class BookingServices
{
	private $container;
	private $em;
	private $session;
	private $logger;
	
	/**
	 * Constructor 
	 * @param EntityManager $entityManager
	 * @param ContainerInterface $container
	 * @param unknown $session
	 */
	public function __construct(EntityManager $entityManager,ContainerInterface $container,$session)
	{
		$this->session = $session;
		$this->container = $container;
        $this->em = $entityManager;
		$this->logger = $this->container->get('logger');
    }
    public function getLocations(){
        $locations = $this->em->getRepository('TripSiteManagementBundle:City')->findAll();
        return $locations;
    }
    public function getVehicles(){
        $vehicles = $this->em->getRepository('TripBookingEngineBundle:Vehicle')->findAll();
        return $vehicles;
    }
    
    public function getDriver(){
    	
    	$drivers = $this->em->getRepository('TripSiteManagementBundle:Driver')->findAll();
    	return $drivers;
    }
    public function getDriverByIndex($drivers)
    {
    	$tempDriver = array();
    	foreach ($drivers as $driver){
    		$tempDriver[$driver->getId()] = $driver;
    	}
    	return $tempDriver;
    }
	
	/**
	* Get catalog service. Will be calleat at entry. 
	* This metod shouyld chek the cache srvice for availability, before calling the 
	* API service ????
	*  
	* @param unknown $result
	* @param unknown $sub
	* @param unknown $mailer
	*/
	public function getCatalog(){
		$catalogue = $this->session->get('catalogue');
		//if(is_null($catalogue)){
			try{
                $catalogue = new Catalogue();
				$locations = $this->getLocations();
                $vehicles = $this->getVehicles();
                $catalogue->setLocations($locations);
                $catalogue->setVehicles($vehicles);
			}catch(\Exception $ex){ 
				//throw new ApplicationException();
			}
			$this->session->set('catalogue',$catalogue);
		//}
		return $catalogue;			
	}
        public function getPackageList(){
        $packagelist = $this->em->getRepository('TripSiteManagementBundle:Package')->findAll();
        return $packagelist;
    }
	
	
	
}
