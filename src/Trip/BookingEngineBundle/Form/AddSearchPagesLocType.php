<?php

namespace Trip\BookingEngineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddSearchPagesLocType extends AbstractType
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
            if($location->getActive()){
                $tempLocations[$location->getId()] = $location->getName();
            }
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
            ->add('title')
            ->add('metaTitle')
            ->add('metakeywords')
            ->add('metades')
            ->add('title')
            ->add('picklocation', 'choice', array(
                'expanded' => false,
                'multiple' => false,
                'data'=>1,
                'choices' => $this->getLocations(),
                'required'    => true,
            ))
            ->add('droplocation', 'choice', array(
                'expanded' => false,
                'multiple' => false,
                'data'=>1,
                'choices' => $this->getLocations(),
                'required'    => true,
            ))
            ->add('url')
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
            'data_class' => 'Trip\BookingEngineBundle\Entity\Destinationlocations'
            
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_booking_engine_add_searchpagesloc';
    }
}
