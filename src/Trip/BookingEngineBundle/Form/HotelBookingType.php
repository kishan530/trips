<?php

namespace Trip\SiteManagementBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HotelBookingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerId')
            ->add('bookingId')
            ->add('totalPrice')
            ->add('discount')
            ->add('finalPrice')
            ->add('serviceTax')
            ->add('swachBharthCess')
            ->add('krishiKalyanCess')
            ->add('amountPaid')
            ->add('paymentId')
            ->add('couponCode')
            ->add('adminCoupon')
            ->add('couponApplyed')
            ->add('numDays')
            ->add('numAdult')
            ->add('numRooms')
            ->add('chekIn')
            ->add('chekOut')
            ->add('status')
            ->add('jobStatus')
            ->add('bookedOn')
            ->add('paymentMode')
            ->add('hotelId')
            ->add('hotelName')
            ->add('location')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\BookingEngineBundle\Entity\HotelRoomBooking'
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
