<?php

namespace Trip\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityLoginController extends Controller
{
    public function loginAction()
    {
        return $this->render('TripSecurityBundle:Default:login.html.twig');
    }
}
