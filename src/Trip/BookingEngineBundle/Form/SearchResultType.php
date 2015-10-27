<?php

namespace Trip\BookingEngineBundle\Form;

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
class SearchResultType extends AbstractType
{
	private $bookingService;
	private $catalog;
	
	public function __construct($bookingService)
	{
		$this->bookingService= $bookingService;
		$this->catalog = $bookingService->getCatalog();
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getLocations()
	{
		$locations = $this->catalog->locations;
		$tempLocations = array();
		foreach ($locations as $location){
		$tempLocations[$location] = $location;
		}
		return $tempLocations;
	}
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        $builder
            ->add('goingFrom', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'choices' => $this->getLocations(),
            		'required'    => true,
            		'empty_value'   => 'Location'
            ))
             ->add('goingTo', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'choices' => $this->getLocations(),
            		'required'    => true,
            		'empty_value'   => 'Location'
            ))
           
            ->add('arrivalTime','text',array(
            						'required'    => true,
            						'label' => 'From Date',
				            		'attr'   =>  array(
				            				'data-date-format'=>'dd/mm/yyyy',
				            		),
            		
            				))
            ->add('departureTime','text',array(            						
            						'required'    => true,
            						'label' => 'To Date',
            						'read_only' => true,
            						'attr'   =>  array(
            								'data-date-format'=>'dd/mm/yyyy',
            						),
            		            
            				))
        
          ->add('price')
          
        ;
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boat\Bundles\BookingEngineBundle\DTO\SearchFilter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stayboat_search_result';
    }
}