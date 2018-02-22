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
use Trip\BookingEngineBundle\Form\VendorNewVehicleType;
use Trip\BookingEngineBundle\Form\VendorNewDriverType;

class VendorRegistraionType extends AbstractType
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
	/*private function getLocations()
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
	/*public function getVehicles()
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
            ->add('companyname','text',array(
        		'required' => true,
        		'data_class' => null,
        		'label'=>'Company Name',
        		))
        		->add('name','text', array(
        		    'attr' => ['readonly' => true],
        		))
        		->add('email','text' ,array(
        		    'attr' => ['readonly' => true],
        		))
			->add('mobileno','text',array(
        		'required' => true,
        		'data_class' => null,
			   
        		'label'=>'Mobile Number',
			    'attr'   =>  array(
			        'title' => 'Enter Valid 10 Digit mobile number',
			        'pattern' => '[0-9]{10}',
			        'readonly' => true,
			    ),
        		))
            ->add('address','textarea',array(
        		'required' => true,
        		'data_class' => null,
        		'label'=>'Address',
        		))
            ->add('pancard','text',array(
        		'required' => true,
        		'data_class' => null,
        		'label'=>'Pancard No',
                'attr'   =>  array(
                    'title' => 'Enter Valid Pancard Number',
                    'pattern' => '[A-Z0-9]{10}',
                ),
        		))
			->add('pancardid','file',array(
        		'required' => false,
        		'data_class' => null,
        		'label'=>'Pancard ID Proof',
        		'attr'   =>  array(
        				'class'   => 'filestyle',
        		),))
			->add('gstno','text',array(
        		'required' => true,
        		'data_class' => null,
        		'label'=>'GST NO',
			    'attr'   =>  array(
    			    'title' => 'Enter Valid GST Number',
    			    'pattern' => '[A-Z][0-9]{15}',
			    ),
        		))
			->add('idproof','file',array(
        		'required' => false,
        		'data_class' => null,
        		'label'=>'ID Proof',
        		'attr'   =>  array(
        				'class'   => 'filestyle',
        		),))
			->add('vehiclesList', 'collection', array(
        		'type'         => new VendorNewVehicleType($this->catalogService,$this->security),
        		'allow_add'    => true,
                 'prototype'=>true,
        		'required'    => false,
        ))
			->add('driversList', 'collection', array(
        		'type'         => new VendorNewDriverType($this->catalogService,$this->security),
        		'allow_add'    => true,
                 'prototype'=>true,
        		'required'    => true,
        ))
         
			
            
       
        ;
        
        
        
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
            $resolver->setDefaults(array(
            'data_class' => 'Trip\BookingEngineBundle\Entity\Vendor',
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