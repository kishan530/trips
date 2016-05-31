<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Trip\SiteManagementBundle\Form\HotelAddressType;

class PackageType extends AbstractType
{
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('code')
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
        return 'trip_sitemanagementbundle_package';
    }
}
