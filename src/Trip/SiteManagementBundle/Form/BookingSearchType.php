<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Event\DataEvent;
/**
 * This is a Form to collect the data of QuestionSearch in
 * Drivekool application.
 *
 * @author 4th Dymension Teknocrats
 * @copyright   <a> 4th Dymension Teknocrats India LLP - 2014</a>
 */
class BookingSearchType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bookingId',null, array(
            		'required'    => false,
            				))
            ->add('start_date',null,array(
            						'required'    => false,
            						'label' => 'From Date',
            						'data'  => date('d/m/Y')
            				))
            ->add('end_date',null,array(
            						'required'    => false,
            						'label' => 'To Date',
            						'data'  => date('d/m/Y')
            				))
        ;
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\SiteManagementBundle\DTO\BookingSearch'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_booking_search';
    }
}