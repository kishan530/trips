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

class InsertImageType extends AbstractType
{
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	
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
        		
        ))
		/* ->add('package') */
		->add('submit', 'submit', array('label' => 'insert'))
        ;
			/* ->add('url')
            ->add('package_id')
            ->add('submit', 'submit', array('label' => 'insert'))
        ;
                   */  
    }
	/*  public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Trip\SiteManagementBundle\Entity\Employee',
            'attr' => array('class' => 'employeeform form-inline'),
        ));
    } */
    
     public function getName()
    {
        return 'trip_site_management_edit_package';
    }
     
   

       
}