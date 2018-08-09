<?php

namespace Trip\BookingEngineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocuploadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
        
        ->add('imgfront', 'file',array(
            'required' => false,
            'data_class' => null,
            'label'=>'.',
            
            'attr'   =>  array(
                'class'   => 'uploaddocdesign',
                'allow_add'    => true,
                'prototype'=>true,
            ),
        ))
        /*->add('imgbkp', 'file',array(
            'required' => false,
            'data_class' => null,
            'label'=>'Image',
            
            'attr'   =>  array(
                'class'   => 'filestyle',
                'allow_add'    => true,
                'prototype'=>true,
            ),
        ))
        ->add('idproof', 'file',array(
            'required' => false,
            'data_class' => null,
            'label'=>'Image',
            
            'attr'   =>  array(
                'class'   => 'filestyle',
                'allow_add'    => true,
                'prototype'=>true,
            ),
        ))*/
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\BookingEngineBundle\Entity\Docupload',
            'attr' => array('class' => 'bookform form-inline'),
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_booking_engine_profile';
    }
}
