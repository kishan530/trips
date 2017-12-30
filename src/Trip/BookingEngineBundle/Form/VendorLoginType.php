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
use Trip\BookingEngineBundle\Form\VendorNewVehicleType;
use Trip\BookingEngineBundle\Form\VendorNewDriverType;

class VendorLoginType extends AbstractType
{
	
	private $bookingService;
	private $catalogService;
	private $security;
	
	
	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
			->add('mobileno')
			
        ;
              
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    /*public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
            $resolver->setDefaults(array(
            'data_class' => 'Trip\BookingEngineBundle\DTO\Vendor',
            'allow_extra_fields' => true,
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_booking_engine_vendor_login';
    }
}