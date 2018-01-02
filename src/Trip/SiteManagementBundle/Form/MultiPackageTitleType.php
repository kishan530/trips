<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MultiPackageTitleType extends AbstractType
{
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
			->add('metatitle')
			->add('metakeywords','textarea')
            ->add('metadescription','textarea')
			->add('statingprice')
			->add('imgpath')
			->add('locationurl')
			->add('type', 'choice', array(
			    'expanded' => false,
			    'multiple' => false,
			    'label' => 'Pacakge Type',
			    'required'    => true,
			    'choices' => array(
			        'One' => 'One',
			        'Two' => 'Two'
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
           'data_class' => 'Trip\SiteManagementBundle\Entity\PackageTitle'
       ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_sitemanagementbundle_multipackage_title';
    }
}
