<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Trip\SiteManagementBundle\Form\PackageItineraryType;
use Trip\SiteManagementBundle\Form\PackageContentType;

class AddImagePackageType extends AbstractType
{
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('imageList1', 'collection', array(
            		// each entry in the array will be an "PackageItinerary" field
            		'type'   => new PackageImageType(),
            		'allow_add'    => true,
            		'prototype'=>true,
            		'required'    => false,
            		// these options are passed to each "PackageItinerary" type
            		//'entry_options'  => array(
            		//   'attr'      => array('class' => '')
            		//),
            )) 
             ->add('submit', 'submit', array('label' => 'submit'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
      $resolver->setDefaults(array(
           'data_class' => 'Trip\SiteManagementBundle\Entity\Package'
       ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_sitemanagementbundle_edit_package';
    }
}
