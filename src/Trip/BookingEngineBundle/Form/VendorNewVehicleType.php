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

class VendorNewVehicleType extends AbstractType
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
		 ->add('vehicleName', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'Vehicle Name',
            		 'choices'  => array(
        'Hatch Back' => 'Hatch Back',
		'Sedan' => 'Sedan',
		'Suv' => 'Suv(Innova,Tavera,Etica)',
		'Tempo' => 'Tempo',
		'Bus' => 'Bus',
		
    ),
            		'required'    => true,
                    
            ))
		->add('vehicleImage', 'file',array(
        		'required' => false,
        		'data_class' => null,
        		'label'=>'Vehicle Image',
        		'attr'   =>  array(
        				'class'   => 'filestyle',
        		),
        ))
        ->add('vehicleRegisCer', 'file',array(
        		'required' => false,
        		'data_class' => null,
        		'label'=>'Vehicle Registration Certificate',
        		'attr'   =>  array(
        				'class'   => 'filestyle',
        		),
        ))
		->add('vehicleInsurance', 'file',array(
        		'required' => false,
        		'data_class' => null,
        		'label'=>'Vehicle Insurance Certificate',
        		'attr'   =>  array(
        				'class'   => 'filestyle',
        		),
        ))
		->add('vehiclePopulation', 'file',array(
        		'required' => false,
        		'data_class' => null,
        		'label'=>'Vehicle Pollution Certificate',
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
        		'data_class' => 'Trip\BookingEngineBundle\Entity\VendorVehicles',
                
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