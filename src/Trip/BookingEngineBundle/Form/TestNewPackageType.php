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

class TestNewPackageType extends AbstractType
{
	private $catalog;
	private $security;
	
	public function __construct($catalog,$security)
	{
		$this->catalog = $catalog;
		$this->security = $security;
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getLocations()
	{
		$locations = $this->catalog->getLocations();
		$tempLocations = array();
		foreach ($locations as $location){
		  $tempLocations[$location->getId()] = $location->getName();
		}
		return $tempLocations;
	}
    /**
	 * @param OptionsResolverInterface $resolver
	 */
	public function getVehicles()
	{
		$locations = $this->catalog->getVehicles();
		$tempLocations = array();
		foreach ($locations as $location){
		  $tempLocations[$location->getId()] = $location->getModel();
		}
		return $tempLocations;
	}
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pickup', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'choices' => $this->getLocations(),
            		'required'    => true,
            		'label' => 'Pick Up',
            		'empty_value'   => 'Select',
                    'attr'   =>  array(
                                        'class'=>'chosen-select',
                                        'data-style'=>'btn-white',
                                        'data-live-search'=>'true',
                                        'data-placeholder'=>'Select'
				            		),
            ))
             ->add('goingTo', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'choices' => $this->getLocations(),
            		'required'    => false,
             		'label' => 'Drop',
            		'empty_value'   => 'Select',
                    'attr'   =>  array(
                                        'class'=>'chosen-select',
                                        'data-style'=>'btn-white',
                                        'data-live-search'=>'true',
                                        'data-placeholder'=>'Select'
				            		),                
            ))
            ->add('locations', 'choice', array(
            		'expanded' => false,
            		'multiple' => true,
            		'choices' => $this->getLocations(),
            		'required'    => false,
            		'empty_value'   => 'Select',
            		'attr'   =>  array(
            				'class'=>'chosen-select',
            				'data-style'=>'btn-white',
            				'data-live-search'=>'true',
            				'data-placeholder'=>'Select'
            		),
            ))
           /*  ->add('numAdult','text',array(
            		'required'    => true,
            		'label' => 'No of Adult',
            		'data'=>'1',
            		'attr'   =>  array(
            				'placeholder'=>'Number of Adult',
            				'class'=>'numAdult'
            		),
            
            )) */
             ->add('vehicleId', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'Vehicle',
            		'choices' =>$this->getVehicles(),
            		'required'    => true,
                    
            ))
           
            ->add('date','date',array(
            						'required'    => true,
            						'label' => 'Date',
                				    'widget'=> 'single_text',
						            'format'=>'d/M/y',
				            		'attr'   =>  array(
				            				'data-date-format'=>'dd/mm/yyyy',
                                            //'placeholder'=>'Date',
                                            'class'=>'preferDate'
				            		),
            		
            ))
           
            
        ->add('driver_id', 'choice', array(
        		 'choices'  => array(
        'Driver' => 'Driver',
		'Jagadeesh' => 'Jagadeesh',
		'Rajesh' => 'Rajesh',
		'Siva' => 'Siva',
		'Kiran' => 'Kiran',
		'Deva' => 'Deva',
		'Venkat' => 'Venkat',
		'Siva Anna' => 'Siva Anna',
		'Ramu' => 'Ramu',
        
    ),
        ))
        ->add('carnumber', 'text', array(
        		
        		'label' => 'Car Number',
        		))
            ->add('diesel')
            ->add('price', 'text', array(
            			
            			'label' => 'Total Price',
            		
            ))
            ->add('advance',  'text', array(
            		
            		'label' => 'ADV',
            ))
            ->add('cash')
            ->add('expenses')
            ->add('comments','textarea')
            ;
                   
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        		'data_class' => 'Trip\BookingEngineBundle\DTO\TestNewPackage',
                
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_search_new_package';
    }
}
/* <?php

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


class TestNewPackageType extends AbstractType
{
	private $bookingService;
	private $catalog;
	
	public function __construct($bookingService,$catalog)
	{
		$this->bookingService= $bookingService;
		$this->catalog = $bookingService->getCatalog();
	}
	
	*
	 * @param OptionsResolverInterface $resolver
	
	private function getLocations()
	{
		$locations = $this->catalog->getLocations();
		$tempLocations = array();
		foreach ($locations as $location){
			$tempLocations[$location->getId()] = $location->getName();
		}
		return $tempLocations;
	}
	*
	 * @param OptionsResolverInterface $resolver
	
	private function getVehicles()
	{
		$locations = $this->catalog->getVehicles();
		$tempLocations = array();
		foreach ($locations as $location){
			$tempLocations[$location->getId()] = $location->getModel();
		}
		return $tempLocations;
	}
	*
	 * @param OptionsResolverInterface $resolver
	
	private function getDriver()
	{
		$drivers= $this->bookingService->getDriver();
		$tempDriver = array();
		foreach ($drivers as $driver){
			$tempDriver[$driver->getId()] = $driver->getName();
		}
		return $tempDriver;
	}
    *
     * @param FormBuilderInterface $builder
     * @param array $options
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('date','date',array(
        		'required'    => true,
        		'label' => 'Date',
        		'widget'=> 'single_text',
        		'format'=>'d/M/y',
        		'attr'   =>  array(
        				'data-date-format'=>'dd/mm/yyyy',
        				//'placeholder'=>'Date',
        				'class'=>'preferDate'
        		),
        		
        ))
        ->add('pickup', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'choices' => $this->getLocations(),
        		'required'    => true,
        		'label' => 'Pick Up',
        ))
        ->add('goingTo', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'choices' => $this->getLocations(),
        		'required'    => true,
        		'empty_value'   => 'Location',
        		'label' => 'Drop',
        ))
        ->add('locations', 'choice', array(
        		'expanded' => false,
        		'multiple' => true,
        		'choices' => $this->getLocations(),
        		'required'    => false,
        		'label' => 'Places To Visit',
        		'empty_value'   => 'Select',
        		'attr'   =>  array(
        				'class'=>'chosen-select',
        				'data-style'=>'btn-white',
        				'data-live-search'=>'true',
        				'data-placeholder'=>'Select'
        		),
        ))
        ->add('vehicle_id', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'choices' => $this->getVehicles(),
        		'required'    => true,
        		'empty_value'   => 'vehicle',
        		'label' => 'Vehicle',
        ))
        ->add('driver_id', 'choice', array(
        		'expanded' => false,
        		'multiple' => false,
        		'choices' => $this->getDriver(),
        		'required'    => true,
        		'empty_value'   => 'Driver',
        ))
        ->add('carnumber', 'text', array(
        		
        		'label' => 'Car Number',
        		))
            ->add('diesel')
            //->add('price', 'text', array(
            			
            			//'label' => 'Total Price',
            		
           // ))
            ->add('advance',  'text', array(
            		
            		'label' => 'ADV',
            ))
            ->add('cash')
            ->add('expenses')
            ->add('comments','textarea')
            
             
            //->add('address',new HotelAddressType($this->catalouge))
       
        ;
    }
    *
     * @param OptionsResolverInterface $resolver
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        		'data_class' => 'Trip\BookingEngineBundle\DTO\TestNewPackage',
                
        ));
    }

    *
     * @return string
    
    public function getName()
    {
        return 'trip_search_new_package';
    }
} */

?>