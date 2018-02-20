<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Event\DataEvent;
use Trip\SiteManagementBundle\Form\HotelImageType;
use Trip\SiteManagementBundle\Form\HotelRoomType;


class HotelDetailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
	
	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('name')
            ->add('overview')
            ->add('metaTitle')
            ->add('metaKeywords')
            ->add('metaDescription')*/
        ->add('name', null, array(
        		'required'    => true,
        		'label' => 'Name', ))
        		
        ->add('overview', null, array(
        		'required'    => true,
        		'label' => 'Overview', ))
        		
        ->add('metaTitle', null, array(
        		'required'    => false,
        		'label' => 'MetaTitle', ))  
        
        ->add('metaKeywords', null, array(
        		'required'    => false,
        		'label' => 'MetaKeywords', ))
        ->add('metaDescription', null, array(
        		'required'    => false,
        		'label' => 'MetaDescription', ))
                        
            ->add('propertyType', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'label' => 'Property Type',
            		'choices' => array(
            				'Service Apartments'=>'Service Apartments',
            				'Resort'=>'Resort',
                		    'Hotel'=>'Hotel',
                		    'Guest House' => 'Guest House',
            		),
            		'required'    => true,
            ))
            ->add('category', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'label' => 'Category',
            		'choices' => array(
            				'1'=>'Service Apartment',
            				'2'=>'Hotel',
            				'3'=>'Guest House',
            				'4'=>'3 Star',
            				'5'=>'4 Star',
            				'6'=>'5 Star',
            		),
            		'required'    => true,
            ))
           // ->add('checkIn')
           // ->add('checkOut')
            ->add('price')          
           // ->add('numRooms')
            
            
            ->add('checkIn', null, array(
            		'required'    => true,
            		'label' => 'CheckIn', ))
            		
            ->add('checkOut', null, array(
            		'required'    => true,
            		'label' => 'CheckOut', ))
            		
            		->add('price',null, array(
            		    
            		    'required'    => true,
            		    'label' => 'Price',
            		))
            
            ->add('numRooms', null, array(
            		'required'    => true,
            		'label' => 'numRooms', ))
            
            
            
            
            
            ->add('priority', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'label' => 'Priority',
            		'choices' => array(          				            				
            				'5'=>'5',
            				'4'=>'4',
            				'3'=>'3',
            				'2'=>'2',
            				'1'=>'1',
            		),
            		'required'    => true,
            ))
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
           // ->add('addressLine1')
           // ->add('addressLine2')
            
            ->add('addressLine1', null, array(
            		'required'    => true,
            		'label' => 'AddressLine1', ))
            ->add('addressLine2', null, array(
            		'required'    => false,
            		'label' => 'AddressLine2', ))
            
            //->add('city')
            ->add('city', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'label' => 'City',
            		'empty_value'   => 'Select',
                'choices' => array(
                    'Tirupati'=>'Tirupati',
                    'Tirumala'=>'Tirumala',
                    'Bangalore'=>'Bangalore',
                   
                ),
            		'required'    => true,
            ))
//             ->add('location', 'choice', array(
//             		'expanded' => false,
//             		'multiple' => false,
//             		'label' => 'Location',
//             		'empty_value'   => 'Select',
//             		//	'choices' => $this->getLocations(),
//             		'required'    => true,
//             ))
           // ->add('location')
            //->add('pincode')
            ->add('location', null, array(
            		'required'    => true,
            		'label' => 'Location', ))
            ->add('pincode', null, array(
            		'required'    => true,
            		'label' => 'Pincode', ))
            
            
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
            
           
            
            ->add('hotelblockStartDate','date',array(
            		'widget'=> 'single_text',
            		'format'=>'M/d/y',
            		'required'    => false,
            		'label'     => 'hotel block Start Date',
            		'attr' => array('data-date-format' => 'dd/mm/yyyy')
            
            ))
            
            ->add('hotelblockEndDate','date',array(
            		'widget'=> 'single_text',
            		'format'=>'M/d/y',
            		'required'    => false,
            		'label'     => 'hotel block End Date',
            		'attr' => array('data-date-format' => 'dd/mm/yyyy')
            
            ))
            
           
            
            ->add('footerDisplay', 'checkbox', array(
            		'label'    => 'Display in footer',
            		'required' => false,
            ))
            
            ->add('url','text', array(
            		'label'    => 'URL',
            		'required' => true,))
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\SiteManagementBundle\DTO\HotelDto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_sitemanagementbundle_add_hotel';
    }
}
