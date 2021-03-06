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


class AddBikeCityAreaType extends AbstractType
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
        $locations = $this->bookingService->getLocations();
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
        ->add('cityid', 'choice', array(
            'expanded' => false,
            'multiple' => false,
            'data'=>1,
            'choices' => $this->getLocations(),
            'required'    => true,
        ))
        ->add('area')
        ->add('soldout', 'choice', array(
            'expanded' => false,
            'multiple' => false,
            'label' => 'Sold Out',
            'choices' => array(
                '0'=>'No',
                '1'=>'Yes',
                
            ),
            'required'    => true,
        ))
        ->add('count')
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
            'data_class' => 'Trip\SiteManagementBundle\Entity\BikesCityArea'
        ));
    }
    

    /**
     * @return string
     */
    public function getName()
    {
        return 'trip_site_management_add_bikecityarea';
    }
}