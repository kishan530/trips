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

class PackageType extends AbstractType
{
	
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
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
            		            
            				)) 
        ;
        
                          
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
                'attr' => array('class' => 'bookform')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_package';
    }
}