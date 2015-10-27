<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class HotelAddressType extends AbstractType
{
    private $catalouge;
	
	public function __construct($catalouge)
	{
		$this->catalouge = $catalouge;
	}
    /**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getLocations()
	{
		$locations = $this->catalouge->getLocations();
		$tempLocations = array();
		foreach ($locations as $location){
		  $tempLocations[$location->getId()] = $location->getName();
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
            ->add('addressLine1')
            ->add('addressLine2',null, array('required'    => false))
            ->add('location')
            ->add('cityId', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'City',
            		'choices' => $this->getLocations(),
            		'required'    => true,
            		'empty_value'   => 'Location',
                    'attr'   =>  array(
                                        'class'=>'selectpicker',
                                        'data-style'=>'btn-white',
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
            'data_class' => 'Trip\SiteManagementBundle\Entity\HotelAddress'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_sitemanagementbundle_hoteladdress';
    }
}
