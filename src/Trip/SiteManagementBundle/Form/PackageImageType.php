<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\EntityRepository;
/**
 * This is a Form to collect the data of BulkFileUpload in
 * Drivekool application.
 */
class PackageImageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('url', 'file',array(
        		'required' => false,
        		'data_class' => null,
        		'label'=>'Image',
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
    			'data_class' => 'Trip\SiteManagementBundle\Entity\PackageImages'
    	));
    }
    
 
    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_sitemanagementbundle_package_image';
    }
}
