<?php
namespace Trip\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
/**
 * This is a RegistrationController for all the login detail in
 * Drivekool application.
 *
 * @author 4th Dymension Teknocrats
 * @copyright   <a> 4th Dymension Teknocrats India LLP - 2014</a>
 */
class RegistrationController extends BaseController
{
	/**
	 * 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
    public function registerAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $user = $userManager->createUser();

        $referer = $request->headers->get('referer');

        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);
        $session = $request->getSession();
        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
            	$session->set('regFail',false);
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $id = $session->get('id');
                    $title = $session->get('title');
                    $pDate = $session->get('pDate');
                    $rDate = $session->get('rDate');
                    $price = $session->get('price');
                    $leftdays = $session->get('leftdays');
                    $hours = $session->get('hours');
                    $location = $session->get('location');
                    $bikearea = $session->get('bikearea');
                    $countinsert = $session->get('countinsert');
                    if(null !== $id){
                        
                        $url = $this->container->get('router')->generate('trip_booking_engine_book_bike_submit',array('id'=>$id,'title'=>$title,'pDate'=>$pDate,'rDate'=>$rDate,'price'=>$price,'leftdays'=>$leftdays,'hours'=>$hours,'location'=>$location,'countinsert'=>$countinsert,'bikearea'=>$bikearea));
                    }    
                    else{
                        $url = $this->container->get('router')->generate('trip_site_management_homepage');
                    }
                   // $url = $this->container->get('router')->generate('trip_site_management_homepage');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
            else
            {
               
                $session->set('regFail',true);
                $session->set('loginfail',false);
                return $this->render('TripSecurityBundle:Default:login.html.twig', array(
                		'form' => $form->createView(),
                ));
            }
        }
        return $this->render('FOSUserBundle:Registration:register.html.twig', array(
        		'form' => $form->createView(),
        ));
    }
    /**
     * 
     * @param Request $request
     * @param unknown $token
     */
    public function confirmAction(Request $request, $token)
    {
    	$userManager = $this->container->get('fos_user.user_manager');
    
    	$user = $userManager->findUserByConfirmationToken($token);
    
    	if (null === $user) {
    
    		/* ************************************
    		 *
    		* User with token not found. Do whatever you want here
    		*
    		* e.g. redirect to login:
    		**************************************/
    		
    		//return $this->container->get('templating')->renderResponse('DriveHomeBundle:Registration:link_error.html.twig');
    		
    		return $this->render('TripSecurityBundle:Registration:link_error.html.twig');
    
    	}
    	else{
    		// Token found. Letting the FOSUserBundle's action handle the confirmation
    		return parent::confirmAction($request, $token);
    	}
    }
    
    
}