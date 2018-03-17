<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditBikesPackageType extends AbstractType
{
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('packagename')
			->add('packageprice')
			->add('packageoffer')
            ->add('packagestatus')
			->add('packagekmlimit')
			->add('packageexcesskm')
			->add('packageadditionalkmlimit')
			->add('packageadditionalpriceday')
			->add('bikeid')
			
			;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
      $resolver->setDefaults(array(
           'data_class' => 'Trip\SiteManagementBundle\Entity\bikespackage'
       ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_site_management_edit_bikes_package';
    }
}
