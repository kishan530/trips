<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Trip\SiteManagementBundle\DTO\HotelRoomDto;
class HotelRoomType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        		
          ->add('roomType', 'choice', array(
            				'expanded' => false,
            				'multiple' => false,
            				'label' => 'RoomType',
            				'choices' => array(
            						'1 BHK Service Apartment'=>'1 BHK Service Apartment',
            						'2 BHK Service Apartment'=>'2 BHK Service Apartment',
            						'3 BHK Service Apartment'=>'3 BHK Service Apartment',
            						'Club Double Room'=>'Club Double Room',
            						'Standard Non A/C'=>'Standard Non A/C',
            						'Deluxe Room'=>'Deluxe Room',
            						'Single Suite Room'=>'Single Suite Room',
            						'Double Suite Room'=>'Double Suite Room',
            						'King Size Suite'=>'King Size Suite',
            						'Queen Size Suite'=>'Queen Size Suite',
            						'Standard Suite'=>'Standard Suite',
            						'Deluxe Suite'=>'Deluxe Suite',
            						'Club Suite'=>'Club Suite',
									'Executive Suite'=>'Executive Suite',
            						
            						
            				),
            				'required'    => true,))
            		
            		
            		
        			
        	->add('capacity', null, array(
            		'required'    => true,
            		'label' => 'capacity', ))
            		
       		->add('price', null, array(
            				'required'    => true,
            				'label' => 'price', ))
    ->add('id','hidden', array(
            						'required'    => true,
            						'label' => 'price', ))
             
            ->add('imagePath', 'file',array(
            				'required' => false,
            				'attr'   =>  array(
            						'class'   => 'filestyle',
            						'data-icon'   => 'false',
            						'label' => 'imagePath',
            				),
            		))
            		
            ->add('maxAdult', null, array(
            				'required'    => true,
            				'label' => 'maxAdult', ))
            				
         	 ->add('maxChild', null, array(
            						'required'    => true,
            						'label' => 'maxChild', ))
      		->add('description', null, array(
            				'required'    => true,
            				'label' => 'description', ))
            				
     		->add('name', null, array(
            				'required'    => true,
            				'label' => 'name', ))
            				
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
            				
       			->add('blockStartDate','date',array(
            						'widget'=> 'single_text',
            						'format'=>'M/d/y',
            						'required'    => false,
            						'label'     => 'block Start Date ',
            						'attr' => array('data-date-format' => 'dd/mm/yyyy')
            				
            				))
            	->add('blockEndDate','date',array(
            						'widget'=> 'single_text',
            						'format'=>'M/d/y',
            						'required'    => false,
            						'label'     => 'block End Date ',
            						'attr' => array('data-date-format' => 'dd/mm/yyyy')
            				
            				))
           		->add('sequence', null, array(
            						'required'    => true,
            						'label' => 'sequence', ))
            						
 					->add('promotionStartDate','date',array(
            								'widget'=> 'single_text',
            								'format'=>'M/d/y',
            								'required'    => false,
            								'label'     => 'Promotion Start Date ',
            								'attr' => array('data-date-format' => 'dd/mm/yyyy')
            						
            						))
            		->add('promotionEndDate','date',array(
            								'widget'=> 'single_text',
            								'format'=>'M/d/y',
            								'required'    => false,
            								'label'     => 'Promotion End Date ',
            								'attr' => array('data-date-format' => 'dd/mm/yyyy')
            						
            						))
            		->add('promotionPrice', null, array(
            								'required'    => false,
            								'label' => 'Promotion Price', ))
            		
            		->add('isDeleted', 'choice', array(
            										'expanded' => false,
            										'multiple' => false,
            										'label' => 'Status',
            										'choices' => array(
            												'1'=>'NO',
            												'0'=>'Yes',
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
            'data_class' => 'Trip\SiteManagementBundle\DTO\HotelRoomDto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_site_management_view_hotel';
    }
}
