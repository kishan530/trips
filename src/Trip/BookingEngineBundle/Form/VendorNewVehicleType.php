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
        ->add('vehicleNumber', 'text',array(
            'required' => false,
            'data_class' => null,
            'label'=>'Vehicle Number',
            'attr'   =>  array(
                'title' => 'Enter Valid Vehicle Number',
                'pattern' => '[A-Z0-9]{10}',
            ),
        ))
        ->add('vehicleColor', 'text',array(
            'required' => false,
            'data_class' => null,
            'label'=>'Vehicle Color',
           
        ))
        ->add('vehicleCapacity', 'choice', array(
            'expanded' => false,
            'multiple' => false,
            'label' => 'Vehicle Capacity',
            'choices'  => array(
                '4' => '4',
                '4+1' => '4+1',
                '7' => '7',
                '7+1' => '7+1',
                '12' => '12',
                
            ),
        ))
        ->add('fuelType', 'choice', array(
            'expanded' => false,
            'multiple' => false,
            'label' => 'Fuel Type',
            'choices'  => array(
                'Petrol' => 'Petrol',
                'Diesel' => 'Diesel',
            ),
        ))
        ->add('vehicleManfactureYear', 'text',array(
            'required' => false,
            'data_class' => null,
            'label'=>'Vehicle Manfacture Year',
            
        ))
        ->add('vehicleManfactureCompany', 'choice',array(
            'expanded' => false,
            'multiple' => false,
            'label' => 'Vehicle Manfacture Company',
            'choices'  => array(
                'Maruti' => 'Maruti',
                'Hyundai' => 'Hyundai',
                'Tata Motors' => 'Tata Motors',
                'Mahindra and Mahindra' => 'Mahindra and Mahindra',
                'Toyota' => 'Toyota',
                'Honda' => 'Honda',
                'Chevrolet' => 'Chevrolet',
                'Ford' => 'Ford',
                'Nissan' => 'Nissan',
                'Skoda' => 'Skoda',
                'Renault' => 'Renault',
                'FORCE MOTORS' => 'FORCE MOTORS',
            ),
            
        ))
        ->add('vehicleChassisNumber', 'text',array(
            'required' => false,
            'data_class' => null,
            'label'=>'Vehicle Chassis Number',
            
        ))
        ->add('vehicleEngineNumber', 'text',array(
            'required' => false,
            'data_class' => null,
            'label'=>'Vehicle Engine Number',
            
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