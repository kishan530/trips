<?php

namespace Trip\BookingEngineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HotelCustomerType extends AbstractType
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
            //->add('haveCoupon', 'checkbox', array(
            //    'label'     => 'I have an Coupon code?',
            //    'required'  => false,
           // ))
            //->add('couponCode')
            //->add('adminCoupon')
            
           // ->add('address','textarea')
        ;
   
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\BookingEngineBundle\Entity\HotelCustomer',
            'attr' => array('class' => 'bookform'),
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_booking_engine_hotel_book_room';
    }
}
