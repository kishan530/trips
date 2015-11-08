<?php

namespace Trip\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityLoginController extends Controller
{
    public function loginAction()
    {
        
        $request = $this->container->get('request');
    	$session = $request->getSession();
    	$session->set('regFail',false);
    	$error =$session->get('error');
    	if(!$error)
    	{
    		$session->set('loginfail',false);
    	}
    	$csrf_token=$session->get('csrf');
    	$last_username=$session->get('last_username');
    	return $this->render('TripSecurityBundle:Default:login.html.twig',array('error'=>$error,
    			'last_username'=>$last_username,
    			'csrf_token'=>$csrf_token,
    	));
       // return $this->render('TripSecurityBundle:Default:login.html.twig');
    }
}
