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
use Trip\BookingEngineBundle\Form\NewPackageType;

class CustomPackageType extends AbstractType
{
	
	private $bookingService;
	private $catalogService;
	
	public function __construct($bookingService)
	{
		$this->bookingService= $bookingService;
		$this->catalogService = $bookingService->getCatalog();
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
            ->add('name')
            ->add('email','email')
            ->add('mobile')
        // ->add('submit', 'submit', array('label' => 'submit'))
         ->add('multiple', 'collection', array(
        		'type'         => new NewPackageType($this->catalogService),
        		'allow_add'    => true,
        		'allow_delete' => true,
                 'prototype'=>true,
        		'required'    => false,
        ))
        ->add('numAdult','text',array(            						
            						'required'    => true,
            						'label' => 'No of Adult',
                                    'data'=>'1',
            						'attr'   =>  array(
                                            'placeholder'=>'Number of Adult'
            						),
            		            
        )) 
           // ->add('address','textarea')
        ;
        
        $builder->add('paymentMode', 'choice', array(

    				'expanded' => true,

    				'multiple' => false,

    				'choices' => array(

                            '30' => '30% payment',
    						'advance' => '50% Payment ',

    				),
                'label'     => 'Payment Mode',
    				'required'    => true,

    		));
           
        ;
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
            $resolver->setDefaults(array(
            'data_class' => 'Trip\BookingEngineBundle\DTO\Customer',
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