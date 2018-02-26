<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Trip\SiteManagementBundle\Form\HotelAddressType;

class HotelType extends AbstractType
{
    private $bookingService;
	private $catalouge;
	
	public function __construct($bookingService)
	{
		$this->bookingService= $bookingService;
		$this->catalouge = $bookingService->getCatalog();
	}
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('imagePath',null, array('label' => 'Image','required'    => false))
            ->add('numRooms')
             ->add('active', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'Status',
            		'choices' => array(
                                        '1'=>'active',
                                        '0'=>'non-active',
				            		),
            		'required'    => true,
                    'attr'   =>  array(
                                        'class'=>'selectpicker',
                                        'data-style'=>'btn-white',
				            		),
            ))
            ->add('address',new HotelAddressType($this->catalouge))
             ->add('submit', 'submit', array('label' => 'submit'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\SiteManagementBundle\Entity\Hotel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_sitemanagementbundle_hotel';
    }
}
