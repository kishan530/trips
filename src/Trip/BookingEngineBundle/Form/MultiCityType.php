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

class MultiCityType extends AbstractType
{
	private $catalog;
	
	public function __construct($catalog)
	{
		$this->catalog = $catalog;
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
           
            ->add('date','text',array(
            						'required'    => false,
            						'label' => 'From Date',
				            		'attr'   =>  array(
				            				'data-date-format'=>'dd/mm/yyyy',
                                            'placeholder'=>'Date'
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
        		'data_class' => 'Trip\BookingEngineBundle\DTO\MultiCity',
        		'csrf_protection'   => false,
        		'allow_extra_fields' => true,
                'attr' => array('class' => 'bookform form-inline')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_search_MultiCity';
    }
}