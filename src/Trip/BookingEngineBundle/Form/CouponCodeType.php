<?php

namespace Trip\BookingEngineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CouponCodeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        		
        		
        	->add('couponName', null, array(
            		'required'    => true,
            		'label' => 'couponName', ))
            		
        	->add('couponCode', null, array(
            				'required'    => true,
            				'label' => 'couponCode', ))
            		
            ->add('startDate','datetime',array(
            				'widget'=> 'single_text',
            				'format'=>'M/d/y HH:mm',
            				'required'    => false,
            				'label'     => 'Start Date',
           					'attr' => array()
            				
            				))
            				
            		
       		
       		->add('expireDate','datetime',array(
            		'widget'=> 'single_text',
            		'format'=>'M/d/y HH:mm',
            		'required'    => false,
            		'label'     => 'expire Date',
            		'attr' => array()
            		
            				))
    
            		
            ->add('amount', null, array(
            				'required'    => true,
            				'label' => 'amount', ))
            				
         	
           
           
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\BookingEngineBundle\DTO\CouponCodeDto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_hotelbundle_couponcode';
    }
}
