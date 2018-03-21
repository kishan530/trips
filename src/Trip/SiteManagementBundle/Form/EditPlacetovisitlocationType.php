<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Collections\ArrayCollection;

class EditPlacetovisitlocationType extends AbstractType
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
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', 'choice', array(
            'expanded' => false,
            'multiple' => false,
            'label' => 'Location',
            'choices' =>$this->getLocations(),
            'required'    => true,
            'attr'   =>  array(
                'class'   => 'places',
                
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
           'data_class' => 'Trip\SiteManagementBundle\Entity\EndPoint'
       ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_site_management_edit_placetovisit_location';
    }
}
