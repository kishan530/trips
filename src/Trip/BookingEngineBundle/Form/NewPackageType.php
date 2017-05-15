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

class NewPackageType extends AbstractType
{
	private $catalog;
	private $security;
	
	public function __construct($catalog,$security)
	{
		$this->catalog = $catalog;
		$this->security = $security;
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
	public function getVehicles()
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
            		'required'    => false,
            		'label' => 'Pick Up',
            		'empty_value'   => 'Select',
                    'attr'   =>  array(
                                        'class'=>'chosen-select',
                                        'data-style'=>'btn-white',
                                        'data-live-search'=>'true',
                                        'data-placeholder'=>'Select'
				            		),
            ))
             ->add('goingTo', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'choices' => $this->getLocations(),
            		'required'    => false,
             		'label' => 'Drop',
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
            ->add('numAdult','text',array(
            		'required'    => true,
            		'label' => 'No of Adult',
            		'data'=>'1',
            		'attr'   =>  array(
            				'placeholder'=>'Number of Adult',
            				'class'=>'numAdult'
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
            		            
            )) 
            ->add('description',null,array(
            		'required'    => false,
            		'attr'   =>  array(
            				'placeholder'=>'If you didn`t find your location write your plan here',
            		),
            ))
            ;
            if ($this->security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
            
            	$builder->add('price');
            }
                          
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        		'data_class' => 'Trip\BookingEngineBundle\DTO\NewPackage',
                
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_search_new_package';
    }
}