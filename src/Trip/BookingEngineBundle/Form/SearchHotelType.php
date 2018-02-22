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
	    $locations = $this->bookingService->getHotelCities();
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
            'expanded' => FALSE,
            'multiple' => FALSE,
            'empty_value'   => 'Select City',
            'choices' => $this->getLocations(),
            'required'    => TRUE,
            'attr'   =>  array(
               
                'style' => 'border-radius: 5px;margin-bottom:-15px;border-color:#eee;'
            ),
            
        ))
          /*    ->add('goingTo', 'choice', array(
            		'expanded' => false,
                    //'label' => 'Location',
            		'multiple' => false,
                 'empty_value'   => 'Select City',
            		'choices' => $this->getLocations(),
                    
            		'required'    => false,
                    //'data'=>2,
            		
                    'attr'   =>  array(
                                        'class'=>'chosen-select',
                                        'data-style'=>'btn-white',
                                        'data-live-search'=>'true',
                                        'data-placeholder'=>'Select Origin'
				            		),                
            )) */
           
            ->add('date','text',array(
            						'required'    => true,
            						'label' => 'Check In',
				            		'attr'   =>  array(
				            				'data-date-format'=>'dd/mm/yyyy',
                                            'placeholder'=>'Check In',
				            		    'style' => 'border-radius: 5px;height:37px;margin-bottom:10px;background-color:#fff;color:#000;border-color: #dddddd;',
				            		    //'onchange' => 'myFunction()'
				            		),
            		
            				))
            ->add('returnDate','text',array(            						
            						'required'    => true,
            						'label' => 'Check Out',
            						'attr'   =>  array(
            								'data-date-format'=>'dd/mm/yyyy',
                                            'placeholder'=>'Check out',
            						    'style' => 'border-radius: 5px;height:37px;margin-bottom:10px;background-color:#fff;color:#000;border-color: #dddddd;',
            						    //'onchange' => 'myFunction()'
            						),
            		            
            				))
            				->add('numAdult','hidden',array(
            				    'required'    => true,
            				    'label' => 'No of Adult',
            				     'data'=>'1',
            				    'attr'   =>  array(
            				        'placeholder'=>'Number of Adult'
            				    ),
            				    
            				))
            				->add('numRooms','hidden',array(
            				    'required'    => true,
            				    'label' => 'No of Adult',
            				    'data'=>'1',
            				    'attr'   =>  array(
            				        'placeholder'=>'Number of Adult'
            				    ),
            				    
            				))
            				->add('numChildren','hidden',array(
            				    'required'    => true,
            				    'label' => 'No of Children',
            				    'data'=>'0',
            				    'attr'   =>  array(
            				        'placeholder'=>'Number of Children'
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
                'attr' => array('class' => 'bookform','id'=>'search')
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