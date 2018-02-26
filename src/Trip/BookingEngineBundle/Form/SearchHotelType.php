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
use Trip\SiteManagementBundle\Form\VehicleType;
use Trip\BookingEngineBundle\Entity\Vehicle;

class SearchHotelType extends AbstractType
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
            if($location->getActive()){
		  $tempLocations[$location->getId()] = $location->getName();
            }
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
             ->add('goingTo', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'choices' => $this->getLocations(),
            		'required'    => false,
                    'data'=>1,
            		'empty_value'   => 'Select Destination',
                    'attr'   =>  array(
                                        'class'=>'chosen-select',
                                        'data-style'=>'btn-white',
                                        'data-live-search'=>'true',
                                        'data-placeholder'=>'Select Origin'
				            		),                
            ))
           
            ->add('date','text',array(
            						'required'    => true,
            						'label' => 'Check In',
				            		'attr'   =>  array(
				            				'data-date-format'=>'dd/mm/yyyy',
                                            'placeholder'=>'Check In'
				            		),
            		
            				))
            ->add('returnDate','text',array(            						
            						'required'    => true,
            						'label' => 'Check out',
            						'attr'   =>  array(
            								'data-date-format'=>'dd/mm/yyyy',
                                            'placeholder'=>'Check out'
            						),
            		            
            				))
        ;
        
                          
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        		'data_class' => 'Trip\BookingEngineBundle\DTO\SearchHotel',
        		'csrf_protection'   => false,
        		'allow_extra_fields' => true,
                'attr' => array('class' => 'bookform','id'=>'searchHotel')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_hotel_search';
    }
}