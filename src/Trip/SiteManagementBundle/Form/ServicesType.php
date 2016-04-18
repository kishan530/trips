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

class ServicesType extends AbstractType
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
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('leavingFrom', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'choices' => $this->getLocations(),
            		'required'    => true,
            ))
         ->add('goingTo', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'choices' => $this->getLocations(),
            		'required'    => true,
            		'empty_value'   => 'Location',
            ))
            ->add('vehicle_id', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'choices' => $this->getVehicles(),
            		'required'    => true,
            		'empty_value'   => 'vehicle',
            ))
        ->add('price')
         ->add('returnPrice')
            
            
           // ->add('numInfant','text',array('data'=>'0'))
        //    ->add('numAdult','text',array('data'=>'1'))
        //   ->add('numChild','text',array('data'=>'0'))
            ->add('submit', 'submit', array('label' => 'submit'))
        ;
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_search';
    }
}