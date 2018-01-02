<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Event\DataEvent;
use Trip\SiteManagementBundle\Entity\BillingPlacesToVisit;

class BillingType extends AbstractType
{
	private $bookingService;
	private $catalog;
	
	public function __construct($bookingService)
	{
		$this->bookingService= $bookingService;
		$this->catalog = $bookingService->getCatalog();
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getLocations()
	{
		$locations = $this->catalog->getLocations();
		$tempLocations = array();
		foreach ($locations as $location){
			$tempLocations[$location->getId()] = $location->getName();
		}
		return $tempLocations;
	}
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getVehicles()
	{
		$locations = $this->catalog->getVehicles();
		$tempLocations = array();
		foreach ($locations as $location){
			$tempLocations[$location->getId()] = $location->getModel();
		}
		return $tempLocations;
	}
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getDriver()
	{
		$drivers= $this->bookingService->getDriver();
		$tempDriver = array();
		foreach ($drivers as $driver){
			$tempDriver[$driver->getId()] = $driver->getName();
		}
		return $tempDriver;
	}
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('multiple', 'collection', array(
        		'type'         => new NewBillingType($this->bookingService,$this->catalog),
        		'allow_add'    => true,
                 'prototype'=>true,
        		'required'    => false,
        ))
		 ->add('submit', 'submit', array('label' => 'submit'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\SiteManagementBundle\DTO\BillingDto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_sitemanagementbundle_billing';
    }
}
