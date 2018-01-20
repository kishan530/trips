<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditBikesType extends AbstractType
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
			->add('fivehours')
			->add('dayrent')
			//->add('imgpath')
			->add('locationurl')
			->add('soldOut', 'choice', array(
			    'expanded' => false,
			    'multiple' => false,
			    'label' => 'Sold Out',
			    'choices' => array(
			        '0'=>'No',
			        '1'=>'Yes',
			        
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
           'data_class' => 'Trip\SiteManagementBundle\Entity\bikes'
       ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_site_management_bikes_list';
    }
}
