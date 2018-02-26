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

class SearchHotelAgainType extends AbstractType
{
	
	
	
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date','text',array(
            						'required'    => true,
            						'label' => 'Check In',
				            		'attr'   =>  array(
				            				'data-date-format'=>'dd/mm/yyyy',
                                            //'placeholder'=>'Check In'
				            		    'style' => 'width: 105px',
				            		    'onchange' => 'myFunction()'
				            		),
            		
            				))
            ->add('returnDate','text',array(            						
            						'required'    => true,
            						'label' => 'Check Out',
            						'attr'   =>  array(
            								'data-date-format'=>'dd/mm/yyyy',
                                            //'placeholder'=>'Check out'
            						    'style' => 'width: 105px',
            						    'onchange' => 'myFunction()'
            						),
            		            
            				))
            				->add('numRooms','choice',array(
            				    'required'    => true,
            				    'label' => 'Rooms',
            				    //'data'=>'1',
            				    'attr'   =>  array(
            				        'style' => 'width: 50px',
            				        'onchange'=> 'myFunction()',
            				        //'placeholder'=>'Number of Rooms'
            				    ),
            				    'choices'  => array(
            				        '1' => 1,
            				        '2' => 2,
            				        '3' => 3,
            				        '4' => 4,
            				       
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
        		'data_class' => 'Trip\BookingEngineBundle\DTO\SearchHotelAgain',
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