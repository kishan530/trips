<?php

namespace Trip\SecurityBundle\Controller;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use \BaseFacebook;
use \FacebookApiException;
/**
 * This is a FacebookProvider for Facebook in
 * Drivekool application.
 *
 * @author 4th Dymension Teknocrats
 * @copyright   <a> 4th Dymension Teknocrats India LLP - 2014</a>
 */
class FacebookProvider implements UserProviderInterface
{
    /**
     * @var \FOS\FacebookBundle\Facebook\FacebookSessionPersistence
     */
    protected $facebook;

    /**
     * @var \FOS\UserBundle\Doctrine\UserManager $userManager
     */
    protected $userManager;

    /**
     * @var \Symfony\Component\Validator\Validator $validator
     */
    protected $validator;

    /**
     * @var \FOS\UserBundle\Security\UserProvider $userProvider
     */
    protected $userProvider;
    /**
     * 
     * @param BaseFacebook $facebook
     * @param unknown $userManager
     * @param unknown $validator
     */
    public function __construct(BaseFacebook $facebook, $userManager, $validator)
    {
        $this->facebook = $facebook;
        $this->userManager = $userManager;
        $this->validator = $validator;
    }
    /**
     * 
     * @param unknown $class
     */
    public function supportsClass($class)
    {
        return $this->userProvider->supportsClass($class);
    }
    /**
     * 
     * @param unknown $fbId
     */
    public function findUserByFbId($fbId)
    {
        return $this->userManager->findUserBy(array('facebookId' => $fbId));
    }
    /**
     * 
     * @param unknown $username
     * @throws UsernameNotFoundException
     * @return unknown
     */
    public function loadUserByUsername($username)
    {
        $user = $this->findUserByFbId($username);

        try {
            $fbdata = $this->facebook->api('/me');
        } catch (FacebookApiException $e) {
            $fbdata = null;
        }

        
        if (empty($user) and !empty($fbdata)) {
        	$user = $this->userManager->findUserBy(array('email' => $fbdata['email']));
        }
        
        
        if (!empty($fbdata)) {
            if (empty($user)) {
                $user = $this->userManager->createUser();
                $user->setEnabled(true);
                $user->setPassword('');
            }

            // TODO use http://developers.facebook.com/docs/api/realtime
            $user->setFBData($fbdata);

            if (count($this->validator->validate($user, 'Facebook'))) {
                // TODO: the user was found obviously, but doesnt match our expectations, do something smart
                throw new UsernameNotFoundException('The facebook user could not be stored');
            }
            $this->userManager->updateUser($user);
        }

        if (empty($user)) {
            throw new UsernameNotFoundException('The user is not authenticated on facebook');
        }

        return $user;
    }
    /**
     * 
     * @param UserInterface $user
     * @throws UnsupportedUserException
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user)) || !$user->getFacebookId()) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getFacebookId());
    }
}