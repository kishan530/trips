<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditHotelType extends AbstractType
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
			->add('city')
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
            ->add('checkIn', null, array(
                'required'    => true,
                'label' => 'CheckIn', ))
                
                ->add('checkOut', null, array(
                    'required'    => true,
                    'label' => 'CheckOut', ))
                    
                    ->add('address',new HotelAddressType($this->catalouge))
                    ->add('soldout')
                    ->add('date','text',array(
                        
                        'required'    => false,
                        'label'     => ' block Start Date',
                        'attr' => array('data-date-format' => 'dd/mm/yyyy')
                        
                    ))
                    
                    ->add('blockEndDate','date',array(
                        'widget'=> 'single_text',
                        'format'=>'M/d/y',
                        'required'    => false,
                        'label'     => ' block End Date',
                        'attr' => array('data-date-format' => 'dd/mm/yyyy')
                        
                    ))
           
                    ->add('imageList', 'collection', array(
                        // each entry in the array will be an "PackageItinerary" field
                        'type'   => new HotelImageType(),
                        'allow_add'    => true,
                        'prototype'=>true,
                        'required'    => false,
                        // these options are passed to each "PackageItinerary" type
                        //'entry_options'  => array(
                        //   'attr'      => array('class' => '')
                        //),
                    ))
                    
                    ->add('roomList', 'collection', array(
                        // each entry in the array will be an "PackageItinerary" field
                        'type'   => new HotelRoomType(),
                        'allow_add'    => true,
                        'prototype'=>true,
                        //'required'    => false,
                        // these options are passed to each "PackageItinerary" type
                        //'entry_options'  => array(
                        //   'attr'      => array('class' => '')
                        //),
                    ))
			
           
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
        return 'trip_sitemanagementbundle_edit_hotel';
    }
}
