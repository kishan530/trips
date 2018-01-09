<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Trip\SiteManagementBundle\Form\HotelAddressType;

class PackageLocationsType extends AbstractType
{
    public function __construct($BookingServices)
	{
		$this->BookingServices= $BookingServices;
		
	}
        /**
	 * @param OptionsResolverInterface $resolver
	 */
	public function getLocations()
	{
		$locations = $this->BookingServices->getLocations();
		$tempLocations = array();
		foreach ($locations as $location){
		  $tempLocations[$location->getId()] = $location->getName();
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
        
            ->add('location', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'Location',
            		'choices' =>$this->getLocations(),
            		'required'    => true,
                    
            ))
            ->add('package', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'PackageCode',
            		'choices' => $this->getPackageList(),
            		'required'    => true,
                    
            ))

             ->add('type', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'Type',
            		'choices' => array(
                                        'PickUp'=>'PickUp',
                                        'FirstDay'=>'Places to Visit',
                                        'SecondDay'=>'Drop',
				            		),
            		'required'    => true,
                   
            ))
           
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\SiteManagementBundle\Dto\PackageLocations'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_site_management_packagelocations';
    }
}
