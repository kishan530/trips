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


class PriceviewbikesType extends AbstractType
{
	private $bookingService;
	private $catalog;
	
	/*public function __construct($bookingService)
	{
		$this->bookingService= $bookingService;
		$this->catalog = $bookingService->getCatalog();
	}*/
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('location', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'label' => 'Location',
					'required'    => true,
            		'choices' => array(
							'Tirupati' => 'Tirupati',
							'Bangalore' => 'Bangalore'
							),
            		
                    
            ))
        ->add('date','datetime',array(
        		'required'    => true,
        		'label' => 'Pick Up Date & Time',
        		'widget'=> 'single_text',
        		'input' => 'datetime',
        		//'format'=>'d/M/y h:m A',
        		'format' => 'yyyy-MM-dd H:mm',
        		'attr'   =>  array(
        				'data-date-format'=>'yyyy-MM-dd HH:mm:ss',
        				//'data-date-format'=>'dd/mm/yyyy HH:mm:ss',
        				//'placeholder'=>'Date',
        				//'class'=>'preferDate'
        				//'class'=>'date',
        				//'name' => 'date',
        		),
        		
        ))
        /*->add('preferTime','datetime',array(
        		'required'    => false,
        		'label' => 'Prefer Time',
        		'widget'=> 'single_text',
        		'format'=>'h:m A',
        		//'input'=>'string',
        		'attr' => array( 'class'=>'preferTime'),
        		//'widget' => 'single_text',
        		
        )) */
        ->add('returndate','datetime',array(
        		'required'    => true,
        		'label' => 'Return Date & Time',
        		'widget'=> 'single_text',
        		'input' => 'datetime',
        		//'format'=>'d/M/y h:m A',
        		'format' => 'yyyy-MM-dd H:mm',
        		'attr'   =>  array(
        				'data-date-format'=>'yyyy-MM-dd HH:mm:ss',
        				//'data-date-format'=>'dd/mm/yyyy',
        				//'placeholder'=>'Date',
        				//'class'=>'preferDate'
        		),
        		
        ))
        /*->add('returnTime','datetime',array(
        		'required'    => false,
        		'label' => 'Return Time',
        		'widget'=> 'single_text',
        		'format'=>'h:m A',
        		//'input'=>'string',
        		'attr' => array( 'class'=>'preferTime'),
        		//'widget' => 'single_text',
        		
        )) */
       ->add('submit', 'submit', array('label' => 'submit'))
        ;
    }
    

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_sitemanagementbundle_price_viewbikes';
    }
}