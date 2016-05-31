<?php

namespace  Trip\SiteManagementBundle\DependencyInjection;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
/**
 * This is an Adoptor for booking engine server.    
 *
 */
class MailServices
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
    /**
     *
     * @param unknown $email
     * @param unknown $subject
     * @param unknown $body
     */
    public function mail($email,$subject,$body){
    	try{
    		$message = \Swift_Message::newInstance()
    		->setSubject($subject)
    		->setFrom(array('noreply@justtrip.in'=>'Just Trip'))
    		->setTo($email)
            ->setReplyTo('support@justtrip.in')
    		->setBody($body, 'text/html');
    
    		$this->container->get('mailer')->send($message);
    
    	}catch(\Exception $e){
        		   
    	}
    }
    /**
     *
     * @param unknown $email
     * @param unknown $subject
     * @param unknown $body
     */
    public function mailWithCC($email,$subject,$body,$CC){
    	try{
    		$message = \Swift_Message::newInstance()
    		->setSubject($subject)
    		->setFrom(array('noreply@justtrip.in'=>'Just Trip'))
    		->setTo($email)
            ->setCc($CC)
            ->setReplyTo('support@justtrip.in')
    		->setBody($body, 'text/html');
    
    		$this->container->get('mailer')->send($message);
    
    	}catch(\Exception $e){
        		   
    	}
    }
    
	
}
