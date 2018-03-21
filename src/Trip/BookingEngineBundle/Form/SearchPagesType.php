<?php

namespace Trip\BookingEngineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SearchPagesType extends AbstractType
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
        $locations = $this->catalog->getLocations();
        $tempLocations = array();
        foreach ($locations as $location){
            $tempLocations[$location->getId()] = $location->getName();
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
        ->add('name', 'choice', array(
            'expanded' => false,
            'multiple' => false,
            'data'=>1,
            'choices' => $this->getLocations(),
            'required'    => true,
        ))
        ->add('desturl')
        ->add('active', 'choice', array(
            'expanded' => false,
            'multiple' => false,
            'label' => 'Active',
            'choices' => array(
                '1'=>'Yes',
                '0'=>'No',
                
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
          'data_class' => 'Trip\BookingEngineBundle\Entity\Destinations'
       ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_booking_engine_edit_searchpages';
    }
}
