<?php

namespace Trip\BookingEngineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerType extends AbstractType
{
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
            ->add('couponCode')
          ->add('haveCoupon', 'checkbox', array(
    				'label'     => 'I have an offer code?',
    				'required'  => false,
    		))
           // ->add('address','textarea')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\BookingEngineBundle\Entity\Customer',
            'attr' => array('class' => 'bookform form-inline'),
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_bookingenginebundle_customer';
    }
}
