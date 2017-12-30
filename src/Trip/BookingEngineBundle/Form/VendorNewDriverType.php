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

class VendorNewDriverType extends AbstractType
{
	private $catalog;
	private $security;
	
	public function __construct($catalog,$security)
	{
		$this->catalog = $catalog;
		$this->security = $security;
	}
	
	
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
		 //->add('driverId')
		->add('drivername','text',array(
        		'required' => true,
        		'data_class' => null,
        		'label'=>'Driver Name',
        		))
        ->add('driverMobileno','text',array(
        		'required' => true,
        		'data_class' => null,
        		'label'=>'Driver Mobile No',
            'attr'   =>  array(
                'title' => 'Enter Valid 10 Digit mobile number',
                'pattern' => '[0-9]{10}',
            ),
                
        		))
		->add('drivingLicence', 'file',array(
        		'required' => false,
        		'data_class' => null,
        		'label'=>'Driver Driving Licence',
        		'attr'   =>  array(
        				'class'   => 'filestyle',
        		),
        ))
		->add('driverIdproof', 'file',array(
        		'required' => false,
        		'data_class' => null,
        		'label'=>'Driver Id Proof',
        		'attr'   =>  array(
        				'class'   => 'filestyle',
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
        		'data_class' => 'Trip\BookingEngineBundle\Entity\VendorDriver',
                
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_booking_engine_vendor_registraion_form';
    }
}


?>