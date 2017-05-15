<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditPackageType extends AbstractType
{
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('name')
            ->add('overview','textarea')
            ->add('metaKeywords','textarea')
            ->add('metaDescription','textarea')
            ->add('metaTitle')
            ->add('packageUrl')
            ->add('type', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'PackageType',
            		'choices' => array(
                                        'one'=>'One Day',
                                        'two'=>'Two Day',
				            		),
            		'required'    => true,
            ))
           ->add('active', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'Status',
            		'choices' => array(
                                        '1'=>'Active',
                                        '0'=>'InActive',
				            		),
            		'required'    => true,
            ))
            ->add('itineraryList', 'collection', array(
            		// each entry in the array will be an "PackageItinerary" field
            		'type'   => new PackageItineraryType(),
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
