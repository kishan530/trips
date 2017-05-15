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
use Trip\BookingEngineBundle\Form\NewPackageType;

class CustomPackageType extends AbstractType
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
            ->add('name',null,array('required'    => true,))
            ->add('email','email')
            ->add('mobile',null,array('required'    => true,))
        // ->add('submit', 'submit', array('label' => 'submit'))
         ->add('multiple', 'collection', array(
        		'type'         => new NewPackageType($this->catalogService,$this->security),
        		'allow_add'    => true,
                 'prototype'=>true,
        		'required'    => false,
        ))
       /*  ->add('numAdult','text',array(            						
            						'required'    => true,
            						'label' => 'No of Adult',
                                    'data'=>'1',
            						'attr'   =>  array(
                                            'placeholder'=>'Number of Adult'
            						),
            		            
        ))
        ->add('pickUp', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'choices' => $this->getLocations(),
        		'required'    => false,
        		'empty_value'   => 'Select',
        		'attr'   =>  array(
        				'class'=>'chosen-select',
        				'data-style'=>'btn-white',
        				'data-live-search'=>'true',
        				'data-placeholder'=>'Select'
        		),
        ))
        ->add('drop', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'choices' => $this->getLocations(),
        		'required'    => false,
        		'empty_value'   => 'Select',
        		'attr'   =>  array(
        				'class'=>'chosen-select',
        				'data-style'=>'btn-white',
        				'data-live-search'=>'true',
        				'data-placeholder'=>'Select'
        		),
        ))
        ->add('placesToVisit', 'choice', array(
        		'expanded' => false,
        		'multiple' => true,
        		'choices' => $this->getLocations(),
        		'required'    => false,
        		'empty_value'   => 'Select',
        		'attr'   =>  array(
        				'class'=>'chosen-select',
        				'data-style'=>'btn-white',
        				'data-live-search'=>'true',
        				'data-placeholder'=>'Select'
        		),
        ))
        ->add('vehicleId', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'label' => 'Vehicle',
        		'choices' =>$this->getVehicles(),
        		'required'    => true,
        
        ))
         
        ->add('date','date',array(
        		'required'    => false,
        		'label' => 'Date',
        		'widget'=> 'single_text',
        		'format'=>'d/M/y',
        		'attr'   =>  array(
        				'data-date-format'=>'dd/mm/yyyy',
        				//'placeholder'=>'Date',
        				'class'=>'preferDate'
        		),
        
        ))
        ->add('preferTime','text',array(
        		'required'    => false,
        		'label' => 'Prefer Time',
        		//'input'=>'string',
        		'attr' => array( 'class'=>'preferTime'),
        		//'widget' => 'single_text',
        
        )) */
        
           // ->add('address','textarea')
        ;
        
        if ($this->security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
        
        	//$builder->add('price');
        	$builder->add('paymentMode', 'choice', array(
        	
        			'expanded' => true,
        	
        			'multiple' => false,
        	
        			'choices' => array(
        	
        					'30' => '30% payment',
        					'advance' => '50% Payment ',
        	
        			),
        			'label'     => 'Payment Mode',
        			'required'    => true,
        	
        	));
        	 
        	;
        }
        
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
            $resolver->setDefaults(array(
            'data_class' => 'Trip\BookingEngineBundle\DTO\Customer',
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