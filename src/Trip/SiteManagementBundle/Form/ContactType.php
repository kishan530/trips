<?php

namespace Trip\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Event\DataEvent;
/**
 * This is a Form to collect the data of QuestionSearch in
 * StayBoat application.
 *
 * @author 4th Dymension Teknocrats
 * @copyright   <a> 4th Dymension Teknocrats India LLP - 2014</a>
 */
class ContactType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('firstName', null, array(
            		'required'    => true,
            		'label' => '',
            ))
            				
            ->add('lastName',null,array(
            		                
            						'required'    => false,
            						'label' => '',
				            	
            						
            				))
            ->add('email',null ,array(
            		                
            						'required'    => true,
            						'label' => '',
            						
            				))
            ->add('phoneNumber', null ,array(
            		                
            						'required'    => true,
            						'label' => '',
            						
            				))
            ->add('subject', null ,array(
            		                
            						'required'    => true,
            						'label' => '',
            						
            				))
            
            
            				
            ->add('message','textarea',array('attr' => array('rows' => '7'),
            						'required'  => true,
            				))
           
          
        ;
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\SiteManagementBundle\Entity\Contact',
            'attr' => array('id'=>'just_trip_contact')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'just_trip_contact';
    }
}