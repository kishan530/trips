<?php

namespace Trip\BookingEngineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Event\DataEvent;
use Trip\BookingEngineBundle\Form\TestNewPackageType;

class TestCustomPackageType extends AbstractType
{
	
	private $bookingService;
	private $catalogService;
	private $security;
	
	public function __construct($bookingService,$security)
	{
		$this->bookingService= $bookingService;
		$this->catalogService = $bookingService->getCatalog();
		$this->security = $security;
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getLocations()
	{
		$locations = $this->catalogService->getLocations();
		$tempLocations = array();
		foreach ($locations as $location){
			$tempLocations[$location->getId()] = $location->getName();
		}
		return $tempLocations;
	}
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function getVehicles()
	{
		$locations = $this->catalogService->getVehicles();
		$tempLocations = array();
		foreach ($locations as $location){
			$tempLocations[$location->getId()] = $location->getModel();
		}
		return $tempLocations;
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
        // ->add('submit', 'submit', array('label' => 'submit'))
         ->add('multiple', 'collection', array(
        		'type'         => new TestNewPackageType($this->catalogService,$this->security),
        		'allow_add'    => true,
                 'prototype'=>true,
        		'required'    => false,
        ))
     
        ;
        
        
        
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
            $resolver->setDefaults(array(
            'data_class' => 'Trip\BookingEngineBundle\DTO\TestCustomer',
            'allow_extra_fields' => true,
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_custom_package';
    }
}