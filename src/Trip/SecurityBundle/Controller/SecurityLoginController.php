<?php

namespace Trip\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityLoginController extends Controller
{
    public function loginAction()
    {
        
        $request = $this->container->get('request');
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
    	$session->set('id',$id);
    	$session->set('title',$title);
    	$session->set('pDate',$pDate);
    	$session->set('rDate',$rDate);
    	$session->set('price',$price);
    	$session->set('leftdays',$leftdays);
    	$session->set('hours',$hours);
    	$session->set('location',$location);
    	$session->set('countadd',$countadd);
    	$session->set('count',$count);
    	$session->set('bikearea',$bikearea);
    	$session->set('countinsert',$countinsert);
    	
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
    	       'id' => $id,
    	));
       // return $this->render('TripSecurityBundle:Default:login.html.twig');
    }
}
