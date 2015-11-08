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
use Trip\BookingEngineBundle\Form\MultiCityType;
use Trip\BookingEngineBundle\DTO\MultiCity;

class SearchType extends AbstractType
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
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('leavingFrom', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'data'=>1,
            		'choices' => $this->getLocations(),
            		'required'    => false,
            		'empty_value'   => 'Select Origin',
                    'attr'   =>  array(
                                        'class'=>'chosen-select',
                                        'data-style'=>'btn-white',
                                        'data-live-search'=>'true',
                                        'data-placeholder'=>'Select Origin'
				            		),
            ))
             ->add('goingTo', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'choices' => $this->getLocations(),
            		'required'    => false,
            		'empty_value'   => 'Select Destination',
                    'attr'   =>  array(
                                        'class'=>'chosen-select',
                                        'data-style'=>'btn-white',
                                        'data-live-search'=>'true',
                                        'data-placeholder'=>'Select Destination'
				            		),                
            ))
           
            ->add('date','date',array(
            						'required'    => false,
            						'label' => 'From Date',
                				    'widget'=> 'single_text',
						            'format'=>'d/M/y',
				            		'attr'   =>  array(
				            				'data-date-format'=>'dd/mm/yyyy',
                                            'placeholder'=>'Date'
				            		),
            		
            				))
            ->add('returnDate','date',array(            						
            						'required'    => false,
            						'label' => 'To Date',
            						'read_only' => true,
                				   'widget'=> 'single_text',
						           'format'=>'d/M/y',
            						'attr'   =>  array(
            								'data-date-format'=>'dd/mm/yyyy',
                                            'placeholder'=>'Return Date'
            						),
            		            
            				))
            /*->add('numDays','text',array(            						
            						'required'    => false,
            						'label' => 'No of Days',
                                    'data'=>'1',
            						'attr'   =>  array(
                                            'placeholder'=>'Number of Days'
            						),
            		            
            				))  */    
            ->add('numAdult','text',array(            						
            						'required'    => true,
            						'label' => 'No of Adult',
                                    'data'=>'1',
            						'attr'   =>  array(
                                            'placeholder'=>'Number of Adult'
            						),
            		            
            				)) 
            ->add('preferTime','text',array(            						
            						'required'    => true,
            						'label' => 'Prefer Time',
                                    //'input'=>'string',
                                   // 'attr' => array('type' => 'text'),
                                //'widget' => 'single_text',
            		            
            				)) 
        ;
        
          $builder->add('multiple', 'collection', array(
                        'type'         => new MultiCityType($this->catalog),
                        'allow_add'    => true,
                        'prototype'=>true,
                    ));
        
    
            // ...
            $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();
                

                // check if the Product object is "new"
                // If no data is passed to the form, the data is "null".
                // This should be considered a new "Product"
                //if ($add=='true' && null !== $add) {
                $data->getMultiple()->add(new MultiCity());
                 $data->getMultiple()->add(new MultiCity());
                   // $form->get('tags')->setData($data->getTags());
                  ///  echo var_dump($data);
                //exit();
                //}
                
            });
                          
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        		'data_class' => 'Trip\BookingEngineBundle\DTO\SearchFilter',
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
        return 'trip_search';
    }
}