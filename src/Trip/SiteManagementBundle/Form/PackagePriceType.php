<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PackagePriceType extends AbstractType
{
    private $bookingService;
	private $catalouge;
	
	public function __construct($BookingServices)
	{
		$this->BookingServices= $BookingServices;
		
	}
        /**
	 * @param OptionsResolverInterface $resolver
	 */
	public function getVehicles()
	{
		$locations = $this->BookingServices->getVehicles();
		$tempLocations = array();
		foreach ($locations as $location){
		  $tempLocations[$location->getId()] = $location->getModel();
		}
		return $tempLocations;
	}
        public function getPackageList()
        {
            $packages = $this->BookingServices->getPackageList();
		$tempPackage = array();
		foreach ($packages as $package){
		  $tempPackage[$package->getId()] = $package->getCode();
		}
		return $tempPackage;
        }
        
        
        
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                           
            ->add('vehicleId', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'VehicleCode',
            		'choices' =>$this->getVehicles(),
            		'required'    => true,
                    
            ))
            ->add('package', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'PackageCode',
            		'choices' => $this->getPackageList(),
            		'required'    => true,
                    
            ))
             ->add('price')   
             
             ->add('submit', 'submit', array('label' => 'submit'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\SiteManagementBundle\Entity\PackagePrice'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_sitemanagementbundle_Price';
    }
}
