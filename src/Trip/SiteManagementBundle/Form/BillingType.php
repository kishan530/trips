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
        ->add('date','date',array(
        		'required'    => true,
        		'label' => 'Date',
        		'widget'=> 'single_text',
        		'format'=>'d/M/y',
        		'attr'   =>  array(
        				'data-date-format'=>'dd/mm/yyyy',
        				//'placeholder'=>'Date',
        				'class'=>'preferDate'
        		),
        		
        ))
        ->add('pickup', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'choices' => $this->getLocations(),
        		'required'    => true,
        		'label' => 'Pick Up',
        ))
        ->add('goingTo', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'choices' => $this->getLocations(),
        		'required'    => true,
        		'empty_value'   => 'Location',
        		'label' => 'Drop',
        ))
        ->add('locations', 'choice', array(
        		'expanded' => false,
        		'multiple' => true,
        		'choices' => $this->getLocations(),
        		'required'    => false,
        		'label' => 'Places To Visit',
        		'empty_value'   => 'Select',
        		'attr'   =>  array(
        				'class'=>'chosen-select',
        				'data-style'=>'btn-white',
        				'data-live-search'=>'true',
        				'data-placeholder'=>'Select'
        		),
        ))
        ->add('vehicle_id', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'choices' => $this->getVehicles(),
        		'required'    => true,
        		'empty_value'   => 'vehicle',
        		'label' => 'Vehicle',
        ))
        ->add('driver_id', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'choices' => $this->getDriver(),
        		'required'    => true,
        		'empty_value'   => 'Driver',
        ))
        
            ->add('diesel')
            ->add('price', 'text', array(
            				
            				'label' => 'Total Price',
            ))
            ->add('advance',  'text', array(
            		
            		'label' => 'ADV',
            ))
            ->add('cash')
            ->add('expenses')
            ->add('comments','textarea')
            
             
            //->add('address',new HotelAddressType($this->catalouge))
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
